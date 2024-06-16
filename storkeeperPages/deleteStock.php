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

    $delete = "DELETE FROM `stock` WHERE `stock`.`id` = $id";
    $result = mysqli_query($conn, $delete);
    header('location:./storeStockPage.php');
    
}

?>