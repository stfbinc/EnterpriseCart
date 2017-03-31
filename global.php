<?php 
session_start();
include 'connect.php';
$table_user='customerinformation';
$table_category="inventoryfamilies";
$table_family="inventorycategories";
$table_product="inventoryitems";
$table_orderheader="orderheader";
$table_orderdetail="orderdetail";
$link=mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());
mysql_select_db($db_name, $link);
$sql='CREATE TABLE IF NOT EXISTS `customerfinancials` (
  `CompanyID` text,
  `DivisionID` text,
  `DepartmentID` text,
  `CustomerID` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;';
mysql_query($sql);
if(!isset($_SESSION["color"])){
	$_SESSION["color"]="Default";
}
$colorSelect="Brown";
if(isset($_GET["colorSelect"])){
	$colorSelect=$_GET["colorSelect"];
	$_SESSION["color"]=$colorSelect;
}
$color=$_SESSION["color"];
$temp="abc";
$head="abc";
?>