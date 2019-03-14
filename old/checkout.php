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
$sql="select * from $table_user where CompanyID='DINOS' and DepartmentID='DEFAULT' and CustomerLogin='".$_SESSION["loadusername"]."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$temp='<form action="payment_porder.php" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td rowspan="5" width="1">
                <img src="'.$color.'/images/layout/spacer.gif" width="1" height="1"></td>
            <td width="385" height="23" valign="middle" background="'.$color.'/images/layout/title_bg.gif">
                <div class="titlebox">
                    :: My Cart
                </div>
            </td>
            <td rowspan="5" width="1">
                <img src="'.$color.'/images/layout/spacer.gif" width="1" height="1"></td>
        </tr>
        <tr>
            <td class="boxspacer">
                <strong><em><a href="default.php">Store</a> &gt; My Cart </em></strong>
                <p>
                </p>
                <asp:Panel ID="BillShipInfo" runat="server" Width="100%">
                    <table cellpadding="0" width="100%" border="0">
                        <tr>
                            <td>
                                <strong>Bill To:</strong></td>
                            <td>
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                </font>
                            </td width="58">
                            <td>
                                <strong>Ship To:</strong></td>
                        </tr>
                        <tr>
                            <td>
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                    Login:</font></td>
                            <td>
                            	<input type="text" name="login" value="'.$row["CustomerLogin"].'" size="12" readonly="readonly">
                                <asp:TextBox ForeColor="#3B64A2" ID="TBLogin" runat="server" Width="120px" Font-Size="8pt"
                                    Text="<%# CustomerID %>" ReadOnly="True"></asp:TextBox>
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                </font>
                            </td>
                            <td>
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                    <asp:Label ID="LLocation" runat="server"></asp:Label>
                                </font>
                            </td>
                            <td width="140">
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                    <asp:DropDownList ID="CBLocation" runat="server" Width="120px" Font-Size="XX-Small"
                                        ForeColor="#3B64A2" OnSelectedIndexChanged="CBLocation_SelectedIndexChanged"
                                        AutoPostBack="True">
                                    </asp:DropDownList>
                                </font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                    Company Name:</font></td>
                            <td>
                            	<input type="text" name="companyname" value="'.$row["CustomerName"].'" size="12">
                                <asp:TextBox ForeColor="#3B64A2" ID="TBBillToName" runat="server" Width="120px" Font-Size="8pt"
                                    Text="<%# Order.BillToName %>"></asp:TextBox>
                                <font color="red" size="1"><b>*</b></font>
                                <asp:RequiredFieldValidator ID="RequiredFieldValidator1" Style="font-size: 0.7em;
                                    font-family: Tahoma, Helvetica, Arial, Verdana, sans-serif" runat="server" ErrorMessage="<p>Company name is required field</p>"
                                    Display="Dynamic" ControlToValidate="TBBillToName"></asp:RequiredFieldValidator>
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                </font>
                            </td>
                            <td>
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                    Company Name:</font></td>
                            <td>
                                <input type="text" name="companynameto" value="'.$row["CustomerName"].'" size="12">
                                <font color="red" size="1"><b>*</b></font>
                                <asp:RequiredFieldValidator ID="RequiredFieldValidator5" Style="font-size: 0.7em;
                                    font-family: Tahoma, Helvetica, Arial, Verdana, sans-serif" runat="server" ErrorMessage="<br>Company name is required field"
                                    Display="Dynamic" ControlToValidate="TBShippingName"></asp:RequiredFieldValidator>
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                </font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                    Address1:</font></td>
                            <td>
                                <input type="text" name="address1" value="'.$row["CustomerAddress1"].'" size="12">
                                <font color="red" size="1"><b>*</b></font>
                                <asp:RequiredFieldValidator ID="RequiredFieldValidator2" Style="font-size: 0.7em;
                                    font-family: Tahoma, Helvetica, Arial, Verdana, sans-serif" runat="server" ErrorMessage="<br>Address1 is required field"
                                    Display="Dynamic" ControlToValidate="TBBillToAddress1"></asp:RequiredFieldValidator>
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                </font>
                            </td>
                            <td>
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                    Address1</font></td>
                            <td>
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                    <input type="text" name="address1to" value="'.$row["CustomerAddress1"].'" size="12">
                                    <font size="3"><font color="red" size="1"><b>*</b></font>
                                        <asp:RequiredFieldValidator ID="RequiredFieldValidator6" Style="font-size: 0.7em;
                                            font-family: Tahoma, Helvetica, Arial, Verdana, sans-serif" runat="server" ErrorMessage="<br>Address1 is required field"
                                            Display="Dynamic" ControlToValidate="TBShippingAddress1"></asp:RequiredFieldValidator>
                                    </font></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                    Address2:</font></td>
                            <td>
                                <input type="text" name="address2" value="'.$row["CustomerAddress2"].'" size="12">
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                </font>
                            </td>
                            <td>
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                    Address2:</font></td>
                            <td>
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                    <input type="text" name="address2to" value="'.$row["CustomerAddress2"].'" size="12">
                                </font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                    Address3:</font></td>
                            <td>
                                <input type="text" name="address3" value="'.$row["CustomerAddress3"].'" size="12">
                            </td>
                            <td>
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                    Address3:</font></td>
                            <td>
                                <input type="text" name="address3to" value="'.$row["CustomerAddress3"].'" size="12">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                    City:</font></td>
                            <td>
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                    <input type="text" name="city" value="'.$row["CustomerCity"].'" size="12">
                                    <font size="3"><font color="red" size="1"><b>*</b></font>
                                        <asp:RequiredFieldValidator ID="RequiredFieldValidator3" Style="font-size: 0.7em;
                                            font-family: Tahoma, Helvetica, Arial, Verdana, sans-serif" runat="server" ErrorMessage="<br>City is required field"
                                            Display="Dynamic" ControlToValidate="TBBillToCity"></asp:RequiredFieldValidator>
                                    </font></font>
                            </td>
                            <td>
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                    City:</font></td>
                            <td>
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                    <input type="text" name="cityto" value="'.$row["CustomerCity"].'" size="12">
                                    <font size="3"><font color="red" size="1"><b>*</b></font>
                                        <asp:RequiredFieldValidator ID="RequiredFieldValidator7" Style="font-size: 0.7em;
                                            font-family: Tahoma, Helvetica, Arial, Verdana, sans-serif" runat="server" ErrorMessage="<br><br>City is required field"
                                            Display="Dynamic" ControlToValidate="TBShippingCity"></asp:RequiredFieldValidator>
                                    </font></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                    State:</font></td>
                            <td>
                                <input type="text" name="state" value="'.$row["CustomerState"].'" size="12">
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                </font>
                            </td>
                            <td>
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                    State:</font></td>
                            <td>
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                   <input type="text" name="stateto" value="'.$row["CustomerState"].'" size="12">
                                </font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                    Zip:</font></td>
                            <td>
                                <input type="text" name="zip" value="'.$row["CustomerZip"].'" size="12">
                                <font color="red" size="1"><b>*</b></font>
                                <asp:RequiredFieldValidator ID="RequiredFieldValidator4" Style="font-size: 0.7em;
                                    font-family: Tahoma, Helvetica, Arial, Verdana, sans-serif" runat="server" ErrorMessage="<br>Zip is required field"
                                    Display="Dynamic" ControlToValidate="TBBillToZip"></asp:RequiredFieldValidator>
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                </font>
                            </td>
                            <td>
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                    Zip:</font></td>
                            <td>
                                <input type="text" name="zipto" value="'.$row["CustomerZip"].'" size="12">
                                <font color="red" size="1"><b>*</b></font>
                                <asp:RequiredFieldValidator ID="RequiredFieldValidator8" Style="font-size: 0.7em;
                                    font-family: Tahoma, Helvetica, Arial, Verdana, sans-serif" runat="server" ErrorMessage="<br>Zip is required field"
                                    Display="Dynamic" ControlToValidate="TBShippingZip"></asp:RequiredFieldValidator>
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                </font>
                            </td>
                        </tr>
                       
                        <tr style="padding-top: 1em">
                            <td style="vertical-align: top" colspan="2">
                                &nbsp;
                                <input type="button" value="Use As \'Ship To\'" onclick="shipto()">
                                <script>
                                function shipto(){
                                	
                                }
                                </script>
                            </td>
                            <td>
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                    Payment method:</font></td>
                            <td>
                                <SELECT id=ctl00_ContentPlaceHolder1_CBPaymentMethod 
                        style="FONT-SIZE: 8pt; WIDTH: 150px; COLOR: #3b64a2"                         
                        name=ctl00$ContentPlaceHolder1$CBPaymentMethod> 
                           <OPTION 
                          value=ccfax>Credit card by Fax (Fax: 
                          954-986-1399)</OPTION> <OPTION value=bcheck>Business 
                          Check (See About Us for Instructions)</OPTION> <OPTION 
                          value=morder selected>Money Order (See About Us for 
                          Instructions)</OPTION> <OPTION value=ccheck>Certified 
                          Check (See About Us for Instructions)</OPTION> <OPTION 
                          value=wire>Wire Transfer (See About Us for 
                          Instructions)</OPTION> <OPTION value=quote>Quote 
                          (Valid until 01/05/2004) (Print for your 
                          records)</OPTION> <OPTION value=inter>International 
                          Orders (See About Us for Instructions)</OPTION> 
                          <OPTION value=porder>Purchase Order (Goverment 
                          Only)</OPTION></SELECT>
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                </font>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                &nbsp;
                            </td>
                            <td>
                                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                                    Ship via:</font></td>
                            <td>
                                <SELECT id=ctl00_ContentPlaceHolder1_CBShipMethodID 
                        style="FONT-SIZE: 8pt; WIDTH: 150px; COLOR: #3b64a2"                         
                        name=ShipMethodID> <OPTION 
                          value=DEFAULT></OPTION> <OPTION value="FedEx Ground" 
                          selected>FedEx Ground</OPTION> <OPTION 
                          value="FedEx Inter E">FedEx International 
                          Economy</OPTION> <OPTION value="FedEx Inter P">FedEx 
                          International Priority</OPTION> <OPTION 
                          value="FedEx Priority">FedEx Priority 
                          Overnight</OPTION> <OPTION value="FedEx Saver">FedEx 
                          Express Saver</OPTION> <OPTION 
                          value="FedEx Second">FedEx Second Day Air</OPTION> 
                          <OPTION value="FedEx Standard">FedEx Standard 
                          Overnight</OPTION></SELECT>
                            </td>
                        </tr>
                    </table>
                </asp:Panel>
            </td>
        </tr>
        <tr>
            <td class="boxspacer">
                <TABLE id=ctl00_ContentPlaceHolder1_Cart_CartGrid 
                  style="FONT-SIZE: 8pt; WIDTH: 100%; COLOR: #3b64a2; BORDER-COLLAPSE: collapse" 
                  cellSpacing=0 rules=all border=1>
                    <TBODY>
                    <TR 
                    style="FONT-WEIGHT: bold; COLOR: white; FONT-FAMILY: Tahoma,Helvetica,Arial,Verdana,sans-serif; BACKGROUND-COLOR: #3b64a2" 
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
                    <DIV id=ctl00_ContentPlaceHolder1_Cart_ShipInfo 
                  style="TEXT-ALIGN: right">
                  <TABLE 
                  style="FONT-WEIGHT: bold; FONT-SIZE: smaller; COLOR: #3b64a2; FONT-FAMILY: Tahoma, Helvetica, Arial, Verdana, sans-serif" 
                  border=0>
                    <TBODY>
                    <TR>
                      <TD align=right width=150>Subtotal: </TD>
                      <TD>$ '.$_SESSION["totalprice"].'</TD></TR>
                    <TR>
                      <TD align=right width=150></TD>
                      <TD></TD></TR>
                    <TR>
                      <TD align=right>Total tax: </TD>
                      <TD>$ 0.00 </TD></TR>
                    <TR>
                      <TD align=right>Grand Total: </TD>
                      <TD>$ '.$_SESSION["totalprice"].'</TD></TR></TBODY></TABLE></DIV>
            </td>
        </tr>
        <tr>
            <td>
                <font face="Tahoma, Helvetica, Arial, Verdana, sans-serif" size="1" color="#3B64A2">
                    Fields marked with an <font color="red" size="1"><b>*</b></font> are required</font>
            </td>
        </tr>
        <tr>
            <td color="#3B64A2">
                <p>
                </p>
                <stfb:cartlist ID="Cart" runat="server"></stfb:cartlist>
                <br />
                <p>
                    <font size="1" face="Tahoma, Helvetica, Arial, Verdana, sans-serif,Helvetica"><strong>
                        Acknowledgment</strong> The STFB Inc Developer License is available for your review
                        at <a href="http://www.stfb.com/license.pdf" target="_blank">License Agreement</a></font></p>
                <p>
                    <font size="1" face="Tahoma, Helvetica, Arial, Verdana, sans-serif,Helvetica">By clicking
                        on the "Process Order" button below, you acknowledge that you have read this agreement,
                        understand it, signed and returned it to STFB Inc, and agree to be bound by its
                        terms and conditions.</font></p>
                <p>
                    <font size="1" face="Tahoma, Helvetica, Arial, Verdana, sans-serif,Helvetica">
                        
                    <input type="submit" value="Process Order">
                    <input type="hidden" name="order">
                    <input type="reset" value="Cancel">
                    <asp:Button ID="OKButton" OnClick="OKButton_Click" runat="server" Text="Process Order">
                        </asp:Button>
                        <asp:Button ID="CancelButton" OnClick="CancelButton_Click" runat="server" Text="Cancel"
                            CausesValidation="false"></asp:Button>
                    </font>
                </p>
            </td>
        </tr>
    </table></form>';
include 'CartMasterPage.php';
?>