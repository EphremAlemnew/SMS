<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   
   $email = mysqli_real_escape_string($conn, $_POST['username']);
   $pass = md5($_POST['password']);
   
   $select = " SELECT * FROM user WHERE username = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['usertype'] == 'Admin'){

         $_SESSION['fname'] = $row['firstname'];
         $_SESSION['lname'] = $row['lastname'];
         $_SESSION['usertype'] = $row['usertype'];
         header('location:./sysAdminPage/adminHomePage.php');

      }elseif($row['usertype'] == 'Manager'){

         $_SESSION['fname'] = $row['firstname'];
         $_SESSION['lname'] = $row['lastname'];
         $_SESSION['usertype'] = $row['usertype'];
         $_SESSION['id'] = $row['id'];
         $_SESSION['changed'] = $row['changed'];
         
         header('location:./managerPages/managerHomePage.php');

      }
      elseif($row['usertype'] == 'Storekeeper'){

         $_SESSION['fname'] = $row['firstname'];
         $_SESSION['lname'] = $row['lastname'];
         $_SESSION['usertype'] = $row['usertype'];
         $_SESSION['id'] = $row['id'];
         $_SESSION['changed'] = $row['changed'];
         header('location:./storkeeperPages/storekeeperHomePage.php');

      }elseif($row['usertype'] == 'Staff'){

         $_SESSION['fname'] = $row['firstname'];
         $_SESSION['lname'] = $row['lastname'];
         $_SESSION['usertype'] = $row['usertype'];
         $_SESSION['id'] = $row['id'];
         $_SESSION['changed'] = $row['changed'];

         header('location:./staffsPages/staffHomePage.php');

      }elseif($row['usertype'] == 'Purchaser'){

         $_SESSION['fname'] = $row['firstname'];
         $_SESSION['lname'] = $row['lastname'];
         $_SESSION['usertype'] = $row['usertype'];
         $_SESSION['id'] = $row['id'];
         $_SESSION['changed'] = $row['changed'];
         header('location:./purchaserPages/purchaserHomePage.php');

      }
     
   }else{
      $error[] = 'Incorrect username or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/style.css">
<style>
   body {
            background-image: url('./assets/imgs/OIP.jpeg');
            background-size: cover; /* Ensures the image covers the entire background */
            background-repeat: no-repeat; /* Prevents the image from repeating */
            
        }
</style>
</head>
<body >
   
<div class="form-container">

   <form action="" method="post">
      <h4>Welcome to Royal college stock management system(RC-SMS)</h4>
      <h3>Log in</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="username" required placeholder="enter your user name">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="submit" name="submit" value="login now" class="form-btn">
      <h6 class=" mb-md-0 text-body-secondary" style="color: red;">If you forget the password contact the admin!</h6>
      <span class=" mb-md-0 text-body-secondary">&copy; 2024 Royal college stock management system RC-SMS</span>
      
    
   </form>

</div>

</body>
</html>