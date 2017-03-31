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
$temp='
        <table width="428" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td rowspan="2" width="1">
                <img src="'.$color.'/images/layout/spacer.gif" width="1" height="1"></td>
            <td background="'.$color.'/images/layout/title_bg.gif" height="23"
                valign="middle">
                <div class="titlebox">
                    :: Forget Password
                </div>
            </td>
            <td rowspan="2" width="1">
                <img src="'.$color.'/images/layout/spacer.gif" width="1" height="1"></td>
        </tr>
        <tr>
            <td>
                <div class="boxspacer">
                    <p>
                        <strong><em><a href="default.php">Store</a> &gt;<a href="support.php">Support</a>
                            &gt;ForgetPassword </em></strong>
                    </p>
                    <p align="center">
                        <asp:Label ID="ErrorMessage" Style="display: block; color: red" runat="server" Font-Name="verdana"
                            Font-Size="X-Small"></asp:Label>
                    </p>
                    <div align="center">
                        <table bordercolor="black" cellspacing="0" rules="none" border="1">
                            <tbody>
                                <tr bgcolor="#336699" class="headerrow">
                                    <td colspan="2">
                                        <div align="center">
                                            <span class="style4">Enter your login and Email.
                                                <br />
                                                Your password will be sent to you
                                                <br />
                                                in few minutes via email. </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="oddrow">
                                    <td width="97">
                                        <span class="style7">Login</span></td>
                                    <td width="110">
                                        <input type="text" ID="TBLogin" runat="server" Width="202px" MaxLength="50">
                                    </td>
                                </tr>
                                <tr class="evenrow">
                                    <td>
                                        <span class="style7">Email</span></td>
                                    <td>
                                        <input type="text" ID="TBEmail" runat="server" Width="201px" MaxLength="100">
                                        <asp:RegularExpressionValidator ID="revEmail" runat="server" ErrorMessage="Invalid"
                                            ValidationExpression="\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*" ControlToValidate="TBEmail"
                                            Font-Name="verdana" Font-Size="XX-Small"></asp:RegularExpressionValidator>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p align="center">
                         <input type="submit" value="ok" style="WIDTH: 75px">
                        <input type="reset" value="cancel" style="WIDTH: 75px">
                    </p>
                </div>
            </td>
        </tr>
    </table>';
include 'CartMasterPage.php';
?>