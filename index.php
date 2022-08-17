<?php
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    $con = require_once('db.php');
    $row = $con->getNote();

    if(isset($_POST['close'])){
        $con->delete($_POST['del']);
        header('Location: index.php');
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
    <link rel="stylesheet" href="text.css">
</head>
<body>
    <div class="col-8 offset-2">
        <div class="row">
            <?php foreach ($row as $row) {?>
                <div class="container">
                    <div class="card">
                        <div class="card-header" style="height:70px;overflow:hidden;">
                            <a href="newnote.php ? id=<?php echo $row['id'] ?>" width="60%" title="edit"><?php echo $row['title'] ?></a>
                            <form action="" method="POST" class="d-inline">
                                <input type="hidden" name="del" value="<?php echo $row['id'] ?>">
                                <button class="btn btn-close fs-4 mt-3" style="position:absolute;top:0;right:0;" name="close" title="close"></button>
                            </form>
                        </div>
                        <div class="card-body">
                            <?php echo $row['description'] ?>
                            <a href="seeMore.php?id=<?php echo $row['id'] ?>"><button class="see" title="see more">See More</button></a>
                            <small class="float-end mt-2 me-4 text-danger" id="date"><?php echo $row['created_at'] ?></small>
                        </div>
                    </div>
                </div>
           <?php } ?>
        </div>
    </div>
    <a href="newnote.php"><button type="button" class="add" title="add note">+</button></a>
</body>
<script src="../bootstrap/js/bootstrap.min.js"></script>
</html>