<?php 
include 'global.php';
$head=' <table width="428" border="0" cellpadding="0" cellspacing="0">
        <tr height="31">
            <td width="85" align="center" valign="middle" background="'.$color.'/images/nav/01_stat.gif">
                <div id="menu">
                    <a href="default.php">STORE</a></div>
            </td>
            <td width="86" align="center" valign="middle" background="'.$color.'/images/nav/02_over.gif">
                <div id="menu">
                    <a href="products.php">PRODUCTS</a></div>
            </td>
            <td width="86" align="center" valign="middle" background="'.$color.'/images/nav/02_stat.gif">
                <div id="menu">
                    <a href="search.php?ads=true">SEARCH</a></div>
            </td>
            <td width="86" align="center" valign="middle" background="'.$color.'/images/nav/02_stat.gif">
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
$temp='<form method="post">
<table width="428" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td rowspan="2" width="1">
                <img src="'.$color.'/images/layout/spacer.gif" width="1" height="1" /></td>
            <td background="'.$color.'/images/layout/title_bg.gif" height="23"
                valign="middle">
                <div class="titlebox">
                    :: Products</div>
            </td>
            <td rowspan="2" width="1">
                <img src="'.$color.'/images/layout/spacer.gif" width="1" height="1" /></td>
        </tr>
        <tr>
            <td>
                <div class="boxspacer">
                    <p>
                        <strong>
                            <br />
                            <em><a href="default.php">Store</a> &gt;<a href="products.php">Product Category</a></em>
                       		 &gt;Product List</em>
                         </strong></p>';
if(!isset($_SESSION["az"])){
	$_SESSION["az"]="A-Z Name";
	$_SESSION["perpage"]=3; 
}                 
if(isset($_POST["go"])){
	$_SESSION["az"]=$_POST["az"];
	$_SESSION["perpage"]=$_POST["perpage"];
}
$temp.=' <p align="right">
                        &nbsp;<font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2"><b>::</b></font>&nbsp;<font
                            face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2"><b>Sort
                                by</b></font>
						<select name="az">
                            <option  Value="A-Z Name" Selected="true">A-Z Name</option>
                            <option  Value="Z-A Name">Z-A Name</option>
                        </select>
                        <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                            <b>:: Show</b></font>
                        <select name="perpage" value="5">
                            <option Value="3" Selected="true">3</option >
                            <option Value="5">5</option >
                            <option Value="10">10</option >
                            <option Value="20">20</option >
                            <option Value="50">50</option >
                        </select>
                        <script>
						  	document.all.az.value="'.$_SESSION["az"].'";
						  	document.all.perpage.value="'.$_SESSION["perpage"].'";
						 </script>
                        <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                            <b>per page</b></font>
                        <input type="hidden" name="go">
                        <input type="submit" value="go">
                    </p>';
if(!isset($_SESSION["page"])){
	$_SESSION["page"]=1;
}
if(isset($_GET['page'])&&$_GET["page"]=="minus"){
	$_SESSION["page"]--;
}
if(isset($_GET['page'])&&$_GET["page"]=="add"){
	$_SESSION["page"]++;
}
if(isset($_POST["go"])){
	$_SESSION["page"]=1;
}
if(isset($_GET["CategoryID"])){
	$_SESSION["CategoryID"]=$_GET["CategoryID"];
}
$CategoryID=$_SESSION["CategoryID"];
$sql="select * from $table_product where CompanyID='DINOS' and DepartmentID='DEFAULT' and ItemCategoryID='".$CategoryID."'";
$result=mysql_query($sql);
$pageAll=ceil(mysql_num_rows($result)/$_SESSION["perpage"]);
if($_SESSION["page"]<1||$_SESSION["page"]>$pageAll){
	$_SESSION["page"]=1;
}
if($_SESSION["az"]=="Z-A Name"){
	$sql="select * from $table_product where CompanyID='DINOS' and DepartmentID='DEFAULT' and ItemCategoryID='".$CategoryID."' order by ItemName desc";                        
}else{
	$sql="select * from $table_product where CompanyID='DINOS' and DepartmentID='DEFAULT' and ItemCategoryID='".$CategoryID."' order by ItemName";       
} 
$startpage=($_SESSION["page"]-1)*$_SESSION["perpage"];
$sql.=" limit $startpage, $_SESSION[perpage]  ";                                                              
$result=mysql_query($sql);
while($row=mysql_fetch_array($result)){	                                               
$temp.=' <HeaderTemplate>
                        </HeaderTemplate>
                        <ItemTemplate>
                            <table border="0" width="100%" bgcolor="#ffffff" cellpadding="3" cellspacing="3">
                                <tr>
                                    <td width="10%" rowspan="4" align="left" valign="bottom">
                                        <a href="cartitem.php?ItemID='.$row["ItemID"].'"><img src="'.$row["PictureURL"].'" width=120 height=80 border=0></a>
                                    </td>
                                    <td width="90%" height="50%" valign="bottom">
                                        <p>
                                            <b><font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="4" color="#3B64A2">
                                                '.$row["ItemName"].'
                                            </font></b>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="90%" height="25%" valign="bottom">
                                        <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                            '.$row["ItemDescription"].'
                                        </font>
                                    </td>
                                </tr>  
                                 <tr>
                                    <td width="90%" height="25%" valign="bottom">
                                        <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                            '.$row["ItemLongDescription"].'
                                        </font>
                                    </td>
                                </tr> 
                                <tr>
                                    <td width="90%" height="25%" valign="bottom">
                                        <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="2" color="#3B64A2">
                                            <p align="right">Price: $'.$row["Price"].'&nbsp</p> 
                                        </font>
                                    </td>
                                </tr>                        
                            </table>
                            <hr size="1" color="#CCCCCC"></hr>
                            <br />
                        </ItemTemplate>';
}
                    
$temp.=' <table width="100%" height="27">
                        <tr>
                            <td width="126" align="left">
                                <span class="style7">';
if($_SESSION["page"]==1){
	$temp.='<font color="gray"><< Previous</font>';
}else{
	$temp.='<a href="?page=minus"><< Previous</a>';
}
$temp.='</span>
                            </td>
                            <td width="146" align="center">
                                <span class="style7">
                                    Page: '.$_SESSION["page"].' of '.$pageAll.'
                                </span>
                            </td>
                            <td width="137" align="right">
                                <span class="style7">';
if($_SESSION["page"]==$pageAll||$pageAll==0){
	$temp.='<font color="gray">Next >></font>';
}else{
	$temp.='<a href="?page=add">Next >></a>';
}                                   
$temp.='     </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
</form>';

include 'CartMasterPage.php';
?>