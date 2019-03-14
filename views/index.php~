<!DOCTYPE html>  
<html dir="<?php echo $ascope["interfaceType"]; ?>">
    <?php
	require 'header.php';
    ?>
    <body onload="main();">
	<style>
	 /*
	    FIXME hardcode for RTL Support, we need support styles separed in the future for RTL and LTR interface types
	  */
	 <?php if($ascope["interfaceType"] == "rtl"): ?>
	 @media (min-width: 768px){
	     #page-wrapper{
		 margin-right : 220px;
		 margin-left : 0px;
	     }
	     .top-left-part{
		 display : none !important;
	     }

	     .navbar-header{
		 padding-right : 220px;
	     }

	     .navbar-header-collapsed{
		 padding-right : 60px;
	     }
	     
	     .shw-rside {
		 left : 0px !important;
		 right : auto !important;
	     }
	     
	     .right-sidebar {
		 left: -240px;
		 right : auto;
	     }

	     .navbar-search {
		 padding-right : 0px;
	     }

	     .content-wrapper #page-wrapper {
		 margin-left : 0px;
		 margin-right : 60px;
	     }

	     .content-wrapper .sidebar .nav-second-level {
		 left : 0px !important;
		 right : 60px !important;
	     }
	 }
	 .navbar-top-links > li {
	     float: right;
	 }

	 #side-menu {
	     padding-right : 0px !important;
	 }

	 #side-menu > li > a {
	     padding: 5px 15px 5px 15px;
	 }

	 .sidebar .arrow {
	     position: absolute;
	     left: 15px;
	     right : auto;
	 }
	 
	 .arrow {
	     float : left !important;
	 }
	 
	 .sidebar .nav-second-level .arrow {
	     left: 15px !important;
	     right : auto !important;
	     top: 8px;
	 }
	 .nav-second-level {
	     padding-right : 0px !important;
	 }
	 
	 .nav-third-level {
	     padding-right : 8px !important;
	 }

	 .nav-fourth-level {
	     padding-right : 0px !important;
	 }
	 <?php endif; ?>
	</style>
	
	<script src="dependencies/plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
	<div class="preloader">
	    <div class="cssload-speeding-wheel"></div>
	</div>
	<div id="wrapper">
	    <?php
		require 'nav/top.php';
	    ?>
	    <?php
		require 'nav/left.php';
	    ?>
	    <!-- /#wrapper -->
	    <?php
		require 'footer.php';
	    ?>
	    <div id="page-wrapper">
		<?php
		    if(key_exists("page", $_GET) && $_GET["page"] == "index")
			require 'dashboards/GeneralLedger.php';
		?>
	    </div>
	    <!-- .right-sidebar -->
	    <div class="right-sidebar">
		<div class="slimscrollright">
		    <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
		    <div class="r-panel-body">
			<ul>
			    <li><b>Layout Options</b></li>
			    <li>
				<div class="checkbox checkbox-info">
				    <input id="checkbox1" type="checkbox" class="fxhdr">
				    <label for="checkbox1"> Fix Header </label>
				</div>
			    </li>
			    <li>
				<div class="checkbox checkbox-warning">
				    <input id="checkbox2" type="checkbox" checked="" class="fxsdr">
				    <label for="checkbox2"> Fix Sidebar </label>
				</div>
			    </li>
			    <li>
				<div class="checkbox checkbox-success">
				    <input id="checkbox4" type="checkbox" class="open-close">
				    <label for="checkbox4" > Toggle Sidebar </label>
				</div>
			    </li>
			    <li>
				<label for="homanyrows">
				    <?php echo $translation->translateLabel("Rows in grid"); ?>
				</label>
				<select id="howmanyrows" style="margin-left: 30px;" onchange="changeDefaultRowsInGrid(this);">
				</select>
			    </li>
			</ul>
			<ul id="themecolors" class="m-t-20">
			    <li><b>With Light sidebar</b></li>
			    <li><a href="javascript:void(0)" theme="default" class="default-theme">1</a></li>
			    <li><a href="javascript:void(0)" theme="green" class="green-theme">2</a></li>
			    <li><a href="javascript:void(0)" theme="gray" class="yellow-theme">3</a></li>
			    <li><a href="javascript:void(0)" theme="blue" class="blue-theme">4</a></li>
			    <li><a href="javascript:void(0)" theme="purple" class="purple-theme">5</a></li>
			    <li><a href="javascript:void(0)" theme="megna" class="megna-theme">6</a></li>
			    <li><b>With Dark sidebar</b></li>
			    <br/>
			    <li><a href="javascript:void(0)" theme="default-dark" class="default-dark-theme">7</a></li>
			    <li><a href="javascript:void(0)" theme="green-dark" class="green-dark-theme">8</a></li>
			    <li><a href="javascript:void(0)" theme="gray-dark" class="yellow-dark-theme working">9</a></li>

			    <li><a href="javascript:void(0)" theme="blue-dark" class="blue-dark-theme">10</a></li>
			    <li><a href="javascript:void(0)" theme="purple-dark" class="purple-dark-theme">11</a></li>
			    <li><a href="javascript:void(0)" theme="megna-dark" class="megna-dark-theme">12</a></li>

			</ul>
		    </div>
		</div>
	    </div>
	    <!-- /.right-sidebar -->
	</div>
	<?php 
	    require 'uiItems/footer.php';
	?>
	<script>
	 //ui handlers initialization like a open|close and hide|show handlers
	 function initUIHandlers(){
	     $(function () {
		 $(".preloader").fadeOut();
		 $('#side-menu').metisMenu();
	     });
	     // Theme settings
	     //Open-Close-right sidebar
	     $(".right-side-toggle").click(function () {
		 $(".right-sidebar").slideDown(50);
		 $(".right-sidebar").toggleClass("shw-rside");
		 // Fix header
		 $(".fxhdr").click(function () {
		     $("body").toggleClass("fix-header");
		 });
		 // Fix sidebar
		 $(".fxsdr").click(function () {
		     $("body").toggleClass("fix-sidebar");
		 });
		 // Service panel js
		 if ($("body").hasClass("fix-header")) {
		     $('.fxhdr').attr('checked', true);
		 }
		 else {
		     $('.fxhdr').attr('checked', false);
		 }
		 if ($("body").hasClass("fix-sidebar")) {
		     $('.fxsdr').attr('checked', true);
		 }
		 else {
		     $('.fxsdr').attr('checked', false);
		 }
	     });
	     
	     //Loads the correct sidebar on window load,
	     //collapses the sidebar on window resize.
	     // Sets the min-height of #page-wrapper to window size
	     $(function () {
		 $(window).bind("load resize", function () {
		     var topOffset = 60;
		     var width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
		     if (width < 768) {
			 $('div.navbar-collapse').addClass('collapse');
			 topOffset = 100; // 2-row-menu
		     }
		     else {
			 $('div.navbar-collapse').removeClass('collapse');
		     }
		     var height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
		     height = height - topOffset;
		     if (height < 1) height = 1;
		     if (height > topOffset) {
			 $("#page-wrapper").css("min-height", (height - 35) + "px");
		     }
		 });
		 var url = window.location;
		 var element = $('ul.nav a').filter(function () {
		     var pattern = this.href.replace(/[=\.\:|\\\{\}\(\)\[\]\^\$\+\*\?\.]/g, "\\$&");
		     if(url.href.match(new RegExp(pattern + "(\\&+|$)"))){
			 //		console.log(url.href);
			 //		console.log(new RegExp(pattern + "(\\&+|$)"));
		     }
		     return url.href.match(new RegExp(pattern + "(\\&+|$)"));
		     //            return this.href == url || url.href.match(new RegExp(pattern + "(\\&+|$)"));
		 });
		 element.addClass('active');
		 element = element.parent().parent();
		 var firstLevel = element.parent().parent();
		 var zeroLevel =  firstLevel.parent().parent();
		 if(firstLevel.hasClass('collapse'))
		     firstLevel.collapse();
		 
		 if(zeroLevel.hasClass('collapse'))
		     zeroLevel.collapse();

		 var twoLevel = element;
		 twoLevel.collapse();
		 var onlyOne = true;
		 twoLevel.on('shown.bs.collapse', function(e){
		     e.stopPropagation();
		 });
		 //	twoLevel.css("display", "none");
		 firstLevel.on('shown.bs.collapse', function(e){
		     setTimeout(function(){
			 //console.log('ddd', twoLevel);
			 if(onlyOne){
			     //		    twoLevel.css("display", "block");
			     twoLevel.css("height", "100%");
			     twoLevel.addClass("in");
			     //		    console.log(twoLevel.collapse());
			     onlyOne = false;
			 }

			 var sidebarHeight = parseInt($(".sidebar").css("height").match(/(\d+)/)[1]),
			     contentHeight = parseInt($("#page-wrapper").css("height").match(/(\d+)/)[1]);
			 console.log(sidebarHeight, contentHeight, sidebarHeight + "px");
			 if(sidebarHeight > contentHeight)
			     $("#page-wrapper").css("min-height", (sidebarHeight + 500) + "px");
		     }, 700);
		 });
		 
		 element = element.parent();
		 
		 if(element.is('li'))
		     element.addClass('active');
	     });
	     
	     // This is for resize window
	     $(function () {
		 $(window).bind("load resize", function () {
		     width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
		     if (width < 1170) {
			 $('body').addClass('content-wrapper');
			 $(".open-close i").removeClass('icon-arrow-left-circle');
			 $(".sidebar-nav, .slimScrollDiv").css("overflow-x", "visible").parent().css("overflow", "visible");
			 $(".logo span").hide();
		     }
		     else {
			 $('body').removeClass('content-wrapper');
			 $(".open-close i").addClass('icon-arrow-left-circle');
			 $(".logo span").show();
		     }
		 });
	     });
	     // This is for click on open close button
	     // Sidebar open close
	     $(".open-close").on('click', function () {
		 console.log("collapsing");
		 if ($("body").hasClass("content-wrapper")) {
		     $("body").trigger("resize");
		     $('.navbar-header').removeClass('navbar-header-collapsed');
		     $(".sidebar-nav, .slimScrollDiv").css("overflow", "hidden").parent().css("overflow", "visible");
		     $("body").removeClass("content-wrapper");
		     $(".open-close i").addClass("icon-arrow-<?php  echo ($ascope["interfaceType"] == "rtl" ? "right" : "left"); ?>-circle");
		     $(".logo span").show();
		 }
		 else {
		     $("body").trigger("resize");
		     $('.navbar-header').addClass('navbar-header-collapsed');
		     $(".sidebar-nav, .slimScrollDiv").css("overflow-x", "visible").parent().css("overflow", "visible");
		     $("body").addClass("content-wrapper");
		     $(".open-close i").removeClass("icon-arrow-<?php  echo ($ascope["interfaceType"] == "rtl" ? "right" : "left"); ?>-circle");
		     $(".logo span").hide();
		 }
	     });
	     // Collapse Panels
	     (function ($, window, document) {
		 var panelSelector = '[data-perform="panel-collapse"]';
		 $(panelSelector).each(function () {
		     var $this = $(this)
		       , parent = $this.closest('.panel')
		       , wrapper = parent.find('.panel-wrapper')
		       , collapseOpts = {
			   toggle: false
		       };
		     if (!wrapper.length) {
			 wrapper = parent.children('.panel-heading').nextAll().wrapAll('<div/>').parent().addClass('panel-wrapper');
			 collapseOpts = {};
		     }
		     wrapper.collapse(collapseOpts).on('hide.bs.collapse', function () {
			 $this.children('i').removeClass('ti-minus').addClass('ti-plus');
		     }).on('show.bs.collapse', function () {
			 $this.children('i').removeClass('ti-plus').addClass('ti-minus');
		     });
		 });
		 $(document).on('click', panelSelector, function (e) {
		     e.preventDefault();
		     var parent = $(this).closest('.panel');
		     var wrapper = parent.find('.panel-wrapper');
		     wrapper.collapse('toggle');
		 });
	     }(jQuery, window, document));
	     // Remove Panels
	     (function ($, window, document) {
		 var panelSelector = '[data-perform="panel-dismiss"]';
		 $(document).on('click', panelSelector, function (e) {
		     e.preventDefault();
		     var parent = $(this).closest('.panel');
		     removeElement();

		     function removeElement() {
			 var col = parent.parent();
			 parent.remove();
			 col.filter(function () {
			     var el = $(this);
			     return (el.is('[class*="col-"]') && el.children('*').length === 0);
			 }).remove();
		     }
		 });
	     }(jQuery, window, document));
	     //tooltip
	     $(function () {
		 $('[data-toggle="tooltip"]').tooltip()
	     })
	     //Popover
	     $(function () {
		 $('[data-toggle="popover"]').popover()
	     })
	     // Task
	     $(".list-task li label").click(function () {
		 $(this).toggleClass("task-done");
	     });
	     $(".settings_box a").click(function () {
		 $("ul.theme_color").toggleClass("theme_block");
	     });
	     //Colepsible toggle
	     $(".collapseble").click(function () {
		 $(".collapseblebox").fadeToggle(350);
	     });
	     // Sidebar
	     $('.slimscrollright').slimScroll({
		 height: '100%'
		 , position: 'right'
		 , size: "5px"
		 , color: '#dcdcdc'
		 , });
	     $('.slimscrollsidebar').slimScroll({
		 height: '100%'
		 , position: 'right'
		 , size: "0px"
		 , color: '#dcdcdc'
		 , });
	     $('.chat-list').slimScroll({
		 height: '100%'
		 , position: 'right'
		 , size: "0px"
		 , color: '#dcdcdc'
		 , });
	     // Resize all elements
	     $("body").trigger("resize");
	     // visited ul li
	     $('.visited li a').click(function (e) {
		 $('.visited li').removeClass('active');
		 var $parent = $(this).parent();
		 if (!$parent.hasClass('active')) {
		     $parent.addClass('active');
		 }
		 e.preventDefault();
	     });
	     // Login and recover password
	     $('#to-recover').click(function () {
		 $("#loginform").slideUp();
		 $("#recoverform").fadeIn();
	     });
	     // Update 1.5
	     // this is for close icon when navigation open in mobile view
	     $(".navbar-toggle").click(function () {
		 $(".navbar-toggle i").toggleClass("ti-menu");
		 $(".navbar-toggle i").addClass("ti-close");
	     });
	     // Update 1.6
	 }
	 
	 var gridViewDefaultRowsInGrid = localStorage.getItem('gridViewDefaultRowsInGrid');
	 if(!gridViewDefaultRowsInGrid)
	     localStorage.setItem('gridViewDefaultRowsInGrid', gridViewDefaultRowsInGrid = 10);
	 
	 function changeDefaultRowsInGrid(item){
	     localStorage.setItem('gridViewDefaultRowsInGrid', gridViewDefaultRowsInGrid = parseInt($(item).val()));
	 }
	 
	 var menuCategories = <?php echo json_encode($leftMenu["Main"]["data"]); ?>;
	 function findMenuItem(href){
	     var ind, sind, submenu, iind, items;
	     for(ind in menuCategories){
		 items = menuCategories[ind].data;
		 for(iind in items){
		     if(items[iind].type == "item"){
			 if(href.match("/" + items[iind].id + "/"))
			     return {
				 menu : menuCategories[ind],
				 item : items[iind]
			     };
		     }else if(items[iind].type == "submenu"){
			 submenu = items[iind].data;
			 for(sind in submenu){
			     //			     console.log(href);
			     //			     console.log(submenu[sind].id);
			     if(href.match("/" + submenu[sind].id + "/"))
				 return {
				     menu : menuCategories[ind],
				     submenu : items[iind],
				     item : submenu[sind]
				 };
			 }
		     }
		 }
	     }
	     return undefined;
	 }
	 
	 //	 console.log(JSON.stringify(menuCategories, null, 3));
	 /*
	    parsing window.location, loading page and insert to content section. Main entry point of SAP
	  */
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
			  $("#page-wrapper").html(data);
			  window.scrollTo(0,0);
		      },0);
		  })
		  .error(function(xhr){
		      if(xhr.status == 401)
			  //			  console.log(xhr.responseText);
		      window.location = "index.php?page=login";
		      else{
			  $("#page-wrapper").html(xhr.responseText);
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
	     var rowOptions = [10, 25, 50,100];
	     var howmanyrows = $("#howmanyrows"), ind, _html = "";
	     initUIHandlers();
	     for(ind in rowOptions)
		 _html += "<option " + ( rowOptions[ind] == gridViewDefaultRowsInGrid ? "selected" : "") + ">" + rowOptions[ind] + "</option>";
	     howmanyrows[0].innerHTML = _html;
	     <?php if(isset($scope)): ?>
	     //sideBarSelectItem("<?php /*echo  $scope["pathFolder"] . "\",\"" . $scope["pathPage"];*/?>");
	     <?php endif; ?>
             var spinnerTarget = document.getElementById('page-wrapper');
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
