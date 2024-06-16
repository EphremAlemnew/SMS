<?php



session_start();

if(!isset($_SESSION['fname'])){
   header('location:../login_form.php');
}
$issuedate = date('Y-m-d H:i:s');
$id = (int)$_GET['id'];
$conn = mysqli_connect('localhost','root','','rc_sms_db');


if(isset($_POST['submit'])){
          $purId = mysqli_real_escape_string($conn, $_POST['purchaser']);
          $update = "UPDATE `purchasing` SET `appByManager` = '1', `purchaser` = '$purId' WHERE `purchasing`.`id` = $id;";
          mysqli_query($conn, $update);
          header("location:./managerPurPage.php");
 
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
      
      <h3 style="text-align:center; margin-top:5%"  class="alert alert-dark">Approving Purchasing Item</h3>
      <?php if(isset($id)){
        $qry = $conn->query("SELECT * from `purchasing` WHERE `purchasing`.`id` = $id; ");
        $row = $qry->fetch_assoc();
        if($row['appByManager']==1){
            echo '<h2>Sorry, Item is assigned to purchaser! <h2/><a href="./managerPurPage.php" style="align-self: flex-end;" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Go to purchasing page?</a>';
     
        }
        else{
            ?>
            
            <div class="col-md-6">
          
          <div class="mb-3 form-floatin"> Select Purchaser
          <select  name="purchaser">
            <?php 
						$i = 1;
						$qry = $conn->query("SELECT *,concat(firstname,' ',lastname) as name from `user` where usertype = 'Purchaser' order by concat(firstname,' ',lastname) asc ");
						while($row = $qry->fetch_assoc()):
			?>
           
        
         <option value="<?php echo $row['id']?>"><?php echo ucwords($row['name']) ?></option>
        
        <?php endwhile; ?>
        </select>
        </div>
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