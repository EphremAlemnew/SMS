
<nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-gradient sticky-top">
            <div class="container px-3 px-lg-0 ">
                 <a class="navbar-brand" href="./adminHomePage.php">
                <img src="../assets/imgs/logo.png" style="border-radius: 50%;" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
                Royal college SMS
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="./adminHomePage.php">Home</a></li>
                        
                        <li class="nav-item"><a class="nav-link" href="./userList.php">User List</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Settings</a></li>
                        
                    </ul>
                    <div class="navbar-nav ml-auto d-flex align-items-center">
                        <a href="#" class="text-light  nav-link"><b> Hi<?php echo " ".$_SESSION['fname']." ".$_SESSION['lname']?> !</b></a>
                            
                        
                    </div>
                    <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" style="color: white;" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Profile</a></li>
               <li><a class="dropdown-item" href="../logout.php">Log out</a></li>
            </ul>
          </div>
                </div>
            </div>
        </nav>