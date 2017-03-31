<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>无标题文档</title>
<style type="text/css">
<!--
* {margin:0;padding:0;background:#fff;font:12px Verdana;}
.input  {width:200px;height:22px;}
.button {width:50px;border:1px solid #718da6;height:22px;}
--> 
</style>
<!--[if IE]>
<style type="text/css">
.input{border:1px solid #718da6;}
</style>
<![endif]-->
</head>
<body>
<?
if($_GET["action"]=="load"){
    $uptypes = array('image/jpg','image/jpeg','image/png','image/pjpeg','image/gif','image/bmp','image/x-png');
	$url     = "http://".$_SERVER["SERVER_NAME"]. $_SERVER["PHP_SELF"];
	$url     = explode("/upload.php",$url);
	$url     = explode("/",$url[0]);
	$max_file_size = 2*(1024*1024); //上传文件大小限制, 单位BYTE

	$root    = "Api_Uppic";
	
	$folder  = date("Y-m",time());
	$authnum = rand()%100000;
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){ 
	    if (!is_uploaded_file($_FILES["file"][tmp_name])){
		    exit("<script language=javascript>alert('Please select one file to upload(请选择上传文件)!');history.go(-1);</script>");
		}
		$file = $_FILES["file"];
		if($max_file_size < $file["size"]){//检查文件大小
		    exit("<script language=javascript>alert('Max file size of $max_file_size bytes exceeded(文件大小不能超过2M)!');history.go(-1);</script>");
		}
		if(!in_array($file["type"],$uptypes)){//检查文件类型
		    exit("<script language=javascript>alert('Type of the file must be \".jpg/.jpeg/.bmp/.gif/png\"(文件后缀只能是.jpg/.jpeg/.bmp/.gif/png)!');history.go(-1);</script>");
		}
	    if(!@file_exists($root."/".$folder)) mkdir($root."/".$folder);
		
	    $filename   = $file["tmp_name"];
	    $image_size = getimagesize($filename);
	    $pinfo      = pathinfo($file["name"]);
		$ftype      = $pinfo['extension'];
		$fileinfo   = $root."/".$folder."/".time().$authnum.".".$ftype;
		
		if (file_exists($fileinfo) && $overwrite != true){ 
		    exit("<script language=javascript>alert('同名文件已经存在了!');history.go(-1);</script>");
		}
		if(!move_uploaded_file ($filename,$fileinfo)){
		   exit("<script language=javascript>alert('移动文件出错!');history.go(-1);</script>");
		}
	    $pinfo=pathinfo($fileinfo);
	    $fname=$pinfo[basename];
		
		$root = explode("../",$root);
		$urlpath = "";
		for($i=0;$i<count($url)-count($root)+1;$i++){
			$urlpath .= $url[$i]."/";
		}
		$urlpath .= $root[count($root)-1]."/";
		
		$picture  = $urlpath.$folder."/".$fname;
	    $id = trim($_POST["id"]);
		if(!$id) $id = "picture";
		
		echo "<script language='javascript'>\r\n";
	    echo "window.parent.document.getElementById('$id').value='$picture';\r\n";
	    echo "window.location.href='upload.php?id=$id';\r\n";
	    echo "</script>\r\n";
	}
	exit;
}
?>
<form action="upload.php?action=load" method="post" enctype="multipart/form-data" name="upform" onSubmit="return checkform();">
	<input name="file" id="file" type="file" class="input" />
	<input name="Submit" type="submit" class="button" value="上 传" />
	<input type="hidden" name="id" id="id" value="<?=$_GET["id"]?>">
</form>
<script language="javascript">
function checkform(){
    if(document.getElementById("file").value == ""){
	    //Please select a picture to upload!
		alert("Please select one file to upload(请选择上传文件)!");
		return false;
	}
}
</script>
</body>
</html>