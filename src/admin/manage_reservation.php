<?php
    include('../auth/auth.php');
    if(getRole() != 'admin'){
        header("location: /");
        exit;
    }
    include ("../models/db.php");
    // Filter
    (isset($_GET["reservation_status"])) ? $reservation_status = $_GET["reservation_status"] : $reservation_status="created";
    (isset($_GET["reservation_time_range"])) ? $reservation_time_range = $_GET["reservation_time_range"] : $reservation_time_range=0;
    //echo "<script>console.log('1: " . $dish_status . "' );</script>";
    // Get dishes
    $db = New DbBase();
    $Reservations = new Reservations($db);
    $total = $Reservations->getTotalReservationCount($reservation_status, $reservation_time_range);
    //echo "<script>console.log('2: " . $total . "' );</script>";
    (isset($_GET["num_per_page"])) ? $num_per_page = $_GET["num_per_page"] : $num_per_page=25;
    $total_pages = ceil($total / $num_per_page);
    // Check that the page number is set.
    if(!isset($_GET['page'])){
        $_GET['page'] = 1;
    }else{
        // Convert the page number to an integer
        $_GET['page'] = (int)$_GET['page'];
    }
    // Calculate the starting number
    $start_idx = ($_GET['page'] - 1) * $num_per_page;
    // SQL Query
    $condition_status = 1;
    if ($reservation_status != ""){
        $condition_status = "(`status` = '$reservation_status')";
    }
    $condition_time = 1;
    if ($reservation_time_range > 0){
        if ($reservation_time_range == 1){
            $condition_time = "(`createTime` BETWEEN DATE(CURRENT_DATE() - INTERVAL 1 WEEK) AND DATE(CURRENT_DATE()))";
        } else if ($reservation_time_range == 2){
            $condition_time = "(`createTime` BETWEEN DATE(CURRENT_DATE() - INTERVAL 1 MONTH) AND DATE(CURRENT_DATE()))";
        } else if ($reservation_time_range == 3){
            $condition_time = "(`createTime` BETWEEN DATE(CURRENT_DATE() - INTERVAL 1 YEAR) AND DATE(CURRENT_DATE()))";
        }
    }
    $query = 'SELECT * FROM `Reservations` WHERE ' . $condition_status . ' AND ' . $condition_time . ' ORDER BY `createTime` DESC LIMIT ' . $start_idx . ', ' . $num_per_page;
    //echo "<script>console.log('2: " . $condition_time . "' );</script>";
    $reservations = $db->query($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Admin - Manage Reservations
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
          <li class="active ">
            <a href="./manage_reservation.php">
              <i class="nc-icon nc-bullet-list-67"></i>
              <p>Manage Reservations</p>
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
            <a class="navbar-brand" href="#">Manage Reservations</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
              <div class="input-group no-border">
                <input type="text" class="form-control" placeholder="Search...">
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
            <div class="card">
              <div class="card-header">
                <div class="card-header row" style="padding: 0px 15px;">
                    <h4 class="card-title"> Reservations</h4>
<!--
                    <div style="margin-left:auto; margin-right:0;">
                        <a href="dish.php?create=1">
                            <input type="submit" class="btn btn-success btn-round" name="add_dish" value="Add"/>
                        </a>
                    </div>
-->
                </div>
                <input id="dish_search" onkeyup="filterTable('dish_search', 'dish_table')" type="text" value="" class="form-control" placeholder="Search current page...">
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table js-sort-table" id="dish_table">
                    <thead class=" text-primary">
                      <th class="js-sort-number">
                        ID
                      </th>
<!--
                      <th>
                        By User
                      </th>
-->
                      <th class="js-sort-number">
                        Table for
                      </th>
                      <th>
                        Time
                      </th>
                      <th>
                        Status
                      </th>
                      <th>
                        Action
                      </th>
                    </thead>
                    <tbody>
                      <?php
                          while ($reservation = $reservations->fetch_assoc()) {
                              echo '<tr>';
                              echo '<td>'.$reservation['id'].'</td>';
                              //echo '<td>'.$reservation['user'].'</td>';
                              echo '<td>'.$reservation['numPersons'].'</td>';
                              echo '<td>'.$reservation['createTime'].'</td>';
                              echo '<td>'. strtoupper($reservation['status']) .'</td>';
                              echo "<td><a href=\"reservation.php?id=$reservation[id]\" class=\"btn btn-primary btn-round\"><i class=\"nc-icon nc-settings\"></i></a></td>";
                              echo '</tr>';
                          }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="row ">
                <div class="pagination text-right col-md-6">
                  <?php
                    if ($total_pages > 0){
                      $prev_page = $_GET['page'] > 1 ? $_GET['page'] - 1 : 1;
                      echo '<a href="?page=' . $prev_page . '&reservation_status=' . $reservation_status . '&reservation_time_range=' . $reservation_time_range . '&num_per_page=' . $num_per_page .'">&laquo;</a>';
                        foreach(range(1, $total_pages) as $page){
                            // Check if we're on the current page in the loop
                            if($page == $_GET['page']){
                                echo '<a class="active">' . $page . '</a>';
                            }else if($page == 1 || $page == $total_pages || ($page >= $_GET['page'] - 5 && $page <= $_GET['page'] + 5)){
                                echo '<a href="?page=' . $page . '&reservation_status=' . $reservation_status . '&reservation_time_range=' . $reservation_time_range . '&num_per_page=' . $num_per_page .'">' . $page . '</a>';
                            }
                        }
                      $next_page = $_GET['page'] < $total_pages ? $_GET['page'] + 1 : $total_pages;
                      echo '<a href="?page=' . $next_page . '&reservation_status=' . $reservation_status . '&reservation_time_range=' . $reservation_time_range . '&num_per_page=' . $num_per_page .'">&raquo;</a>';
                    }
                  ?>
                </div>
                <div class="col-md-6">
                    <form method="get" class="row">
                      <select name="reservation_time_range" class="form-control" style="width: auto;">
                        <option value="0"<?=$reservation_time_range == 0 ? ' selected="selected"' : '';?>>Time: All</option>
                        <option value="1"<?=$reservation_time_range == 1 ? ' selected="selected"' : '';?>>Time: Last week</option>
                        <option value="2"<?=$reservation_time_range == 2 ? ' selected="selected"' : '';?>>Time: Last month</option>
                        <option value="3"<?=$reservation_time_range == 3 ? ' selected="selected"' : '';?>>Time: Last year</option>
                      </select>
                      <select name="reservation_status" class="form-control" style="width: auto;">
                        <option value=""<?=$reservation_status == "" ? ' selected="selected"' : '';?>>Status: All</option>
                        <option value="created"<?=$reservation_status == "created" ? ' selected="selected"' : '';?>>Status: Created</option>
                        <option value="cancelled"<?=$reservation_status == "cancelled" ? ' selected="selected"' : '';?>>Status: Cancelled</option>
                        <option value="accepted"<?=$reservation_status == "accepted" ? ' selected="selected"' : '';?>>Status: Accepted</option>
                        <option value="denied"<?=$reservation_status == "denied" ? ' selected="selected"' : '';?>>Status: Denied</option>
                        <option value="done"<?=$reservation_status == "done" ? ' selected="selected"' : '';?>>Status: Done</option>
                      </select>
                      <select name="num_per_page" class="form-control" style="width: auto;">
                        <option value="5"<?=$num_per_page == 5 ? ' selected="selected"' : '';?>>5 entries</option>
                        <option value="10"<?=$num_per_page == 10 ? ' selected="selected"' : '';?>>10 entries</option>
                        <option value="25"<?=$num_per_page == 25 ? ' selected="selected"' : '';?>>25 entries</option>
                        <option value="50"<?=$num_per_page == 50 ? ' selected="selected"' : '';?>>50 entries</option>
                        <option value="100"<?=$num_per_page == 100 ? ' selected="selected"' : '';?>>100 entries</option>
                      </select>
                      <input type="submit" name="submit" style="width: auto;" value="Filter"/>
                    </form>
                </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
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
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>
  <!-- My script -->
  <script src="assets/js/myscripts.js"></script>
  <script src="assets/js/sort-table.js"></script>
  <script>
      if(window.location.hash == '#updateSuccess'){
        showNotification('top', 'center', 'success', 'Reservation updated successfully')
      } else if(window.location.hash == '#createSuccess'){
        showNotification('top', 'center', 'success', 'Reservation created successfully')
      } else if(window.location.hash == '#removeSuccess'){
        showNotification('top', 'center', 'success', 'Reservation removed successfully')
      }
      removeHash();
  </script>
</body>

</html>