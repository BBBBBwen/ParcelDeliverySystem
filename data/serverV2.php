<?php
session_start();

$errors = array();
$identity = $_SERVER['QUERY_STRING'];

require 'connectDB.php';

if(isset($_POST['login'])) {
    if (empty($_POST['email'])) { array_push($errors, "empty email"); }
    if (empty($_POST['password'])) { array_push($errors, "empty password"); }

    if (count($errors) == 0) {

        $query = "SELECT * FROM users WHERE email=:email";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':email', $_POST['email']);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($_POST['password'], $user['password'])) {
            if(isset($_SESSION['id'])) {
                unset($_SESSION['id']);
            }

            $_SESSION['id'] = $user['id'];

            if($user['is_customer'] > 0) {

                $_SESSION['user'] = $user['is_customer'];

                $query = "SELECT * FROM customers WHERE id=:id";
                $stmt = $db->prepare($query);
                $stmt->bindValue(':id', $user['id']);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                $_SESSION['firstName'] = $user['firstName'];
                $_SESSION['lastName'] = $user['lastName'];
                $_SESSION['address'] = $user['address'];
                $_SESSION['email'] = $_POST['email'];

                header("Location: customerV2.php");
            } else if($user['is_driver'] > 0) {
                $_SESSION['driver'] = $user['is_driver'];

                $query = "SELECT * FROM drivers WHERE id=:id";
                $stmt = $db->prepare($query);
                $stmt->bindValue(':id', $user['id']);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC); 
                $_SESSION['firstName'] = $user['firstName'];
                $_SESSION['lastName'] = $user['lastName'];
                $_SESSION['address'] = $user['address'];
                $_SESSION['email'] = $_POST['email'];

                driverLogon($user['id'], $db);

                header("Location: driverV2.php");
            } else if($user['is_admin'] > 0) {

            }
        } else {
            array_push($errors, "Wrong login information");
        }
    }
}

if(isset($_POST['register'])) {
    if (empty($_POST['email'])) { 
        array_push($errors, "Please enter your email!");
    }

    if (empty($_POST['password'])) { 
        array_push($errors, "Password cannot be empty!");
    }

    if ($_POST['password'] != $_POST['passwordConfirm']) {
        array_push($errors, "Password mismatch!");
    }

    if (empty($_POST['firstName'])) {
        array_push($errors, "Please enter your First name!");
    }

    if (empty($_POST['lastName'])) {
        array_push($errors, "Please enter your Last name!");
    }

    $sql = "SELECT COUNT(email) AS num FROM users WHERE email=:email";
    
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $_POST['email']);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row['num'] > 0) {
        array_push($errors, "email already exists");
    } 

    if(count($errors) == 0) {
        $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (email, password)
  			      VALUES(:email, :password)";
  	    $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $_POST['email']);
        $stmt->bindValue(':password', $hash);
        $result = $stmt->execute();
        $lastId = $db->lastInsertId();

        $sql = "INSERT INTO customers (id, firstName, lastName, address)
                    VALUES(:id, :firstName, :lastName, :address)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $lastId);
        $stmt->bindValue(':firstName', $_POST['firstName']);
        $stmt->bindValue(':lastName', $_POST['lastName']);
        $stmt->bindValue(':address', $_POST['address']);
        $result = $stmt->execute();

        if($result) {
            header('location: /');
        } else {
            array_push($errors, "fail to register");
        }
    }
}

if(isset($_POST['save'])) {
   if(empty($_POST['firstName'])) {
       array_push($errors, "First Name cannot be empty!");
   }

   if(empty($_POST['lastName'])) {
       array_push($errors, "Last Name cannot be empty!");
   }

   if(empty($_POST['address'])) {
       array_push($errors, "Address cannot be empty!");
   }

   if(count($errors) == 0) {
       $sql = "UPDATE customers SET firstName=?, lastName=?, address=? WHERE id=?";
       $stmt =$db->prepare($sql);
       $result = $stmt->execute([$_POST['firstName'], $_POST['lastName'], $_POST['address'], $_SESSION['id']]);
       
       if($result) {
           $_SESSION['firstName'] = $_POST['firstName'];
           $_SESSION['lastName'] = $_POST['lastName'];
           $_SESSION['address'] = $_POST['address'];

           header("Refresh:0");
       } else {
           array_push($errors, "Update failed!");
       }
   }
}

if(isset($_POST['booking'])) {
    if(empty($_POST['receiverName'])) {
        array_push($errors, "Receiver name cannot be empty!");
    }

    if(empty($_POST['receiverAddress'])) {
        array_push($errors, "Receiver address cannot be empty!");
    }

    if(empty($_POST['receiverPhone'])) {
        array_push($errors, "Receiver phone cannot be empty!");
    }

    if(count($errors) == 0) {
        $sql = "INSERT INTO bookings (parcelID, customerID, parcelName, receiverName, receiverAddress, receiverPhone) VALUES(?,?,?,?,?,?)";

        $stmt = $db->prepare($sql);
        $parcelID = date("Ymdhis").'-'.$_SESSION['id'];
        $result = $stmt->execute([$parcelID, $_SESSION['id'], $_POST['parcelName'], $_POST['receiverName'], $_POST['receiverAddress'], $_POST['receiverPhone']]);

        if($result) {
            header("Location: allBooking.php?type=current");
        } else {
            array_push($errors, "Fail to book job");
        }
    }
}

function driverLogon($id, $db) {
    $sql = "UPDATE drivers SET status='online' WHERE id=?";
    $stmt = $db->prepare($sql);
    $result = $stmt->execute([$id]);
}

if($_SESSION['user']) {
    $path = 'customerV2.php';
} else if($_SESSION['driver']) {
    $path = 'driverV2.php';
} else {
    $path = '/';
}

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .');';
    echo '</script>';
}
?>
