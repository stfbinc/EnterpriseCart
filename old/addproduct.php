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
		$sql="select id from $table_product where product='".$_POST["product"]."'";
		$result=mysql_query($sql);
		$error="";
		if(mysql_num_rows($result)>0){
			$error.="The product name exists<br>";
		}
		if($_POST["product"]==""){
			$error.="The product name can't be empty<br>";	
		}
		if($error==""){
			move_uploaded_file($_FILES["file"]["tmp_name"], $album."/".$filename);
			$sql="insert into $table_product (product, category, intro, price, image) values ('".$_POST["product"]."', '".$_POST["category"]."', '".$_POST["intro"]."', '".$_POST["price"]."', '".$album."/".$filename."')";
			mysql_query($sql);
			echo "Complete";
		}else{
			echo $error;
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
  <label>Product Name:<br><input type="text" name="product"></label><br>
  <label>category:<br>
  <select name="category">
  	<?php 
  	$sql="select category from $table_category";
  	$result=mysql_query($sql);
  	$option="";
  	while($row=mysql_fetch_array($result)){
  		$option.="<option value=$row[0]>$row[0]</option>";
  	}
  	echo $option;
  	?>
  </select></label><br>
  <label>Introduction:<br /><textarea name="intro"  cols="30" rows="10"></textarea></label><br />
  <label>Price:<br>$<input type="text" name="price"></label><br>
  <input type="submit" name="Submit" value="Add"/>
  <input type="hidden" name="action" value="upload"/>
  </label>
</form>
<hr size="1" />	
<table border=1>
<tr bgcolor="#0066C">
<td>id</td><td>product</td><td>category</td><td>intro</td><td>delete</td>
</tr>
<?php 
if(isset($_GET["action"])&&$_GET["action"]=="delete"){
	$sql="delete from $table_product where id='".$_GET["id"]."'";
	mysql_query($sql);
	echo "<font color=red>Delete one product</font>";
}
$sql="select * from $table_product";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result)){
	echo '<tr>
			<td>'.$row["id"].'</td><td>'.$row["product"].'</td>
			<td>'.$row["category"].'</td><td>'.$row["intro"].'</td>
			<td><a href="?action=delete&id='.$row["id"].'">delete</a></td>
		</tr>';
}
?>
</table>
</div>	
</body>
</html>

