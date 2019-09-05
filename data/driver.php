<?php
session_start();

require 'connectDB.php';

$sql = "SELECT * FROM parcel WHERE status='processing' LIMIT 1";
if(isset($_SESSION['parcelID'])) $sql = "SELECT * FROM parcel WHERE id=:id";
$stmt = $db->prepare($sql);
$stmt->bindValue(':id', $_SESSION['parcelID']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['pickUp'])) {
    $currentDate = date('Y/m/d H:i:s');
    $sql = "UPDATE parcel SET driverID = :driverID, status='delivering', pickUpDate=:currentDate WHERE id=:id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':driverID', $_SESSION['id']);
    $stmt->bindValue(':currentDate', $currentDate);
    $stmt->bindValue(':id', $user['id']);
    $stmt->execute();

    $_SESSION['parcelID'] = $user['id'];
    header("Refresh:0");
}

if(isset($_POST['delivered'])) {
    $currentDate = date('Y/m/d H:i:s');
    $sql = "UPDATE parcel SET status='done', endDate=:currentDate WHERE id=:id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':currentDate', $currentDate);
    $stmt->bindValue(':id', $_SESSION['parcelID']);
    $stmt->execute();
    if(isset($_SESSION["parcelID"])){
        unset($_SESSION["parcelID"]);
    }
    header("Refresh:0");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF8">
    <title>Driver</title>
    <link id='styleCss' type="text/css" rel="styleSheet" href="../css/datailStyle.css">
</head>

<body>
    <header>
        <a href="/"><img src="images/logo.png" alt="Logo"></a>
        <h1>Welcome <?php echo $_SESSION['username']; ?></h1>
    </header>
    <main>
        <?php if($user) : ?>
        <h2>Current Job</h2>
        <form action='<?php $_SEVER['PHP_SELF'];?>' method='POST'>
        <div>
            parcelName: <p><?php echo $user['parcelName']; ?></p>
        </div>
        <div>
            senderAddress: <p><?php echo $user['senderAddress']; ?></p>
        </div>
        <div>
            recieverName: <p><?php echo $user['recieverName']; ?></p>
        </div>
        <div>
            recieverAddress: <p><?php echo $user['recieverAddress']; ?></p>
        </div>
        <div>
            recieverPhoneNumber: <p><?php echo $user['recieverPhoneNumber']; ?></p>
        </div>
        <div>
            pickUpDate: <p><?php echo $user['pickUpDate']; ?></p>
        </div>
        <div>
            endDate: <p><?php echo $user['endDate']; ?></p>
        </div>
        <div>
            status: <p><?php echo $user['status']; ?></p>
        </div>
        <button type='submit' name='pickUp'>
            <a>pick Up</a>
        </button>
        <button type='submit' name='delivered'>
            <a>Delivered</a>
        </button>
        </form>
        <?php endif; ?>
    </main>
</body>

</html>
