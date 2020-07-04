<?
include('./auth/auth.php');
include('./utils/utils.php');
include('./models/db.php');
$db = new DbBase();
$Dishes = new Dishes($db);
$Comments = new Comments($db);
$role = getRole();
$username = '';
if ($role != 'unknown'){
	$username = $_SESSION['userInfo']['username'];
}
$dishes = $Dishes->getAllDishesIsShow(5);
$commennts = $Comments->getCommentVisibles(5);
echo json_encode($commennts);
?>
<!doctype html>
<html lang="en">
  <head>
	<title>A Restaurant</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/aos.css">
	<link rel="stylesheet" href="css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="css/jquery.timepicker.css">
	<link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/newVer.css">

	  </head>
	  <body class="bg-light">

		<body data-spy="scroll" data-target="#ftco-navbar-spy" data-offset="0">

		<div class="site-wrap">
		  
		  <nav class="site-menu" id="ftco-navbar-spy">
			<div class="site-menu-inner" id="ftco-navbar">
			  <ul id="mainNav" class="list-unstyled">
				<?php
				if ($role != 'unknown'){
					echo "<li><a style='font-size:30px' href='#'>$username</a></li><br><br>";
				}
				?>
				<li><a class="sellected" href="#section-home">Home</a></li>
				<li><a href="#section-about">About Us</a></li>
				<li><a href="#section-menu">Our Menu</a></li>
				<li><a href="#section-reservation">Reserve A Table</a></li>
			  </ul>
			</div>
			<div class="navAbsolute">
				<?php
				if($role == 'unknown'){
					echo "<a href='auth/login.php'><button class='btnLogin'>Login</button></a>";
				}else {
					echo "<a href='auth/logout.php'><button class='btnLogout'>Logout</button></a>";
				}
				?>
			</div>
		  </nav>

		  <header class="site-header ">
        <div class="row align-items-center">
          <div class="col-5 col-md-3">
             
          </div>
          <div class="col-2 col-md-6 text-center site-logo-wrap">
            <a href="index.html" class="site-logo">A</a>
          </div>
          <div class="col-5 col-md-3 text-right menu-burger-wrap">
            <a href="#" class="site-nav-toggle js-site-nav-toggle"><i></i></a>

          </div>
        </div>
       
      </header> <!-- site-header -->
      
      <div class="main-wrap " id="section-home">

        <div class="cover_1 overlay bg-light">
          <div class="img_bg" style="background-image: url(images/cover.jpg);" data-stellar-background-ratio="0.5">
            <div class="container">
              <div class="row align-items-center justify-content-center text-center">
                <div class="col-md-10" data-aos="fade-up">
                  <h2 class="heading mb-5">Welcome to A Restaurant</h2>
                  <p><a href="#section-reservation" class="smoothscroll btn btn-outline-white px-5 py-3">Reserve A Table</a></p>
                </div>
              </div>
            </div>
          </div>
        </div> 

        <div class="section"  data-aos="fade-up">
          <div class="container">
            <div class="row section-heading justify-content-center mb-5">
              <div class="col-md-8 text-center">
                <h2 class="heading mb-3">Find your best food</h2>
                <p class="sub-heading mb-5">This is the best place you can find!</p>  
              </div>
            </div>
            <div class="row">

              <div class="ftco-46">
                <div class="ftco-46-row d-flex flex-column flex-lg-row">
                  <div class="ftco-46-image" style="background-image: url(images/img_1.jpg);"></div>
                  <div class="ftco-46-text ftco-46-arrow-left">
                    <h4 class="ftco-46-subheading">Vegies</h4>
                    <h3 class="ftco-46-heading">Beef Empanadas</h3>
                    <p class="mb-5">Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                    <p><a href="#" class="btn-link">Learn More <span class="ion-android-arrow-forward"></span></a></p>
                  </div>
                  <div class="ftco-46-image" style="background-image: url(images/img_2.jpg);"></div> 
                </div>

                <div class="ftco-46-row d-flex flex-column flex-lg-row">
                  <div class="ftco-46-text ftco-46-arrow-right">
                    <h4 class="ftco-46-subheading">Food</h4>
                    <h3 class="ftco-46-heading">Buttermilk Chicken Jibaritos</h3>
                    <p class="mb-5">A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                    <p><a href="#" class="btn-link">Learn More <span class="ion-android-arrow-forward"></span></a></p>
                  </div>
                  <div class="ftco-46-image" style="background-image: url(images/img_3.jpg);"></div>
                  <div class="ftco-46-text ftco-46-arrow-up">
                    <h4 class="ftco-46-subheading">Food</h4>
                    <h3 class="ftco-46-heading">Chicken Chimichurri Croquettes</h3>
                    <p class="mb-5">Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life.</p>
                    <p><a href="#" class="btn-link">Learn More <span class="ion-android-arrow-forward"></span></a></p>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div> <!-- .section -->

        <div class="section pb-3 bg-white" id="section-about" data-aos="fade-up">
          <div class="container">
            <div class="row align-items-center justify-content-center">
              <div class="col-md-12 col-lg-8 section-heading">
                <h2 class="heading mb-5">The Restaurant</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                <p>It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
              </div>
            </div>
          </div>
        </div> <!-- .section -->
        

        <div class="section pt-2 pb-2 text-center" data-aos="fade">
          <!-- <p><img src="images/bg_hero.png" alt="Image" class="img-fluid"></p> -->
          <div class="w3-content w3-display-container">
          <img class="mySlides" src="images/im1.jpg" style="width:100%">
          <img class="mySlides" src="images/im2.jpg" style="width:100%">
          <img class="mySlides" src="images/im4.jpg" style="width:100%">
          <img class="mySlides" src="images/im5.jpg" style="width:100%">

          <button class="w3-button w3-white w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
          <button class="w3-button w3-white w3-display-right" onclick="plusDivs(1)">&#10095;</button>
        </div> <!-- .section -->

        <div class="section bg-white" data-aos="fade-up">
          <div class="container">
            <div class="row mb-5">
              <div class="col-md-12 section-heading text-center">
                <h2 class="heading mb-5">Meet The Chefs</h2>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 pr-md-5 text-center mb-5">
                <div class="ftco-38">
                  <div class="ftco-38-img">
                    <div class="ftco-38-header">
                      <img src="images/chef_1.jpg" alt="Image">
                      <h3 class="ftco-38-heading">Goden Ramsay</h3>
                      <p class="ftco-38-subheading">Master Chef</p>
                    </div>
                    <div class="ftco-38-body">
                      <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                      <p>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. It is a paradisematic country.</p>
                      <p>
                        <a href="#" class="p-2"><span class="fa fa-facebook"></span></a>
                        <a href="#" class="p-2"><span class="fa fa-twitter"></span></a>
                        <a href="#" class="p-2"><span class="fa fa-instagram"></span></a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 pl-md-5 text-center mb-5">
                <div class="ftco-38">
                  <div class="ftco-38-img">
                    <div class="ftco-38-header">
                      <img src="images/chef_2.jpg" alt="Image">
                      <h3 class="ftco-38-heading">Nick Browning</h3>
                      <p class="ftco-38-subheading">Master Chef</p>
                    </div>
                    <div class="ftco-38-body">
                      <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                      <p>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. It is a paradisematic country.</p>
                      <p>
                        <a href="#" class="p-2"><span class="fa fa-facebook"></span></a>
                        <a href="#" class="p-2"><span class="fa fa-twitter"></span></a>
                        <a href="#" class="p-2"><span class="fa fa-instagram"></span></a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- <div class="col-md-4"></div> -->
            </div>
          </div>
        </div> <!-- .section -->

        <div class="section bg-light" id="section-menu" data-aos="fade-up">
          <div class="container">
            <div class="row section-heading justify-content-center mb-5">
              <div class="col-md-8 text-center">
                <h2 class="heading mb-3">Menu</h2>
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="col-md-8">
                <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-breakfast" role="tabpanel" aria-labelledby="pills-breakfast-tab">
					<?php
						foreach($dishes as $dish){
							echo menuItem($dish['name'],$dish['descriptions'],$dish['price'], $dish['image']);
						}
					?>
                  </div>
                  <div class="tab-pane fade" id="pills-lunch" role="tabpanel" aria-labelledby="pills-lunch-tab">
                    
				   </div>
              </div>
              
            </div>
          </div>
        </div> <!-- .section -->

        <div class="section bg-white services-section" data-aos="fade-up">
          <div class="container">
            <div class="row section-heading justify-content-center mb-5">
              <div class="col-md-8 text-center">
                <h2 class="heading mb-3">Other Services</h2>
              </div>
            </div>
            <div class="row">
              <div class="col-m mb-5d-6 col-lg-4" data-aos="fade-up">
                <div class="media feature-icon d-block text-center">
                  <div class="icon">
                    <span class="flaticon-soup"></span>
                  </div>
                  <div class="media-body">
                    <h3>Quality Cuisine</h3>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up" data-aos-delay="100">
                <div class="media feature-icon d-block text-center">
                  <div class="icon">
                    <span class="flaticon-vegetables"></span>
                  </div>
                  <div class="media-body">
                    <h3>Fresh Food</h3>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up" data-aos-delay="300">
                <div class="media feature-icon d-block text-center">
                  <div class="icon">
                    <span class="flaticon-pancake"></span>
                  </div>
                  <div class="media-body">
                    <h3>Bread &amp; Pancake</h3>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up" data-aos-delay="500">
                <div class="media feature-icon d-block text-center">
                  <div class="icon">
                    <span class="flaticon-tray"></span>
                  </div>
                  <div class="media-body">
                    <h3>Reserve Now</h3>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up" data-aos-delay="300">
                <div class="media feature-icon d-block text-center">
                  <div class="icon">
                    <span class="flaticon-salad"></span>
                  </div>
                  <div class="media-body">
                    <h3>Fresh Vegies Salad</h3>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up" data-aos-delay="500">
                <div class="media feature-icon d-block text-center">
                  <div class="icon">
                    <span class="flaticon-chicken"></span>
                  </div>
                  <div class="media-body">
                    <h3>Whole Chicken</h3>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div> <!-- .section -->

        <div class="section bg-light" data-aos="fade-up" id="section-reservation">
          <div class="container">
            <div class="row section-heading justify-content-center mb-5">
              <div class="col-md-8 text-center">
                <h2 class="heading mb-3">Reservation</h2>
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="col-md-10 p-5 form-wrap">
                <form action="#">
                  <div class="row mb-4">
                    <div class="form-group col-md-4">
                      <label for="name" class="label">Name</label>
                      <div class="form-field-icon-wrap">
                        <span class="icon ion-android-person"></span>
                        <input type="text" class="form-control" id="name">
                      </div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="email" class="label">Email</label>
                      <div class="form-field-icon-wrap">
                        <span class="icon ion-email"></span>
                        <input type="email" class="form-control" id="email">
                      </div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="phone" class="label">Phone</label>
                      <div class="form-field-icon-wrap">
                        <span class="icon ion-android-call"></span>
                        <input type="text" class="form-control" id="phone">
                      </div>
                    </div>

                    <div class="form-group col-md-4">
                      <label for="persons" class="label">Number of Persons</label>
                      <div class="form-field-icon-wrap">
                        <span class="icon ion-android-arrow-dropdown"></span>
                        <select name="persons" id="persons" class="form-control">
                          <option value="">1 person</option>
                          <option value="">2 persons</option>
                          <option value="">3 persons</option>
                          <option value="">4 persons</option>
                          <option value="">5+ persons</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="date" class="label">Date</label>
                      <div class="form-field-icon-wrap">
                        <span class="icon ion-calendar"></span>
                        <input type="text" class="form-control" id="date">
                      </div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="time" class="label">Time</label>
                      <div class="form-field-icon-wrap">
                        <span class="icon ion-android-time"></span>
                        <input type="text" class="form-control" id="time">
                      </div>
                    </div>
                  </div>
                  <div class="row justify-content-center">
                    <div class="col-md-4">
                      <input type="submit" class="btn btn-primary btn-outline-primary btn-block" value="Reserve Now">
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div> <!-- .section -->

         <div class="section bg-white"  data-aos="fade-up">
          <div class="container">
            <div class="row section-heading justify-content-center mb-5">
              <div class="col-md-8 text-center">
                <h2 class="heading mb-3">Customer Reviews</h2>
              </div>
            </div>
            <div class="row justify-content-center text-center" data-aos="fade-up">
              <div class="col-md-8">
                <div class="owl-carousel home-slider-loop-false">
				<?php
					foreach($commennts as $comment){
						echo commentItem($comment['name'],$comment['content']);
					}
				?>
                </div>
              </div>
            </div>
          </div>  
        </div> <!-- .section -->

        <div class="map-wrap" id="map"  data-aos="fade"></div>


        <footer class="ftco-footer">
          <div class="container">
            
            <div class="row">
            <div class="col-md-4 mb-5">
              <div class="footer-widget">
                <h3 class="mb-4">About Restaurant</h3>
                <p>Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their projects again and again. And if she hasn’t been rewritten, then they are still using her.</p>
                
                <p><a href="#" class="btn btn-primary btn-outline-primary">Read More</a></p>
              </div>
            </div>
            <div class="col-md-4 mb-5">
              <div class="footer-widget">
                <h3 class="mb-4">Lunch Service</h3>
                <p>Booking from 12:00pm &mdash; 1:30pm</p>
                <h3 class="mb-4">Dinner Service</h3>
                <p>Everyday: <br> Booking from 6:00pm &mdash; 9:00pm</p>
              </div>
            </div>

            <div class="col-md-4">
              <div class="footer-widget">
                <h3 class="mb-4">Follow Along</h3>
                <ul class="list-unstyled social">
                  <li><a href="#"><span class="fa fa-tripadvisor"></span></a>TripadvisorLink</li>
                  <li><a href="#"><span class="fa fa-twitter"></span></a>TwitterLink</li>
                  <li><a href="#"><span class="fa fa-facebook"></span></a>FacebookLink</li>
                  <li><a href="#"><span class="fa fa-instagram"></span></a>InstagramLink</li>
                </ul>
              </div>

            </div>

          </div>
        </footer>
    </div>

		<script>
			var slideIndex = 1;
			showDivs(slideIndex);
			
			function plusDivs(n) {
			  showDivs(slideIndex += n);
			}
			
			function showDivs(n) {
			  var i;
			  var x = document.getElementsByClassName("mySlides");
			  if (n > x.length) {slideIndex = 1}
			  if (n < 1) {slideIndex = x.length}
			  for (i = 0; i < x.length; i++) {
			    x[i].style.display = "none";
			  }
			  x[slideIndex-1].style.display = "block";
			}
		</script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r79/three.min.js"></script>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/jquery.timepicker.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>    
    <script src="js/aos.js"></script>

    <script src="js/main.js"></script>
  </body>
</html>

