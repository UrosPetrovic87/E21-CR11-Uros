<?php
// session_start();

// $nav='';
// if (isset($_SESSION[ 'user']) != "") {
//    $nav = ' <li class="nav-item">
//           <a class="nav-link" aria-current="page" href="home.php">Our animals</a>
//         </li>
//         <li class="nav-item">
//           <a class="nav-link" href="login.php">Your Profil</a>
//         </li>';
// }

// if (isset($_SESSION['adm']) ) {
//    $nav = ' <li class="nav-item">
//           <a class="nav-link" aria-current="page" href="home.php">Our animals</a>
//         </li>
//         <li class="nav-item">
//           <a class="nav-link" href="products/index.php">Animals List</a>
//         </li>
//          <li class="nav-item">
//           <a class="nav-link" href="dashboard.php">Users List</a>
//         </li>';
// }


require_once 'components/db_connect.php';
if ($_GET['animal_id']) {
    $id = $_GET['animal_id'];
    $sql = "SELECT * FROM animals WHERE animal_id = {$id}";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $breed = $data['breed']; 
        $name = $data['name'];
        $photo = $data['photo'];
        $description = $data['description'];
        $location = $data['location'];
        $hobbies = $data['hobbies'];
        $age = $data['age'];
        $size = $data['size'];
    } else {
        header("location: products/error.php");
    }
    mysqli_close($connect);
} else {
    header("location: products/error.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Animal info</title>
        <link rel="stylesheet" href="style/details.css">
        <?php require_once 'components/boot.php'?>  
        <style type= "text/css">
       
      
    body {
        background: #EEBF96;
        
    }
    .card {
        border-radius: 10px;
    }

    .navbar {
      background-color: #232428; 
    }

    h1, h3 {
       color: #729a72;
    }

    h5 {
      color: #729a72;
      text-shadow: 0.5px 0.5px #000000;
    }
    #crd {
  justify-content: space-around;
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
<div class="container">
<div class="card mb-3" style="max-width: 400px;">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="pictures/´ <?php echo $photo?>´" class="img-fluid rounded-start" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title"><?php echo $name ?></h5>
              <p class="card-text">Breed: <?php echo $breed ?></p>
              <p class="card-text">Description: <?php echo $description ?></p>
              <p class="card-text">Age: <?php echo $age ?></p>
              <p class="card-text">Size: <?php echo $size ?></p>
              <p class="card-text">Hobbies: <?php echo $hobbies ?></p>
              <p class="card-text">Living in  <?php echo $location ?></p>
            </div>
          </div>
        </div>
      </div>


      </div>


       
       
    </body>
</html>
