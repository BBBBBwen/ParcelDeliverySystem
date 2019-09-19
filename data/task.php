<?
include("getTask.php");
include("serverV2.php");
?>

<!DOCTYPE html>
<html>

<?php include_once("content/head.php"); ?>

<body>
    
    <?php include_once("content/header.php"); ?>

    <div class="container">
        <div class="col-md-6">
            <h1>Parcel ID : <?php echo $_GET["data"]; ?></h1>
            <label>Customer Name</label>
            <input type="text"class="input_box form-control" disabled>
            <label>Customer Address</label>
            <input type="text"class="input_box form-control" disabled>
            <label>Receiver Name</label>
            <input type="text"class="input_box form-control" disabled>
            <label>Receiver Address</label>
            <input type="text"class="input_box form-control" disabled>
            <label>Customer Phone Number</label>
            <input type="text"class="input_box form-control" disabled>
            
            <form method="POST" action="#">
                <button type="submit" name="picked" class="btn btn-primary">Picked Up</button>
                <button type="submit" name="delivered" class="btn btn-warning">Delivered</button>
            </form>
        </div>
    </div>
</body>
</html>
