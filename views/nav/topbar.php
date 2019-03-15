<div class="header-top-area hidden-xs">
    <div class="container">
	<div class="row">
            <div class="col-lg-6 col-md-6 col-sm-4">
		<!-- 			<div class="welcome">
                     <span class="phone">Phone: +12345 67890</span> <span class="hidden-sm">/</span>
                     <span class="email hidden-sm">Email: yourname@domain.com</span>
		     </div> -->
            </div>
            <div class="col-lg-6 col-md-6 col-sm-8">
		<div class="top-menu">
		    <span class="dropdown" style="float:right !important">
			<button class="btn btn-default dropdown-toggle" type="button" id="langChooserDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:white; border:0px; background-color:inherit; margin-top:2px">
			    <?php echo $scope["user"]["language"]; ?>
			    <span class="caret"></span>
			</button>
			<ul class="dropdown-menu lang-chooser-popup dropdown-chooser" aria-labelledby="langChooserDropdown" aria-expanded="false">
			    <li><a href="javascript:;" data-value="<?php echo $scope["user"]["language"]; ?>" class="lang-item"><img src="assets/img/langs/<?php echo $scope["user"]["language"]; ?>.png">  <?php echo $scope["user"]["language"]; ?></a></li>
			    <?php
				foreach($translation->languages as $value)
				if($value != $scope["user"]["language"])
				    echo "<li><a href=\"javascript:;\" data-value=\"$value\" class=\"lang-item\"><img src=\"assets/img/langs/{$value}.png\">  " . $value . "</a></li>";
			    ?>
			</ul>
		    </span>
                    <ul id="currency">
			<li><a href="#">USD <i class="fa fa-angle-down"></i></a>
                            <ul>
				<li><a href="#">EURO</a></li>
				<li><a href="#">AUD</a></li>
				<li><a href="#">Rs</a></li>
                            </ul>
			</li>
                    </ul>
                    <ul>
			<li><a href="#"><?php echo $translation->translateLabel("My Account"); ?></a></li>
			<li><a href="#"><?php echo $translation->translateLabel("Wishlist"); ?></a></li>
			<li><a href="#"><?php echo $translation->translateLabel("Shopping cart"); ?></a></li>
			<li><a href="#"><?php echo $translation->translateLabel("Checkout"); ?></a></li>
                    </ul>
		</div>
            </div>
	</div>
    </div>
</div>
<!-- header-top-area end -->
<div class="sticky-wrapper">
    <header>			
	<!-- header-bottom-area start -->            
	<div class="header-bottom-area">
	    <div class="container">
		<div class="row">
		    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<div class="logo">
			    <a href="index.html"><span>e</span> Online Shop</a>
			</div>
		    </div>
		    <div class="col-lg-6 col-md-5 col-sm-5 col-xs-6 hidden-xs">
			<div class="header-search">
			    <select>
                    		<option value="0">All Categories</option>
				<option value="1">Women's Clothing &amp; Accessories</option>
				<option value="2">Men's Clothing &amp; Accessories</option>
				<option value="0">Phones &amp; Telecommunications</option>
				<option value="0">Computer &amp; Office</option>
				<option value="0">Consumer Electronics</option>
				<option value="0">Jewelry &amp; Accessories</option>
				<option value="0">Home &amp; Garden</option>
				<option value="0">Luggage &amp; Bags</option>
				<option value="0">Shoes</option>
				<option value="0">Mother &amp; Kids</option>
				<option value="0">Sports &amp; Entertainment</option>
				<option value="0">Health &amp; Beauty</option>
				<option value="0">Watches</option>
				<option value="0">Toys &amp; Hobbies</option>
				<option value="0">Weddings &amp; Events</option>
				<option value="0">Novelty &amp; Special Use</option>
				<option value="0">Automobiles &amp; Motorcycles</option>
				<option value="0">Lights &amp; Lighting</option>
				<option value="0">Furniture</option>
				<option value="0">Industry &amp; Business</option>
				<option value="0">Electronic Components &amp; Supplies</option>
				<option value="0">Office &amp; School Supplies</option>
				<option value="0">Electrical Equipment &amp; Supplies</option>
				<option value="0">Gifts &amp; Crafts</option>
				<option value="0">Home Improvement</option>
				<option value="0">Food</option>
				<option value="0">Travel and Coupons</option>
				<option value="0">Security &amp; Protection</option>
				<option value="0">In All Categories</option>
                            </select>
                            <input type="text" placeholder="search product..." />
			    <button><i class="fa fa-search"></i></button>
			</div>
		    </div>
		    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 account-wrap">
			<!-- Header shopping cart -->
			<div class="my-account-holder">                
                	    <div class="my-account-title">
                    		<div class="user-icon float-left">
	                            <i class="fa fa-exchange" aria-hidden="true"></i>
    				</div>                                   
				<div class="clearfix"></div>                     
                            </div>
			</div>
			<!-- Header shopping cart -->
			<div class="my-account-holder">                
                	    <div class="my-account-title">
                    		<div class="user-icon float-left">
	                            <i class="fa fa-heart" aria-hidden="true"></i>
    				</div>                                   
				<div class="clearfix"></div>                     
                            </div>
			</div>                             
			<div class="my-account-holder">                
                            <div class="total-cart my-account-title" data-toggle="my-cart">
                    		<div class="user-icon float-left">
	                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
    				</div>
				<div class="float-left cart-link">
                        	    <a href="#">2 Item(s)</a>
				</div>
				<div class="clearfix"></div>  
				<ul>
				    <li>
					<div class="cart-img">
					    <a href="#"><img src="assets/img/cart/total-cart.jpg" alt="" /></a>											    
					</div>
					<div class="cart-info">
					    <h4><a href="#">Vestibulum suscipit</a></h4>
					    <span>£165.00 <span>x 1</span></span>
					</div>
					<div class="del-icon">
					    <i class="fa fa-times-circle"></i>
					</div>
				    </li>
				    <li>
					<div class="cart-img">
					    <a href="#"><img src="assets/img/cart/total-cart.jpg" alt="" /></a>											    
					</div>
					<div class="cart-info">
					    <h4><a href="#">Vestibulum suscipit</a></h4>
					    <span>£165.00 <span>x 1</span></span>
					</div>
					<div class="del-icon">
					    <i class="fa fa-times-circle"></i>
					</div>
				    </li>
				    <li>
					<div class="subtotal-text">Subtotal: </div>
					<div class="subtotal-price">£300.00</div>
				    </li>
                                    <li>
					<a href="#" class="button float-right">Checkout</a>										    
				    </li>
				</ul>                   
                            </div>
			</div>
		    </div>
		</div>
	    </div>
	</div>

	<?php require "menu.php"; ?>
    </header>
</div>
<script>
 $(".lang-chooser-popup li a").click(function(){
     var item = $(this), lang = item.data('value');
     item.parents(".dropdown").find('.btn').html(item.text() + ' <span class="caret"></span>');
     item.parents(".dropdown").find('.btn').val(lang);
     var current = "<?php echo $scope["user"]["language"]; ?>";
     if(lang != current)
	 $.getJSON("index.php?page=language&setLanguage=" + lang)
	  .success(function(data) {
//	      console.log(data);
	      location.reload();
	  })
	  .error(function(err){
	      console.log('something going wrong');
	  });
 });

</script>
