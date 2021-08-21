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

if ($_POST) {
    $id = $_POST['id'];
    $picture = $_POST['picture'];
    ($picture =="product.png")?: unlink("../../pictures/$picture");

    $sql = "DELETE FROM animals WHERE animal_id = {$id}";
    if (mysqli_query($connect, $sql) === TRUE) {
        $class = "success";
        $message = "Successfully Deleted!";
    } else {
        $class = "danger";
        $message = "The entry was not deleted due to: <br>" . $connect->error;
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
        <title>Delete</title>
        <?php require_once '../../components/boot.php'?>  
        <style>

body {
        background: rgb(140,150,118);
        background: radial-gradient(circle, rgba(140,150,118,0.927608543417367) 39%, rgba(125,121,121,0.8267682072829132) 74%);
}

.navbar {
  background-color: #232428; 
}

.btn-warning {
    transition: all .2s ease-in-out;

}

.btn-warning:hover{
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
   <div class="alert alert-<?=$class;?>"  role="alert">
       <p><?=$message;?></p >
       <a href='../index.php' ><button class="btn btn-warning"  type='button'><i class="fas fa-home"></i> Home</button></a> 
   </div >
</div>
</body>
</html>