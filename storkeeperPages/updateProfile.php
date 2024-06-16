<?php
session_start();

if(!isset($_SESSION['fname'])){
    header('location:../login_form.php');
}

$conn = mysqli_connect('localhost','root','','rc_sms_db');

$id = 0;
$fname = '';
$lname = '';
$username = '';


if($_SERVER['REQUEST_METHOD']=='GET' && isset($_GET['id'])){
    $id = (int)$_GET['id'];

    $select = "SELECT * FROM `user` WHERE id=$id";
    $result = mysqli_query($conn, $select);
    
    if($result){
        $row = $result->fetch_assoc();
        if($row){
            $fname = $row['firstname'];
            $lname = $row['lastname'];
            $username = $row['username'];
            $id= $row['id'];
            
        }
    }
} elseif(isset($_POST['submit'])) {
    
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = md5($_POST['pass']);
    $pass2 = md5($_POST['pass2']);
    if($pass==''){
        $update = "UPDATE `user` SET `firstname` = 'Meselechh', `lastname` = 'Berhanu' WHERE `user`.`id` = 6;";
    $result = mysqli_query($conn, $update);
    
    if(!$result){
        $error = mysqli_error($conn);
    } else {
        header('location:./storeStockPage.php');
        exit();
    }
    }else{

    }
    
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC-SMS-Sys Storkeeper page</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
      /* =========== Google Fonts ============ */
      /* =============== Globals ============== */
    </style>
</head>
<body>
    <!-- =============== Navigation ================ -->
    <?php @include('./header.php'); ?>
    <div class="container col-md-6">
        <form method="post" class="row g-4">
            <input type="hidden" name="id" value="<?php echo $id ?>" />
            <?php
            if(isset($error)){
                echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
            };
            ?>
            <h3 style="text-align:center; margin-top:5%" class="alert alert-dark">Updating Your Profile</h3>
            <div class="col-md-6">
                <label for="validationServer01" class="form-label">First Name</label>
                <input type="text" class="form-control" name="fname" id="validationServer01" value="<?php echo $fname ?>" required>
            </div>
            <div class="col-md-6">
                <label for="validationServer02" class="form-label">Last Name</label>
                <input type="text" class="form-control" name="lname" id="validationServer02" value="<?php echo $lname ?>" required>
            </div>
            <div class="col-md-6">
                <label for="validationServer01" class="form-label">User name</label>
                <input type="text" class="form-control" name="username" id="validationServer01" value="<?php echo $username ?>" required>
            </div>
            <h5 style="text-align:left;color:red; margin: 10px;">If you don't want to update the password leave blank!</h5>
            <div class="col-md-8">
                <label for="validationServer01" class="form-label">Password</label>
                <input type="password" class="form-control" name="pass" id="validationServer01" >
            </div>
            <div class="col-md-8">
                <label for="validationServer01" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="pass2" id="validationServer01" >
            </div>
            
            
            
            <div class="col-6">
                <input type="submit" name="submit" value="Update" class="btn btn-primary">
            </div>
            <div class="col-6">
            <a href="./storeStockPage.php" class="btn btn-secondary" > Cancel</a>
                
            </div>
        </form>
    </div>
    <?php @include('../footer.php'); ?>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
