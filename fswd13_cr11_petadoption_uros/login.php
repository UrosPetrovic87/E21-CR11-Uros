<?php
session_start();
require_once 'components/db_connect.php';

if (isset($_SESSION[ 'user']) != "") {
   header("Location: profil.php");
   exit;
}
if (isset($_SESSION['adm']) != "") {
   header("Location: dashboard.php"); 
}
$error = false ;
$email = $password = $emailError = $passError = '';

if (isset ($_POST['btn-login'])) {

   $email = trim($_POST['email']);
   $email = strip_tags($email);
   $email = htmlspecialchars($email);

   $pass = trim($_POST['pass']);
   $pass = strip_tags($pass);
   $pass = htmlspecialchars($pass);


   if (empty($email)) {
       $error = true;
       $emailError = "Please enter your email address.";
   } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $error = true;
       $emailError = "Please enter valid email address.";
   }

   if (empty($pass)) {
       $error = true;
       $passError = "Please enter your password.";
   }

   if (!$error) {

       $password = hash('sha256', $pass); 

       $sqlSelect = "SELECT id, first_name, password, status FROM user WHERE email = ? ";
       $stmt = $connect->prepare($sqlSelect);
       $stmt->bind_param("s", $email);
       $work = $stmt->execute();
       $result = $stmt->get_result();
       $row = $result->fetch_assoc();
       $count = $result->num_rows;
       if ($count == 1 && $row['password'] == $password) {
           if($row['status'] == 'adm'){
           $_SESSION['adm'] = $row['id'];           
           header( "Location: dashboard.php");}
           else{
               $_SESSION['user'] = $row['id']; 
              header( "Location: profil.php");
           }          
       } else {
           $errMSG = "Incorrect Credentials, Try again..." ;
       }
   }
}
$connect->close();
?>


<!DOCTYPE html>
<html lang="en" >
<head>
   <meta charset="UTF-8"> 
    <meta name="viewport"   content="width=device-width, initial-scale=1.0">
<title>Login</title>
<?php require_once 'components/boot.php'?>
<style>
    .card {
    border-radius: 20px;
    }
    body {
    background: rgb(140,150,118);
           
    }
    .navbar {
    background-color: #232428; 
    }

    form {
     margin: 1rem;
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
          <a class="nav-link" href="login.php">Your Profil</a>
        </li>
    </div>
  </div>
</nav>
   <div class="container"> 
   <div class="card">
       <form method="post" action= "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" >
           <h2>LogIn</h2> 
           <hr/>
            <?php
           if (isset($errMSG)) {
               echo $errMSG;
           }
           ?>
       
           <input type="email"  autocomplete="off" name= "email" class="form-control"  placeholder="Your Email" value="<?php echo $email; ?>"  maxlength ="40" />
           <span class="text-danger" ><?php echo $emailError; ?></span >

           <input  type="password" name= "pass"  class="form-control"  placeholder="Your Password" maxlength="15"  />
           <span class= "text-danger"><?php echo $passError; ?></span>
           <hr/>
           <button class="btn btn-block btn-primary"  type="submit" name ="btn-login">Sign In</button>
           <hr/>
           <a href="register.php"> Not registered yet? Click here</a>
        </form>
   
   </div>
   </div>
</body >
</html>