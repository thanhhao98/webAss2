<?php
function menuItem($name, $description, $price, $img){
	$item = '<div class="d-block d-md-flex menu-food-item">
	  <div class="text order-1 mb-3">
		<img src="%s" alt="Image">
		<h3><a href="#">%s</a></h3>
		<p>%s</p>
	  </div>
	  <div class="price order-2">
		<strong>$%s</strong>
	  </div>
	</div>
	';
	return sprintf($item, $img, $name, $description, $price);
}
function commentItem($name, $content){
	$item = '<div class="item">
				<blockquote class="testimonial">
				  <p>&ldquo;%s&rdquo;</p>
				  <div class="author">
					<img src="images/person_1.jpg" alt="Image placeholder" class="mb-3">
					<h4>%s</h4>
				  </div>
				</blockquote>
			  </div>';
	return sprintf($item, $content, $name);
}

?>
