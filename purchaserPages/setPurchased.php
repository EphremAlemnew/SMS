<?php



session_start();

if(!isset($_SESSION['fname'])){
   header('location:../login_form.php');
}
$issuedate = date('Y-m-d H:i:s');
$id = (int)$_GET['id'];
$conn = mysqli_connect('localhost','root','','rc_sms_db');


if(isset($_POST['submit'])){
          $expdate = mysqli_real_escape_string($conn, $_POST['expdate']);
          $update = "UPDATE `purchasing` SET `Purchased` = '1', `expdate`='$expdate',`purdate`='$issuedate' WHERE `purchasing`.`id` = $id;";
          mysqli_query($conn, $update);
          header("location:./purPurchasing.php");
 
 };
 
?>
<!DOCTYPE html>
<html >

<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC-SMS-Sys Manager page</title>
    <!-- ======= Styles ====== -->
     <link rel="stylesheet" href="../css/bootstrap.min.css">
   
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
      
      <h3 style="text-align:center; margin-top:5%"  class="alert alert-dark">Approving Purchased Item</h3>
      <?php if(isset($id)){
        $qry = $conn->query("SELECT * from `purchasing` WHERE `purchasing`.`id` = $id; ");
        $row = $qry->fetch_assoc();
        if($row['appByManager']==0){
            echo '<h2>Sorry, Item is not Approved to purchase! <h2/><a href="./purPurchasing.php" style="align-self: flex-end;" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Go to purchasing page?</a>';
     
        }elseif($row['Purchased']==1){
            echo '<h2>Sorry, Item is Already purchased! <h2/><a href="./purPurchasing.php" style="align-self: flex-end;" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Go to purchasing page?</a>';
     
        }
        else{
            ?>
            <div class="col-md-6">
            <label for="validationServer02" class="form-label">Enter Expire date of the item</label>
            <input type="text" class="form-control " placeholder="YYYY-MM-DD" name="expdate" id="validationServer02"  required>
           
          </div>
            
          
          
          <div class="col-12">
          <input type="submit" name="submit" value="Submit" class="btn btn-primary">
       </div>
            
            <?php
        }	
     }
?>





          
        </form>

</div>
   <?php @include('../footer.php');?>

        <!-- ========================= Main ==================== -->
        
        

        <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>