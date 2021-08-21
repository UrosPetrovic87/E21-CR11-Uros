<?php
session_start();
require_once 'components/db_connect.php';

if (isset($_SESSION['adm' ])) {
   header("Location: dashboard.php");
   exit;
}


if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
   header("Location: login.php" );
    exit;
}

$res = mysqli_query($connect, "SELECT * FROM user WHERE id=" . $_SESSION['user']);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
$connect->close();
?>
<!DOCTYPE html>
<html lang="en" >
<head>
   <meta charset="UTF-8"> 
    <meta name="viewport"   content="width=device-width, initial-scale=1.0">
<title>Pet<?php  echo $row['first_name']; ?></title >
<?php require_once 'components/boot.php' ?>
<style>
  body {
        background: rgb(140,150,118);
        background: linear-gradient(265deg, rgba(140,150,118,1) 48%, rgba(114,154,114,1) 100%);
    }
    .userImage{
    width: 200px;
    height: 200px;
    margin: 2rem auto;
    object-fit: cover;
    border-radius: 20px;

    }

    .card {
        border-radius: 20px;
    }
    .navbar {
        background-color: #232428; 
        }

    a {
        color: green;
    }

    a:hover {
        color: #dce0be;
    }
</style>
</head>
<body> 
<nav class="navbar navbar-expand navbar-dark mb-3 sticky-top shadow">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="home.php">Our animals</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="seniors.php">Our seniors</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profil.php">Your Profil</a>
        </li>
        
    </div>
  </div>
</nav>
<div class ="container">
   <div class="card shadow text-center"> 
       <img class= "userImage" src="pictures/<?php echo $row['picture']; ?>" alt="<?php echo $row['first_name']; ?>">
       <h2>Hi <?php  echo $row['first_name']; ?></h2>
       <ul class="list-group">
            <li class="list-group-item">Name: <?php  echo $row['first_name'] . " " . $row['last_name']; ?></li>
            <li class="list-group-item">Adress: <?php  echo $row['adress']; ?></li>
            <li class="list-group-item">Phone: <?php  echo $row['phone']; ?></li>
            <li class="list-group-item">E-mail: <?php  echo $row['email']; ?></li>
        </ul>
   <a href="logout.php?logout" class=" mx-3">Sign Out</a>
   <a href="update.php?id=<?php echo $_SESSION['user'] ?>" >Update your profile</a>
   </div>
</div>
</body >

</html>