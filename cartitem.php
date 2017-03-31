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
if(!isset($_SESSION["id"])){
	$_SESSION["id"]="";
}
if(isset($_GET["ItemID"])){
	$id=$_GET["ItemID"];
	$errr="";
	if(!isset($_SESSION["num"][$id])){
		$_SESSION["num"][$id]=1;       //变量$id放在后面
	}	
	if(in_array($id, $_SESSION["id"])){
		$errr="The product exists in the my cart";
		$_SESSION["num"][$id]++;
	}else{
		$_SESSION["id"][]=$_GET["ItemID"];
	}	
}
$sql="select * from $table_product where CompanyID='DINOS' and DepartmentID='DEFAULT' and ItemID='".$id."'";
$request=mysql_query($sql);
$row=mysql_fetch_array($request);
$temp=' <table width="428" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td rowspan="2" width="1">
                <img src="'.$color.'/images/layout/spacer.gif" width="1" height="1" /></td>
            <td background="'.$color.'/images/layout/title_bg.gif" height="23"
                valign="middle">
                <div class="titlebox">
                    :: Items</div>
            </td>
            <td rowspan="2" width="1">
                <img src="'.$color.'/images/layout/spacer.gif" width="1" height="1"></td>
        </tr>
        <tr>
            <td>
                <div class="boxspacer">
                    <p>
                        <strong>
                            <br />
                            <em><a href="default.php">Store</a>&gt;Items</em></strong></p>
                    <p>
                        &nbsp;</p>
                    <asp:Repeater ID="DataGrid1" runat="server">
                        <HeaderTemplate>
                        </HeaderTemplate>
                        <ItemTemplate>
                            <table border="0" rules="none" cellpadding="0" cellspacing="0" width="382" bgcolor="#ffffff">
                                <tr>
                                    <td align="center">
                                        <img src="'.$row["PictureURL"].'"
                                            Width="120" Height="80">
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <b><font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="3" color="#3B64A2">
                                            '.$row["ItemName"].'
                                        </font></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="2" color="#3B64A2">
                                            '.$row["ItemDescription"].'
                                        </font>
                                    </td>
                                </tr>   
                                <tr>
                                    <td align="center">
                                        <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                            '.$row["ItemLongDescription"].'
                                        </font>
                                    </td>
                                </tr>                              
                                <tr>
                                    <td align="center">
                                        <br />
                                        <p>
                                            <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                                <b>Price:&nbsp;
                                                    $'.$row["Price"].'
                                                </b></font>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </ItemTemplate>
                        <FooterTemplate>
                        </FooterTemplate>
                    </asp:Repeater>
                    <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="382" align="center">
                                <br />
                                <font face="Arial" size="1">
                                	<a href="cart.php"><img src="'.$color.'/images/layout/addtocart.gif" border="0"></a>
                                    <asp:ImageButton ID="btnAddToCart" runat="server" OnPreRender="GetURL" OnClick="AddToCart">
                                    </asp:ImageButton>
                                    &nbsp;&nbsp;&nbsp; <a href="default.php">
                                        <img src="'.$color.'/images/layout/back.gif" border="0"></a>
                                </font>
                            </td>
                        </tr>
                    </table>
                    <hr size="1" color="#CCCCCC" />
                    <table width="425" height="27">
                        <tr>
                            <td width="126" align="left">
                                <asp:LinkButton ID="LBPrev" runat="server" Font-Name="verdana" Font-Size="XX-Small"
                                    Font-Bold="true" Text="<< Previous"></asp:LinkButton>
                            </td>
                            <td width="146" align="center">
                                <span class="style1">
                                    <asp:Label ID="lblCurrentPage" runat="server" ForeColor="#3B64A2" Font-Name="verdana"
                                        Font-Size="XX-Small" Font-Bold="true"></asp:Label>
                                </span>
                            </td>
                            <td width="137" align="right">
                                <span class="style7">
                                    <asp:LinkButton ID="LBNext" runat="server" Text="Next >>" Font-Name="verdana" Font-Size="XX-Small"
                                        Font-Bold="true"></asp:LinkButton>
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
';
$temp.="<font color=red>".$errr."</font>";
include 'CartMasterPage.php';
?>