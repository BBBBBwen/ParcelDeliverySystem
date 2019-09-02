<?php
session_start();

function getIdentity() {
    return 'registration';
}

$email = "";
$firstName = "";
$lastName = "";
$errors = array();
$dbName = getIdentity();

//need to change when connectting to cloud
#db = mysqli_connect('localhost', 'root', '', $dbName);

if(isset($_POST['reg'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $passwordConfirm = mysqli_real_escape_string($db, $_POST['passwordConfirm']);
    $firstName = mysqli_real_escape_string($db, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($db, $_POST['lastName']);

    if (empty($email)) { array_push($errors, "empty email"); }
    if (empty($password)) { array_push($errors, "empty password"); }
    if ($password != $passwordConfirm) {array_push($errors, "password do not match");}
    if (empty($firstName)) { array_push($errors, "empty first name"); }
    if (empty($lastName)) { array_push($errors, "empty last name"); }

    $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if ($user['email'] === $email)
            array_push($errors, "email already exists");
    }

    if (count($errors) == 0) {
        $query = "INSERT INTO users (email, password, firstName, lastName)
  			      VALUES('$email', '$password', 'firstName', 'lastName')";
  	    mysqli_query($db, $query);
        header('location: ../index.html');
    }
}

if(isset($_POST['login'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($email))
        array_push($errors, "empty email");
    if (empty($password))
        array_push($errors, "empty password");

    if (count($errors) == 0) {
        $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $firstName." ".$lastName;
            header('location: ../index.html');
        } else {
            array_push($errors, "Wrong login information");
        }
    }
}

?>