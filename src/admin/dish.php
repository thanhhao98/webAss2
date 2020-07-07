<?php
    include('../auth/auth.php');
    if(getRole() != 'admin'){
        header("location: /");
        exit;
    }
    include "../models/db.php";
    include "utils.php";
    $db = new DbBase();
    $Dishes = new Dishes($db);
    $admin_id = $_SESSION['userId'];
    if (isset($_GET['id'])){
        $dishid = (int)$_GET['id'];
        $dish = $Dishes->getDishById($dishid);
        $dishname = $dish['name'];
        $dishprice = $dish['price'];
        $dishdesc = $dish['descriptions'];
        $dishstatus = $dish['status'];
        $dishdisplay = $dish['onShow'];
        $dishimage = $dish['image'];
    }
    //echo "<script>console.log('Debug Objects: " . $dishimage . "' );</script>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../images/logo.png">
  <link rel="icon" type="image/png" href="../images/logo.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Admin - Dishes
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <link href="assets/css/mystyle.css" rel="stylesheet" />
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
        <a href="../.." class="simple-text logo-normal">
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
          <li>
            <a href="./manage_user.php">
              <i class="nc-icon nc-single-02"></i>
              <p>Manage Users</p>
            </a>
          </li>
          <li class="active ">
            <a href="./manage_dish.php">
              <i class="nc-icon nc-tile-56"></i>
              <p>Manage Dishes</p>
            </a>
          </li>
          <li>
            <a href="./manage_reservation.php">
              <i class="nc-icon nc-bullet-list-67"></i>
              <p>Manage Reservations</p>
            </a>
          </li>
          <li>
            <a href="./manage_table.php">
              <i class="nc-icon nc-paper"></i>
              <p>Manage Tables</p>
            </a>
          </li>
          <li>
            <a href="./manage_comment.php">
              <i class="nc-icon nc-chat-33"></i>
              <p>Manage Comments</p>
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
            <a class="navbar-brand" href="manage_dish.php"><i class="nc-icon nc-minimal-left"></i> Back to Management</a>
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
          <div class="col-md-4">
            <div class="card card-user">
              <div class="image">
                <input class="img-dish" id="btnfile" type="image" src="<?php echo '../' . $dishimage; ?>" alt="Click to upload dish image preview"/>
                <div style="display: none;">
                  <input type="file" id="uploadfile" />
                </div>
              </div>
              <p class="text-center" style="<?php if (!isset($_GET['imgName'])){ echo 'display: none;'; }?>">
                New image: <?php echo $_GET['imgName']; ?>
              </p>
              <div class="card-footer" style="<?php if (isset($_GET['create'])){ echo 'display: none;'; }?>">
                <hr>
                <div class="button-container">
                  <div class="row">
                    <div class="col-lg-3 col-md-6 col-6 ml-auto">
                      <h5>12<br><small>Orders</small></h5>
                    </div>
                    <div class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
                      <h5>2/20<br><small>Popularity</small></h5>
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
                <?php
                    if (isset($_GET['create'])){
                        echo "<h5 class=\"card-title\">Create New Dish</h5>";
                    } else{
                        echo "<h5 class=\"card-title\">Edit Dish Information</h5>";
                    } 
                    if (isset($_POST['remove_dish'])){
                        $result = $Dishes->deleteDishById($dishid);
                        if ($result){
                            echo "<script type='text/javascript'>alert('Success');</script>";
                            redirect("manage_dish.php#removeSuccess");
                        }
                    } 
                ?>
                <div style="margin-left:auto; margin-right:0; <?php if (isset($_GET['create'])){ echo 'display: none;'; }?>">
                    <form method="post">
                        <input type="submit" class="btn btn-danger btn-round" name="remove_dish" value="Remove"/>
                    </form>
                </div>
              </div>
              <div class="card-body">
                <form method="post">
                  <?php 
                    if (isset($_POST['update_dish'])){
                        $dishname = $dishprice = $dishdesc = $dishdisplay = $dishstatus = "";
                        if (isset($_GET['imgName'])){
                            $dishimage = "images/" . $_GET['imgName'];
                        }
                        else if (!isset($dishimage)){
                            $dishimage = "";
                        }
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                          $dishname = test_input($_POST["name"]);
                          $dishprice = (int)test_input($_POST["price"]);
                          $dishdesc = test_input($_POST["desc"]);
                          $dishstatus = (int)test_input($_POST["status"]);
                          $dishdisplay = (int)test_input($_POST["display"]);
                        }
                        if (strlen($dishname) < 1){
                            echo "<script type='text/javascript'>alert('Please enter name');</script>";
                        }else {
                            if (isset($_GET['create'])){
                                $result = $Dishes->createDish($dishname, $dishprice, $dishdesc, $dishstatus, $dishimage, $admin_id, $dishdisplay);
                                if ($result){
                                    redirect("manage_dish.php#createSuccess");
                                }
                            } else{
                                $result = $Dishes->updateDishById($dishid, $dishname, $dishprice, $dishdesc, $dishstatus, $dishimage, $admin_id, $dishdisplay);
                                if ($result){
                                    redirect("manage_dish.php#updateSuccess");
                                }
                            }
                            //if ($result){
                                //echo "<script type='text/javascript'>alert('Success');</script>";
                                //redirect("manage_dish.php");
                            //}
                        }
                        //echo "<script>console.log('Update result: " . $result . "' );</script>";
                    }
                  ?>
                  <div class="row">
                    <div class="col-md-3 pr-1">
                      <div class="form-group">
                        <label>ID (disabled)</label>
                        <input name="id" type="text" class="form-control" disabled="" placeholder="ID" value="<?php echo $dishid; ?>">
                      </div>
                    </div>
                    <div class="col-md-9">
                      <div class="form-group">
                        <label>Name</label>
                        <input name="name" type="text" class="form-control" placeholder="Name" value="<?php echo $dishname; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Price</label>
                        <input name="price" type="number" min="1" max="10" class="form-control" placeholder="0" value="<?php echo $dishprice; ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                          <option value="0"<?=$dishstatus == 0 ? ' selected="selected"' : '';?>>Unavailable</option>
                          <option value="1"<?=$dishstatus == 1 ? ' selected="selected"' : '';?>>Available</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Display</label>
                        <select name="display" class="form-control">
                          <option value="0"<?=$dishdisplay == 0 ? ' selected="selected"' : '';?>>Hidden</option>
                          <option value="1"<?=$dishdisplay == 1 ? ' selected="selected"' : '';?>>Shown</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Description</label>
                        <input name="desc" type="text" class="form-control" placeholder="Description" value="<?php echo $dishdesc; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <?php
                        if (isset($_GET['create'])){
                            echo "<input type=\"submit\" class=\"btn btn-primary btn-round\" name=\"update_dish\" value=\"Create Dish\"/>";
                        } else{
                            echo "<input type=\"submit\" class=\"btn btn-primary btn-round\" name=\"update_dish\" value=\"Update Dish Info\"/>";
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
  <script>
    $("#btnfile").click(function () {
        $("#uploadfile").click();
    });
    $("#uploadfile").change(function () {
        var file = $(this).val().replace(/C:\\fakepath\\/ig,'');
        var current = window.location.href;
        //console.log(file);
        //console.log(current);
        window.location.href = current + "&imgName=" + file;
    });
  </script>
</body>

</html>
