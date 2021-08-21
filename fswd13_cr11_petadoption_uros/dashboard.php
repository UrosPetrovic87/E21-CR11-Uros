<?php
session_start();
require_once 'components/db_connect.php';
// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
//if session user exist it shouldn't access dashboard.php
if (isset($_SESSION["user"])) {
    header("Location: profil.php");
    exit;
}

$id = $_SESSION['adm'];
$status = 'adm';
$sql = "SELECT * FROM user WHERE status != '$status'";
$result = mysqli_query($connect, $sql);

//this variable will hold the body for the table
$tbody = ''; 
if ($result->num_rows > 0) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $tbody .= "<tr>
           <td><img class='img-thumbnail rounded-circle' src='pictures/" . $row['picture'] . "' alt=" . $row['first_name'] . "></td>
           <td>" . $row['first_name'] . " " . $row['last_name'] . "</td>
           <td>" . $row['phone'] . "</td>
           <td>" . $row['adress'] . "</td>
           <td>" . $row['email'] . "</td>
           <td><a href='update.php?id=" . $row['id'] . "'><button class='btn btn-success' type='button'><i class='far fa-edit'></i></button></a>
           <a href='delete.php?id=" . $row['id'] . "'><button class='btn btn-danger' type='button'><i class='fas fa-trash-alt'></i></button></a></td>
        </tr>";
    }
} else {
    $tbody = "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en" >
<head>
   <meta charset="UTF-8"> 
    <meta name="viewport"   content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
   <title>List of users</title> 
   <?php require_once 'components/boot.php' ?> 
   <style type="text/css" > 
        body {
            background: rgb(188,225,170);
        }    
        .img-thumbnail{
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        td {
            vertical-align: middle;
        }
        tr {
            text-align: center;
        }
        .userImage{
            width: 100px ;
            height: 100px;
            object-fit: cover;

        }
        .navbar {
            background-color: #232428; 
        }
        


   </style>
</head>
<body >
<nav class="navbar navbar-expand navbar-dark mb-3 sticky-top shadow">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="home.php">Our animals</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="products/index.php">Animals List</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="dashboard.php">Users List</a>
        </li>
    </div>
  </div>
</nav>
<div class="container" >
   <div class= "row align-items-center">
       <div  class="col-2 text-center">
       <img class="rounded-circle img-thumbnail"  src="pictures/admavatar.png" alt= "Adm avatar" >
       <p class="fw-bold">Administrator</p>
       <a  href="logout.php?logout" class="text-white">Sign Out </a>
       </div >
       <div  class="col-8">
        <h2 class="text-center my-3">List of Users</h2>
       <table class='table shadow table-striped'> 
           <thead class="table-success">
               <tr>
                   <th>Picture</th>
                   <th>Name</th >
                   <th>Phone</th>
                   <th>Adress</th>
                   <th>Email</th >
                   <th>Edit</th >
               </tr>
           </thead>
           <tbody>
            <?=$tbody?>
            </tbody>
        </table>
       </div>
   </div> 
</div> 
</body> 
</html>