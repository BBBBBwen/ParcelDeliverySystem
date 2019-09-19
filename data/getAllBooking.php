<?php

if($_GET['type'] == "current") {
    $status = "< 3";
} else {
    $status = "= 3";
}

$sql = "SELECT a.parcelID, a.parcelName, a.receiverName, a.receiverAddress, a.receiverPhone, b.status, a.timestamp FROM bookings a JOIN parcel_status b ON a.parcelStatus = b.id WHERE a.customerID = ? AND a.parcelStatus ".$status; 
$stmt = $db->prepare($sql);
$stmt->execute([$_SESSION['id']]);

?>
