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
    include ("../models/db.php");
    $db = New DbBase();
    $Dishes = new Dishes($db);
    $total = $Dishes->getTotalDishCount();
    (isset($_POST["num_per_page"])) ? $num_per_page = $_POST["num_per_page"] : $num_per_page=25;
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
    $query = 'SELECT * FROM `Dishes` LIMIT ' . $start_idx . ', ' . $num_per_page;
    $dishes = $db->query($query);
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
  <link href="assets/css/mystyle.css" rel="stylesheet" />
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
            <a class="navbar-brand" href="javascript:;">Paper Dashboard 2</a>
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
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Dishes</h4>
                <input type="text" value="" class="form-control" placeholder="Search...">
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="user_table">
                    <thead class=" text-primary">
                      <th>
                        ID
                      </th>
                      <th>
                        Name
                      </th>
                      <th>
                        Price
                      </th>
                      <th>
                        Description
                      </th>
                      <th>
                        Status
                      </th>
                      <th>
                        Image
                      </th>
                      <th class="text-right">
                        Action
                      </th>
                    </thead>
                    <tbody>
                      <?php
                          while ($dish = $dishes->fetch_assoc()) {
                              echo '<tr>';
                              echo '<td>'.$dish['id'].'</td>';
                              echo '<td>'.$dish['name'].'</td>';
                              echo '<td>'.$dish['price'].'</td>';
                              echo '<td>'.$dish['descriptions'].'</td>';
                              echo '<td>'.$dish['status'].'</td>';
                              echo '<td>'.$dish['image'].'</td>';
                              echo '</tr>';
                          }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="pagination">
              <?php
                  $prev_page = $_GET['page'] > 1 ? $_GET['page'] - 1 : 1;
                  echo '<a href="?page=' . $prev_page . '">&laquo;</a>';
                    foreach(range(1, $total_pages) as $page){
                        // Check if we're on the current page in the loop
                        if($page == $_GET['page']){
                            echo '<a class="active">' . $page . '</a>';
                        }else if($page == 1 || $page == $totalPages || ($page >= $_GET['page'] - 2 && $page <= $_GET['page'] + 2)){
                            echo '<a href="?page=' . $page . '">' . $page . '</a>';
                        }
                    }
                  $next_page = $_GET['page'] < $total_pages ? $_GET['page'] + 1 : $total_pages;
                  echo '<a href="?page=' . $next_page . '">&raquo;</a>';
              ?>
            </div>
            <div class="text-right">
                <form method="post">
                  Show
                  <select name="num_per_page">
                    <option value="5"<?=$num_per_page == 5 ? ' selected="selected"' : '';?>>5</option>
                    <option value="10"<?=$num_per_page == 10 ? ' selected="selected"' : '';?>>10</option>
                    <option value="25"<?=$num_per_page == 25 ? ' selected="selected"' : '';?>>25</option>
                    <option value="50"<?=$num_per_page == 50 ? ' selected="selected"' : '';?>>50</option>
                    <option value="100"<?=$num_per_page == 100 ? ' selected="selected"' : '';?>>100</option>
                  </select>
                  entries
                  <input type="submit" name="submit"/>
                </form>
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
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>-->
  <!-- Chart JS 
  <script src="assets/js/plugins/chartjs.min.js"></script>-->
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc 
  <script src="assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>
  <script src="assets/demo/demo.js"></script>-->
</body>

</html>
