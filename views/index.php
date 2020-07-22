<?php
    $cartSettings = $data->getCartSettings();
    $company = $data->getCompany();
?>

<!DOCTYPE html>  
<html class="no-js">
    <head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title><?php echo $company->CompanyName; ?></title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Place favicon.ico in the root directory -->
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	<script src="assets/js/jquery.min.js"></script>
	<!-- modernizr css -->
	<script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
	<!-- google fonts -->
	<link href='https://fonts.googleapis.com/css?family=Lato:400,900,700,300' rel='stylesheet'
            type='text/css'>
	<!-- all css here -->
	<!-- bootstrap v3.3.6 css 
	     <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	     <!-- animate css 
	     <link rel="stylesheet" href="assets/css/animate.css">
	     <!-- jquery-ui.min css
	     <link rel="stylesheet" href="assets/css/jquery-ui.min.css">
	     <!-- meanmenu css
	     <link rel="stylesheet" href="assets/css/meanmenu.min.css">
	     <!-- RS slider css
	     <link rel="stylesheet" type="text/css" href="assets/lib/rs-plugin/css/settings.css" media="screen" />
	     <!-- owl.carousel css
	     <link rel="stylesheet" href="assets/css/owl.carousel.css">
	     <!-- font-awesome css
	     <link rel="stylesheet" href="assets/css/font-awesome.min.css">
	     <!-- style css 
	     <link rel="stylesheet" href="assets/css/style.css">
	     <!-- responsive css
	     <link rel="stylesheet" href="assets/css/responsive.css">
	     <!-- color css -->
	<link rel="stylesheet" href="assets/css/bundle.css">
	<link rel="stylesheet" type="text/css" href="assets/lib/rs-plugin/css/settings.css" media="screen" />
	<link class="color-scheme-color" type="text/css" rel="stylesheet" media="all" href="assets/css/theme/color-01.css">
	<style>
	 .modal.in .modal-dialog 
	 {
	     -webkit-transform: translate(0, calc(50vh - 50%));
	     -ms-transform: translate(0, 50vh) translate(0, -50%);
	     -o-transform: translate(0, calc(50vh - 50%));
	     transform: translate(0, 50vh) translate(0, -50%);
	 }
	 
	 .dropdown-chooser {
	     width : 150px;
	 }

	 .dropdown-chooser > li > a {
	     color : black !important;
	 }
	 .product-img a img {
	     margin : 0px 0 !important;
	 }
	 .secondary-img {
	     width : 200px;
	     height : 200px;
	 }
	</style>
	<script>
	 function formatCurrency(value, precision){
	     var parts;
             if(value != undefined){
                 value = value.toString();
                 if(!precision)
		     precision = 2;
                 if((parts = value.match(/([-+\d]+)\.(\d+)/)) != null)
		     value = parts[1].replace(/\B(?=(\d{3})+(?!\d))/g, ',') + '.' + parts[2].substring(0, precision);
             }
	     return value;
	 }

	 var context = {
	     company : <?php echo json_encode($company, JSON_PRETTY_PRINT); ?>
	 };
	 
	 //global object used for creatink links to any part of application
	 var linksMaker = {
	     makeEnterpriseXDocreportsLink : function(type, id){
		 return "index.php?page=docreports&type=" + type + "&id=" + id;
	     },
	     makeEnterpriseXImageLink : function(item, field){
		 return "<?php echo $scope["config"]["EnterpriseXURL"]; ?>/uploads/" + item + "/" + field;
	     },
	     makeEnterpriseXProcedureLink : function(path, procedure){
                 var configName = "<?php echo ($scope["config"]["software"] == "Cart" ? "common" : "Admin");  ?>"
		 return "<?php echo $scope["config"]["EnterpriseXURL"]; ?>/index.php?config=" + configName + "&page=grid&action=" + path + "&procedure=" + procedure + "&CompanyID=<?php echo $scope["defaultCompany"]["CompanyID"]; ?>&DivisionID=<?php echo $scope["defaultCompany"]["DivisionID"]; ?>&DepartmentID=<?php echo $scope["defaultCompany"]["DepartmentID"]; ?>&EmployeeID=<?php echo $scope["config"]["EnterpriseXEmployeeID"]; ?>&EmployeePassword=<?php echo $scope["config"]["EnterpriseXEmployeePassword"]; ?>";
	     },
	     makeProcedureLink : function (path, procedure){
		 return "index.php?page=forms&action=" + path + "&procedure=" + procedure;
	     },
	     makeItemImageLink : function(item){
		 return (item.PictureURL != null  && item.PictureURL.length ? "assets/img/" + item.PictureURL : "assets/img/product/s1.jpg");
	     }
	 };
	 
	 function serverProcedureAnyCall(path, methodName, props, cb, jsonRequest, successAlert){
	     $.post(linksMaker.makeProcedureLink(path, methodName), jsonRequest ? JSON.stringify(props) : props, 'text')
	      .success(function(data) {
		  if(successAlert)
		      alert(data);	  
		  if(cb)
		      cb(data, undefined);
	      })
	      .error(function(xhr){
		  cb(undefined, xhr);
	      });
	 }

         var APIconfig = <?php echo json_encode($oscope->config["EnterpriseUniversalAPI"], JSON_PRETTY_PRINT); ?>;
         async function APICall(type, getParams, body){
             return $.ajax({
                 url: APIconfig.address + getParams,
                 type:  type,
                 data : JSON.stringify(body),
                 contentType : 'application/json'
             });
             /*
                try{
                
                try{
                postRes = await $.ajax({
                url: `../index.php?page=api&module=forms&path=AccountsReceivable/OrderProcessing/ViewOrders&action=procedure&procedure=Post&session_id=${session.session_id}`,
                type: 'POST',
                data : JSON.stringify({
                OrderNumber : 2132
                }),
                contentType : 'application/json'
                });
                }
                }
              */
         }

         var session_id = "<?php echo Session::get("session_id"); ?>";
	 
	 function serverEnterpriseXProcedureAnyCall(path, methodName, props, cb, jsonRequest, successAlert){
	     $.post(linksMaker.makeEnterpriseXProcedureLink(path, methodName), jsonRequest ? JSON.stringify(props) : props, 'text')
	      .success(function(data) {
		  if(successAlert)
		      alert(data);	  
		  if(cb)
		      cb(data, undefined);
	      })
	      .error(function(xhr){
		  cb(undefined, xhr);
	      });
	 }

	 var onlocationSkipUrls = {};
	 function onlocation(location){
	     var path = location.toString();
	     if(onlocationSkipUrls.hasOwnProperty(path)){
		 delete onlocationSkipUrls[path];
		 return;
	     }
	     var match;
	     if(path.search(/index\.php.*\#\//) != -1){
		 path = path.replace(/index\.php.*\#\//, "index\.php");
		 match = path.match(/grid\/(\w+)\/\w+\/(\w+)\//);
		 //		 if(match)
		 //		     sideBarSelectItem(findMenuItem(path));//match[1], match[2]);
		 //		 else{
		 //		     sideBarCloseAll();
		 //		     sideBarDeselectAll();
		 //		 }
		 //console.log(path);
		 $.get(path)
		  .done(function(data){
		      setTimeout(function(){
			  $("#content").html(data);
			  window.scrollTo(0,0);
		      },0);
		  })
		  .error(function(xhr){
		      if(xhr.status == 401)
			  console.log(xhr.responseText);
		      //	      window.location = "index.php?page=login";
		      else{
			  $("#content").html(xhr.responseText);
			  window.scrollTo(0,0);
			  //			  alert("Unable to load page");
		      }
		  });
	     }
	 }
	 onlocation(window.location);
	 $(window).on('hashchange', function() {
	     onlocation(window.location);
	 });

	 //select sidebar item if application loaded in separated pages mode, like that: grid/GeneralLedger/ledgerAccountGroup/grid/main/all, without index#/
         //	 if(window.location.toString().search(/#/) == -1)
         //	     window.location = "index.php#/?page=forms&action=products";
	</script>
    </head>
    <body onload="main();" class="home-1">
	<!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
	<!-- Add your site or application content here -->
	<!-- header-top-area start -->
	<?php require "nav/topbar.php"; ?>

	<div id="content">
	    <?php $api->get("forms", "products"); ?>
	</div>
	
	<!-- footer start -->
	<footer>
	    <!-- footer-top-area start -->
	    <div class="footer-top-area">
		<div class="container">
		    <div class="row">
			<!-- footer-widget start -->
			<div class="col-lg-3 col-md-3 col-sm-4">
			    <div class="footer-widget">
				<div class="footer-logo"><a href="#"><img style="width:40px; height:40px; margin-bottom:10px" src="<?php echo $linksMaker->makeEnterpriseXImageLink($scope, $company, "SmallLogo"); ?>" /> <?php echo $company->CompanyName; ?></a></div>								
				<!-- <p>Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. .</p>
				     <address class="box-address">
				     <span class="fa fa-home"></span>123 Pall Mall, London England<br>
				     <span class="fa fa-phone"></span> <b class="color-dark">+12345 67890 </b><br>										
				     <span class="fa fa-envelope"></span> <a class="color" href="mailto:admin@yourdomain.com">admin@yourdomain.com</a>
				     </address>                                 -->
			    </div>
			</div>
			<!-- footer-widget end -->
			<!-- footer-widget start -->
			<div class="col-lg-3 col-md-3 hidden-sm">
			    <div class="footer-widget">
				<h3>Information</h3>
				<ul class="footer-menu">
				    <?php if($cartSettings->AboutUsPage): ?>
					<li><a href="#/?page=forms&action=loadcontent&content=AboutUsPage">About Us</a></li>
				    <?php endif; ?>
				    <?php if($cartSettings->CustomerService): ?>
					<li><a href="#/?page=forms&action=loadcontent&content=CustomerService">Customer Service</a></li>
				    <?php endif; ?>
				    <?php if($cartSettings->PrivacyPolicy): ?>
					<li><a href="#/?page=forms&action=loadcontent&content=PrivacyPolicy">Privacy Policy</a></li>
				    <?php endif; ?>
				    <?php if($cartSettings->SiteMap): ?>
					<li><a href="#/?page=forms&action=loadcontent&content=SiteMap">Site Map</a></li>
				    <?php endif; ?>
				    <?php if($cartSettings->Contact): ?>
					<li><a href="#/?page=forms&action=loadcontent&content=Contact">Contact</a></li>
				    <?php endif; ?>
				</ul>
			    </div>
			</div>
			<!-- footer-widget end -->
			<!-- footer-widget start -->
			<div class="col-lg-3 col-md-3 col-sm-4">
			    <div class="footer-widget">
				<h3>Our services</h3>
				<ul class="footer-menu">
				    <?php if($cartSettings->ShippingReturns): ?>
					<li><a href="#/?page=forms&action=loadcontent&content=ShippingReturns">Shipping & Returns</a></li>
				    <?php endif; ?>
				    <?php if($cartSettings->SecureShopping): ?>
					<li><a href="#/?page=forms&action=loadcontent&content=SecureShopping">Secure Shopping</a></li>
				    <?php endif; ?>
				    <?php if($cartSettings->InternationalShipping): ?>
					<li><a href="#/?page=forms&action=loadcontent&content=InternationalShipping">International Shipping</a></li>
				    <?php endif; ?>
				    <?php if($cartSettings->Affiliates): ?>
					<li><a href="#/?page=forms&action=loadcontent&content=Affiliates">Affiliates</a></li>
				    <?php endif; ?>
				    <?php if($cartSettings->Help): ?>
					<li><a href="#/?page=forms&action=loadcontent&content=Help">Help</a></li>
				    <?php endif; ?>
				</ul>
			    </div>
			</div>
			<!-- footer-widget end -->
			<!-- footer-widget start -->
			<div class="col-lg-3 col-md-3 col-sm-4">
			    <div class="footer-widget">		
                                <h3>NEWSLETTER SIGNUP</h3>
                                <div class="subscribe-title">                               
                                    <form action="https://stfb.net/EnterpriseX/index.php?config=STFBEnterprise&page=help&method=newsletterSubscribe" method="post"">
					<div class="subscribe-form">
					    <input type="email" name="EMAIL" placeholder="Your Email.........">
					    <button>
						subscribe</button>
					</div>
                                    </form>
                                </div>						
                                <div class="widget-icon">
				    <?php if($cartSettings->Facebook): ?>
					<a href="<?php echo $cartSettings->FacebookUrl; ?>"><i class="fa fa-facebook"></i></a>
				    <?php endif; ?>
				    <?php if($cartSettings->Twitter): ?>
					<a href="<?php echo $cartSettings->TwitterUrl; ?>"><i class="fa fa-twitter"></i></a>
				    <?php endif; ?>
				    <?php if($cartSettings->LinkedIn): ?>
					<a href="<?php echo $cartSettings->LinkedInUrl; ?>"><i class="fa fa-linkedin"></i></a>
				    <?php endif; ?>
				    <?php if($cartSettings->GooglePlus): ?>
					<a href="<?php echo $cartSettings->GooglePlusUrl; ?>"><i class="fa fa-google-plus"></i></a>
				    <?php endif; ?>
				    <?php if($cartSettings->Instagram): ?>
					<a href="<?php echo $cartSettings->InstagramUrl; ?>"><i class="fa fa-instagram"></i></a>
				    <?php endif; ?>
				    <?php if($cartSettings->YouTube): ?>
					<a href="<?php echo $cartSettings->YouTubeUrl; ?>"><i class="fa fa-youtube-square"></i></a>
				    <?php endif; ?>
				</div>
			    </div>
			</div>
			<!-- footer-widget end -->
		    </div>
		</div>
	    </div>
	    <!-- footer-top-area end -->
	    <!-- footer-bottom-area start -->
	    <div class="footer-bottom-area">
		<div class="container">
		    <div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6">
			    <div class="copyright">
				<p>Copyright © <a href="#" target="_blank"><?php echo $company->CompanyName; ?></a> All Rights Reserved</p>
			    </div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6">
			    <div class="payment-img">
				<img src="assets/img/payment.png" alt="" />
			    </div>
			</div>
		    </div>
		</div>
	    </div>
	    <!-- footer-bottom-area end -->
	</footer>
	<!-- footer end -->
	<!-- Color Variations 
	     <div class="color-scheme-select trans-05">
             <div class="color-scheme-title text-colored mgt-25 mgb-15">
	     <h5>
             20 Awesome Colors</h5>
             </div>
             <div id="color-01" class="color-scheme-content color-scheme-selected" style="background: #01c583">
             </div>
             <div id="color-02" class="color-scheme-content " style="background: #F64747">
             </div>
             <div id="color-03" class="color-scheme-content" style="background: #0082c8">
             </div>
             <div id="color-04" class="color-scheme-content" style="background: #FF9800">
             </div>
             <div id="color-05" class="color-scheme-content" style="background: #E91E63">
             </div>
             <div id="color-06" class="color-scheme-content" style="background: #009688">
             </div>
             <div id="color-07" class="color-scheme-content" style="background: #FF5722">
             </div>
             <div id="color-08" class="color-scheme-content" style="background: #9EC139">
             </div>
             <div id="color-09" class="color-scheme-content" style="background: #9C27B0">
             </div>
             <div id="color-10" class="color-scheme-content" style="background: #4CAF50">
             </div>
             <div id="color-11" class="color-scheme-content" style="background: #795548">
             </div>
             <div id="color-12" class="color-scheme-content" style="background: #FF007F">
             </div>
             <div id="color-13" class="color-scheme-content" style="background: #673AB7">
             </div>
             <div id="color-14" class="color-scheme-content" style="background: #8BC34A">
             </div>
             <div id="color-15" class="color-scheme-content" style="background: #3E2723">
             </div>
             <div id="color-16" class="color-scheme-content" style="background: #FF7711">
             </div>
             <div id="color-17" class="color-scheme-content" style="background: #BF9C4F">
             </div>
             <div id="color-18" class="color-scheme-content" style="background: #33691E">
             </div>
             <div id="color-19" class="color-scheme-content" style="background: #607D8B">
             </div>
             <div id="color-20" class="color-scheme-content" style="background: #FF7077">
             </div>
             <div class="color-scheme-select-btn trans-05">
	     <span class="fa fa-cogs"></span>
             </div>
	     </div>
	-->
	<!-- jquery latest version 
	     <script src="assets/js/vendor/jquery-1.12.0.min.js"></script>
	     <!-- bootstrap js
	     <script src="assets/js/bootstrap.min.js"></script>
	     <!-- owl.carousel js 
	     <script src="assets/js/owl.carousel.min.js"></script>
	     <!-- jquery-ui js
	     <script src="assets/js/jquery-ui.min.js"></script>
	     <!-- RS-Plugin JS 
	     <script type="assets/text/javascript" src="lib/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
	     <script type="assets/text/javascript" src="lib/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
	     <script src="assets/lib/rs-plugin/rs.home.js"></script>
	     <!-- meanmenu js 
	     <script src="assets/js/jquery.meanmenu.js"></script>
	     <!-- wow js 
	     <script src="assets/js/wow.min.js"></script>
	     <!-- plugins js
	     <script src="assets/js/plugins.js"></script>
	     <!-- main js 
	     <script src="assets/js/main.js"></script>
	     <!-- Cookie js 
	     <script src="assets/js/jquery.cookie.js"></script>
	     <script src="assets/js/spin.min.js"></script>
	-->

	<!-- all js here -->
	<script src="assets/js/body.bundle.js"></script> 

	<script>	 
	 async function main(){
             var spinnerTarget = document.getElementById('content');
             var spinner;
	     $(document).ajaxStart(function(){
		 setTimeout(function(){
		     spinner = new Spinner({
			 lines: 13 // The number of lines to draw
			 , length: 28 // The length of each line
			 , width: 16 // The line thickness
			 , radius: 37 // The radius of the inner circle
			 , scale: 1 // Scales overall size of the spinner
			 , corners: 1 // Corner roundness (0..1)
			 , color: 'gray'//'#000' // #rgb or #rrggbb or array of colors
			 , opacity: 0.25 // Opacity of the lines
			 , rotate: 11 // The rotation offset
			 , direction: 1 // 1: clockwise, -1: counterclockwise
			 , speed: 1 // Rounds per second
			 , trail: 60 // Afterglow percentage
			 , fps: 20 // Frames per second when using setTimeout() as a fallback for CSS
			 , zIndex: 2e9 // The z-index (defaults to 2000000000)
			 , className: 'spinner' // The CSS class to assign to the spinner
			 , top: '40%' // Top position relative to parent
			 , left: '50%' // Left position relative to parent
			 , shadow: false // Whether to render a shadow
			 , hwaccel: false // Whether to use hardware acceleration
			 , position: 'absolute' // Element positioning
		     }).spin(spinnerTarget);
		 },0);
	     });
	     $(document).ajaxStop(function(){
		 //		 console.log('end');
		 if(spinner)
		     spinner.stop();
		 else
		     setTimeout(function(){
			 spinner.stop();
		     }, 0);
	     });
	 }
	</script>
    </body>
</html>
