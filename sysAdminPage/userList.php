<?php



session_start();

if(!isset($_SESSION['fname'])){
   header('location:../login_form.php');
}
$conn = mysqli_connect('localhost','root','','rc_sms_db');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC-SMS-Sys Admin User List page</title>
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
	<?php @include('./header.php');?>
    
        

        <!-- ========================= Main ==================== -->
        
        
    <div  class=" py-4 container card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">List of System Users</h3>
		<div  class="card-tools" >
			<a href="./addNewUserList.php" style="align-self: flex-end;" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-hover table-striped">
				
				<thead>
					<tr>
						<th>#</th>
						
						<th>Name</th>
						<th>Username</th>
						<th>User Type</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$i = 1;
						$qry = $conn->query("SELECT *,concat(firstname,' ',lastname) as name from `user` where usertype != 'Admin' order by concat(firstname,' ',lastname) asc ");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo ucwords($row['name']) ?></td>
							<td ><p class="m-0 truncate-1"><?php echo $row['username'] ?></p></td>
							<td ><p class="m-0"><?php echo $row['usertype'] ?></p></td>
							<td >
				                  <a  href="./editUser.php?id=<?php echo $row['id']?>" class="btn btn-warning"> Edit</a>
								  <a  href="./deleteUser.php?id=<?php echo $row['id']?>" class="btn btn-danger"> Delete</a>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<?php @include('../footer.php');?>
    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>
	<script src="../js/bootstrap.bundle.min.js"></script>
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>