<!DOCTYPE html>  
<html>
    <head>
    </head>
    <body onload="main();">
	<style>
	</style>
	
	<div class="preloader">
	    <div class="cssload-speeding-wheel"></div>
	</div>

	<div id="content">
	    Cart
	</div>
	
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
