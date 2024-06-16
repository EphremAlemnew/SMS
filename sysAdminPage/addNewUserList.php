<?php



session_start();

if(!isset($_SESSION['fname'])){
   header('location:../login_form.php');
}
$conn = mysqli_connect('localhost','root','','rc_sms_db');
if(isset($_POST['submit'])){

    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $user_type = $_POST['user_type'];
 
    $select = " SELECT * FROM user WHERE username = '$username' && password = '$pass' ";
 
    $result = mysqli_query($conn, $select);
 
    if(mysqli_num_rows($result) > 0){
 
       $error = 'user already exist!';
 
    }else{
 
       if($pass != $cpass){
          $error = 'password not matched!';
       }else{
          $insert = "INSERT INTO user(firstname, lastname, username, password, usertype, changed) VALUES('$firstname','$lastname','$username','$pass','$user_type','0')";
          mysqli_query($conn, $insert);
          $error = 'A new user is added to the system successfully!';
          
       }
    }
 
 };
 
?>
<!DOCTYPE html>
<html >

<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC-SMS-Sys Storkeeper page</title>
    <!-- ======= Styles ====== -->
     <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
      /* =========== Google Fonts ============ */

/* =============== Globals ============== */




    </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <?php @include('./header.php');?>
        <div class="container col-md-6">
        <?php
      if(isset($error)){
        
            echo '<div class="alert alert-success" role="alert">'.$error.'</div>';
        
      };
      ?>
   <form action="" class="main" method="post">
      <h3>Add new user</h3>
      <div class="mb-3 form-floating">
            <input type="text" name="firstname" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">First name</label>
     </div>
     <div class="mb-3  form-floating">
            <input type="text" name="lastname" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Last Name</label>
     </div>
     <div class="mb-3 form-floating">
            <input type="text" name="username" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">User name</label>
     </div>
     <div class="mb-3  form-floating">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
     </div>
     <div class="mb-3 form-floating">
            <input type="password" name="cpassword" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Confirm password</label>
     </div>
          
        <div class="mb-3 form-floatin"> User type :>
        <select  name="user_type">
         <option value="Admin">system Admin</option>
         <option value="Manager">Manager</option>
         <option value="Storekeeper">Storekeeper</option>
         <option value="Staff">Staff</option>
         <option value="Purchaser">Purchaser</option>
      </select>
        </div> 
    
    <div>
    <input type="submit" name="submit" value="Register now" class="btn btn-primary">
    
    </div>
      
      </div>
      
      
   </form>

</div>
   <?php @include('../footer.php');?>

        <!-- ========================= Main ==================== -->
        
        

        <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>