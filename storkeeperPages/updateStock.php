<?php
session_start();

if(!isset($_SESSION['fname'])){
    header('location:../login_form.php');
}

$conn = mysqli_connect('localhost','root','','rc_sms_db');

$id = 0;
$itemId = '';
$itemName = '';
$itemDesc = '';
$itemPdate = '';
$itemEdate = '';
$amount = '';

if($_SERVER['REQUEST_METHOD']=='GET' && isset($_GET['id'])){
    $id = (int)$_GET['id'];

    $select = "SELECT * FROM `stock` WHERE id=$id";
    $result = mysqli_query($conn, $select);
    
    if($result){
        $row = $result->fetch_assoc();
        if($row){
            $itemId = $row['code'];
            $itemName = $row['name'];
            $itemDesc = $row['description'];
            $itemPdate = $row['purdate'];
            $itemEdate = $row['expdate'];
            $amount = $row['amount'];
        }
    }
} elseif(isset($_POST['submit'])) {
    $id = (int)$_POST['id'];
    $itemId = mysqli_real_escape_string($conn, $_POST['code']);
    $itemName = mysqli_real_escape_string($conn, $_POST['itemName']);
    $itemDesc = mysqli_real_escape_string($conn, $_POST['itemDesc']);
    $itemPdate = mysqli_real_escape_string($conn, $_POST['Pdate']);
    $itemEdate = mysqli_real_escape_string($conn, $_POST['Edate']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);

    $update = "UPDATE `stock` SET `code` = '$itemId', `name` = '$itemName', `description` = '$itemDesc', `purdate` = '$itemPdate', `expdate` = '$itemEdate', `amount` = '$amount' WHERE `id` = $id";
    $result = mysqli_query($conn, $update);
    
    if(!$result){
        $error = mysqli_error($conn);
    } else {
        header('location:./storeStockPage.php');
        exit();
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
            <h3 style="text-align:center; margin-top:5%" class="alert alert-dark">Updating an item</h3>
            <div class="col-md-6">
                <label for="validationServer01" class="form-label">Item Code</label>
                <input type="text" class="form-control" name="code" id="validationServer01" value="<?php echo $itemId ?>" required>
            </div>
            <div class="col-md-6">
                <label for="validationServer02" class="form-label">Item Name</label>
                <input type="text" class="form-control" name="itemName" id="validationServer02" value="<?php echo $itemName ?>" required>
            </div>
            <div class="col-md-6">
                <label for="validationServer01" class="form-label">Description</label>
                <input type="text" class="form-control" name="itemDesc" id="validationServer01" value="<?php echo $itemDesc ?>" required>
            </div>
            <div class="col-md-6">
                <label for="validationServer02" class="form-label">Purchased date</label>
                <input type="text" class="form-control" name="Pdate" id="validationServer02" value="<?php echo $itemPdate ?>" required>
            </div>
            <div class="col-md-6">
                <label for="validationServer01" class="form-label">Expire Date</label>
                <input type="text" class="form-control" name="Edate" id="validationServer01" value="<?php echo $itemEdate ?>" required>
            </div>
            <div class="col-md-6">
                <label for="validationServer02" class="form-label">Amount</label>
                <input type="number" class="form-control" name="amount" id="validationServer02" value="<?php echo $amount ?>" required>
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
