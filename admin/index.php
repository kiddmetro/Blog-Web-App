<?php 

require_once ('../config/db.php')

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/fontawesome.css">

</head>
<body>
    
     <!-- *********** SIDE BAR ********** -->
     <div class="side-bar">

        <div class="side-bar-menu">
          <div class="side-bar-header text-light">
           <h2>ADMIN DASHBOARD</h2>
          </div>
            <div class="side-bar-option">
                <div>
                  <i class="fa-solid fa-gauge text-light mx-3 my-4"></i>
                   <a href="index.php" class="text-light">DashBoard</a>
                </div>    
                <div>
                  <i class="fa-solid fa-blog text-light  mx-3 my-4"></i>
                   <a href="" class="text-light">Blogs</a>
                </div>   
                <div>
                  <i class="fa-solid fa-cloud-arrow-up text-light  mx-3 my-4"></i>
                   <a href="./blog-upload.php" class="text-light">Upload Blogs</a>
                </div>   
                <div>
                  <i class="fa-solid fa-comments text-light  mx-3 my-4"></i>
                   <a href="comment.php" class="text-light">Comments</a>
                </div>  
                <div>
                <i class="fa-solid fa-reply text-light  mx-3 my-4"></i>
                   <a href="./replies.php" class="text-light">Replies</a>
                </div>                
            </div>
    
            <div class="bottom-icon">
              <a href="" class="text-light">LOGOUT</a>
              <i class="fa-solid fa-arrow-right-from-bracket ms-2 text-light"></i>
            </div>
        </div>
        
    </div>

    
    <div class="main-body">
        <!-- NAV BAR -->
        <nav class="dashboard-navbar">
            <div class="navbar-top">
                <div class="navbar-icon" >
                    <span class="fa fa-bars"></span>
                </div> 
                <div class="dashboard-logo">
                    <a class="navbar-brand" href="#"><span class="blog-logo">Blog</span><span class="blog-logo2">Book</span><img src="../image/logo/logo.svg" class="logo-image" alt="logo-fullstop"></a>
                </div>
                <div class="dashboard-menu">
                    <div>DashBoard</div>
                    <div>User</div>
                    <div>Settings</div>
                </div>

                <div class="dashboard-profile d-flex">
                    <div class="dashboard-profile-image" >
                        <img src="../image/cover-image/Image.png" alt="">
                    </div>

                    <div class="ms-2">
                      <i class="fa-regular fa-bell"></i>
                    </div>
                </div>
            </div>
            <hr>
            <div>
                <div class="d-flex pb-2 " >
                    <a class="px-3" href="" >Home</a>/
                    <a class="px-3" href="index.php" >Dashboard</a>
                </div>

            </div>

        </nav>

       
           <div class="table-wrapper" >
              <table class="">
                <thead>
                  <tr>
                    <th scope="col">User ID</th>
                    <th scope="col">User Info</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">?</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                  $query = "SELECT * FROM users";
                  $query_run = mysqli_query($db, $query);

                  if(mysqli_num_rows($query_run) > 0)
                  {
                      foreach($query_run as $userdata)
                      {
                        $userImage = $userdata['user_image'];

                        $createdAt = strtotime($userdata['created_at']); // Convert the created_at timestamp 
                          $formattedDate = date("M j, Y", $createdAt);
                ?>
                  <tr>
                    <th scope="row"><?= $userdata['user_id']; ?></th>
                    <td>
                      <div class="d-flex">
                        <div class="individual-profile">
                          <img class="profile-image" src="../image/cover-image/<?php echo $userImage; ?>" alt="userprofile">
                        </div>
                        <div class="user-row">
                          <div><span class="user-row-name"><?= $userdata['firstname']; ?></span> <span class="user-row-name"><?= $userdata['lastname']; ?></span></div>
                          <div class=" text-medium-emphasis"> Registered: <span><?php echo $formattedDate; ?></span></div>
                        </div>
                      </div>
                    </td>
                    <td> <?=$userdata['username'];?></td>
                    <td><?= $userdata['email']; ?></td>
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-transparent" type="button" id="dLabel" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fa-solid fa-ellipsis-vertical"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                          <a class="dropdown-item" href="#">Info</a>
                          <a class="dropdown-item" href="#">Edit</a>
                          <a class="dropdown-item text-danger" href="#">Delete</a>
                        </ul>
                      </div>
                    </td>
                  </tr>
                  <?php
                          }
                      }
                      else
                      {
                          echo "<h5> No Record Found </h5>";
                      }
                  ?>
                </tbody>
              </table>
           </div>
    </div>


    

    <script src="../node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.js"></script>


</body>
</html>