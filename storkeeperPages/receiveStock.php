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
$reason='';
$pBy='';

if($_SERVER['REQUEST_METHOD']=='GET' && isset($_GET['id'])){
    $id = (int)$_GET['id'];

    $select = "SELECT * FROM `purchasing` WHERE id=$id";
    $result = mysqli_query($conn, $select);
    
    if($result){
        $row = $result->fetch_assoc();
        if($row){
            if($row['Purchased']==0&&$row['appByManager']==0){
                echo '<div class="container align-items-center"><h2>Sorry, No The item is not Purchased or Approved yet!<h2/><a href="./storePurchasing.php" style="align-self: flex-end;" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Go to purchasing page?</a>
						</div>';
                
            }else{
                $itemId = $row['code'];
            $itemName = $row['name'];
            $itemDesc = $row['description'];
            $itemPdate = $row['purdate'];
            $itemEdate = $row['expdate'];
            $amount = $row['amount'];
            $insert = "INSERT INTO `stock` (`id`, `code`, `name`, `description`, `purdate`, `expdate`, `amount`) VALUES (NULL, '$itemId', '$itemName', '$itemDesc', '$itemPdate', '$itemEdate', '$amount');";
            $result = mysqli_query($conn, $insert);
            if(!$result){
                $error = mysqli_error($conn);
            } else {
            $delete = "DELETE FROM `purchasing` WHERE `purchasing`.`id` = $id";
            $result = mysqli_query($conn, $delete);
            header('location:./storePurchasing.php');
            }
        }
            

            
    
    
        }
    }
} elseif(isset($_POST['submit'])) {
    $id = (int)$_POST['id'];
    $itemId = mysqli_real_escape_string($conn, $_POST['code']);
    $itemName = mysqli_real_escape_string($conn, $_POST['itemName']);
    $itemDesc = mysqli_real_escape_string($conn, $_POST['itemDesc']);
    $itemPdate = mysqli_real_escape_string($conn, $_POST['Pdate']);
    $itemEdate = mysqli_real_escape_string($conn, $_POST['Edate']);
    $reason = mysqli_real_escape_string($conn, $_POST['reason']);
    $pBy = mysqli_real_escape_string($conn, $_POST['pBy']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);

    
    $update = "UPDATE `returns` SET `code` = '$itemId', `name` = '$itemName', `description` = '$itemDesc', `purdate` = '$itemPdate', `expdate` = '$itemEdate', `amount` = '$amount', `reason` = '$reason', `purby` = '$pBy' WHERE `returns`.`id` = $id;";
    $result = mysqli_query($conn, $update);
    
    if(!$result){
        $error = mysqli_error($conn);
    } else {
    
    header('location:./storeReturnPage.php');
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
    
</html>