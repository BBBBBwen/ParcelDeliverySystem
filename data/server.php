<?php
session_start();

$errors = array();
$identity = $_SERVER['QUERY_STRING'];

require 'connectDB.php';

if(isset($_POST['reg'])) {
    if (empty($_POST['email'])) array_push($errors, "empty email");
    if (empty($_POST['password'])) array_push($errors, "empty password");
    if ($_POST['password'] != $_POST['passwordConfirm']) array_push($errors, "password do not match");
    if (empty($_POST['firstName'])) array_push($errors, "empty first name");
    if (empty($_POST['lastName'])) array_push($errors, "empty last name");

    $sql = "SELECT COUNT(email) AS num FROM $identity WHERE email=:email";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $_POST['email']);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row['num'] > 0)
        array_push($errors, "email already exists");

    if (count($errors) == 0) {
        $sql = "INSERT INTO ".$identity." (email, password, firstName, lastName)
  			      VALUES(:email, :password, :firstName, :lastName)";
  	    $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $_POST['email']);
        $stmt->bindValue(':password', $_POST['password']);
        $stmt->bindValue(':firstName', $_POST['firstName']);
        $stmt->bindValue(':lastName', $_POST['lastName']);
        $result = $stmt->execute();
        if($result) header('location: ../index.php');
        else array_push($errors, "fail to register");
    }
}

if(isset($_POST['login'])) {
    if (empty($_POST['email'])) { array_push($errors, "empty email"); }
    if (empty($_POST['password'])) { array_push($errors, "empty password"); }

    if (count($errors) == 0) {
        $query = "SELECT * FROM $identity WHERE email=:email AND password=:password";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':email', $_POST['email']);
        $stmt->bindValue(':password', $_POST['password']);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            $_SESSION['username'] = $user['firstName']." ".$user['lastName'];
            $_SESSION['id'] = $user['id'];
            header("Location: ".$identity.".php");
        } else {
            array_push($errors, "Wrong login information");
        }
    }
}

?>
