<?php



session_start();

if(!isset($_SESSION['fname'])){
   header('location:../login_form.php');
}
$issuedate = date('Y-m-d H:i:s');
$conn = mysqli_connect('localhost','root','','rc_sms_db');
if(isset($_POST['submit'])){

    $itemId = mysqli_real_escape_string($conn, $_POST['code']);
    $itemName = mysqli_real_escape_string($conn, $_POST['itemName']);
    $itemDesc = mysqli_real_escape_string($conn, $_POST['itemDesc']);
    
    // $itemEdate = mysqli_real_escape_string($conn, $_POST['Edate']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
 
    $select = " SELECT * FROM purchasing WHERE code = '$itemId' ";
 
    $result = mysqli_query($conn, $select);
 
    if(mysqli_num_rows($result) > 0){
 
       $error = 'This Item already exist!';
 
    }else{
 
      
          $insert = "INSERT INTO `purchasing` (`id`, `code`, `name`, `description`, `issuedate`, `purdate`, `expdate`, `amount`, `appByManager`, `appByStore`, `Purchased`, `purchaser`) VALUES (NULL, '$itemId', '$itemName', '$itemDesc', '$issuedate', '', '', '$amount', 0, 0, 0, NULL);";
          mysqli_query($conn, $insert);
          $error = 'A New purchasing added successfully!';
          
       
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
        
   <form method="post" action="" class="row g-4">
   <?php
      if(isset($error)){
        
            echo '<div class="alert alert-success" role="alert">'.$error.'</div>';
        
      };
      ?>
      <h3 style="text-align:center; margin-top:5%"  class="alert alert-dark">Add new Purchasing Items</h3>
          <div class="col-md-6">
          
            <label for="validationServer01" class="form-label">Item Code</label>
            <input type="text" class="form-control" name="code" id="validationServer01"  required>
            
          </div>
          <div class="col-md-6">
            <label for="validationServer02" class="form-label">Item Name</label>
            <input type="text" class="form-control " name="itemName" id="validationServer02"  required>
           
          </div>
          <div class="col-md-6">
            <label for="validationServer01" class="form-label">Item Description</label>
            <input type="text" class="form-control " name="itemDesc" id="validationServer01"  required>
            
          </div>
          
          <div class="col-md-6">
            <label for="validationServer02" class="form-label">Amount</label>
            <input type="number" class="form-control " name="amount" id="validationServer02"  required>
            
          </div>
          <div class="col-12">
          <input type="submit" name="submit" value="Submit" class="btn btn-primary">
       </div>
        </form>

</div>
   <?php @include('../footer.php');?>

        <!-- ========================= Main ==================== -->
        
        

        <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>