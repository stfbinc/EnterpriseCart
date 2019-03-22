<!DOCTYPE html>  
<html class="no-js">
    <head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Enterprise X Cart</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Place favicon.ico in the root directory -->
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	<script src="assets/js/jquery.min.js"></script>
	<!-- google fonts -->
	<link href='https://fonts.googleapis.com/css?family=Lato:400,900,700,300' rel='stylesheet'
            type='text/css'>
	<!-- all css here -->
	<!-- bootstrap v3.3.6 css -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<!-- animate css -->
	<link rel="stylesheet" href="assets/css/animate.css">
	<!-- jquery-ui.min css -->
	<link rel="stylesheet" href="assets/css/jquery-ui.min.css">
	<!-- meanmenu css -->
	<link rel="stylesheet" href="assets/css/meanmenu.min.css">
	<!-- RS slider css -->
	<link rel="stylesheet" type="text/css" href="assets/lib/rs-plugin/css/settings.css" media="screen" />
	<!-- owl.carousel css -->
	<link rel="stylesheet" href="assets/css/owl.carousel.css">
	<!-- font-awesome css -->
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<!-- style css -->
	<link rel="stylesheet" href="assets/css/style.css">
	<!-- responsive css -->
	<link rel="stylesheet" href="assets/css/responsive.css">
	<!-- color css -->
	<link class="color-scheme-color" type="text/css" rel="stylesheet" media="all" href="assets/css/theme/color-01.css">
	<!-- modernizr css -->
	<script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
	<style>
	 .dropdown-chooser {
	     width : 150px;
	 }

	 .dropdown-chooser > li > a {
	     color : black !important;
	 }
	</style>
	<script>
	 //global object used for creatink links to any part of application
	 var linksMaker = {
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
				<div class="footer-logo"><a href="#"><span>e</span> Online Shop</a></div>								
				<p>Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. .</p>
				<address class="box-address">
				    <span class="fa fa-home"></span>123 Pall Mall, London England<br>
				    <span class="fa fa-phone"></span> <b class="color-dark">+12345 67890 </b><br>										
				    <span class="fa fa-envelope"></span> <a class="color" href="mailto:admin@yourdomain.com">admin@yourdomain.com</a>
				</address>                                
			    </div>
			</div>
			<!-- footer-widget end -->
			<!-- footer-widget start -->
			<div class="col-lg-3 col-md-3 hidden-sm">
			    <div class="footer-widget">
				<h3>Information</h3>
				<ul class="footer-menu">
				    <li><a href="#">About Us</a></li>
				    <li><a href="#">Customer Service</a></li>
				    <li><a href="#">Privacy Policy</a></li>
				    <li><a href="#">Site Map</a></li>
				    <li><a href="#">Contact</a></li>
				</ul>
			    </div>
			</div>
			<!-- footer-widget end -->
			<!-- footer-widget start -->
			<div class="col-lg-3 col-md-3 col-sm-4">
			    <div class="footer-widget">
				<h3>Our services</h3>
				<ul class="footer-menu">
				    <li><a href="#">Shipping & Returns</a></li>
				    <li><a href="#">Secure Shopping</a></li>
				    <li><a href="#">International Shipping</a></li>
				    <li><a href="#">Affiliates</a></li>
				    <li><a href="#">Help</a></li>
				</ul>
			    </div>
			</div>
			<!-- footer-widget end -->
			<!-- footer-widget start -->
			<div class="col-lg-3 col-md-3 col-sm-4">
			    <div class="footer-widget">		
                                <h3>NEWSLETTER SIGNUP</h3>
                                <div class="subscribe-title">                               
                                    <form action="#">
					<div class="subscribe-form">
					    <input type="text" placeholder="Your Email.........">
					    <button>
						subscribe</button>
					</div>
                                    </form>
                                </div>						
                                <div class="widget-icon">
				    <a href="#"><i class="fa fa-facebook"></i></a>
				    <a href="#"><i class="fa fa-twitter"></i></a>
				    <a href="#"><i class="fa fa-linkedin"></i></a>
				    <a href="#"><i class="fa fa-google-plus"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-youtube-square"></i></a>
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
				<p>Copyright © <a href="#" target="_blank">Enterprise X Cart</a>. All Rights Reserved</p>
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
	<!-- Color Variations -->
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
	<!-- all js here -->
	<!-- jquery latest version -->
	<script src="assets/js/vendor/jquery-1.12.0.min.js"></script>
	<!-- bootstrap js -->
	<script src="assets/js/bootstrap.min.js"></script>
	<!-- owl.carousel js -->
	<script src="assets/js/owl.carousel.min.js"></script>
	<!-- jquery-ui js -->
	<script src="assets/js/jquery-ui.min.js"></script>
	<!-- RS-Plugin JS -->
	<script type="assets/text/javascript" src="lib/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
	<script type="assets/text/javascript" src="lib/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
	<script src="assets/lib/rs-plugin/rs.home.js"></script>
	<!-- meanmenu js -->
	<script src="assets/js/jquery.meanmenu.js"></script>
	<!-- wow js -->
	<script src="assets/js/wow.min.js"></script>
	<!-- plugins js -->
	<script src="assets/js/plugins.js"></script>
	<!-- main js -->
	<script src="assets/js/main.js"></script>
	<!-- Cookie js -->
	<script src="assets/js/jquery.cookie.js"></script>

	<script>
	 
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
	 function main(){
             var spinnerTarget = document.getElementById('page-wrapper');
             var spinner;
	     if(window.location.toString().search(/#/) == -1)
		 window.location = "index.php#/?page=index&action=store";
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
		     console.log('end');
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
