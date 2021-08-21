<?php 
session_start();

$nav='';
if (isset($_SESSION[ 'user']) != "") {
   $nav = ' <li class="nav-item">
          <a class="nav-link" aria-current="page" href="home.php">Our animals</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Your Profil</a>
        </li>';
}

if (isset($_SESSION['adm']) ) {
   $nav = ' <li class="nav-item">
          <a class="nav-link" aria-current="page" href="home.php">Our animals</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="products/index.php">Animals List</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="dashboard.php">Users List</a>
        </li>';
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
   $nav = ' <li class="nav-item">
          <a class="nav-link" aria-current="page" href="home.php">Our animals</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Your Profil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="seniors.php">Our seniors</a>
        </li>';
}
require_once 'components/db_connect.php' ;

$sql = "SELECT * FROM animals";
$result = mysqli_query($connect ,$sql);
$card=''; //this variable will hold the body for the table
if(mysqli_num_rows($result)  > 0) {     
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){       
        
        $card.= '<div class="card" style="width: 18rem;">
        <img src="pictures/'. $row["photo"] . '" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">'. $row["name"]. '</h5>
          <p class="card-text">Breed: '. $row["breed"] .'</p>
          <p class="card-text">Description: '. $row["description"] .'</p>
          <p class="card-text">Age: '. $row["age"] .'</p>
          <p class="card-text">Size: '. $row["size"] .'</p>
          <p class="card-text">Hobbies: '. $row["hobbies"] .'</p>
          <p class="card-text">Living in  '. $row["location"].'</p>
          <a href="moredetails.php?animal_id= '. $row["animal_id"].' " class="btn btn-primary">More</a>        
        </div>
      </div>';
                };
    } 

    $connect->close();



?>
<!DOCTYPE html>
<html lang="en" >
<head>
   <meta  charset="UTF-8">
   <meta name="viewport"  content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
   <title>Our Animals</title>
   <?php require_once 'components/boot.php'  ?>
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
            <div>
                <h1>Be welcome in our Pet-Center</h1>
                <h4>On our site we collect information about animals that are ready for adoption.</h4>
             <br>   
            </div>
            <br>
            
                <div id="crd" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <?= $card;?>
                </div>    
        </div>
</body>
</html>