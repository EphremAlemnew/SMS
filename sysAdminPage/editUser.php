<?php



session_start();

if(!isset($_SESSION['fname'])){
   header('location:../login_form.php');
}

$id=0;
$firstname='';
$lastname= '';
$username='';
$conn = mysqli_connect('localhost','root','','rc_sms_db');


if($_SERVER['REQUEST_METHOD']=='GET' && isset($_GET['id'])){
    $id = $_GET['id'];
    $select = "SELECT * FROM `user` WHERE id=$id";
    $result = mysqli_query($conn, $select);
    
    if($result){
        $row = $result->fetch_assoc();
        if($row){
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $username = $row['username'];
            
        }
    }

}

if(isset($_POST['submit'])){

          $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
          $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
          $username = mysqli_real_escape_string($conn, $_POST['username']);
          $insert = "UPDATE `user` SET `firstname` = '$firstname', `lastname` = '$lastname', `changed` = '0' WHERE `user`.`id` = $id;";
          mysqli_query($conn, $insert);
          $error = 'Account updated successfully!';  
 
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
   <form class="main" method="post">
      <h3>Updating user</h3>
      <div class="mb-3 form-floating">
            <input type="text" name="firstname" class="form-control" id="floatingPassword" value="<?php echo $firstname ?>" placeholder="Password">
            <label for="floatingPassword">First name</label>
     </div>
     <div class="mb-3  form-floating">
            <input type="text" name="lastname" class="form-control" id="floatingPassword" value="<?php echo $lastname ?>" placeholder="Password">
            <label for="floatingPassword">Last Name</label>
     </div>
     <div class="mb-3 form-floating">
            <input type="text" name="username" class="form-control" id="floatingPassword" value="<?php echo $username ?>" placeholder="Password">
            <label for="floatingPassword">User name</label>
     </div>
    
    <div>
    <input type="submit" name="submit" value="Update" class="btn btn-primary">
    
    </div>
      
      </div>
      
      
   </form>

</div>
   <?php @include('../footer.php');?>

        <!-- ========================= Main ==================== -->
        
        

        <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>