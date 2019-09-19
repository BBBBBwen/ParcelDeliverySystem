<?php include("serverV2.php"); ?>
<!DOCTYPE html>
<html>

<?php include_once("content/head.php"); ?>

<body>

    <?php include_once("content/header.php"); ?>

    <div class="container">
        <div class="col-md-8">
            <h1> Welcome <?php echo $_SESSION['firstName'].' '.$_SESSION['lastName']?> </h1> 

            <a class="btn btn-primary" href="allTask.php">Task</a>
            <a class="btn btn-danger" href="report.php">Report</a>
        </div>
    </div>

    <?php include_once("content/foot.php"); ?>
</body>
</html>
