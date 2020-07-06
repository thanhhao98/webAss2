<?php
    include('../auth/auth.php');
    if(getRole() != 'admin'){
        header("location: /");
        exit;
    }
    include "../models/db.php";
    include "utils.php";
    $db = new DbBase();
    $Reservations = new Reservations($db);
    $ReservationItem = new ReservationItem($db);
    $Dishes = new Dishes($db);
    $dishes = $Dishes->getAllDishes();
    $admin_id = $_SESSION['userId'];
    if (isset($_GET['reservationid'])){
        $reservationid = (int)$_GET['reservationid'];
        //$items = $ReservationItem->getItemsByReservationId($reservationid);
        //$reservationitems = [];
        //while ($item = $items->fetch_assoc()) {
            //$dish = $Dishes->getDishById($item['dish']);
            //$reservationitem = [
                //"id" => $item['id'],
                //"name" => $dish['name'],
                //"price" => $item['price'],
                //"quantity" => $item['quantity']
            //];
            //array_push($reservationitems, $reservationitem);
        //}
    }
    //echo "<script>console.log('Debug Objects: " . $_SESSION['items'][0]['name'] . "' );</script>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Admin - Reservations
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
          <li>
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
            <a class="navbar-brand" href="reservation.php?id=<?php echo $reservationid ?>"><i class="nc-icon nc-minimal-left"></i> Back to Reservation</a>
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
                <h5 class="card-title">Reservation Items</h5>
                  <form method="post" style="margin-left:auto; margin-right:0;">
                    <div class='row' style="margin-left:auto; margin-right:0;">
                        <?php
                          if (isset($_POST['addItem'])){
                            //echo "<script>console.log('Debug Objects: " . $_POST['dish_select'] . "' );</script>";
                            $hasDish = false;
                            $dishid = $_POST['dish_select'];
                            foreach ($_SESSION['items'] as $item){
                                if ($item['dishid'] == $dishid){
                                    $hasDish = true;
                                    break;
                                } 
                            }
                            if ($hasDish){
                                echo "<script type='text/javascript'>alert('Chosen dish already there');</script>";
                            } else{
                                $dish = $Dishes->getDishById($dishid);
                                $reservationitem = [
                                    "id" => 0,
                                    "name" => $dish['name'],
                                    "dishid" => $dish['id'],
                                    "price" => $dish['price'],
                                    "quantity" => 1
                                ];
                                array_push($_SESSION['items'], $reservationitem);
                            }
                          }
                      echo '<div form-group">';
                        echo '<label>Dish</label>';
                        echo '<select class="form-control" name="dish_select">';
                        while ($dish = $dishes->fetch_assoc()){
                            echo '<option value="'; echo $dish['id']; echo '">';
                            echo $dish['id']; echo ' - '; echo $dish['name'];
                            echo '</option>';
                        }
                        echo '</select>';
                      echo "</div>";
                        ?>
                      <div class='row' style="margin-left:20px; margin-right:0;">
                        <input type="submit" class="btn btn-success btn-round" name="addItem" value="+"/>
                      </div>
                    </div>
                </form>
              </div>
              <div class="card-body">
                <form method="post">
                  <?php
                      # Modify item
                      if (isset($_POST['modifyItem'])){
                          # TODO: improve
                          $reservationItems = $ReservationItem->getItemsByReservationId($reservationid);
                          $updatedItemIds = [];
                          foreach ($_SESSION['items'] as $i=>$item){
                              $isNew = true;
                              foreach ($reservationItems as $ritem){
                                  if ($ritem['dish'] == $item['dishid']){
                                      //echo "<script>console.log('1: " . $ritem['dish'] . "' );</script>";
                                      $x = 'item_q' . $i;
                                      $result = $ReservationItem->updateItemById($ritem['id'], $reservationid, $item['dishid'], $item['price'], $_POST[$x]); 
                                      $isNew = false;
                                      array_push($updatedItemIds, $ritem['dish']);
                                      break;
                                  }
                              }
                              if ($isNew){
                                  //echo "<script>console.log('2: " . $item['name'] . "' );</script>";
                                  $x = 'item_q' . $i;
                                  $result = $ReservationItem->createReservationItem($reservationid, $item['dishid'], $item['price'], (int)$_POST[$x]); 
                              }
                          }
                          foreach ($reservationItems as $ritem){
                              if (in_array($ritem['dish'], $updatedItemIds)){
                                  continue;
                              }
                              $ReservationItem->deleteItemById($ritem['id']);
                          }
                          $reservationpage = "reservation.php?id=" . $reservationid;
                          redirect($reservationpage);
                      }
                      # Load items
                      foreach ($_SESSION['items'] as $i=>$item){
                          # Remove
                          $btn_remove = 'removeItem' . $i;
                          if (isset($_POST[$btn_remove])){
                              //$ReservationItem->deleteItemById($_SESSION['items'][$i]['id']);
                              unset($_SESSION['items'][$i]);
                              continue;
                          }
                          # Display
                          echo '<div class="row">';
                              echo '<div class="col-md-7 pr-1 form-group">';
                                echo '<label>Dish Name</label>';
                                echo '<input type="text" disabled="" class="form-control" value="'; echo $item['name']; echo '">';
                              echo "</div>";
                              echo '<div class="col-md-2 pr-1 form-group">';
                                echo '<label>Price</label>';
                                echo '<input type="number" disabled="" class="form-control" value="'; echo $item['price']; echo '">';
                              echo "</div>";
                              echo '<div class="col-md-2 form-group">';
                                echo '<label>Quantity</label>';
                              echo '<input type="number" min="1" max="100" class="form-control" name="item_q';
                              echo $i;
                              echo '" value="'; 
                              echo $item['quantity']; echo '">';
                              echo "</div>";
                              echo '<div class="col-md-1 pr-1 form-group">';
                                //echo '<div style="visibility: hidden">Action</div>';
                                echo '<input type="submit" class="btn btn-danger btn-round" value="-" name="removeItem';
                                echo $i;
                                echo '">';
                              echo "</div>";
                          echo "</div>";
                      }
                  ?>
                <div class="row">
                    <div class="update ml-auto mr-auto">
                        <input type="submit" class="btn btn-primary btn-round" name="modifyItem" value="Update Items">
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
