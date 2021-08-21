<?php 
session_start();
if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
    header("Location: ../home.php");
    exit;
}
if(isset($_SESSION["user"])){
    header("Location: ../login.php");
    exit;
}
require_once '../components/db_connect.php';

if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM animals WHERE animal_id = {$id}" ;
    $result = mysqli_query($connect, $sql);
    $data = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 1) {
        $breed = $data['breed']; 
        $name = $data['name'];
        $photo = $data['photo'];
        $description = $data['description'];
        $location = $data['location'];
        $hobbies = $data['hobbies'];
        $age = $data['age'];
        $size = $data['size'];
    } else {
        header("location: error.php");
    }
    mysqli_close($connect);
} else {
    header("location: error.php");
}  
?>

<!DOCTYPE html>
<html lang="en" >
<head>
   <meta  charset="UTF-8">
   <meta name="viewport"  content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
   <title>Delete Animal</title> 
    <?php require_once '../components/boot.php'?>
   <style type= "text/css"> 

        body {
            background: rgb(140,150,118);
            background: radial-gradient(circle, rgba(140,150,118,0.927608543417367) 39%, rgba(125,121,121,0.8267682072829132) 74%);
        }    

        fieldset {
            margin: auto;
            width: 70% ;
        }     
        .img-thumbnail{
            width: 100px !important;
            height: 100px !important;
            object-fit:cover;
        }   

        .navbar {
            background-color: #232428; 
        }

        .card {
            border-radius: 20px;
            padding: 1rem;
                }
        
        .btn-warning,
        .btn-danger {
            transition: all .2s ease-in-out;

        }

        .btn-warning:hover,
        .btn-danger:hover {
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
          <a class="nav-link" aria-current="page" href="../home.php">Our animals</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php">Animals List</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="../dashboard.php">Users List</a>
        </li>
    </div>
  </div>
</nav>
<fieldset class="text-center">
<div class="card shadow">
<legend class= 'h2 mb-3'>Delete <?php echo $name ?> <img class='img-thumbnail rounded-circle'  src='../pictures/<?php echo $photo ?>' alt="<?php echo $name ?>"></legend>
<h5> You have selected the data below: </h5>
<table class="table mt-3" >
<tr>
           <td><?php echo $breed?></td>
           <td><?php echo $name?></td>
           <td><?php echo $description?></td>
</tr> 
</table>

<h3 class="mb-4" >Do you really want to delete this animal?</h3>
<form  action ="actions/a_delete.php"  method="post">
  <input type="hidden" name ="id" value= "<?php echo $id ?>" />
  <input type= "hidden" name= "picture" value= "<?php echo $photo ?>" />
  <button class="btn btn-danger"  type="submit"> <i class="fas fa-trash-alt"></i> Yes, delete it!</button  > 
  <a  href="../dashboard.php" ><button  class="btn btn-warning"  type= "button"><i class="fas fa-reply"></i> No, go back!</button></a>
</form >
</div>
</fieldset>
</body> 
</html >