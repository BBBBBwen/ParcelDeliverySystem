<?php
session_start();

$errors = array();
require 'connectDB.php';

$sql = "SELECT * FROM customer WHERE id=:id";
$stmt = $db->prepare($sql);
$stmt->bindValue(':id', $_SESSION['id']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['save'])) {
    if (empty($_POST['email'])) array_push($errors, "empty email");
    if (empty($_POST['firstName'])) array_push($errors, "empty first name");
    if (empty($_POST['lastName'])) array_push($errors, "empty last name");
    if (empty($_POST['address'])) array_push($errors, "empty address");

    if (count($errors) == 0) {
        $sql = "UPDATE customer SET email=:email, firstName=:firstName, lastName=:lastName, address=:address WHERE id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $_POST['email']);
        $stmt->bindValue(':firstName', $_POST['firstName']);
        $stmt->bindValue(':lastName', $_POST['lastName']);
        $stmt->bindValue(':address', $_POST['address']);
        $stmt->bindValue(':id', $_SESSION['id']);
        $result = $stmt->execute();
        if($result) header("Refresh:0");
        else array_push($errors, "update failed");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF8">
    <title>Driver</title>
    <link id='styleCss' type="text/css" rel="styleSheet" href="../css/profileStyle.css">
</head>

<body>
    <header>
        <a href="/"><img src="images/logo.png" alt="Logo"></a>
        <h1><?php echo $_SESSION['username']; ?></h1>
    </header>
    <main>
    <form action="<?php $_SEVER['PHP_SELF'];?>" method="post">
        <?php include('error.php'); ?>
        <div>
            <label>Email</label>
            <input type="email" name="email" value = "<?php echo $user['email'] ?>" >
        </div>
        <div>
            <label>First Name</label>
            <input type="text" name="firstName" value = "<?php echo $user['firstName'] ?>">
        </div>
        <div>
            <label>Last Name</label>
            <input type="text" name="lastName" value = "<?php echo $user['lastName'] ?>">
        </div>
        <div>
            <label>address</label>
            <input type="text" name="address" value = "<?php echo $user['address'] ?>">
        </div>
        <div>
            <button type="submit" name="save">Save</button>
        </div>
    </form>
    </main>
</body>
</html>
