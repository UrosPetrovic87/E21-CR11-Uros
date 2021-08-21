<?php
session_start();
if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
    header("Location: ../../home.php");
    exit;
}
if(isset($_SESSION["user"])){
    header("Location: ../../login.php");
    exit;
}
require_once '../../components/db_connect.php';
require_once '../../components/file_upload.php';

if ($_POST) {    
    $breed = $_POST['breed']; 
    $name = $_POST['name'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $hobbies = $_POST['hobbies'];
    $age = $_POST['age'];
    $size = $_POST['size'];   
    $id = $_POST['id'];
   $uploadError = '';

    $picture = file_upload($_FILES['photo'], 'product');//file_upload() called  
    if($picture->error===0){
        ($_POST["picture"]=="product.png")?: unlink("../pictures/$_POST[photo]");           
        $sql = "UPDATE animals SET breed = '$breed', name = '$name',  image = '$photo->fileName', description = '$description', location = '$location', hobbies = '$hobbies', age = '$age', size = '$size' WHERE id = {$id}";
    }else{
        $sql = "UPDATE animals SET breed = '$breed', name = '$name' , description = '$description', location = '$location', hobbies = '$hobbies', age = '$age', size = '$size' WHERE id = {$id}";
    }    
    if (mysqli_query($connect, $sql) === TRUE) {
        $class = "success";
        $message = "The record was successfully updated";
        $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
    } else {
        $class = "danger";
        $message = "Error while updating record : <br>" . mysqli_connect_error();
        $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
    }
    mysqli_close($connect);    
} else {
    header("location: ../error.php");
}
?>

<!DOCTYPE html>
<html lang="en" >
<head>
    <meta  charset="UTF-8">
    <meta name="viewport"   content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
   <title>Update Animal</title>
   <?php require_once '../../components/boot.php' ?> 
    <style>
        body {
            background: rgb(140,150,118);
            background: radial-gradient(circle, rgba(140,150,118,0.927608543417367) 39%, rgba(125,121,121,0.8267682072829132) 74%);
        }

        .navbar {
            background-color: #232428; 
            }

        .btn-warning,
        .btn-secondary {
            transition: all .2s ease-in-out;

        }

        .btn-warning:hover,
        .btn-secondary:hover {
            transform: scale(1.1);
        }
    </style>
</head> 
<body>
<nav class="navbar navbar-expand navbar-dark mb-3 sticky-top shadow">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="../../home.php">Our animals</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../index.php">Animals List</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="../../dashboard.php">Users List</a>
        </li>
    </div>
  </div>
</nav>
   <div class="container text-center"> 
       <div class="alert alert-<?php echo $class;?>"  role="alert">
           <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
            <a href='../update.php?id=<?=$id;?>' ><button class="btn btn-secondary" type='button'><i class="fas fa-reply"></i> Back</button></a>
            <a href='../index.php' ><button class="btn btn-warning"  type='button'><i class="fas fa-home"></i> Home</button></a> 
        </div>
   </div>
</body>
</html>