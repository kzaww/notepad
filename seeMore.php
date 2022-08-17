<?php
    $con=require_once('db.php');

    if(isset($_GET['id'])){
        $seeMore=$con->seeMore($_GET['id']);
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note Pad</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="col-8 offset-2">
        <div class="row">
            <div class="container mt-5">
                <a href="index.php"><button class="btn btn-secondary mb-2 col-2">Back</button></a>
                <div class="card">
                    <div class="card-header">
                            <h2 class=" text-decoration-underline"><?php echo $seeMore['title']; ?></h2>
                            <small class="mt-3 me-3 text-danger" style="position:absolute;top:0;right:0;"><?php echo $seeMore['created_at'] ?></small>
                    </div>
                    <div class="card-body" style="background-color:rgb(163, 163, 65);">
                        <?php echo $seeMore['description']; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../bootstrap/js/bootstrap.min.js"></script>
</html>