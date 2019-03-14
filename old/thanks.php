<?php 
include 'global.php';
$head=' <table width="428" border="0" cellpadding="0" cellspacing="0">
        <tr height="31">
            <td width="85" align="center" valign="middle" background="'.$color.'/images/nav/01_stat.gif">
                <div id="menu">
                    <a href="default.php">STORE</a></div>
            </td>
            <td width="86" align="center" valign="middle" background="'.$color.'/images/nav/02_stat.gif">
                <div id="menu">
                    <a href="products.php">PRODUCTS</a></div>
            </td>
            <td width="86" align="center" valign="middle" background="'.$color.'/images/nav/02_stat.gif">
                <div id="menu">
                    <a href="search.php?ads=true">SEARCH</a></div>
            </td>
            <td width="86" align="center" valign="middle" background="'.$color.'/images/nav/02_over.gif">
                <div id="menu">
                    <a href="cart.php">MY CART </a>
                </div>
            </td>
            <td width="85" align="center" valign="middle" background="'.$color.'/images/nav/03_stat.gif">
                <div id="menu">
                    <a href="support.php">SUPPORT</a></div>
            </td>
        </tr>
        <tr height="20">
            <td colspan="5" background="'.$color.'/images/nav/menu_bg.gif">
                &nbsp;</td>
        </tr>
    </table>';
$temp='<table width="428" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td rowspan="2" width="1">
                <img src="'.$color.'/images/layout/spacer.gif" width="1" height="1" /></td>
            <td background="'.$color.'/images/layout/title_bg.gif" height="23"
                valign="middle">
                <div class="titlebox">
                    :: My Cart
                </div>
            </td>
            <td rowspan="2" width="1">
                <img src="'.$color.'/images/layout/spacer.gif" width="1" height="1" /></td>
        </tr>
        <tr>
            <td>
                <div class="boxspacer">
                    <p>
                        <strong><em><a href="default.php">Store</a> &gt; Thanks </em></strong>
                    </p>
                    <p>
                        &nbsp;</p>
                    <p align="center" class="style18">
                        <font face="Arial">Thank you for your order.</font>
                    </p>
                    <p align="center">
                        <font size="5"><a href="Products.php">
                            <img src="'.$color.'/images/layout/back.gif" border="0" /></a>
                        </font>
                    </p>
                </div>
            </td>
        </tr>
    </table>';
include 'CartMasterPage.php';
if(isset($_SESSION["loadusername"])&&isset($_SESSION["temp"])){
$nameN=$_SESSION["loadusername"].$_SESSION["rand"];
$name="orderlist/".$nameN.".txt";
file_put_contents($name, $_SESSION["temp"]);
$sql="insert into $table_order (list, path) values ('".$nameN."', '".$name."')";
mysql_query($sql);
}
?>