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
$temp='<script type="text/javascript" language="javascript">
function Print()
{
  var printButton = document.getElementById("PrintButton")
  var doneButton = document.getElementById("ctl00$ContentPlaceHolder1$DoneButton")
  printButton.style.display = \'none\';
  printButton.style.visibility = \'hidden\';
  doneButton.style.display = \'none\';
  doneButton.style.visibility = \'hidden\';
  var sOrderNo = \'<% =OrderNumber%>\';
  var PostOrder = window.open(\'PaymentReport.php?OrderNumber=\'+ sOrderNo);
  doneButton.style.display = \'inline\';
  doneButton.style.visibility = \'visible\';
  printButton.style.display = \'inline\';
  printButton.style.visibility = \'visible\';
}
    </script>

    <table width="428" border="0" cellspacing="0" cellpadding="0">
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
                        <strong><em><a href="default.php">Store</a> &gt; Purchase Order </em></strong></p>
                    <p align="right">
                    </p>';

$_SESSION["rand"]=rand(2000, 3000);
$temp.='<asp:Panel ID="HeaderPanel" runat="server">
                        <table style="margin-left: 60%; width: 150px" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                                <tr>
                                    <td style="padding-bottom: 0.4em" colspan="2" align="center">
                                        <b><font size="6">Order</font></b>
                                    </td>
                                </tr>
                                <tr style="font-weight: bold; font-size: 12; color: white; background-color: black">
                                    <td width="100">
                                        Date</td>
                                    <td width="100">
                                        Order #</td>
                                </tr>
                                <tr style="font-size: 12">
                                    <td>
                                        '.date("d")."/".date("m")."/".date("Y").'
                                    </td>
                                    <td>
                                        '.$_SESSION["rand"].'
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="margin-top: 5em" width="70%" border="0">
                            <tbody>
                                <tr>
                                    <td width="50%">
                                        <div style="font-weight: bold; font-size: 12; width: 160px">
                                            <div style="font-weight: bold; font-size: 1.2em; margin-bottom: 0.2em; color: white;
                                                background-color: black">
                                                Bill&nbsp;To
                                            </div>
                                            '.$_POST["companyname"].'
                                            <br />
                                            '.$_POST["address1"].'
                                            <br />
                                            '.$_POST["address2"].'
                                            <br />
                                            '.$_POST["address3"].'
                                            <br />
                                            '.$_POST["companyname"].' '.$_POST["city"].' '.$_POST["state"].' '.$_POST["zip"].'
                                        </div>
                                    </td>
                                    <td>
                                        <div style="font-weight: bold; font-size: 12; margin-left: 10%; width: 150px">
                                            <div style="font-weight: bold; font-size: 1.2em; margin-bottom: 0.2em; color: white;
                                                background-color: black">
                                                Ship&nbsp;To
                                            </div>
                                            '.$_POST["companynameto"].'
                                            <br />
                                            '.$_POST["address1to"].'
                                            <br />
                                            '.$_POST["address2to"].'
                                            <br />
                                            '.$_POST["address3to"].'
                                            <br />
                                            '.$_POST["companynameto"].' '.$_POST["cityto"].' '.$_POST["stateto"].' '.$_POST["zipto"].'
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="margin-top: 5em; font-weight: bold; font-size: 0.9em" border="0">
                            <tbody>
                                <tr>
                                    <td>
                                        Due Date:</td>
                                    <td>
                                        '.date("d")."/".date("m")."/".date("Y").'
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Ship Via:</td>
                                    <td>
                                        <%# field("ShipMethodDescription") %>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Ship Date:</td>
                                    <td>
                                        '.date("d")."/".date("m")."/".date("Y").'
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </asp:Panel>
                </div>
                <p>
                </p>
                <TABLE id=ctl00_ContentPlaceHolder1_Cart_CartGrid 
                  style="margin-top: 5em; font-weight: bold; font-size: 10"
                  cellSpacing=0 rules=all border=1>
                    <TBODY>
                    <TR 
                    style="FONT-WEIGHT: bold; COLOR: white; FONT-FAMILY: Tahoma,Helvetica,Arial,Verdana,sans-serif; BACKGROUND-COLOR: black" 
                    align=left>
                      <TD>Item ID</TD>
                      <TD>Item Name</TD>
                      <TD>Description</TD>
                      <TD align=right>Quantity</TD>
                      <TD align=right>Price</TD>
                      <TD align=right>Amount</TD></TR>';
foreach ($_SESSION["id"] as $k=>$v){
$sql="select * from $table_product where CompanyID='DINOS' and DepartmentID='DEFAULT' and ItemID='".$v."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$temp.='<TR>
                      <TD>'.$row["ItemID"].'</TD>
                      <TD>'.$row["ItemName"].'</TD>
                      <TD>'.$row["ItemDescription"].'</TD>
                      <TD style="WIDTH: 40px" align=right>'.$_SESSION["num"][$v].'</TD>
                      <TD style="WIDTH: 60px" align=right>'.$row["Price"].'</TD>
                      <TD style="WIDTH: 60px" align=right>'.$_SESSION["num"][$v]*$row["Price"].' </TD>
                      </TR>';
}                
$temp.='</TBODY></TABLE>
               <div align="right">
                    <asp:Panel ID="SummaryPanel" runat="server" align="right">
                        <div align="right">
                            <table style="font-weight: bold; font-size: 0.9em" border="0">
                                <tbody>
                                    <tr>
                                        <td align="right">
                                            Subtotal :</td>
                                        <td>
                                            <strong>
                                                $ '.$_SESSION["totalprice"].'
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            Shipping:</td>
                                        <td>
                                            <strong>
                                                $ 0.00
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            Tax:</td>
                                        <td>
                                            <strong>
                                                $ 0.00
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            Total:</td>
                                        <td>
                                            <strong>
                                               $ '.$_SESSION["totalprice"].'
                                            </strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </asp:Panel>
                </div>
            </td>
        </tr>
    </table>
    <p>
        <input name="button" type="button" id="PrintButton" style="width: 100px" onclick="Print()"
            value="Print" />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="button" value="Done" style="width: 100px" onclick="thanks()">
        <script>
        function thanks(){
        	window.location.href="thanks.php";
        }
        </script>
        <asp:Button ID="DoneButton" OnClick="DoneButton_Click" runat="server" Width="100"
            Text="Done"></asp:Button>
    </p>
    <table width="428" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td>
                <p>
                </p>
                <p>
                </p>
                <p>
                </p>
                <p>
                </p>
                <p>
                </p>
                <p>
                    &nbsp;
                </p>
                <div class="boxspacer">
                    <p>
                    </p>
                    <p>
                    </p>
                    <p>
                        <br />
                    </p>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td align="right">
                                <div class="boxspacer">
                                    &nbsp;&nbsp;&nbsp;</div>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>';
$_SESSION["temp"]=$temp;
include 'CartMasterPage.php';
if(isset($_POST["order"])){
	$sql="select OrderNumber from $table_orderheader order by OrderNumber desc";
	$result=mysql_query($sql);
	while($row=mysql_fetch_array($result)){
		if($row["OrderNumber"]!="DEFAULT"){
			$_SESSION["OrderNumber"]=$row["OrderNumber"];
			break;
		}
	}
	$_SESSION["OrderNumber"]++;
	$sql="INSERT INTO `orderheader` VALUES ('DINOS', 'DEFAULT', 'DEFAULT', '".$_SESSION["OrderNumber"]."',
	 'Order', 'Order', '".date("Y")."-".date("m")."-".date("d")." ".date("H:i:s")."', '".date("Y")."-".date("m")."-".date("d")." ".date("H:i:s")."', '".date("Y")."-".date("m")."-".date("d")." ".date("H:i:s")."', 
	 '2025-12-31 00:00:00', '".date("Y")."-".date("m")."-".date("d")." ".date("H:i:s")."', '0', 'None', 'None', '', '".$_POST["login"]."', 'Net Due', 'USD', '1', 
	 '".$_SESSION["totalprice"]."', '0', '0.0000', '0', '0.0000', '".$_SESSION["totalprice"]."', '0.0000', '0', '0.0000', '0.0000', '".$_SESSION["totalprice"]."', 
	 'Demo', '0.0000', '0.0000', '0.0000', '0', '".$_POST["ShipMethodID"]."', 'DEFAULT', 'SAME', 'SAME', '', '', '', '', '', '', 
	 '', '', null, null, null, null, null, '410000', 'cash', '0.0000', '".$_SESSION["totalprice"]."', null, null, null, null, null, null, 
	 null, null, null, null, null, '1', '0', '1900-01-01 00:00:00', '0', '1900-01-01 00:00:00', '0', '1900-01-01 00:00:00', 
	 null, '0', '1900-01-01 00:00:00', '0', null, '1900-01-01 00:00:00', '1', '".date("H:i:s")."', '".date("Y")."-".date("m")."-".date("d")." ".date("H:i:s")."', '0', null, null, null, 
	 null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, 
	 null, null, null);";
	mysql_query($sql);
	foreach ($_SESSION["id"] as $k=>$v){
		$sql="select * from $table_product where CompanyID='DINOS' and DepartmentID='DEFAULT' and ItemID='".$v."'";
		$result=mysql_query($sql);
		$row=mysql_fetch_array($result);
		$subtotal=$row["price"]*$_SESSION["num"][$v];
		$sql="INSERT INTO `orderdetail` VALUES ('DINOS', 'DEFAULT', 'DEFAULT', 
		'".$_SESSION["OrderNumber"]."', null, '".$row["ItemID"]."', null, 'DEFAULT', 'DEFAULT', null, 
		'".$row["ItemDescription"]."', '".$_SESSION["num"][$v]."', '0', '0', 'Each', '0', '0', '1', null, 
		null, '0.0000', '".$row["Price"]."', 'DEFAULT', '0.0000', '0', '".$subtotal."', '".$subtotal."', 
		'0', '410000', 'DEFAULT', null, null, null, null, null, null, null, null, null, null, 
		null, null, null, null, null, null, null, null, null);";
		mysql_query($sql);
	}
}
print_r($_POST);
?>