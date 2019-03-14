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
$temp=' <table width="428" border="0" cellspacing="0" cellpadding="0">
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
                        <strong><em><a href="default.php">Store</a> &gt; My Cart </em></strong>
                    </p>';
if(!isset($_SESSION["loadusername"])){
	$temp.="<font color=red>You should login to check out the cart</font>";
}
$temp.='<p align="center">
                        <asp:Label ID="lblMsg" runat="server" Font-Name="verdana" Font-Size="XX-Small" ForeColor="#FF0000"></asp:Label></p>
                    <p>
                    </p>
                    <asp:Repeater ID="DataGrid1" runat="server" OnItemCommand="HandleItemCommand">
                        <HeaderTemplate>
                            <table border="0" rules="none" cellpadding="0" cellspacing="0" width="99%" bgcolor="#3B64A2"
                                forecolor="#ffffff">
                                <tr>
                                    <td width="15%" align="left">
                                        <b><font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#ffffff">
                                            &nbsp;&nbsp;Item</font></b></td>
                                    <td width="19%" align="right">
                                        <b><font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#ffffff">
                                            ItemID</font></b></td>
                                    <td width="38%" align="right">
                                        <b><font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#ffffff">
                                            Quantity</font> </b>
                                    </td>
                                    <td width="24%" align="right">
                                        <b><font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#ffffff">
                                            Price</font></b>
                                    </td>
                                    <td width="4%" align="center">
                                        <b><font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#ffffff">
                                        </font></b>
                                    </td>
                                </tr>
                            </table>
                        </HeaderTemplate>
                        <ItemTemplate>
                            <table border="0" rules="none" cellpadding="0" cellspacing="0" width="99%" bgcolor="#ffffff">
                                ';
$price="0";
$total="0";
$totalitem="0";
if(isset($_GET["quantity"])){
	if($_GET["quantity"]=="plus"){
		$_SESSION["num"][$_GET["id"]]++;
	}
	if($_GET["quantity"]=="minus"){
		$_SESSION["num"][$_GET["id"]]--;		
	}
	if($_SESSION["num"][$_GET["id"]]<1){
		$_SESSION["num"][$_GET["id"]]=1;
		unset($_SESSION["id"][$_GET["key"]]);
	}
}
foreach ($_SESSION["id"] as $k=>$v){
$sql="select * from $table_product where CompanyID='DINOS' and DepartmentID='DEFAULT' and ItemID='".$v."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$total+=$row["Price"]*$_SESSION["num"][$v];
$totalitem+=$_SESSION["num"][$v];
$temp.='<tr>
                                    <td width="8%" align="left">
                                        <b><font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                            <img src='.$row["PictureURL"].'
                                                Width="80" Height="50">
                                        </font></b>
                                    </td>
                                    <td width="10%" align="left">
                                        <b><font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                        </font></b>
                                    </td>
                                    <td width="25%" align="left">
                                        <b><font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                            <p align="center">'.$row["ItemID"].'</p>
                                        </font></b>
                                    </td>
                                    <td width="26%" align="right">
                                        <b><font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                            <input type="text" size=2 name="quantity[]" value="'.$_SESSION["num"][$v].'" readonly="readonly"></font>
                                            <a href="?quantity=plus&id='.$v.'"><img src="plus.jpg" border=0></a>
                                            <a href="?quantity=minus&id='.$v.'&key='.$k.'"><img src="minus.jpg" border=0></a>
                                            
                                        </b>
                                    </td>
                                    <td width="25%" align="right">
                                        <b><font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                            '.$row["Price"].'
                                        </font></b>
                                    </td>
                                    <strong></strong>
                                    <td width="6%" align="center">
                                        <asp:ImageButton ID="ImageButton3" CommandName="remove" runat="server" ImageUrl="./images/remove.jpg"
                                            Width="9" Height="9" Visible="false"></asp:ImageButton>
                                    </td></tr>';
}
$_SESSION["totalitem"]=$totalitem;
$_SESSION["totalprice"]=$total;
$temp.='
       </table>
                        </ItemTemplate><AlternatingItemTemplate>
                            <table border="0" rules="none" cellpadding="0" cellspacing="0" width="99%" bgcolor="#f4f4f4">
                                <tr>
                                    <td width="8%" align="left">
                                        <b><font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                            <asp:Image ID="Image2" runat="server" ImageUrl=\'<%# Common.GetPictureUrl(Container.DataItem, "PictureURL") %>\'
                                                Width="80" Height="50"></asp:Image>
                                        </font></b>
                                    </td>
                                    <td width="10%" align="left">
                                        <b><font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                        </font></b>
                                    </td>
                                    <td width="25%" align="left">
                                        <b><font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                            <%# DataBinder.Eval(Container.DataItem, "ItemID") %>
                                        </font></b>
                                    </td>
                                    <td width="26%" align="right">
                                        <b><font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                            <asp:TextBox runat="server" ID="TBQty" Text=\'<%# DataBinder.Eval(Container.DataItem, "Quantity") %>\'
                                                Width="20" Enabled="false"></asp:TextBox></font>
                                            <asp:ImageButton ID="ImageButton4" CommandName="plus" runat="server" ImageUrl="images/plus.jpg"
                                                Width="11" Height="11"></asp:ImageButton>
                                            <asp:ImageButton ID="ImageButton5" CommandName="minus" runat="server" ImageUrl="images/minus.jpg"
                                                Width="11" Height="11"></asp:ImageButton>
                                            <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                            </font></b>
                                    </td>
                                    <td width="25%" align="right">
                                        <b><font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                            <b>
                                                <% =Session("CartCurrencySymbol") & " " %>
                                                <%# FormatNumber(Cdbl(Session("CartCurrencyXRate")) * CDbl(DataBinder.Eval(Container.DataItem, "Price")) * CDbl(DataBinder.Eval(Container.DataItem, "Quantity")))%>
                                            </b></font></b>
                                    </td>
                                    <td width="6%" align="center">
                                        <asp:ImageButton ID="ImageButton6" CommandName="remove" runat="server" ImageUrl="./images/remove.jpg"
                                            Width="9" Height="9" Visible="false"></asp:ImageButton>
                                    </td>
                                </tr>
                            </table>
                        </AlternatingItemTemplate>
                        <FooterTemplate>
                            <table border="0" rules="none" cellpadding="0" cellspacing="0" width="99%" bgcolor="#F4F4F4"
                                forecolor="#000000">
                                <tr>
                                    <td width="15%" align="left">
                                        <b><font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                        </font></b>
                                    </td>
                                    <td width="15%" align="left">
                                        <b><font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                        </font></b>
                                    </td>
                                    <td width="15%" align="left">
                                        <b><font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                        </font></b>
                                    </td>
                                    <td width="13%" align="right">
                                        <b><font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                        </font></b>
                                    </td>
                                    <td width="10%" align="right">
                                        <b><font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                        </font></b>
                                    </td>
                                    <td width="29%" align="right">
                                        <b><font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                            Total: '.$total.'                                            
                                        </font></b>
                                    </td>
                                    <td width="3%" align="center">
                                        <b><font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                        </font></b>
                                    </td>
                                </tr>
                            </table>
                            <table border="0" cellpadding="0" cellspacing="0" align="right">
                                <tr>
                                    <td height="73">
                                        <p>
                                            <br />
                                        </p>
                                        <a href="products.php">
                                            <img src="'.$color.'/images/layout/continue.gif" border="0"></a>
                                        <a href="checkout.php">
                                            <img src="'.$color.'/images/layout/checkout.gif" border="0"></a>
                                         <a href="default.php?action=remove">
                                            <img src="'.$color.'/images/layout/remove.gif" border="0"></a>
                                        <asp:ImageButton ID="btnDelete" runat="server" OnPreRender="GetURL" OnClick="btnDelete_Click">
                                        </asp:ImageButton>
                                    </td>
                                </tr>
                            </table>
                        </FooterTemplate>
                    </asp:Repeater>
                </div>
            </td>
        </tr>
    </table>';
include 'CartMasterPage.php';
?>