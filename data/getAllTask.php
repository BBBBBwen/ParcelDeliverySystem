<?php

$sql = "select b.parcelID, c.firstName, c.lastName, b.receiverName, p.pickedDate, p.deliveredDate from parcels p JOIN bookings b ON p.customerID = b.customerID JOIN customers c ON c.id = p.customerID where p.driverID = ".$_SESSION['id'];
$stmt = $db->prepare($sql);
$stmt->execute();

?>
