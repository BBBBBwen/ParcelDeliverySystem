<?php 
include("serverV2.php"); 
include("getAllTask.php");
?>
<!DOCTYPE html>
<html>

<?php include_once("content/head.php"); ?>

<body>

    <?php include_once("content/header.php"); ?>

    <div class="container">
        <div class="col-md-12">
            <h1>All Task</h1>
            <table border='1'>
                <tr>
                    <th>Parcel ID</th>
                    <th>Customer Name</th>
                    <th>Receiver Name</th>
                    <th>Pick Up Date</th>
                    <th>Delivered Date</th>
                </tr>
                <?php
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>";
                    echo "<a href='task.php?data=".$row['parcelID']."'>".$row['parcelID']."</a>";
                    echo "</td>";
                    echo "<td>". $row['firstName'].' '. $row['lastName'] ."</td>";
                    echo "<td>". $row['receiverName'] ."</td>";
                    echo "<td>". $row['pickedDate'] ."</td>";
                    echo "<td>". $row['deliveredDate'] ."</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>

    <?php include_once("content/foot.php"); ?>
</body>
</html>
