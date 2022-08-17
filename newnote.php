<?php
    // echo "<pre>";
    // var_dump($_GET);
    // echo "</pre>";

    $con = require_once('db.php');


    $edit = [
        'id'=>'',
        'title'=>'',
        'description'=>''
    ];

    if(isset($_GET['id']))
    {
        $edit = $con->editNote($_GET['id']);
    }

    $id = $_POST['up'] ?? '';
    $errors=[];
    if(isset($_POST['save'])){
        if($_POST['title'] && $_POST['description']){
            if($id){
                $con->updateNote($id,$_POST);
            }else{
                $con->newNote($_POST);
            }
            header('Location:index.php');
        }else{
            if(!$_POST['title'] && !$_POST['description']){
                $errors['title']='This field is required!!';
                $errors['des']='This field is required!!';
            }elseif(!$_POST['title'] && $_POST['description']){
                $errors['title']='This field is required!!';
            }elseif(!$_POST['description'] && $_POST['title'] ){
                $errors['des']='This field is required!!';
            }
        }
    
    }

    // echo "<pre>";
    // var_dump($errors);
    // echo "</pre>";
    
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
<style>
    body{
        margin:0;
        padding:0;
        box-sizing:border-box;
        overflow: hidden;
        height: 100vh;
        display:flex;
        align-items:center;
    }

</style>
<body>
    <div class="col-6 offset-3">
        <div class="row">
            <a href="index.php" style="transform:translateX(-2%);"><button class="btn btn-secondary col-2 mb-2">back</button></a>
            <div class="card border border-2">
                <div class="card-body">
                    <form action="" method="POST">
                        <input type="hidden" name="up" value="<?php echo $edit['id'] ?>">
                        <label for="title">Title:</label>
                            <input type="text" name="title" class="form-control <?php echo isset($errors['title'])? 'is-invalid':'';?>" value="<?php echo isset($_POST['title'])? $_POST['title']:$edit['title'] ;?>" placeholder="add title...">
                            <div class="invalid-feedback">
                                <?php echo $errors['title'] ?>
                            </div>
                        <br>

                        <label for="des">description:</label>
                        <textarea class="form-control <?php echo isset($errors['des'])? 'is-invalid':'';  ?>" name="description" placeholder="add description..." id="des" cols="30" rows="10"><?php echo isset($_POST['description'])? $_POST['description']:$edit['description'] ;?></textarea>
                        <div class="invalid-feedback">
                                <?php  if(isset($errors['des'])){
                                        echo $errors['des']; 
                                    }else{
                                        echo "";
                                    } ?>
                        </div>
                        <br>
                        <button type="submit" name="save" class="btn btn-primary w-25 float-end"><?php echo ($edit['id'])? 'Update':"Add" ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../bootstrap/js/bootstrap.min.js"></script>
</html>