<style>
body{margin:0px;padding:0px;background-color: #EFEFEF;font-size:12px;}
ul{	margin:0px;	padding:0px;list-style:none;}
a{color:#333333;text-decoration:none;}
a:hover{color:#999999;}
.ablum_out{width:98%px;margin-left:10px;margin-top:10px;}
.ablum_out img{margin:4px;border:#ccc 1px solid;}
.ablum_out li{float:left;width:180px;text-align:center;margin:5px;}
</style>
<div align="center">
<table border=1>
<tr bgcolor="#0066C">
<td>id</td><td>name</td><td>intro</td><td>delete</td>
</tr>
<?php 
include_once 'connect.php';
if(isset($_GET["action"])&&$_GET["action"]=="delete"){
	$sql="delete from $table_order where id='".$_GET["id"]."'";
	mysql_query($sql);
	echo "<font color=red>Delete one order</font>";
}
$sql="select * from $table_order";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result)){
	echo '<tr>
			<td>'.$row["id"].'</td><td>'.$row["list"].'</td>
			<td><a href="?action=detail&path='.$row["path"].'">'.$row["path"].'</a></td>
			<td><a href="?action=delete&id='.$row["id"].'">delete</a></td>
		</tr>';
}
?>
</table>
<hr>
<?php 
if(isset($_GET["action"])&&$_GET["action"]=="detail"){
	include $_GET["path"];
}
?>
</div>