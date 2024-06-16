<?php



session_start();

if(!isset($_SESSION['fname'])){
   header('location:../login_form.php');
}
$id=0;
$issuedate = date('Y-m-d H:i:s');
$reqId=$_SESSION['id'];
$conn = mysqli_connect('localhost','root','','rc_sms_db');
if(isset($_POST['submit'])){

    $id = mysqli_real_escape_string($conn, $_POST['req']);
    $amount= mysqli_real_escape_string($conn, $_POST['amount']);
    $select = " SELECT * FROM stock WHERE `id` = '$id' ";

    $result = mysqli_query($conn, $select);
 
    if(mysqli_num_rows($result) > 0){
        $row = $result->fetch_assoc();
        $itemId = $row['code'];
        $itemName = $row['name'];
        $itemDesc = $row['description'];
        $itemPdate = $row['purdate'];
        $itemEdate = $row['expdate'];
        $amount1 = $row['amount'];
        if($amount>$amount1){
            $error = 'Amount is more than stock amount. please require below'.$amount1.' '.'amount';
        }else{
        $insert = "INSERT INTO `requests` (`id`, `code`, `name`, `description`, `purdate`, `expdate`, `reqDate`, `amount`, `appByManager`, `appByStore`, `requestedBy`, `appByReq`) VALUES (NULL, '$itemId', '$itemName', '$itemDesc', '$itemPdate', '$itemEdate', '$issuedate', '$amount', '0', '0', '$reqId', '0');";
        mysqli_query($conn, $insert);
        $error = 'Your request is sent, wait for the approval!';
        }
    }else{
          
          $error = 'Sorry Something Went wrong!';
    }
 
 };
 
?>
<!DOCTYPE html>
<html >

<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC-SMS-Sys Staffs page</title>
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
      <h3 style="text-align:center; margin-top:5%"  class="alert alert-dark">Require new item</h3>
      <div class="col-md-6">
          
          <div class="mb-3  form-floating"> Select the item you want to require! 
          <select  name="req">
            <?php 
						$i = 1;
						$qry = $conn->query("SELECT * FROM `stock`;");
						while($row = $qry->fetch_assoc()):
			?>
           
        
         <option value="<?php echo $row['id']?>"><?php echo $row['name'] ?></option>
        
        <?php endwhile; ?>
</select></div>
          <div class="col-md-6 mb-3">
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