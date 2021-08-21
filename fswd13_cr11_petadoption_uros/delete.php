<?php 
session_start();
require_once 'components/db_connect.php';
// if session is not set this will redirect to login page
if( !isset($_SESSION['adm']) && !isset($_SESSION['user']) ) {
    header("Location: login.php");
    exit;
   }
if(isset($_SESSION["user"])){
    header("Location: profil.php");
    exit;
   }
//initial bootstrap class for the confirmation message
   $class = 'd-none';
//the GET method will show the info from the user to be deleted
   if ($_GET['id']) {
   $id = $_GET['id'];
   $sql = "SELECT * FROM user WHERE id = {$id}" ;
   $result = mysqli_query($connect, $sql);
   $data = mysqli_fetch_assoc($result);
   if (mysqli_num_rows($result) == 1) {
    $f_name = $data['first_name'];
    $l_name = $data['last_name'];
    $email = $data['email'];
    $adress = $data['adress'];
    $picture = $data['picture'];
    $phone = $data['phone'];
} }
//the POST method will actually delete the user permanently
if ($_POST) {
    $id = $_POST['id'];
    $picture = $_POST['picture'];
    ($picture =="avatar.png")?: unlink("pictures/$picture");

   $sql = "DELETE FROM user WHERE id = {$id}";
   if ($connect->query($sql) === TRUE) {
    $class = "alert alert-success";
    $message = "Successfully Deleted!";
    header("refresh:3;url=dashboard.php");
} else {
    $class = "alert alert-danger";
    $message = "The entry was not deleted due to: <br>" .             $connect->error;
}
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en" >
<head>
   <meta charset="UTF-8"> 
    <meta name="viewport"   content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
   <title>Delete Account</title> 
    <?php require_once 'components/boot.php' ?> 
   <style type= "text/css" >
         body {
            background: rgb(140,150,118);
            background: radial-gradient(circle, rgba(140,150,118,0.927608543417367) 39%, rgba(125,121,121,0.8267682072829132) 74%);
        }    
        .img-thumbnail{
            width: 100px !important;
            height: 100px !important;
            object-fit: cover;
        }

      fieldset {
        margin: auto;
        width: 70% ;
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
<fieldset class="text-center"> 
<div class="card shadow">
<legend class='h2 mb-3'>Delete <?php echo $f_name ?><img class= 'img-thumbnail rounded-circle mx-3'  src='pictures/<?php echo $picture ?>' alt="<?php echo $f_name ?>"></legend >
<h5>You have selected the data below: </h5>
<table class="table mt-3">
<tr>
    <td><?php echo "$f_name $l_name"?></td>
    <td><?php echo $email?></td>
    <td ><?php echo $adress?></td>
    <td ><?php echo $phone?></td>
</tr> 
</table>
<h3 class="mb-4">Do you really want to delete this user?</h3 >
<form  method="post">
  <input type="hidden" name ="id" value= "<?php echo $id ?>" />
  <input type= "hidden" name= "picture" value= "<?php echo $picture ?>" />
  <button class="btn btn-danger"  type="submit"><i class="fas fa-trash-alt"></i> Yes, delete it! </button  > 
  <a  href="products/index.php" ><button  class="btn btn-warning"  type= "button"><i class="fas fa-reply"></i> No, go back!</button></a>
</form >
</fieldset>

</div>
<div  class="<?php echo $class; ?>" role="alert" >
       <p><?php echo ($message) ?? ''; ?></p>           
</div>
</body> 
</html >