<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link type="text/css" rel="styleSheet" href="../css/regStyle.css">
</head>
<body>
<<<<<<< Updated upstream
    <header>
        <a href="/"><img src="images/logo.png" alt="Logo"></a>
        <h1>Registration</h1>
    </header>

    <form action="register.php?<?php echo $identity; ?>" method="post">
        <?php include('error.php'); ?>
        <div>
            <label>Email</label>
            <input type="email" name="email">
=======

    <?php include_once("content/header.php"); ?>

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-6 col-md-offset-3">
            <h1>Registeration</h1>
                <form method="POST" action="register.php">
                    <?php include("error.php"); ?>

                    <label>Email</label>
                    <input class="input_box form-control" type="email" name="email">
                    <label>Password</label>
                    <input class="input_box form-control" type="password" name="password">
                    <label>Confirm Password</label>
                    <input class="input_box form-control" type="password" name="passwordConfirm">

                    <label>First Name</label>
                    <input class="input_box form-control" type="text" name="firstName">
                    <label>Last Name</label>
                    <input class="input_box form-control" type="text" name="lastName">
                    <label>Address</label>
                    <input class="input_box form-control" type="text" name="address">
                    <label>Contact Number</label>
                    <input class="input_box form-control" type="text" name="contactNum">

                    <button type="submit" name="register" class="btn btn-danger">Register</button>
                </form>
            </div>
>>>>>>> Stashed changes
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password">
            <label>Confirm Password</label>
            <input type="password" name="passwordConfirm">
        </div>
        <div>
            <label>First Name</label>
            <input type="text" name="firstName">
            <label>Last Name</label>
            <input type="text" name="lastName">
        </div>
        <div>
            <button type="submit" name="reg">Register</button>
        </div>
    </form>
</body>

</html>
