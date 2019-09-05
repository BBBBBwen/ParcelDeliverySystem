<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF8">
    <title>Parcel Delivery System</title>
    <link id='styleCss' type="text/css" rel="styleSheet" href="css/indexStyle.css">
</head>

<body>
    <header>
        <a href="/"><img src="images/logo.png" alt="Logo"></a>
        <h1>Put Something here in full width</h1>
    </header>
    <main>
        <div class='div1' class='tab'>
            <h2>Customer</h2>
            <button type='button' class='link'>
                <a href="data\login.php?customer">Login</a>
            </button><br>
            <button type='button' class='link'>
                <a href="data\register.php?customer">Sign Up</a>
            </button>
        </div>
        <div class='div2'>
            <h2>Driver</h2>
            <button type='button' class='link'>
                <a href="data\login.php?driver">Login</a>
            </button><br>
            <button type='button' class='link'>
                <a href="data\register.php?driver">Sign Up</a>
            </button>
        </div>
        <div class='div3'>
            <h2>Administrator</h2>
            <button type='button' class='link'>
                <a href="data\login.php?admin">Login</a><br>
            </button>
        </div>
    </main>
    <footer>
        <span>ISYS1106-Software Engineering Project Management
            <script>
                document.write(new Date().getFullYear());
            </script><br>
            Team Member:<br>
        </span>
    </footer>
</body>

</html>