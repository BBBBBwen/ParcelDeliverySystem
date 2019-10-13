<?php
session_start();
require 'connectDB.php';
if(isset($_SESSION['id'])) {
    $geocodeFromLatLong = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=".$_COOKIE['co']."&sensor=false&key=AIzaSyB4VlCHHZgZ1rrsEY9S-LtYdMz-f858Dig");
    $output = json_decode($geocodeFromLatLong);
    $status = $output->status;
    $address = ($status=="OK")?$output->results[1]->formatted_address:'';

    $sql = "UPDATE drivers SET lastKnowPosition = :lastKnowPosition WHERE id=:id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':lastKnowPosition', $address);
    $stmt->bindValue(':id', $_SESSION['id']);
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
