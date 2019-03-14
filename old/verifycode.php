<?php
/*****************************9_3.php************************************/
session_start();
//设置验证码可取的字符,去掉不易辨认的字符
$chars="23456789ABCDEFGHJKLMNPRSTWXY";
$string="";
//随机从字符串中取得字符，并组成字符串
for($i=0;$i<5;$i++){
	//设置随机时间种子
	srand((double)microtime()*1000000);
	//取得随机数
	$rand    =rand(0,strlen($chars)-1);
	//根据随机数，取得字符
	$string .= substr($chars,$rand,1);
}
//注册一个SESSION变量，用于下一页读取认证码
$_SESSION["string"]=strtolower($string);
//输出图形格式
Header("Content-type: image/png");
//设置图形宽与高
$imageWidth = 85;
$imageHeight = 22;
//使用imagecreate()函数创建图形
$im = imagecreate($imageWidth,$imageHeight);
//设置图形背景色
$backColor = ImageColorAllocate($im, rand(220,255),rand(220,255),rand(220,255)); //背景色
//填充图形颜色
imagefilledrectangle($im, 0, 0, $imageWidth, $imageHeight, $backColor);
//随机在画布上画100个颜色点
for($i=0;$i<100;$i++){ //画斑点
	$dotColor = ImageColorAllocate($im, rand(0,255),rand(0,255),rand(0,255)); //设置点的颜色
	$x = rand(0,$imageWidth); $y = rand(0,$imageHeight);
	//使用imagesetpixel()画点
	imagesetpixel($im, $x, $y, $dotColor);
}
for($i=0;$i<strlen($string);$i++){
	//设置字的颜色
	$frontColor = ImageColorAllocate($im, rand(0,120),rand(0,120),rand(0,120));
	//把字符写入图形中
	imagestring($im,10, rand(15*$i+1,15*$i+10), rand(0,5), substr($string,$i,1),$frontColor);
}
//输出PNG格式图形
imagepng($im);
//释放资料
imagedestroy($im);
exit();
?>