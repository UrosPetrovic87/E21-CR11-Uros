<!DOCTYPE html>
<html lang="en" >
   <head>
       <meta charset="UTF-8">
        <title>Error</title>
        <?php require_once '../components/boot.php'?>    
        <style>
                body {
            background: rgb(140,150,118);
           
        }    

        .navbar {
            background-color: #232428; 
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
          <a class="nav-link" href="../login.php">Your Profil</a>
        </li>
    </div>
  </div>
</nav>
       <div  class="container">  
           <div class="mt-3 mb-3 text-center" >
               <h1>Something went wrong...</h1> 
           </div>
            <div class="alert alert-warning text-center" role="alert">
               <p>You've made an invalid request. Please <a href="home.php" class ="alert-link">go back</a> to homepage and try again.</p> 
           </div>
        </div>
   </body>
</html>