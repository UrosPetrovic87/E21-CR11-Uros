<?php
session_start();

if(!isset($_SESSION["adm"]) && !isset($_SESSION["user"])){
    header("Location: ../login.php");
    exit;
}
if(isset($_SESSION["user"])){
    header("Location: ../home.php");
    exit;
}
require_once '../components/db_connect.php';
$sql = "SELECT * FROM animals";
$result = mysqli_query($connect ,$sql);
$tbody=''; //this variable will hold the body for the table
if(mysqli_num_rows($result)  > 0) {     
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){         
        $tbody .= "<tr>
            <th scope='row'><img class='img-thumbnail' src='../pictures/" .$row['photo']."'</th>
            <td>" .$row['breed']."</td>
            <td>" .$row['name']."</td>
            <td>" .$row['description']."</td>
            <td>" .$row['age']."</td>
            <td>" .$row['size']."</td>
            <td><a href='update.php?id=" .$row['animal_id']."'><button class='btn btn-success' type='button'><i class='far fa-edit'></i></button></a>
            <a href='../delete.php?id=" .$row['animal_id']."'><button class='btn btn-danger' type='button'><i class='fas fa-trash-alt'></i></button></a></td>
        </tr>";
    };
} else {
    $tbody =  "<tr><td colspan='6'><center>No Data Available </center></td></tr>";
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en" >
<head>
   <meta  charset="UTF-8">
   <meta name="viewport"  content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
   <title>List of Animals</title>
   <?php require_once '../components/boot.php'  ?>
   <style type= "text/css">
        
        body {
            background: rgb(133,201,232);
       
        }
        .manageProduct {           
            margin: auto;
        }

        .img-thumbnail{
            width: 80px !important;
            height: 80px !important;
            object-fit: cover; 
        }

        td{   
            vertical-align: middle;
        }
        tr{
            text-align: center;
        }

        .navbar {
            background-color: #232428;
            }

        .btn-success,
        .btn-danger {
            transition: all .2s ease-in-out;

        }

        .btn-success:hover,
        .btn-danger:hover {
            transform: scale(1.1);
        }

        .button {
            text-align: center;
        }

   </style>

</head>
<body> 



<nav class="navbar navbar-expand navbar-dark mb-3 sticky-top shadow">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="../home.php">Our animals</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php">Animals List</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="../login.php">Users List</a>
        </li>
    </div>
  </div>
</nav>
<div class="container">
    <div class="manageProduct">    
    <h2 class ='text-center my-4'>List of Animals</h2> 
        <div class='mb-3 button'>
        <a href= "create.php"><button class='btn btn-success shadow'type="button">Add Animal</button></a>
        </div>
        <table class="table shadow table-striped mt-5">
    <thead class="table-success">
        <tr>
        <th scope="col">Photo</th>
        <th scope="col">Breed</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Age</th>
        <th scope="col">Size</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?= $tbody; ?>
    </tbody>
    </table>
    </div>
</div>
</body>
</html>