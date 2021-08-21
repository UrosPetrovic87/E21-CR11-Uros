<?php
session_start();
require_once 'components/db_connect.php';
require_once 'components/file_upload.php';
// if session is not set this will redirect to login page
if( !isset($_SESSION['adm']) && !isset($_SESSION['user']) ) {
    header("Location: login.php");
    exit;
   }
   
$backBtn = '';
//if it is a user it will create a back button to home.php
if(isset($_SESSION["user"])){
    $backBtn = "profil.php";    
}
//if it is a adm it will create a back button to dashboard.php
if(isset($_SESSION["adm"])){
    $backBtn = "dashBoard.php";    
}

//fetch and populate form
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM user WHERE id = {$id}";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $f_name = $data['first_name'];
        $l_name = $data['last_name'];
        $email = $data['email'];
        $adress = $data['adress'];
        $picture = $data['picture'];
        $phone = $data['phone'];
    }   
}

//update
$class = 'd-none';
if (isset($_POST["submit"])) {
    $f_name = $_POST['first_name'];
    $l_name = $_POST['last_name'];
    $email = $_POST['email'];
    $adress = $_POST['adress'];
    $phone = $_POST['phone'];
    $id = $_POST['id'];
    //variable for upload pictures errors is initialized
    $uploadError = '';    
    $pictureArray = file_upload($_FILES['picture']); //file_upload() called
    $picture = $pictureArray->fileName;
    if ($pictureArray->error === 0) {       
        ($_POST["picture"] == "avatar.png") ?: unlink("pictures/{$_POST["picture"]}");
        $sql = "UPDATE user SET first_name = '$f_name', last_name = '$l_name', email = '$email', phone = '$phone', adress = '$adress', picture = '$pictureArray->fileName' WHERE id = {$id}";
    } else {
        $sql = "UPDATE user SET first_name = '$f_name', last_name = '$l_name', email = '$email', phone = '$phone', adress = '$adress' WHERE id = {$id}";
    }
    if (mysqli_query($connect, $sql) === true) {     
        $class = "alert alert-success";
        $message = "The record was successfully updated";
        $uploadError = ($pictureArray->error != 0) ? $pictureArray->ErrorMessage : '';
        header("refresh:3;url=update.php?id={$id}");
    } else {
        $class = "alert alert-danger";
        $message = "Error while updating record : <br>" . $connect->error;
        $uploadError = ($pictureArray->error != 0) ? $pictureArray->ErrorMessage : '';
        header("refresh:3;url=update.php?id={$id}");
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
  <title>Edit User</title>
  <?php require_once 'components/boot.php'?>
  <style type= "text/css">
       .img-thumbnail{
           width: 70px;
           height: 70px;
           object-fit:cover;
       }

       .card {
                    border-radius: 20px;
                }
        body {
                background: rgb(140,150,118);
                background: linear-gradient(265deg, rgba(140,150,118,1) 48%, rgba(114,154,114,1) 100%);
            }
        .navbar {
            background-color: #232428; 
            }

        form {
            margin: auto;
            width: 60% ;
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
<div class ="container">
<div class="card shadow">
        <div class="d-flex justify-content-center align-items-center m-3">
       <h2>Update <?php echo $f_name ?> </h2>        
       <img class='img-thumbnail rounded-circle mx-2'  src='pictures/<?php echo $data['picture'] ?>' alt="<?php echo $f_name ?>">
        
        </div>
       <form  method="post" enctype="multipart/form-data" >
           <table  class="table">
               <tr>
                   <th>First Name</th >
                   <td><input class="form-control"  type="text"  name ="first_name" placeholder = "First Name"  value="<?php echo $f_name ?>"   /></td>
               </tr>
               <tr>
                   <th>Last Name</th> 
                   <td ><input class= "form-control" type= "text"  name="last_name"  placeholder="Last Name" value ="<?php echo $l_name ?>" /></td>
               </tr>
               <tr>
                   <th>Email</th> 
                   <td><input class ="form-control" type ="email" name ="email" placeholder = "Email" value = "<?php echo $email ?>" /></td>
               </tr>
               <tr>
                   <th>Adress</th> 
                    <td ><input class= "form-control" type ="text"  name="adress"  placeholder= "Adress"   value = "<?php echo $adress ?>"  /></td >
               </tr>
               <tr>
                   <th>Phone</th> 
                    <td ><input class= "form-control" type ="text"  name="phone"  placeholder= "Phone"   value = "<?php echo $phone ?>"  /></td >
               </tr>
               <tr>
                   <th>Picture</th> 
                    <td><input  class= "form-control"  type ="file"   name = "picture"   /></td> 
                </tr > 
                <tr > 
                    <input   type = "hidden"   name = "id"   value = "<?php echo $data['id'] ?>"  /> 
                    <input   type = "hidden"   name = "picture"   value = "<?php echo $picture ?>"  /> 
                </tr > 
            </table > 
            <div class="card-body d-flex justify-content-center">
                <td ><button   name = "submit"   class = "btn btn-success mx-2"   type = "submit" ><i class="far fa-save"></i> Save Changes </button ></td > 
                    <td ><a   href = "<?php echo $backBtn?>" ><button   class = "btn btn-warning"   type = "button" ><i class="fas fa-reply"></i> Back </button ></a ></td > 

            </div>
        </form >     
</div>
</body > 
</html >
