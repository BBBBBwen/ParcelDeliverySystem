<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link type="text/css" rel="styleSheet" href="../css/regStyle.css">
</head>
<body>
    <header>
        <a href="/"><img src="images/logo.png" alt="Logo"></a>
        <h1>Registration</h1>
    </header>

    <form action="register.php?<?php echo $identity; ?>"" method="post">
        <?php include('error.php'); ?>
        <div>
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>">
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password">
            <label>Confirm Password</label>
            <input type="password" name="passwordConfirm">
        </div>
        <div>
            <label>First Name</label>
            <input type="text" name="firstName" value="<?php echo $firstName; ?>">
            <label>Last Name</label>
            <input type="text" name="lastName" value="<?php echo $lastName; ?>">
        </div>
        <div>
            <button type="submit" name="reg">Register</button>
        </div>
    </form>
</body>

</html>
