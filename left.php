<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>无标题文档</title>
<style type="text/css">
<!--
.STYLE1 {font-size: 18px}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style>
</head>

<body>
<?php 
include_once 'connect.php'; 
if(isset($_POST["aa"])){
	$sql="select admin from $table_user where login='".$_POST["login"]."' and password='".$_POST["password"]."'";
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
	if($row["admin"]==1){
		$_SESSION["administrator"]=1;
	}
}
?>
<?php 
if(!isset($_SESSION["administrator"])){
?>
<form method="post">
admin: <input type="text" name="login" size=12/>
password: <input type="password" name="password" size=12/>
<input type="submit" value="submit"/>
<input type="hidden" name="aa"/>
</form>
<?php 
}else if(isset($_SESSION["administrator"])&&$_SESSION["administrator"]==1){
?>
 <p><a href="addcategory.php" target="mainFrame" class="STYLE1">admin category
   </a></p>
 <p><a href="addproduct.php" target="mainFrame" class="STYLE1">admin product</a>  </p>
 <p><a href="orderlist.php" target="mainFrame" class="STYLE1">admin order</a></p>
<?php 
}
?>
</body>
</html>
