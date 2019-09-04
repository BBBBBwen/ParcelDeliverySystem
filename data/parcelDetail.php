<?php
$name = $_SERVER['QUERY_STRING'];

$db = mysqli_connect('localhost', 'root', '19910225', 'registration');
$result = mysqli_query($db,"SELECT * FROM parcelDetail WHERE parcelName='$name' LIMIT 1");
$user = mysqli_fetch_array($result);

$senderAddress = $user['senderAddress'];
$recieverName = $user['recieverName'];
$recieverAddress = $user['recieverAddress'];
$recieverPhoneNumber = $user['recieverPhoneNumber'];
$pickUpDate = $user['pickUpDate'] == null ? '-' : $user['pickUpDate'];
$endDate = $user['endDate'] == null ? '-' : $user['endDate'];
$status = $user['status'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF8">
    <title>Parcel detail</title>
    <link id='styleCss' type="text/css" rel="styleSheet" href="../css/detailStyle.css">
</head>

<body>
    <header>
        <a href="/"><img src="images/logo.png" alt="Logo"></a>
        <h1><?php echo $name; ?></h1>
    </header>
    <main>
        <div>
            <label>senderAddress</label>
            <p><?php echo $senderAddress; ?></p>
        </div>
        <div>
            <label>recieverName</label>
            <p><?php echo $recieverName; ?></p>
        </div>
        <div>
            <label>recieverAddress</label>
            <p><?php echo $recieverAddress; ?></p>
        </div>
        <div>
            <label>recieverPhoneNumber</label>
            <p><?php echo $recieverPhoneNumber; ?></p>
        </div>
        <div>
            <label>pickUpDate</label>
            <p><?php echo $pickUpDate; ?></p>
        </div>
        <div>
            <label>endDate</label>
            <p><?php echo $endDate; ?></p>
        </div>
        <div>
            <label>status</label>
            <p><?php echo $status; ?></p>
        </div>

    </main>

</body>

</html>
