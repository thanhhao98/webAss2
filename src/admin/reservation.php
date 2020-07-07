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
    $Tables = new Tables($db);
    $admin_id = $_SESSION['userId'];
    //echo "<script>console.log('Debug Objects: " . isset($_POST['num']) . "' );</script>";
    if (isset($_GET['id'])){
        $reservationid = (int)$_GET['id'];
        $reservation = $Reservations->getReservationById($reservationid);
        $reservationtime = $reservation['createTime'];
        //(isset($_POST['num'])) ? $reservationstatus = $_POST['status'] : $reservationstatus = $reservation['status'];
        $reservationstatus = $reservation['status'];
        $reservationuser = $reservation['user'];
        //(isset($_POST['num'])) ? $reservationnum = $_POST['num'] : $reservationnum = $reservation['numPersons'];
        $reservationnum = $reservation['numPersons'];
        $reservationprice = 0;
        $currentTable = $Tables->getTableByReservationId($reservationid);
        $availableTables = $Tables->getAvailableTables($reservationnum);
        $items = $ReservationItem->getItemsByReservationId($reservationid);
        $reservationitems = [];
        while ($item = $items->fetch_assoc()) {
            $dish = $Dishes->getDishById($item['dish']);
            $reservationitem = [
                "id" => $item['id'],
                "name" => $dish['name'],
                "dishid" => $dish['id'],
                "price" => $item['price'],
                "quantity" => $item['quantity']
            ];
            $reservationprice += $item['price'] * $item['quantity'];
            array_push($reservationitems, $reservationitem);
        }
        $_SESSION['items'] = $reservationitems;
    }
    //echo "<script>console.log('Debug Objects: " . ($currentTable === NULL) . "' );</script>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../images/logo.png">
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
            <a class="navbar-brand" href="manage_reservation.php"><i class="nc-icon nc-minimal-left"></i> Back to Management</a>
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
          <div class="col-md-6">
            <div class="card card-user">
              <div class="card-header row" style="padding: 0 30px;">
                  <h5 class="card-title">Reservation Items</h5>
              </div>
              <div class="card-body">
              <?php
                  # Modify item
                  if (isset($_POST['modifyItem'])){
                      $itempage = "reservationitem.php?reservationid=" . $reservationid;
                      redirect($itempage);
                  }
                  # Load items
                  $i = 0;
                  foreach ($reservationitems as $item){
                      echo '<div class="row">';
                          echo '<div class="col-md-6 pr-1 form-group">';
                            echo '<label>Dish Name</label>';
                            echo '<input type="text" disabled="" class="form-control" value="'; echo $item['name']; echo '">';
                          echo "</div>";
                          echo '<div class="col-md-3 pr-1 form-group">';
                            echo '<label>Price</label>';
                            echo '<input type="number" disabled="" class="form-control" value="'; echo $item['price']; echo '">';
                          echo "</div>";
                          echo '<div class="col-md-3 form-group">';
                            echo '<label>Quantity</label>';
                          echo '<input type="number" disabled="" min="1" max="100" class="form-control" name="item_q';
                          echo $i;
                          echo '" value="'; 
                          echo $item['quantity']; echo '">';
                          echo "</div>";
                      echo "</div>";
                      $i += 1;
                  }
              ?>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <form method="post">
                        <input type="submit" class="btn btn-success btn-round" name="modifyItem" value="Add/Remove Items">
                      </form>
                    </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-user">
              <div class="card-header row" style="padding: 0 30px;">
                <?php
                    if (isset($_GET['create'])){
                        echo "<h5 class=\"card-title\">Create New Dish</h5>";
                    } else{
                        echo "<h5 class=\"card-title\">Edit Reservation Information</h5>";
                    } 
                    if (isset($_POST['remove_reservation'])){
                        $result = $Reservations->deleteReservationById($reservationid);
                        if ($result){
                            echo "<script type='text/javascript'>alert('Success');</script>";
                            redirect("manage_reservation.php#removeSuccess");
                        }
                    } 
                ?>
                <div style="display: none; margin-left:auto; margin-right:0; <?php if (isset($_GET['create'])){ echo 'display: none;'; }?>">
                    <form method="post">
                        <input type="submit" class="btn btn-danger btn-round" name="remove_reservation" value="Remove"/>
                    </form>
                </div>
              </div>
              <div class="card-body">
                <form method="post">
                  <?php 
                    if (isset($_POST['update_reservation'])){
                        $reservationnum = $reservationstatus = "";
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                          $reservationnum = (int)test_input($_POST["num"]);
                          $reservationstatus = test_input($_POST["status"]);
                        }
                        # Update table
                        $result_table = true;
                        $selected_table_id = $_POST['table_select'];
                        $selected_table = $Tables->getTableById($selected_table_id);
                        if ($_POST['startTime'] == NULL){
                            $startTime = NULL;
                        } else{
                            $startTime = new DateTime($_POST['startTime']);
                            $startTime = $startTime->format('Y-m-d H:i:s');
                        }
                        if ($_POST['endTime'] == NULL){
                            $endTime = NULL;
                        } else{
                            $endTime = new DateTime($_POST['endTime']);
                            $endTime = $endTime->format('Y-m-d H:i:s');
                        }
                        $chosenStartTime = $currentTable['startReser'];
                        $chosenEndTime = $currentTable['lastReser'];
                        $timeChanged = false;
                        if (($chosenStartTime != $startTime) || ($chosenEndTime != $endTime)){
                            $timeChanged = true;
                            $chosenStartTime = $startTime;
                            $chosenEndTime = $endTime;
                        }
                        if ($reservationnum > $selected_table['quantity']){
                            echo "<script type='text/javascript'>alert('Please choose larger table');</script>";
                        } else if ($chosenStartTime > $chosenEndTime){
                            echo "<script type='text/javascript'>alert('Please choose sensible time');</script>";
                        } else if (($selected_table_id != $currentTable['id']) || $timeChanged){
                            # Update old table
                            $result_2 = $Tables->UpdateTableById($currentTable['id'], $currentTable['quantity'], 1, NULL, NULL, NULL, $admin_id);
                            # Update new table
                            $result_1 = $Tables->UpdateTableById($selected_table_id, $selected_table['quantity'], 0, $chosenStartTime, $chosenEndTime, $reservationid, $admin_id);
                            $result_table = $result_1 && $result_2;
                            //echo "<script>console.log('1: " . $result_table . "' );</script>";
                        }
                        # Update reservation
                        $result_reservation = $Reservations->updateReservationById($reservationid, $reservationnum, $reservationstatus, $admin_id);
                        # Redirect
                        if ($result_table && $result_reservation){
                            redirect("manage_reservation.php#updateSuccess");
                        }
                    }
                  ?>
                  <div class="row">
                    <div class="col-md-2 pr-1">
                      <div class="form-group">
                        <label>ID</label>
                        <input name="id" type="text" class="form-control" disabled="" placeholder="ID" value="<?php echo $reservationid; ?>">
                      </div>
                    </div>
                    <div class="col-md-3 pr-1">
                      <div class="form-group">
                        <label>Total Price</label>
                        <input name="id" type="text" class="form-control" disabled="" placeholder="ID" value="<?php echo $reservationprice; ?>">
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group">
                        <label>Time created</label>
                        <input name="time" type="text" class="form-control" disabled="" placeholder="Time" value="<?php echo $reservationtime; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-2 pr-1">
                      <div class="form-group">
                        <label>People</label>
                        <input name="num" type="number" min=1 max=15 class="form-control" placeholder="1" value="<?php echo $reservationnum; ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                          <option value="created"<?=$reservationstatus == "created" ? ' selected="selected"' : '';?>>Created</option>
                          <option value="cancelled"<?=$reservationstatus == "cancelled" ? ' selected="selected"' : '';?>>Cancelled</option>
                          <option value="accepted"<?=$reservationstatus == "accepted" ? ' selected="selected"' : '';?>>Accepted</option>
                          <option value="denied"<?=$reservationstatus == "denied" ? ' selected="selected"' : '';?>>Denied</option>
                          <option value="done"<?=$reservationstatus == "done" ? ' selected="selected"' : '';?>>Done</option>
                        </select>
                      </div>
                    </div>
                  <?php
                      echo '<div class="col-md-6 form-group">';
                        echo '<label>Table</label>';
                        echo '<select class="form-control" name="table_select">';
                        echo '<option value="'; echo $currentTable['id']; echo '">';
                        if ($currentTable === NULL){
                            echo "Please select table";
                        }else{
                            echo $currentTable['id']; echo ' - For '; echo $currentTable['quantity']; echo ' person(s) max';
                        }
                        echo "</option>";
                        while ($table = $availableTables->fetch_assoc()){
                            echo '<option value="'; echo $table['id']; echo '">';
                            echo $table['id']; echo ' - For '; echo $table['quantity']; echo ' person(s) max';
                            echo '</option>';
                        }
                        echo '</select>';
                      echo "</div>";
                  //echo '<div class="row">';
                      echo '<div class="col-md-6 pr-1 form-group">';
                        echo '<label>Start time</label>';
                        if ($currentTable === NULL){
                            $time = NULL;
                        } else if ($currentTable['startReser'] == NULL){
                            $time = NULL;    
                        } else{
                            $time = new DateTime($currentTable['startReser']);
                            $time = $time->format('Y-m-d\TH:i');
                        }
                        echo '<input name="startTime" type="datetime-local" class="form-control" value="'; echo $time; echo '">';
                      echo "</div>";
                      echo '<div class="col-md-6 pl-1 form-group">';
                        echo '<label>End time</label>';
                        if ($currentTable === NULL){
                            $time = NULL;
                        } else if ($currentTable['lastReser'] == NULL){
                            $time = NULL;    
                        }else{
                            $time = new DateTime($currentTable['lastReser']);
                            $time = $time->format('Y-m-d\TH:i');
                        }
                        echo '<input name="endTime" type="datetime-local" class="form-control" value="'; echo $time; echo '">';
                      echo "</div>";
                  ?>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <?php
                        if (isset($_GET['create'])){
                            echo "<input type=\"submit\" class=\"btn btn-primary btn-round\" name=\"update_reservation\" value=\"Create reservation\"/>";
                        } else{
                            echo "<input type=\"submit\" class=\"btn btn-primary btn-round\" name=\"update_reservation\" value=\"Update Reservation Info\"/>";
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
