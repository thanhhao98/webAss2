<?php
    include('../auth/auth.php');
    if(getRole() != 'admin'){
        header("location: /");
        exit;
    }
    include "../models/db.php";
    include "utils.php";
    $db = new DbBase();
    $Tables = new Tables($db);
    $admin_id = $_SESSION['userId'];
    if (isset($_GET['id'])){
        $tableid = (int)$_GET['id'];
        $table = $Tables->getTableById($tableid);
        $tableQuantity = $table['quantity'];
        $tableStatus = $table['isAvailable'];
        $tableStartReser = $table['startReser'];
        $tableLastReser = $table['lastReser'];
        $tableReservation = $table['reservation'];
    }
    //echo "<script>console.log('Debug Objects: " . $tableLastReser->format('Y-m-d\TH:i') . "' );</script>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Admin - Tables
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
          <li>
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
          <li class="active ">
            <a href="./manage_table.php">
              <i class="nc-icon nc-paper"></i>
              <p>Manage Tables</p>
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
            <a class="navbar-brand" href="manage_table.php"><i class="nc-icon nc-minimal-left"></i> Back to Management</a>
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
          <div class="col-md-12">
            <div class="card card-user">
              <div class="card-header row" style="padding: 0 30px;">
                <?php
                    if (isset($_GET['create'])){
                        echo "<h5 class=\"card-title\">Create New Table</h5>";
                    } else{
                        echo "<h5 class=\"card-title\">Edit Table Information</h5>";
                    } 
                    if (isset($_POST['remove_table'])){
                        $result = $Tables->deleteTableById($tableid);
                        if ($result){
                            //echo "<script type='text/javascript'>alert('Success');</script>";
                            redirect("manage_table.php#removeSuccess");
                        }
                    } 
                ?>
                <div style="margin-left:auto; margin-right:0; 
                    <?php 
                    if ((isset($_GET['create'])) || ($tableReservation != NULL)){
                        echo 'display: none;';
                    }
                    ?>">
                    <form method="post">
                        <input type="submit" class="btn btn-danger btn-round" name="remove_table" value="Remove"/>
                    </form>
                </div>
              </div>
              <div class="card-body">
                <form method="post">
                  <?php 
                    if (isset($_POST['update_table'])){
                        $tableQuantity = 1;
                        $tableStartReser = $tableLastReser = "";
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                          $tableQuantity = (int)$_POST["quantity"];
                        }
                        # Update table
                        if ($_POST['startTime'] == NULL){
                            $tableStartReser = NULL;
                        } else{
                            $tableStartReser = new DateTime($_POST['startTime']);
                            $tableStartReser = $tableStartReser->format('Y-m-d H:i:s');
                        }
                        if ($_POST['endTime'] == NULL){
                            $tableLastReser = NULL;
                        } else{
                            $tableLastReser = new DateTime($_POST['endTime']);
                            $tableLastReser = $tableLastReser->format('Y-m-d H:i:s');
                        }
                        if ($tableStartReser > $tableLastReser){
                            echo "<script type='text/javascript'>alert('Please choose sensible time');</script>";
                        } else if (isset($_GET['create'])){
                            $result = $Tables->createTable($tableQuantity, 1, $tableStartReser, $tableLastReser, NULL, $admin_id);
                            echo "<script>console.log('Log: " .($tableStartReser === NULL) . "' );</script>";
                            if ($result){
                                redirect("manage_table.php#createSuccess");
                            }
                        } else{
                            $result = $Tables->updateTableById($tableid, $tableQuantity, $tableStatus, $tableStartReser, $tableLastReser, $tableReservation, $admin_id);
                            if ($result){
                                redirect("manage_table.php#updateSuccess");
                            }
                        }
                    }
                        //echo "<script>console.log('Update result: " . $result . "' );</script>";
                  ?>
                  <div class="row">
                    <div class="col-md-3 pr-1">
                      <div class="form-group">
                        <label>ID</label>
                        <input name="id" type="text" class="form-control" disabled="" placeholder="ID" value="<?php echo $tableid; ?>">
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>Reservation</label>
                        <input name="reservation" type="text" class="form-control" disabled="" placeholder="" value="<?php echo $tableReservation; ?>">
                      </div>
                    </div>
                    <div class="col-md-2 pl-1">
                      <div class="form-group">
                        <label>Status</label>
                        <input name="status" type="text" disabled="" class="form-control" placeholder=""
                        value="<?php
                            if ($tableStatus == 1){
                                echo 'Available';
                            } else{
                                echo 'Booked';
                            }
                        ?>">
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Capacity</label>
                        <input name="quantity" type="number" min="1" max="30" class="form-control" placeholder="1" value="<?php echo $tableQuantity ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 form-group">
                      <label>Start time</label>
                      <input name="startTime" type="datetime-local" class="form-control" 
                        value="<?php
                            if ($tableStartReser === NULL){
                                    echo '';
                            } else{
                                $time = new DateTime($tableStartReser);
                                echo $time->format('Y-m-d\TH:i');
                            }
                        ?>">
                    </div>
                    <div class="col-md-6 form-group">
                      <label>End time</label>
                      <input name="endTime" type="datetime-local" class="form-control"
                        value="<?php
                            if ($tableLastReser === NULL){
                                    echo '';
                            } else{
                                $time = new DateTime($tableLastReser);
                                echo $time->format('Y-m-d\TH:i');
                            }
                        ?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <?php
                        if (isset($_GET['create'])){
                            echo "<input type=\"submit\" class=\"btn btn-primary btn-round\" name=\"update_table\" value=\"Create Table\"/>";
                        } else{
                            echo "<input type=\"submit\" class=\"btn btn-primary btn-round\" name=\"update_table\" value=\"Update Table Info\"/>";
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
