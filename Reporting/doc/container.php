<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
	<title><?php echo $app->title; ?></title>
	<!-- Bootstrap Core CSS -->
	<link href="dependencies/assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- jQuery -->
	<script src="dependencies/plugins/bower_components/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="dependencies/assets/bootstrap/dist/js/bootstrap.min.js"></script>
	<title><?php echo $app->title; ?></title>
	<style>
	 .invoice-table-ship {
	     margin-top: 20px; 
	     border:2px solid black;
	 }

	 .invoice-table-ship tr{
	     border:2px solid black;
	 }

	 .invoice-table-ship .row-header{
	     background-color:black;
	     color:white;
	 }

	 .invoice-table-ship td {
	     border:2px solid black;
	     font-weight : bold;
	 }

	 .invoice-table-detail .row-header{
	     background-color:black;
	     color:white;
	     style:height:10px;
	 }

	 .invoice-table-summary td {
	     font-weight : 600;
	     padding-left : 5px;
	 }
	 .invoice-table-summary .summ {
	     text-align : right;
	 }
	 @media print {
	     a[href]:after {
		 content: none !important;
	     }
	 }
	</style>
    </head>
    <body style="padding:10px; font-family: Arial;">
	<div id="content" class="container-fluid" style="background: #ffffff; padding-bottom:10px;">
	    <?php
	    if(isset($content))
		require __DIR__ . "/" . $content;
	    ?>
	</div>
	<script>
	</script>
    </body>
</html>
