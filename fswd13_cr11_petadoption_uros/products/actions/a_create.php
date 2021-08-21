<?php
session_start();
if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
    header("Location:../index.php");
    exit;
}
if(isset($_SESSION["user"])){
    header("Location: ../../home.php");
    exit;
}
require_once '../../components/db_connect.php';
require_once '../../components/file_upload.php';

if ($_POST) {   
    $breed = $_POST['breed']; 
    $name = $_POST['name'];
    // $photo = file_upload_animal($_FILES['photo']);  
    $descripiton = $_POST['descripiton'];
    $location = $_POST['location'];
    $hobbies = $_POST['hobbies'];
    $age = $_POST['age'];
    $size = $_POST['size'];   
    $uploadError = '';
   
    $uploadError = '';
    //this function exists in the service file upload.
    $photo = file_upload($_FILES['photo'],"animals");  
    if($animals == 'none'){
        $sql = "INSERT INTO animals (breed, name, photo, description, location, hobbies, age, size) VALUES ('$breed', '$name', '$photo->fileName', '$descripiton', '$location', '$hobbies', '$age', '$size')";
    }else {
        $sql = "INSERT INTO animals (breed, name, photo, description, location, hobbies, age, size) VALUES ('$breed', '$name', '$photo->fileName', '$descripiton', '$location', '$hobbies', '$age', '$size')";
    }
    

    if (mysqli_query($connect, $sql) === true) {
        $class = "success";
        $message = "The entry below was successfully created <br>
        <table class='table text-center'><tr>
        <td> $breed </td>
        <td> $name </td>
        <td> $age </td>
        </tr></table><hr>
        ";
        $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
    } else {
        $class = "danger";
        $message = "Error while creating record. Try again: <br>" . $connect->error;
        $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
    }
    mysqli_close($connect);
} else {
    header("location: ../error.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"   content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
        <title>Import Animal</title>
        <?php require_once '../../components/boot.php'?>
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
       <div class="alert alert-<?=$class;?>"  role="alert">
           <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
            <a href='../index.php' ><button class="btn btn-warning"  type='button'><i class="fas fa-home"></i> Home</button></a> 
       </div>
   </div>
    </body>
</html>