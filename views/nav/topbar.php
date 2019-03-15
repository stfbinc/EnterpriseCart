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
                            <ul id="currencyChooser">
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
			    <select id="searchCategories">
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

 serverProcedureAnyCall("products", "getFamilies", [], function(data){
     var _html = '', ind, families = JSON.parse(data);
     for(ind in families)
	 _html += "<option value=\"" + ind + "\">" + families[ind].FamilyName + "</option>\n";

     $("#searchCategories").html(_html);
 });

 serverProcedureAnyCall("products", "getCurrencies", [], function(data){
     var _html = '', ind, list = JSON.parse(data);
     for(ind in list)
	 _html += " <li><a href=\"#\">" + list[ind].CurrencyID + "</a></li>\n";

     $("#currencyChooser").html(_html);
 });
</script>
