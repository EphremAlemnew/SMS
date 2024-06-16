<?php



session_start();

if(!isset($_SESSION['fname'])){
   header('location:../login_form.php');
}elseif($_SESSION['changed']==0){
    header('location:./purchaserHomePage.php');   
}
$id=$_SESSION['id'];
$conn = mysqli_connect('localhost','root','','rc_sms_db');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC-SMS-Sys Purchaser page</title>
    <!-- ======= Styles ====== -->
     <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
      /* =========== Google Fonts ============ */
@import url("https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap");

/* =============== Globals ============== */




    </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <?php @include('./header.php'); ?>
        

        <!-- ========================= Main ==================== -->
        
        
    <div  class="container card card-outline card-primary">
	<div style="align-content: center;" class="card-header ">
		<h3 style="align-self: center;" class="card-title">List of Returned Materials</h3>
	</div>
    
	<div class="card-body">
		<div class="">
        <div class="">
			<table class="table table-hover table-striped">
				
				<thead>
					<tr>
						<th>#</th>
						<th>Item code</th>
						<th>Item Name</th>
                  <th>Description</th>
                  <th>Purchased date</th>
                  <th>Expire date</th>
						<th>Amount</th>
                        <th>Reason</th>
                        <!-- <th>Purchased by</th> -->
						<!-- <th>Action</th> -->
					</tr>
				</thead>
				<tbody>
					<?php 
						$i = 1;
						$qry = $conn->query("SELECT * from `returns` WHERE `purby`='$id' ");
                        if($qry->num_rows > 0){
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo $row['code'] ?></td>
							<td ><p class="m-0 truncate-1"><?php echo $row['name'] ?></p></td>
							<td ><p class="m-0"><?php echo $row['description'] ?></p></td>
							<td><p class="m-0"><?php echo $row['purdate'] ?></p></td>
                     <td><p class="m-0"><?php echo $row['expdate'] ?></p></td>
                     <td><p class="m-0"><?php echo $row['amount'] ?></p></td>
                     <td><p class="m-0"><?php echo $row['reason'] ?></p></td>
                     <!-- <td><p class="m-0"><?php echo $row['purby'] ?></p></td> -->
                     <!-- <td >
                     <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Action</a>
            <ul class="dropdown-menu">
              <a href="./returnEdit.php?id=<?php echo $row['id']?>" class="dropdown-item btn btn-primary"><span class="d-inline-block bg-success rounded-circle p-1"></span>Edit</a>
              <a href="./returnToStore.php?id=<?php echo $row['id']?>"" class="dropdown-item btn btn-secondary"><span class="d-inline-block bg-primary rounded-circle p-1"></span>Return to store</a>
             <a href="./returnDelete.php?id=<?php echo $row['id']?>" class="dropdown-item btn btn-danger"><span class="d-inline-block bg-danger rounded-circle p-1"></span> Delete</a>
            </ul>
          </div>
				                  
							</td> -->
						</tr>
					<?php endwhile;}else{
                        echo '<h2>Sorry, No Returned items!<h2/>';
                    } ?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<?php @include('../footer.php'); ?>
    <!-- =========== Scripts =========  -->
    <script src="../js/bootstrap.bundle.min.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>