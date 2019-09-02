<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link rel="regStyle" type="text/css" href="../css/regStyle.css"
</head>
<body>
    <header>
        <a href="/"><img src="images/logo.png" alt="Logo"></a>
        <h1>Registration</h1>
    </header>

    <form method="post" action="register.php">
        <?php if(count($errors) > 0) : ?>
            <div class="error">
                <?php foreach($errors as $error) : ?>
                    <p><?php echo $error ?></p>
                <?php endforeach ?>
            </div>
        <?php endif ?>
        <div>
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>">
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password">
        </div>
        <div>
            <label>Confirm Password</label>
            <input type="password" name="passwordConfirm">
        </div>
        <div>
            <label>Username</label>
            <input type="text" name="username" value="<?php echo $username; ?>">
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
