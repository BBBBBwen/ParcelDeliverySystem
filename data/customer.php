<?php
session_start();

$errors = array();
require 'connectDB.php';

if(isset($_POST['book'])) {
    if (empty($_POST['parcelName'])) array_push($errors, "empty parcelName");
    if (empty($_POST['recieverName'])) array_push($errors, "empty recieverName");
    if (empty($_POST['recieverAddress'])) array_push($errors, "empty recieverAddress");
    if (empty($_POST['recieverPhoneNumber'])) array_push($errors, "empty recieverPhoneNumber");
    $sql = "SELECT * FROM customer WHERE id=:id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id', $_SESSION['id']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user['address'] == null) array_push($errors, "empty address");
    if (count($errors) == 0) {
        $distanceData = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?&origins=".urlencode($user['address'])."&destinations=".urlencode($_POST['recieverAddress'])."&key=AIzaSyB4VlCHHZgZ1rrsEY9S-LtYdMz-f858Dig");
        $data = json_decode($distanceData);
        $distance = floor($data->rows[0]->elements[0]->distance->value / 1000);
        echo $data->rows[0]->elements[0]->distance->value;
        echo "dis: ".$distance;

        $sql = "INSERT INTO parcel (parcelName, customerID, recieverName, recieverAddress, recieverPhoneNumber, status, payment)
  			      VALUES(:parcelName, :customerID, :recieverName, :recieverAddress, :recieverPhoneNumber, :status, :payment)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':parcelName', $_POST['parcelName']);
        $stmt->bindValue(':customerID', $_SESSION['id']);
        $stmt->bindValue(':recieverName', $_POST['recieverName']);
        $stmt->bindValue(':recieverAddress', $_POST['recieverAddress']);
        $stmt->bindValue(':recieverPhoneNumber', $_POST['recieverPhoneNumber']);
        $stmt->bindValue(':status', 'processing');
        $stmt->bindValue(':payment', $distance);
        $result = $stmt->execute();
        if($result) header("Refresh:0");
        else array_push($errors, "fail to book job");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF8">
    <title>Customer</title>
    <link id='styleCss' type="text/css" rel="styleSheet" href="../css/datailStyle.css">
</head>

<body>
    <header>
        <a href="/"><img src="images/logo.png" alt="Logo"></a>
        <a href="\data\profile.php"><img src="images/profile.png" alt="profile"></a>
        <h1>Welcome <?php echo $_SESSION['username'];?></h1>
    </header>
    <main>
        <div>
            <?php
                $sql = "SELECT * FROM parcel LIMIT 10";
                $stmt = $db->prepare($sql);
                $stmt->execute();
                echo "<table border='1'>
                <tr>
                    <th>parcelName</th>
                    <th>recieverName</th>
                    <th>recieverAddress</th>
                    <th>recieverPhoneNumber</th>
                    <th>status</th>
                    <th>payment</th>
                </tr>";

                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td><a href='parcelDetail.php?".$row['id']."' target='_blank'>" . $row['parcelName'] . "</a></td>";
                echo "<td>" . $row['recieverName'] . "</td>";
                echo "<td>" . $row['recieverAddress'] . "</td>";
                echo "<td>" . $row['recieverPhoneNumber'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "<td>" . $row['payment'] . "</td>";
                echo "</tr>";
                }
                echo "</table>"; ?>
        </div>
        <?php include('error.php'); ?>
            <button type='button' id='bookbtn' class='link'>
                <a>Book Job</a>
            </button><br>
        </div>
    </main>
    <div id='bgd' class='bgdc'>
        <div class="main1">
            <div class="close">
                Book
                <span id="close1" class='close-button'>×</span>
            </div>
            <div class="main2">
                <form action="customer.php" method='post'>
                    <div class='alignt'>
                        <label>parcelName</label>
                    </div>
                    <div class='alignt'>
                        <input type='text' name='parcelName' class='input' required />
                    </div>
                    <div class='alignt'>
                        <label>recieverName</label>
                    </div>
                    <div class='alignt'>
                        <input type='text' name='recieverName' class='input' required />
                    </div>
                    <div class='alignt'>
                        <label>recieverAddress</label>
                    </div>
                    <div class='alignt'>
                        <input type='text' name='recieverAddress' class='input' required />
                    </div>
                    <div class='alignt'>
                        <label>recieverPhoneNumber</label>
                    </div>
                    <div class='alignt'>
                        <input type='text' name='recieverPhoneNumber' class='input' required />
                    </div>
                    <div class='alignt'>
                        <button type='submit' class='btn' name='book'>Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    var btn = document.getElementById('bookbtn');
    var bgd = document.getElementById('bgd');
    var close = document.getElementById('close1');

    btn.onclick = function show() {
        bgd.style.display = "block";
    }

    close.onclick = function close() {
        bgd.style.display = "none";
    }

    window.onclick = function close(e) {
        if (e.target == bgd) {
            bgd.style.display = "none";
        }
    }
</script>
</html>
