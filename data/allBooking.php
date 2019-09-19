<?php
include("serverV2.php");
include("getAllBooking.php");i
?>
<!DOCTYPE html>
<html>

<?php include_once("content/head.php"); ?>

<body>
    
    <?php include_once("content/header.php"); ?>

    <div class="container">
        <div class="col-md-12">
            <h1>Current Booking</h1>

            <table border='1'>
                <tr>
                    <th>Parcel ID</th>
                    <th>Parcel Name</th>
                    <th>Receiver Name</th>
                    <th>Receiver Address</th>
                    <th>Receiver Phone Number</th>
                    <th>Status</th>
                    <th>Timestamp</th>
                </tr>
                <?php
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>". $row['parcelID'] ."</td>";
                    echo "<td>". $row['parcelName'] ."</td>";
                    echo "<td>". $row['receiverName'] ."</td>";
                    echo "<td>". $row['receiverAddress'] ."</td>";
                    echo "<td>". $row['receiverPhone'] ."</td>";
                    echo "<td>". $row['status'] ."</td>";
                    echo "<td>". $row['timestamp'] ."</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>

    <?php include_once("content/foot.php"); ?>
</body>
</html>
