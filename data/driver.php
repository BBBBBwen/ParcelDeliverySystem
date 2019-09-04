<?php
session_start();

$db = mysqli_connect('localhost', 'root', '19910225', 'registration');

$result = mysqli_query($db,"SELECT * FROM parcelDetail WHERE status='processing' LIMIT 1");
if(isset($_SESSION["id"])) $result = mysqli_query($db,"SELECT * FROM parcelDetail WHERE id=$_SESSION['id'] LIMIT 1");
$user = mysqli_fetch_array($result);

$id = $user['id'];
$parcelName = $user['parcelName'];
$senderAddress = $user['senderAddress'];
$recieverName = $user['recieverName'];
$recieverAddress = $user['recieverAddress'];
$recieverPhoneNumber = $user['recieverPhoneNumber'];
$pickUpDate = $user['pickUpDate'] == null ? '-' : $user['pickUpDate'];
$endDate = $user['endDate'] == null ? '-' : $user['endDate'];
$status = $user['status'];

if(isset($_POST['pickUp'])) {
    $currentDate = date('Y/m/d H:i:s');
    mysqli_query($db,"UPDATE parcelDetail SET status='delivering', pickUpDate='$currentDate' WHERE parcelName='$parcelName'");
    $_SESSION['id'] = $id;
    header("Refresh:0");
}

if(isset($_POST['delivered'])) {
    $currentDate = date('Y/m/d H:i:s');
    mysqli_query($db,"UPDATE parcelDetail SET status='done', endDate='$currentDate' WHERE parcelName='$parcelName'");
    if(isset($_SESSION["id"])){
        unset($_SESSION["id"]);
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
        <h2>Current Job</h2>
        <form action='<?php $_SEVER['PHP_SELF'];?>' method='POST'>
        <div>
            parcelName: <p><?php echo $parcelName; ?></p>
        </div>
        <div>
            senderAddress: <p><?php echo $senderAddress; ?></p>
        </div>
        <div>
            recieverName: <p><?php echo $recieverName; ?></p>
        </div>
        <div>
            recieverAddress: <p><?php echo $recieverAddress; ?></p>
        </div>
        <div>
            recieverPhoneNumber: <p><?php echo $recieverPhoneNumber; ?></p>
        </div>
        <div>
            pickUpDate: <p><?php echo $pickUpDate; ?></p>
        </div>
        <div>
            endDate: <p><?php echo $endDate; ?></p>
        </div>
        <div>
            status: <p><?php echo $status; ?></p>
        </div>
        <button type='submit' name='pickUp'>
            <a>pick Up</a>
        </button>
        <button type='submit' name='delivered'>
            <a>Delivered</a>
        </button>
        </form>
    </main>
</body>

</html>
