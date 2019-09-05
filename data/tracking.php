<?php
session_start();
require 'connectDB.php';
if(isset($_SESSION['driverID'])) {
    $sql = "UPDATE driver SET lastKnowCoordinate = :lastKnowCoordinate WHERE id=:id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':lastKnowCoordinate', $_COOKIE['co']);
    $stmt->bindValue(':id', $_SESSION['driverID']);
    $stmt->execute();
} else {
    echo "Tracking not available";
}
?>

<script>
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    }
}

function showPosition(position) {
    document.cookie = "co=" + position.coords.latitude + "," + position.coords.longitude;
}
getLocation();
</script>
