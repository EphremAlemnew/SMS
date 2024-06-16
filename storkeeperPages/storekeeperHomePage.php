<?php



session_start();

if(!isset($_SESSION['fname'])){
   header('location:../login_form.php');
}
$conn = mysqli_connect('localhost','root','','rc_sms_db');

if(isset($_POST['submit'])){
   $firstname = $_SESSION['fname'];
   $lastname = $_SESSION['lname'];
   
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_SESSION['usertype'];
   $id=$_SESSION['id'];

   if($pass != $cpass){
    $error[] = 'Sorry password is not matched!';
 }else{
    $insert = "UPDATE `user` SET `password` = '$pass', `changed` = '1' WHERE `user`.`id` = $id ;";
    mysqli_query($conn, $insert);
    $error[] = 'Success!';
    header('location:../login_form.php');
 }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC-SMS-Sys Storkeeper page</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   
    <!-- ======= Styles ====== -->
     <link rel="stylesheet" href="../css/bootstrap.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
 <style>
      /* =========== Google Fonts ============ */
@import url("https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap");

/* =============== Globals ============== */

    </style>
</head>
    <!-- =============== Navigation ================ -->
    <?php @include('./header.php');?>

        <?php if( $_SESSION['changed'] ==0 ){
            
        ?>
        <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
         };
      };
      ?>
        <div class="container col-md-8"  >
        <h4 style="align-self: center;" >Sorry <?php echo $_SESSION['fname']." ".$_SESSION['lname']?> You have to change the password first!</h4>
        </div>
        <div style="align-self: center;" class="container col-md-8">
            <form method="post" class="main" >
             
          <div class="mb-3 col-md-4 form-floating">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
          </div>
          <div class="mb-3 col-md-4 form-floating">
            <input type="password" name="cpassword" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Confirm Password</label>
          </div>
          <button name="submit" class="btn btn-primary align-self-center">Submit</button>
            </form>
        </div>
        <?php }else{
            ?>
         <div style="margin-top: 30px;" class="container col-md-10">
         <h3 style="text-align:left"  class="">Dashboard</h3>
         <div class="row">

         <a href="./storeStockPage.php" style="text-decoration: none;" class="col-md-3 mb-3">
         <div class="card text-bg-danger mb-3 h-10" >
  <div class="card-header">Stocks</div>
  <div class="card-body">
  <div class="row">
    <div class="col-md-4"><i class="fa-brands fa-slack fa-3x"></i></div>
    <div class="col-md-4"> <h1><?php 
                    echo $conn->query("SELECT * FROM `stock`;")->num_rows;
                ?></h1></div>
    </div>
  </div>
</div>
         </a>
         <a href="./storeReturnPage.php" style="text-decoration: none;" class="col-md-3 mb-3">
         <div class="card text-bg-secondary mb-3 h-10">
  <div class="card-header">Returns</div>
  <div class="card-body">
    <div class="row">
    <div class="col-md-4"><i class="fa-solid fa-arrow-rotate-left fa-3x"></i></div>
    <div class="col-md-4"> <h1><?php 
                    echo $conn->query("SELECT * FROM `returns`;")->num_rows;
                ?></h1></div>
    </div>
    
   
    
    </div>
</div>
         </a>
         <a href="./storePurchasing.php" style="text-decoration: none;" class="col-md-3 mb-3">
         <div class="card text-bg-warning mb-3 h-10">
  <div class="card-header">Purchasings</div>
  <div class="card-body">
  <div class="row">
    <div class="col-md-4"><i class="fa-solid fa-cart-shopping fa-3x"></i></div>
    <div class="col-md-4"> <h1><?php 
                    echo $conn->query("SELECT * FROM `purchasing`;")->num_rows;
                ?></h1></div>
    </div>
  </div>
</div>
         </a>
         <a href="./storeRequestsPage.php" style="text-decoration: none;" class="col-md-3 mb-3">
         <div class="card text-bg-success mb-3 h-10">
  <div class="card-header">Requests</div>
  <div class="card-body">
  <div class="row">
    <div class="col-md-4"><i class="fa-solid fa-bell-concierge fa-3x"></i></div>
    <div class="col-md-4"><h1> <?php 
                    echo $conn->query("SELECT * FROM `requests`;")->num_rows;
                ?></h1></div>
    </div>
  </div>
</di>
         </div>
         
         </a>
         <h3 style="text-align:left"  class="">About</h3>
         <p>Royal college is one of the 1stprivate collages in Oromiya adama Shewa located in oromiya Region, around mebrat haile, Ethiopia. The collage was inaugurated by the owner from abroad in 1999 E.C and it was among the 1st non-governmental collage in the nation with persistent commitment the pursuit to establish as the nation’s leading education care provider. Then the collage development its facilities, technology, service standards and personnel to become a renowned institution.
         Royal collage is tertiary institution in Addis Ababa Ethiopia its one of a number of privately run collages that emerged following the opening to private investment of educational sector. The collage provides degree, TVET and certificate training in Accounting, Business Administration and marketing management, information technology. It also offers certificates and TVET in these fields as well as in then secretarial science, Accounting, hardware, data base, in this collage situated in adama town, oromiya region around mebrat haile.</p>
          
         </div>
            
        <?php } ?>

        
        <?php @include('../footer.php'); ?>

        

        <!-- ========================= Main ==================== -->
        
        
    

    <!-- =========== Scripts =========  -->
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>