<?php



session_start();

if(!isset($_SESSION['fname'])){
   header('location:../login_form.php');
}
$conn = mysqli_connect('localhost','root','','rc_sms_db');
?>
<!DOCTYPE html>
<html >

<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC-SMS-Sys Storkeeper page</title>
    <!-- ======= Styles ====== -->
     <link rel="stylesheet" href="../css/bootstrap.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
      /* =========== Google Fonts ============ */

/* =============== Globals ============== */




    </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <?php @include('./header.php');?>
    <div style="margin-top: 30px;" class="container col-md-10">
         <h3 style="text-align:left"  class="">Dashboard</h3>
         <div class="row">

         <a href="./userList.php" style="text-decoration: none;" class="col-md-3 mb-3">
         <div class="card text-bg-danger mb-3 h-10" >
  <div class="card-header">Staffs</div>
  <div class="card-body">
  <div class="row">
    <div class="col-md-4"><i class="fa-regular fa-user fa-3x"></i></div>
    <div class="col-md-4"> <h1><?php 
                    echo $conn->query("SELECT * from `user` where usertype = 'Staff'")->num_rows;
                ?></h1></div>
    </div>
  </div>
</div>
         </a>
         <a href="./userList.php" style="text-decoration: none;" class="col-md-3 mb-3">
         <div class="card text-bg-secondary mb-3 h-10">
  <div class="card-header">Managers</div>
  <div class="card-body">
    <div class="row">
    <div class="col-md-4"><i class="fa-solid fa-user fa-3x"></i></div>
    <div class="col-md-4"> <h1><?php 
                    echo $conn->query("SELECT * from `user` where usertype = 'Manager'")->num_rows;
                ?></h1></div>
    </div>
    
   
    
    </div>
</div>
         </a>
         <a href="./userList.php" style="text-decoration: none;" class="col-md-3 mb-3">
         <div class="card text-bg-warning mb-3 h-10">
  <div class="card-header">Store keepers</div>
  <div class="card-body">
  <div class="row">
    <div class="col-md-4"><i class="fa-solid fa-store fa-3x"></i></div>
    <div class="col-md-4"> <h1><?php 
                    echo $conn->query("SELECT * from `user` where usertype = 'Storekeeper'")->num_rows;
                ?></h1></div>
    </div>
  </div>
</div>
         </a>
         <a href="./userList.php" style="text-decoration: none;" class="col-md-3 mb-3">
         <div class="card text-bg-success mb-3 h-10">
  <div class="card-header">Purchasers</div>
  <div class="card-body">
  <div class="row">
    <div class="col-md-4"><i class="fa-solid fa-bag-shopping fa-3x"></i></div>
    <div class="col-md-4"> <h1><?php 
                    echo $conn->query("SELECT * from `user` where usertype = 'Purchaser'")->num_rows;
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
    <?php @include('../footer.php');?>
   

        <!-- ========================= Main ==================== -->
        
        

    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>