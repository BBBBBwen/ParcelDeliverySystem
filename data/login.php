<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link type="text/css" rel="styleSheet" href="../css/regStyle.css">
</head>
<body>
    <header>
        <a href="/"><img src="images/logo.png" alt="Logo"></a>
        <h1>Login</h1>
    </header>

    <form method="post" action="login.php?<?php echo $identity; ?>"">
        <?php include('error.php'); ?>
        <div>
            <label>email</label>
  		    <input type="email" name="email" >
  	    </div>
  	    <div>
  		    <label>Password</label>
  		    <input type="password" name="password">
  	    </div>
  	<div>
  		<button type="submit" name="login">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php?<?php echo $identity; ?>">Sign up</a>
  	</p>
  </form>
</body>

</html>
