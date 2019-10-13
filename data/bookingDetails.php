<?php include("serverV2.php"); ?>

<!DOCTYPE html>
<html>

<?php include_once("content/head.php"); ?>

<body>

    <?php include_once("content/header.php"); ?>

    <div class="container">
        <div class="col-md-12">
            <h1>Parcel ID : <?php echo $_GET["data"]; ?></h1>

            <table border="1">
                <tr>
                    <th>Info</th>
                    <th>Location</th>
                    <th>Timestamp</th>
                </tr>
                <?php getBookingDetails($_GET["data"], $db); ?>
            </table>
        </div>
    </div>

    <?php include_once("content/foot.php"); ?>
</body>
</html>
