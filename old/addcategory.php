<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title></title>
<style>
body{margin:0px;padding:0px;background-color: #EFEFEF;font-size:12px;}
ul{	margin:0px;	padding:0px;list-style:none;}
a{color:#333333;text-decoration:none;}
a:hover{color:#999999;}
.ablum_out{width:98%px;margin-left:10px;margin-top:10px;}
.ablum_out img{margin:4px;border:#ccc 1px solid;}
.ablum_out li{float:left;width:180px;text-align:center;margin:5px;}
</style>
</head>

<body>
<div align="center">
<div class="ablum_out">
			<ul>
<?php
include_once 'connect.php';
$album = "itemimages";
if(is_dir($album)!==true){
	mkdir($album);
}
if(isset($_POST["action"]) and $_POST["action"]=="upload"){
	if(isset($_FILES["file"]["tmp_name"])){
		$filename = time().$_FILES["file"]["name"];
		$sql="select id from $table_category where category='".$_POST["category"]."'";
		$result=mysql_query($sql);
		$error="";
		if(mysql_num_rows($result)>0){
			$error.="The category name exists<br>";
		}
		if($_POST["category"]==""){
			$error.="The category name can't be empty<br>";	
		}
		if($error==""){
			move_uploaded_file($_FILES["file"]["tmp_name"], $album."/".$filename);
			$sql="insert into $table_category (category, intro, image) values ('".$_POST["category"]."', '".$_POST["intro"]."', '".$album."/".$filename."')";
			mysql_query($sql);
			echo "<font color=red>Complete</font>";
		}else{
			echo "<font color=red>".$error."</font>";
		}
	}
}
?>
			</ul>
	</div>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <label>
  <?php echo '<img src="'.$album."/".$filename.'" width="120" height="80" border="0" />';?><br />
  <input type="file" name="file"/>
  </label><br />
  <label>
  <label>Category Name:<br><input type="text" name="category"></label><br>
  <label>Introduction:<br /><textarea name="intro"  cols="30" rows="10"></textarea></label><br />
  <input type="submit" name="Submit" value="Add"/>
  <input type="hidden" name="action" value="upload"/>
  </label>
</form>
<hr size="1" />	
<table border=1>
<tr bgcolor="#0066C">
<td>id</td><td>category</td><td>intro</td><td>delete</td>
</tr>
<?php 
if(isset($_GET["action"])&&$_GET["action"]=="delete"){
	$sql="delete from $table_category where id='".$_GET["id"]."'";
	mysql_query($sql);
	$sql="delete from $table_product where category='".$_GET["category"]."'";
	mysql_query($sql);
	echo "<font color=red>Delete one category</font>";
}
$sql="select * from $table_category";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result)){
	echo '<tr>
			<td>'.$row["id"].'</td><td>'.$row["category"].'</td><td>'.$row["intro"].'</td><td><a href="?action=delete&id='.$row["id"].'&category='.$row["category"].'">delete</a></td>
		</tr>';
}
?>
</table>
</div>	
</body>
</html>

