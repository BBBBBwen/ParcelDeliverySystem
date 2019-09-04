<?php
session_start();

$parcelName = "";
$senderAddress = "";
$recieverName = "";
$recieverAddress = "";
$recieverPhoneNumber = "";
$errors = array();

//need to change when connectting to cloud
$db = mysqli_connect('localhost', 'root', '19910225', 'registration');

if(isset($_POST['book'])) {
    $parcelName = mysqli_real_escape_string($db, $_POST['parcelName']);
    $senderAddress = mysqli_real_escape_string($db, $_POST['senderAddress']);
    $recieverName = mysqli_real_escape_string($db, $_POST['recieverName']);
    $recieverAddress = mysqli_real_escape_string($db, $_POST['recieverAddress']);
    $recieverPhoneNumber = mysqli_real_escape_string($db, $_POST['recieverPhoneNumber']);

    if (empty($parcelName)) { array_push($errors, "empty parcelName"); }
    if (empty($senderAddress)) { array_push($errors, "empty senderAddress"); }
    if (empty($recieverName)) { array_push($errors, "empty recieverName"); }
    if (empty($recieverAddress)) { array_push($errors, "empty recieverAddress"); }
    if (empty($recieverPhoneNumber)) { array_push($errors, "empty recieverPhoneNumber"); }

    if (count($errors) == 0) {
        $query = "INSERT INTO parcelDetail (parcelName, senderAddress, recieverName, recieverAddress, recieverPhoneNumber, status)
  			      VALUES('$parcelName', '$senderAddress', '$recieverName', '$recieverAddress', '$recieverPhoneNumber', 'processing')";
  	    mysqli_query($db, $query);
        header('location: /');
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
        <h1>Welcome <?php echo $_SESSION['username']; ?></h1>
    </header>
    <main>
        <div>
            <?php
                $result = mysqli_query($db,"SELECT * FROM parcelDetail LIMIT 10");
                echo "<table border='1'>
                <tr>
                    <th>parcelName</th>
                    <th>senderAddress</th>
                    <th>recieverName</th>
                    <th>recieverAddress</th>
                    <th>recieverPhoneNumber</th>
                    <th>status</th>
                </tr>";

                while($row = mysqli_fetch_array($result))
                {
                echo "<tr>";
                echo "<td><a href='parcelDetail.php?".$row['parcelName']."' target='_blank'>" . $row['parcelName'] . "</a></td>";
                echo "<td>" . $row['senderAddress'] . "</td>";
                echo "<td>" . $row['recieverName'] . "</td>";
                echo "<td>" . $row['recieverAddress'] . "</td>";
                echo "<td>" . $row['recieverPhoneNumber'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
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
                        <input type='text' name='parcelName' class='input' value='<?php echo $parcelName; ?>' placeholder='enter parcel's Name' required />
                    </div>
                    <div class='alignt'>
                        <label>senderAddress</label>
                    </div>
                    <div class='alignt'>
                        <input type='text' name='senderAddress' class='input' value='<?php echo $senderAddress; ?>' placeholder='enter sender's Address' required />
                    </div>
                    <div class='alignt'>
                        <label>recieverName</label>
                    </div>
                    <div class='alignt'>
                        <input type='text' name='recieverName' class='input' value='<?php echo $recieverName; ?>' placeholder='enter reciever's Name' required />
                    </div>
                    <div class='alignt'>
                        <label>recieverAddress</label>
                    </div>
                    <div class='alignt'>
                        <input type='text' name='recieverAddress' class='input' value='<?php echo $recieverAddress; ?>' placeholder='enter reciever's Address' required />
                    </div>
                    <div class='alignt'>
                        <label>recieverPhoneNumber</label>
                    </div>
                    <div class='alignt'>
                        <input type='text' name='recieverPhoneNumber' class='input' value='<?php echo $recieverPhoneNumber; ?>' placeholder='enter reciever's PhoneNumber' required />
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
