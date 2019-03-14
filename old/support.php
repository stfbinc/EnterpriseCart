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
            <td width="86" align="center" valign="middle" background="'.$color.'/images/nav/02_stat.gif">
                <div id="menu">
                    <a href="cart.php">MY CART </a>
                </div>
            </td>
            <td width="85" align="center" valign="middle" background="'.$color.'/images/nav/03_over.gif">
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
                    :: Customer Service and Support</div>
            </td>
            <td rowspan="2" width="1">
                <img src="'.$color.'/images/layout/spacer.gif" width="1" height="1" /></td>
        </tr>
        <tr>
            <td>
                <div class="boxspacer">
                    <p>
                        <strong><em><a href="default.php">Store</a> &gt; Support </em></strong>
                    </p>
                    <table width="100%" border="0" cellpadding="0" cellspacing="1">
                        <tr>
                            <td align="center" bgcolor="#336699" class="style12 style8">
                                <div align="left" class="style12">
                                    Support</div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <ul>
                                    <li>
                                        <asp:HyperLink ID="downloadManager" runat="server" NavigateUrl="~/DownloadManager/main.php" Font-Size="X-Small"
                                            Font-Names="Tahoma, Helvetica, Arial, Verdana, sans-serif" Font-Bold="true" Text="Download" Target="_blank"><span class="login"> <a href=main.htm><strong>Download</strong></a></span></asp:HyperLink>
                                        <br />
                                        <span class="style2">Download your files </span></li>
                                    </li>
                                    <li>
                                        <asp:HyperLink ID="accountbutton" runat="server" NavigateUrl="Accounts.php" Font-Size="X-Small"
                                            Font-Names="Tahoma, Helvetica, Arial, Verdana, sans-serif" Font-Bold="true" Text="Account Maintenance"><span class="login"><a href="Accounts.php"><strong>Account Maintenance</strong></a></span></asp:HyperLink>
                                        <br />
                                        <span class="style2">Enter and Change you Company Name, Address, Email Address, And
                                            Ship To"\'"s </span></li>
                                    <li><span class="login">
                                        <asp:HyperLink ID="forgotaccountbutton" runat="server" NavigateUrl="forgetpassword.php"
                                            Font-Size="X-Small" Font-Names="Tahoma, Helvetica, Arial, Verdana, sans-serif"
                                            Font-Bold="True" Text="Retrieve Password"><a href="forgetpassword.php"><strong>Retrieve Password</strong></a></asp:HyperLink>
                                    </span>
                                        <br>
                                        <span class="style2">Have your password sent to the email address that we have on file
                                            for you. </span></li>
                                    <li><span class="login"><b>
                                        <asp:HyperLink ID="soleprovider" runat="server" Target="_blank" NavigateUrl="./SoleSource.htm"
                                            Font-Size="X-Small" Font-Names="Tahoma, Helvetica, Arial, Verdana, sans-serif"
                                            Font-Bold="True" Text="Print Sole Provider Statement"> <a href="SoleSource.htm">View Sole Provider Statement</a></asp:HyperLink>
                                    </b></span>
                                        <br>
                                        <span class="style2">This is a document required by some government agencies. </span>
                                        <li><span class="login"><b>
                                            <asp:HyperLink ID="customersupport" runat="server" Target="_blank" NavigateUrl="https://www.stfb.net/enterprisehelpdesk/index.php?CompanyID=DINOS"
                                                Font-Size="X-Small" Font-Names="Tahoma, Helvetica, Arial, Verdana, sans-serif"
                                                Font-Bold="True" Text="Enter Customer Support Area"><a href="#"> Enter Customer Support Area</a></asp:HyperLink>
                                        </b></span>
                                            <br>
                                            <span class="style2">Enter the STFB Inc. Help Desk System with User Support forms and
                                                Bug Report Forms </span></li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                    <p>
                        <strong>FAQs</strong>
                        <br />
                        If you have any queries, please choose a question from the FAQs box below and the
                        answer will appear in the box beneath it. If you have a question that is not listed
                        below please email your enquiry to

                        <script language="JavaScript">
							<!-- 
							var orang = "generalinfo";
							var usaha = "stfb.com"; 
							document.write(\'<a href=\"mailto:\' + orang + \'@\' + usaha + \'\">\');
							document.write(orang + \'@\' + usaha + \'</a>\'); 
							//-->
                        </script>

                        <!-- Q&A script start  -->
                    </p>
                    <table width="330" border="0">
                        <tr>
                            <td width="55">
                                <div class="boxspacer">
                                    <strong>FAQs:</strong></div>
                            </td>
                            <td width="363" valign="top">
                                <select id="question" size="1" onchange="showAnswer()">
                                    <option value="none">Select a question</option>
                                    <option value="Delenit admodum sed et, cu mea esse justo euismod. Ad mundi disputationi has, quo et gloriatur accommodare.">
                                        Question 1</option>
                                    <option value="Alia comprehensam, at perpetua senserit duo, rebum ludus dolorem nam ut. Vim at feugiat ancillae, mea eu probo gubergren.">
                                        Question 2</option>
                                    <option value="Recusabo consectetuer sed cu, quod perfecto qualisque vel eu, reformidans conclusionemque est ei. Adhuc dolore qui ad.">
                                        Question 3</option>
                                    <option value="Mea ad. Sit posse quaerendum et, eu sed saepe persius. Verterem expetenda ocurreret no per, in est omnes abhorreant, illud soluta accusamus usu te.">
                                        Question 4</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" valign="top">
                                <div class="boxspacer">
                                    <strong>Answer:</strong></div>
                            </td>
                            <td>
                                <textarea id="answer" rows="6" cols="40" readonly="readonly"></textarea>
                            </td>
                        </tr>
                    </table>
                    <table width="100%">
                        <tr>
                            <td class="td_blue style9">
                                <span class="style13">Order, Invoice & Contract Tracking and History</span>
                            </td>
                        </tr>
                    </table>
                    <p>
                        <asp:DataGrid ID="OrderHistoryGrid" runat="server" AllowPaging="True" GridLines="None"
                            Width="100%" AutoGenerateColumns="False" OnPageIndexChanged="OrderHistoryGrid_PageIndexChanged">
                            <HeaderStyle Font-Names="Tahoma, Helvetica, Arial, Verdana, sans-serif" Font-Size="X-Small"
                                Font-Bold="True" ForeColor="White" BackColor="#3B64A2"></HeaderStyle>
                            <PagerStyle Mode="NumericPages"></PagerStyle>
                            <AlternatingItemStyle Font-Size="X-Small" Font-Names="Tahoma, Helvetica, Arial, Verdana, sans-serif"
                                ForeColor="Black" BackColor="#F4F4F4"></AlternatingItemStyle>
                            <ItemStyle Font-Size="X-Small" Font-Names="Tahoma, Helvetica, Arial, Verdana, sans-serif"
                                ForeColor="#3B64A2" BackColor="White"></ItemStyle>
                            <Columns>
                                <asp:TemplateColumn HeaderText="Date">
                                    <HeaderStyle Width="90px"></HeaderStyle>
                                    <ItemTemplate>
                                        <%# makeOrderLink(Container.DataItem) %>
                                    </ItemTemplate>
                                    <EditItemTemplate>
                                        <asp:TextBox runat="server"></asp:TextBox>
                                    </EditItemTemplate>
                                </asp:TemplateColumn>
                                <asp:BoundColumn DataField="OrderNumber" HeaderText="Order No">
                                    <HeaderStyle Width="90px"></HeaderStyle>
                                </asp:BoundColumn>
                                <asp:BoundColumn DataField="ShipMethodDescription" HeaderText="Shipped Via"></asp:BoundColumn>
                                <asp:BoundColumn DataField="ShipDate" HeaderText="Ship Date" DataFormatString="{0:d}">
                                </asp:BoundColumn>
                                <asp:BoundColumn DataField="TrackingNumber" HeaderText="Tracking Number"></asp:BoundColumn>
                            </Columns>
                        </asp:DataGrid>
                        <asp:DataGrid ID="InvoiceHistoryGrid" runat="server" AllowPaging="True" GridLines="None"
                            Width="100%" AutoGenerateColumns="False" OnPageIndexChanged="InvoiceHistoryGrid_PageIndexChanged">
                            <HeaderStyle Font-Names="Tahoma, Helvetica, Arial, Verdana, sans-serif" Font-Size="X-Small"
                                Font-Bold="True" ForeColor="White" BackColor="#3B64A2"></HeaderStyle>
                            <PagerStyle Mode="NumericPages"></PagerStyle>
                            <AlternatingItemStyle Font-Size="X-Small" Font-Names="Tahoma, Helvetica, Arial, Verdana, sans-serif"
                                ForeColor="Black" BackColor="#F4F4F4"></AlternatingItemStyle>
                            <ItemStyle Font-Size="X-Small" Font-Names="Tahoma, Helvetica, Arial, Verdana, sans-serif"
                                ForeColor="#3B64A2" BackColor="White"></ItemStyle>
                            <Columns>
                                <asp:TemplateColumn HeaderText="Date">
                                    <HeaderStyle Width="90px"></HeaderStyle>
                                    <ItemTemplate>
                                        <%# makeInvoiceLink(Container.DataItem) %>
                                    </ItemTemplate>
                                    <EditItemTemplate>
                                        <asp:TextBox runat="server"></asp:TextBox>
                                    </EditItemTemplate>
                                </asp:TemplateColumn>
                                <asp:BoundColumn DataField="InvoiceNumber" HeaderText="Invoice No">
                                    <HeaderStyle Width="90px"></HeaderStyle>
                                </asp:BoundColumn>
                                <asp:BoundColumn DataField="ShipMethodID" HeaderText="Shipped Via"></asp:BoundColumn>
                                <asp:BoundColumn DataField="ShipDate" HeaderText="Ship Date" DataFormatString="{0:d}">
                                </asp:BoundColumn>
                                <asp:BoundColumn DataField="TrackingNumber" HeaderText="Tracking Number"></asp:BoundColumn>
                            </Columns>
                        </asp:DataGrid>
                        <asp:DataGrid ID="ContractHistoryGrid" runat="server" AllowPaging="True" GridLines="None"
                            Width="100%" AutoGenerateColumns="False" OnPageIndexChanged="ContractHistoryGrid_PageIndexChanged">
                            <HeaderStyle Font-Names="Tahoma, Helvetica, Arial, Verdana, sans-serif" Font-Size="X-Small"
                                Font-Bold="True" ForeColor="White" BackColor="#3B64A2"></HeaderStyle>
                            <PagerStyle Mode="NumericPages"></PagerStyle>
                            <AlternatingItemStyle Font-Size="X-Small" Font-Names="Tahoma, Helvetica, Arial, Verdana, sans-serif"
                                ForeColor="Black" BackColor="#F4F4F4"></AlternatingItemStyle>
                            <ItemStyle Font-Size="X-Small" Font-Names="Tahoma, Helvetica, Arial, Verdana, sans-serif"
                                ForeColor="#3B64A2" BackColor="White"></ItemStyle>
                            <Columns>
                                <asp:TemplateColumn HeaderText="Date">
                                    <HeaderStyle Width="90px"></HeaderStyle>
                                    <ItemTemplate>
                                        <%# makeContractLink(Container.DataItem) %>
                                    </ItemTemplate>
                                    <EditItemTemplate>
                                        <asp:TextBox runat="server"></asp:TextBox>
                                    </EditItemTemplate>
                                </asp:TemplateColumn>
                                <asp:BoundColumn DataField="OrderNumber" HeaderText="Contract No">
                                    <HeaderStyle Width="90px"></HeaderStyle>
                                </asp:BoundColumn>
                                <asp:BoundColumn DataField="ContractTypeID" HeaderText="Contract Type"></asp:BoundColumn>
                                <asp:BoundColumn DataField="ContractStartDate" HeaderText="Start Date" DataFormatString="{0:d}">
                                </asp:BoundColumn>
                                <asp:BoundColumn DataField="ContractEndDate" HeaderText="End Date" DataFormatString="{0:d}">
                                </asp:BoundColumn>
                            </Columns>
                        </asp:DataGrid>
                    </p>
                    <p>
                        <strong>Te mea</strong>
                        <br>
                        Alia comprehensam, at perpetua senserit duo, rebum ludus dolorem nam ut. Vim at
                        feugiat ancillae, mea eu probo gubergren. Recusabo consectetuer sed cu, quod perfecto
                        qualisque vel eu, reformidans conclusionemque est ei. Adhuc dolore qui ad. Eum te
                        assum vocibus gubergren. Ex dicant oporteat detraxit mea, vel cu ubique latine signiferumque.</p>
                    <p>
                        <strong>Lorem Bonorum</strong><br>
                        Mea ad. Sit posse quaerendum et, eu sed saepe persius. Verterem expetenda ocurreret
                        no per, in est omnes abhorreant, illud soluta accusamus usu te. Suas vituperata
                        et usu, takimata postulant in mel.</p>
                    <table width="75%" border="0" cellspacing="0" cellpadding="0" align="center">
                        <tr>
                            <td>
                                <div class="boxspacer">
                                    <strong>Address:</strong></div>
                            </td>
                            <td>
                                <div class="boxspacer">
                                    54 Rodeo Dr.<br>
                                    Sydney, NSW 27529-7523</div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="boxspacer">
                                    <strong>General Info:</strong></div>
                            </td>
                            <td>
                                <div class="boxspacer">

                                    <script language="JavaScript">
							<!-- 
							var orang = "generalinfo";
							var usaha = "stfb.com"; 
							document.write(\'<a href=\"mailto:\' + orang + \'@\' + usaha + \'\">\');
							document.write(orang + \'@\' + usaha + \'</a>\'); 
							//-->
                                    </script>

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="boxspacer">
                                    <strong>Customer Support:</strong></div>
                            </td>
                            <td>
                                <div class="boxspacer">

                                    <script language="JavaScript">
							<!-- 
							var orang = "customersupport";
							var usaha = "stfb.com"; 
							document.write(\'<a href=\"mailto:\' + orang + \'@\' + usaha + \'\">\');
							document.write(orang + \'@\' + usaha + \'</a>\'); 
							//-->
                                    </script>

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="boxspacer">
                                    <strong>Phone:</strong></div>
                            </td>
                            <td>
                                <div class="boxspacer">
                                    546-578-8547</div>
                            </td>
                        </tr>
                    </table>
                    <br />
                    <br />
                    <center>
                        <img src="'.$color.'/images/handshake.gif" width="140" height="100" /></center>
                </div>
            </td>
        </tr>
    </table>';
include 'CartMasterPage.php';
?>
<SCRIPT language=javascript type=text/javascript>
// Courtesy of SimplytheBest.net - http://simplythebest.net/scripts/
<!--
function showAnswer()
{
	var question = document.getElementById("question")
    var answer = document.getElementById("answer")

	if(question.value=="none")
	{
	answer.value="^ Please select a question above ^"
	}else
	{
	answer.value=question.value
	}
	
/*
	var frmName;
	frmName=document.getElementByID("whatForm")
	if(document.forms[whatForm].question.value=="none")
	{
	document.forms[whatForm].answer.value="^ Please select a question above ^"
	}else
	{
	document.forms[whatForm].answer.value=document.forms[whatForm].question.values
	}
*/
}
// -->
    </SCRIPT>