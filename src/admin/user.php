<!--
=========================================================
* Paper Dashboard 2 - v2.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/paper-dashboard-2
* Copyright 2020 Creative Tim (https://www.creative-tim.com)

Coded by www.creative-tim.com

 =========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<?php
    include "../models/db.php";
    include "utils.php";
    $db = new DbBase();
    $Users = new Users($db);
    if (isset($_GET['id'])){
        $userid = (int)$_GET['id'];
        $user = $Users->getUserById($userid);
        $username = $user['name'];
        $userpwd = $user['password'];
        $useremail = $user['email'];
        $userphone = $user['phone'];
    } 
    //else if (isset($_GET['create'])){
        //echo "<script>console.log('Debug Objects: " . isset($_GET['create']) . "' );</script>";
    //}
    //echo "<script>console.log('Debug Objects: " . isset($_GET['id']) . "' );</script>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Paper Dashboard 2 by Creative Tim
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project 
  <link href="assets/demo/demo.css" rel="stylesheet" />-->
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="https://www.creative-tim.com" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="assets/img/logo-small.png">
          </div>
          <!-- <p>CT</p> -->
        </a>
        <a href="#" class="simple-text logo-normal">
          HOME
          <!-- <div class="logo-image-big">
            <img src="assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li>
            <a href="./dashboard.php">
              <i class="nc-icon nc-bank"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="active ">
            <a href="./manage_user.php">
              <i class="nc-icon nc-single-02"></i>
              <p>Manage Users</p>
            </a>
          </li>
          <li>
            <a href="./manage_dish.php">
              <i class="nc-icon nc-tile-56"></i>
              <p>Manage Dishes</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="manage_user.php"><i class="nc-icon nc-minimal-left"></i> Back to Management</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="nc-icon nc-zoom-split"></i>
                  </div>
                </div>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link btn-magnify" href="javascript:;">
                  <i class="nc-icon nc-layout-11"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Stats</span>
                  </p>
                </a>
              </li>
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-bell-55"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link btn-rotate" href="javascript:;">
                  <i class="nc-icon nc-settings-gear-65"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Account</span>
                  </p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="row">
          <div class="col-md-4" style="<?php if (isset($_GET['create'])){ echo 'display: none;'; }?>">
            <div class="card card-user">
              <div class="image">
                <img src="assets/img/damir-bosnjak.jpg" alt="...">
              </div>
              <div class="card-body">
                <div class="author">
                  <a href="#">
                    <img class="avatar border-gray" src="assets/img/default-avatar.png" alt="...">
                    <h5 class="title">Name Placeholder</h5>
                  </a>
                </div>
                <p class="description text-center">
                  "Anh thanh nien tre <br>
                  Voi tam hon gia coi"
                </p>
              </div>
              <div class="card-footer">
                <hr>
                <div class="button-container">
                  <div class="row">
                    <div class="col-lg-3 col-md-6 col-6 ml-auto">
                      <h5>12<br><small>Orders</small></h5>
                    </div>
                    <div class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
                      <h5>20<br><small>Dishes</small></h5>
                    </div>
                    <div class="col-lg-3 mr-auto">
                      <h5>24,6$<br><small>Spent</small></h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card card-user">
              <div class="card-header row" style="padding: 0 30px;">
                    <!--<h5 class="card-title">Edit Profile</h5>-->
                    <?php
                        if (isset($_GET['create'])){
                            echo "<h5 class=\"card-title\">Create Profile</h5>";
                        } else{
                            echo "<h5 class=\"card-title\">Edit Profile</h5>";
                        } 
                        if (isset($_POST['remove_user'])){
                            $result = $Users->deleteUserById($userid);
                            if ($result){
                                echo "<script type='text/javascript'>alert('Success');</script>";
                                redirect("manage_user.php");
                            }
                        } 
                    ?>
                <div style="margin-left:auto; margin-right:0; <?php if (isset($_GET['create'])){ echo 'display: none;'; }?>">
                    <form method="post">
                        <input type="submit" class="btn btn-danger btn-round" name="remove_user" value="Remove"/>
                    </form>
                </div>
              </div>
              <div class="card-body">
                <form method="post">
                  <?php 
                    if (isset($_POST['update_profile'])){
                        $username = $useremail = $userphone = $userpwd = "";
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                          $username = test_input($_POST["username"], "username");
                          $useremail = test_input($_POST["email"]);
                          $userphone = test_input($_POST["phone"]);
                          $newpwd = test_input($_POST["password"]);
                          if (!empty($newpwd)){
                              $userpwd = $newpwd;
                          }
                        }
                        if (strlen($username) < 6){
                            echo "<script type='text/javascript'>alert('Username should be 6 characters or longer');</script>";
                        }else if (strlen($userpwd) < 6){
                            echo "<script type='text/javascript'>alert('Password should be 6 characters or longer');</script>";
                        }else {
                            if (isset($_GET['create'])){
                                $result = $Users->createUser($username, $useremail, $userphone, $userpwd);
                            } else{
                                $result = $Users->updateUserById($userid, $username, $useremail, $userphone, $userpwd);
                            }
                            if ($result){
                                echo "<script type='text/javascript'>alert('Success');</script>";
                                redirect("manage_user.php");
                            }
                        }
                        //echo "<script>console.log('Update result: " . $result . "' );</script>";
                    }
                  ?>
                  <div class="row">
                    <div class="col-md-3 pr-1">
                      <div class="form-group">
                        <label>ID (disabled)</label>
                        <input name="id" type="text" class="form-control" disabled="" placeholder="ID" value="<?php echo $userid; ?>">
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Username</label>
                        <input name="username" type="text" class="form-control" placeholder="Username" value="<?php echo $username; ?>">
                      </div>
                    </div>
                    <div class="col-md-5 pl-1">
                      <div class="form-group">
                        <label>Password</label>
                        <input name="password" type="password" class="form-control" placeholder="Password" value="">
                      </div>
                    </div>
                  </div>
                  <!--
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Name" value="69420">
                      </div>
                    </div>
                  </div>
                  -->
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Phone</label>
                        <input name="phone" type="number" class="form-control" placeholder="000000000" value="<?php echo $userphone; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input name="email" type="email" class="form-control" placeholder="Email" value="<?php echo $useremail; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <?php
                        if (isset($_GET['create'])){
                            echo "<input type=\"submit\" class=\"btn btn-primary btn-round\" name=\"update_profile\" value=\"Create Profile\"/>";
                        } else{
                            echo "<input type=\"submit\" class=\"btn btn-primary btn-round\" name=\"update_profile\" value=\"Update Profile\"/>";
                        } 
                      ?>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
            <!--
            <nav class="footer-nav">
              <ul>
                <li><a href="https://www.creative-tim.com" target="_blank">Creative Tim</a></li>
                <li><a href="https://www.creative-tim.com/blog" target="_blank">Blog</a></li>
                <li><a href="https://www.creative-tim.com/license" target="_blank">Licenses</a></li>
              </ul>
            </nav>
            -->
            <div class="credits ml-auto">
              <span class="copyright">
                © <script>
                  document.write(new Date().getFullYear())
                </script>, made with <i class="fa fa-heart heart"></i>
              </span>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="assets/js/plugins/chartjs.min.js"></script>-->
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>
</body>

</html>
