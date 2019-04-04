<div id="loginForm" class="modal fade  bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
	<div class="modal-content">
	    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">
		    <?php echo $translation->translateLabel("Log In"); ?>
		</h4>
	    </div>
	    <div class="modal-body">
		<form id="loginform">
		    <div class="form-group">
			<div class="row">
 			    <div class="col-xs-6">
				<label class="dropdown-label pull-left"><?php echo $translation->translateLabel("Username"); ?>:</label>
			    </div>
			    <div class="col-xs-6">
				<input name="username" class="form-control pull-right b-none"/>
			    </div>
			</div>
		    </div>
		    <div class="form-group">
			<div class="row">
 			    <div class="col-xs-6">
				<label class="dropdown-label pull-left"><?php echo $translation->translateLabel("Password"); ?>:</label>
			    </div>
			    <div class="col-xs-6">
				<input name="password" class="form-control pull-right b-none"/>
			    </div>
			</div>
		    </div>
		</form>
	    </div>
	    <div class="modal-footer">
		<button type="button" class="btn btn-primary" data-dismiss="modal" id="loginButton">
		    <?php echo $translation->translateLabel("Login"); ?>
		</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">
		    <?php echo $translation->translateLabel("Cancel"); ?>
		</button>
	    </div>
	</div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="header-top-area hidden-xs">
    <div class="container">
	<div class="row">
            <div class="col-lg-6 col-md-6 col-sm-4">
		<div class="welcome">
                    <!--  <span class="phone">Phone: +12345 67890</span> <span class="hidden-sm">/</span>
			 <span class="email hidden-sm">Email: yourname@domain.com</span> -->
		</div>
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
			<?php if(key_exists("Customer", $user)): ?>
			    <span class="dropdown">
				<button class="btn btn-default dropdown-toggle" type="button" id="customerDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:white; border:0px; background-color:inherit; margin-top:-2px">
				    <?php echo $user["Customer"]->CustomerLogin; ?>
				    <span class="caret"></span>
				</button>
				<ul class="dropdown-menu customer-popup dropdown-chooser" aria-labelledby="customerDropdown" aria-expanded="false">
				    <li><a href="javascript:;" id="logoutButton" data-value="logout" class="lang-item"> <?php echo $translation->translateLabel("Log out"); ?></a>
				    </li>
				</ul>
			    </span>
			    <li><a href="#/?page=forms&action=account">
				<?php
				    echo $translation->translateLabel("Account");
				?>
			    </a>
			    </li>
			<?php else: ?>
			    <li><a href="javascript:;" onclick="$('#loginForm').modal('show');">
				<?php
				    if(key_exists("Customer", $user))
					echo $user["Customer"]->CustomerLogin;
				    else
					echo $translation->translateLabel("Login");
				?>
			    </a>
			    </li>
			<?php endif ?>
			<!-- <li><a href="#"><?php echo $translation->translateLabel("Wishlist"); ?></a></li> -->
			<li><a href="#/?page=forms&action=shoppingcart"><?php echo $translation->translateLabel("Cart"); ?></a></li>
			<li><a href="#/?page=forms&action=checkout"><?php echo $translation->translateLabel("Checkout"); ?></a></li>
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
			    <a href="index.php"><img style="width:40px; height:40px; margin-bottom:10px" src="<?php echo $linksMaker->makeEnterpriseXImageLink($scope, $company, "SmallLogo"); ?>" /> <?php echo $company->CompanyName; ?></a>
			</div>
		    </div>
		    <div class="col-lg-6 col-md-5 col-sm-5 col-xs-6 hidden-xs">
			<div class="header-search">
			    <form id="searchForm" onsubmit="return false">
				<select name="family" id="searchFamilies">
				</select>
				<input type="text" placeholder="search product..." name="text" />
				<button onclick="search();"><i class="fa fa-search"></i></button>
			    </form>
			</div>
		    </div>
		    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 account-wrap">
			<!-- Header shopping cart -->
			<!-- <div class="my-account-holder">                
                	     <div class="my-account-title">
                    	     <div class="user-icon float-left">
	                     <i class="fa fa-exchange" aria-hidden="true"></i>
    			     </div>                                   
			     <div class="clearfix"></div>                     
                             </div>
			     </div> -->
			<!-- Header shopping cart -->
			<!-- <div class="my-account-holder">                
                	     <div class="my-account-title">
                    	     <div class="user-icon float-left">
	                     <i class="fa fa-heart" aria-hidden="true"></i>
    			     </div>                                   
			     <div class="clearfix"></div>                     
                             </div>
			     </div> -->                             
			<div class="my-account-holder">                
                            <div class="total-cart my-account-title" data-toggle="my-cart">
                    		<div class="user-icon float-left">
	                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
    				</div>
				<div class="float-left cart-link">
                        	    <a id="shoppingCartTopbarCounter" href="#"></a>
				</div>
				<div class="clearfix"></div>  
				<ul id="shoppingCartTopbarList">
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

 function search(){
     var searchForm = $("#searchForm");

     serverProcedureAnyCall("search", "searchproducts", searchForm.serialize(), function(data, error){
	 if(data)
	     window.location = "index.php#/?page=forms&action=search&" + searchForm.serialize();
	 //location.reload();
	 else
	     console.log("login failed");
     });
 }

 serverProcedureAnyCall("products", "getFamilies", [], function(data){
     var _html = '', ind, families = JSON.parse(data);
     for(ind in families)
	 _html += "<option value=\"" + ind + "\">" + families[ind].FamilyName + "</option>\n";

     $("#searchFamilies").html(_html);

     _html = '';
     for(ind in families)
	 _html += "<li><a href=\"index.php#/?page=forms&action=products&categories=true&family=" + ind + "\">" + families[ind].FamilyName + "</a></li>"
     $("#productsFamilies").html(_html);
     $("#mobileMenu").html($("#desktopMenu").html());
 });

 serverProcedureAnyCall("products", "getCurrencies", [], function(data){
     var _html = '', ind, list = JSON.parse(data);
     for(ind in list)
	 _html += " <li><a href=\"#\">" + list[ind].CurrencyID + "</a></li>\n";

     $("#currencyChooser").html(_html);
 });

 $('#loginButton').click(function(){
     var loginform = $('#loginform');
     serverProcedureAnyCall("users", "login", loginform.serialize(), function(data, error){
	 if(data)
	     location.reload();
	 else
	     console.log("login failed");
     });
     
 });

 $('#logoutButton').click(function(){
     serverProcedureAnyCall("users", "logout", undefined, function(data, error){
	 if(data)
	     location.reload();
	 else
	     console.log("login failed");
     });     
 });

 var items = [
     {
	 ItemID : "Hoho",
	 Price : 400.50,
	 PictureURL : "assets/img/cart/total-cart.jpg",
	 counter : 1
     },
     {
	 ItemID : "Crown",
	 Price : 40000,
	 PictureURL : "assets/img/cart/total-cart.jpg",
	 counter : 2
     }
 ];
 
 function shoppingCartRender(shoppingCart){
     var element = $("#shoppingCartTopbarList"), _html = '', itemsCounter = 0, ind, subtotal = 0,
	 items = shoppingCart.items;
     for(ind in items){
	 _html += "<li><div class=\"cart-img\"><a href=\"#\"><img src=\"" + linksMaker.makeItemImageLink(items[ind]) + "\" alt=\"\" /></a></div><div class=\"cart-info\"><h4><a href=\"#\">" + items[ind].ItemID + "</a></h4><span>" + items[ind].Price + " <span>x " + items[ind].counter + "</span></span></div><div onclick=\"shoppingCartRemoveItem('" + items[ind].ItemID + "');\" class=\"del-icon\"><i class=\"fa fa-minus\"></i></div><div onclick=\"shoppingCartAddItem('" + items[ind].ItemID + "');\" class=\"del-icon\"><i class=\"fa fa-plus\"></i></div></li>";
	 itemsCounter++;
	 subtotal += items[ind].Price * items[ind].counter;
     }
     _html += "<li><div class=\"subtotal-text\">Subtotal: </div><div class=\"subtotal-price\">" + subtotal + "</div></li><li><a href=\"#/?page=forms&action=checkout\" class=\"button float-right\">Checkout</a></li>"
     element.html(_html);

     $("#shoppingCartTopbarCounter").html(itemsCounter + " Item(s)");
 }
 
 serverProcedureAnyCall("shoppingcart", "shoppingCartGetCart", undefined, function(data, error){
     if(data)
	 shoppingCartRender(JSON.parse(data));
     else
	 console.log("login failed");
 });
 
 function shoppingCartCheckout(){
     console.log('checkout');
 }

 function shoppingCartAddItem(ItemID){
     serverProcedureAnyCall("shoppingcart", "shoppingCartAddItem", "ItemID=" + ItemID, function(data, error){
	 if(data){
	     shoppingCartRender(JSON.parse(data));
	     if(typeof shoppingCartFormRender == 'function')
		 shoppingCartFormRender(JSON.parse(data));
	 }
	 else
	     console.log("login failed");
     });
 }
 
 function shoppingCartRemoveItem(ItemID){
     serverProcedureAnyCall("shoppingcart", "shoppingCartRemoveItem", "ItemID=" + ItemID, function(data, error){
	 if(data){
	     shoppingCartRender(JSON.parse(data));
	     if(typeof shoppingCartFormRender == 'function')
		 shoppingCartFormRender(JSON.parse(data));
	     //	     location.reload();
	 }else
	 console.log("login failed");
     });
 }
</script>
