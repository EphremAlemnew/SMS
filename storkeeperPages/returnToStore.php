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

    $select = "SELECT * FROM `returns` WHERE id=$id";
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
            $reason = $row['reason'];
            $pBy = $row['purby'];

            $insert = "INSERT INTO `stock` (`id`, `code`, `name`, `description`, `purdate`, `expdate`, `amount`) VALUES (NULL, '$itemId', '$itemName', '$itemDesc', '$itemPdate', '$itemEdate', '$amount');";
          $result = mysqli_query($conn, $insert);
    
    if(!$result){
        $error = mysqli_error($conn);
    } else {
    $delete = "DELETE FROM `returns` WHERE `returns`.`id` = $id";
    $result = mysqli_query($conn, $delete);
    header('location:./storeReturnPage.php');
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

<
