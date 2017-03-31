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
<form method="post">
    <table width="428" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td rowspan="2" width="1">
                <img src="'.$color.'/images/layout/spacer.gif" width="1" height="1" /></td>
            <td background="'.$color.'/images/layout/title_bg.gif" height="23"
                valign="middle">
                <div class="titlebox">
                    :: New Customer
                </div>
            </td>
            <td rowspan="2" width="1">
                <img src="'.$color.'/images/layout/spacer.gif" width="1" height="1" /></td>
        </tr>
        <tr>
            <td>
                <div class="boxspacer">
                    <p>
                        <strong><em><a href="default.php">Store</a> &gt;<a href="support.php"> Support</a>
                            &gt;New Customer </em></strong>
                    </p>
                    <p>
                        <font face="Verdana, Arial, Helvetica, sans-serif" size="-1" color="#FF0000">
                            <asp:Label ID="ErrorText" Font-Name="verdana" Font-Size="X-Small"  ></asp:Label></font>
                    </p>
                    <table width="99%" height="481" border="0" cellspacing="0" bordercolor="black" rules="none">
                        <tbody>
                            <tr>
                                <td align="middle" colspan="2">
                                    Customer Information</td>
                            </tr>
                            <tr>
                                <td width="16%">
                                    <span class="style3">Login:</span></td>
                                <td width="84%">
                                    <input type="text"  name="login"   Width="175px"> 
                                    <span class="style9">*
                                        <asp:RequiredFieldValidator ID="RequiredFieldValidator2"   ControlToValidate="TBLogin"
                                            ErrorMessage="Login is required field "></asp:RequiredFieldValidator>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="style3">Password:</span></td>
                                <td>
                                    <input type="password"  name="password"  size="21"> 
                                    <span class="style9">*
                                        <asp:RequiredFieldValidator ID="RequiredFieldValidator3"   ControlToValidate="TBPassword"
                                            ErrorMessage="Password is required field"></asp:RequiredFieldValidator>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="style3">Confirm password:</span></td>
                                <td>
                                    <input type="password"  name="confirmpassword"  size="21"> 
                                    <span class="style9">*
                                        <asp:RequiredFieldValidator ID="RequiredFieldValidator4"   ControlToValidate="TBConfirmPassword"
                                            ErrorMessage="Password is required field"></asp:RequiredFieldValidator>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="style3">Company Name:</span></td>
                                <td>
                                    <input type="text"  name="companyname"   Width="175px"> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="style3">First name : </span>
                                </td>
                                <td>
                                    <input type="text"  name="firstname"   Width="175px" MaxLength="50"> 
                                    <span class="style9">*
                                        <asp:RequiredFieldValidator ID="RequiredFieldValidator1"   ControlToValidate="TBFirstName"
                                            ErrorMessage="First Name is required field"></asp:RequiredFieldValidator>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="style3">Last name</span></td>
                                <td>
                                    <input type="text"  name="lastname"   Width="175px" MaxLength="50"> 
                                    <span class="style9">*
                                        <asp:RequiredFieldValidator ID="RequiredFieldValidator6"   ControlToValidate="TBLastName"
                                            ErrorMessage="Last Name is required field"></asp:RequiredFieldValidator>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="style3">Salutation</span></td>
                                <td>
                                    <input type="text"  name="salutation"   Width="175px" MaxLength="50"> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="style3">Email:</span></td>
                                <td>
                                    <input type="text"  name="email"   Width="175px"> 
                                    <span class="style9">*
                                        <asp:RequiredFieldValidator ID="RequiredFieldValidator5"   ControlToValidate="TBEmail"
                                            ErrorMessage="Email is required field" Display="Dynamic"></asp:RequiredFieldValidator>
                                    </span><span class="style9">
                                        <asp:RegularExpressionValidator ID="RegularExpressionValidator1"   ControlToValidate="TBEmail"
                                            ErrorMessage="Incorrect Email" ValidationExpression="\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*"
                                            Display="Dynamic"></asp:RegularExpressionValidator>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="style3">Address1:</span></td>
                                <td>
                                    <input type="text"  name="address1"   Width="175px"> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="style3">Address2:</span></td>
                                <td>
                                    <input type="text"  name="address2"   Width="175px"> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="style3">Address3</span>:</td>
                                <td>
                                    <input type="text"  name="address3"   Width="175px"> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="style3">City:</span></td>
                                <td>
                                    <input type="text"  name="city"   Width="175px"> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="style3">State:</span></td>
                                <td>
                                    <input type="text"  name="state"   Width="175px"> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="style3">Zip:</span></td>
                                <td>
                                    <input type="text"  name="zip"   Width="175px"> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="style3">Phone:</span></td>
                                <td>
                                    <input type="text"  name="phone"   Width="175px"> 
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <strong><em><font face="Arial" size="1">&nbsp;Fields marked with an <font color="red">
                                        *</font> are required<br />
                                        &nbsp;When you are done entering your information, please be sure to press the "OK"
                                        button at the bottom of the screen only ONCE or you may get a duplicate customer
                                        id error. </font></em></strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table bordercolor="black" cellspacing="0" rules="none" width="100%" align="center"
                        border="0" visible="false">
                        <tbody>
                            <tr>
                                <td height="23" colspan="2" align="middle">
                                    <div align="left" class="style11">
                                        <font face="Arial">Ship To Locations:</font></div>
                                </td>
                            </tr>
                            <tr>
                                <td width="90">
                                    
                                <td width="326">
                                    <a name="#CBLocation"></a>
                                    </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="style3">Company Name:</span></td>
                                <td>
                                    <input type="text"  ID="TBShippingName"   Width="175px" Font-Size="8pt"> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="style3">Address1:</span></td>
                                <td>
                                    <input type="text"  ID="TBShippingAddress1"   Width="175px" Font-Size="8pt"> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="style3">Address2:</span></td>
                                <td>
                                    <input type="text"  ID="TBShippingAddress2"   Width="175px" Font-Size="8pt"> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="style3">Address3:</span></td>
                                <td>
                                    <input type="text"  ID="TBShippingAddress3"   Width="175px" Font-Size="8pt"> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="style3">State:</span></td>
                                <td>
                                    <input type="text"  ID="TBShippingState"   Width="175px" Font-Size="8pt"> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="style3">City:</span></td>
                                <td>
                                    <input type="text"  ID="TBShippingCity"   Width="175px" Font-Size="8pt"> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="style3">Zip:</span></td>
                                <td>
                                    <input type="text"  ID="TBShippingZip"   Width="175px" Font-Size="8pt"> 
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p>
                        <input type="submit" value="ok" style="WIDTH: 75px">
                        <input type="hidden" name="newcustomer">
                        <input type="reset" value="cancel" style="WIDTH: 75px">                      
                </div>
            </td>
        </tr>
    </table>
</form>';
if(isset($_POST["newcustomer"])){
	$error="";
	$sql="select * from $table_user where CustomerLogin='".$_POST["login"]."'";
	$result=mysql_query($sql);
	if(mysql_num_rows($result)>0){
		$error.="The login is engaged<br>";
	}
	$sql="select * from $table_user where CustomerEmail='".$_POST["email"]."'";
	$result=mysql_query($sql);
	if(mysql_num_rows($result)>0){
		$error.="The email is engaged<br>";
	}
	if($_POST["login"]==""||$_POST["password"]==""||$_POST["email"]==""||$_POST["firstname"]==""||$_POST["lastname"]==""){
		$error.="The * can't be empty";
	}
	if($_POST["password"]!=$_POST["confirmpassword"]){
		$error.="The two passwords is not same<br>";
	}
	if($error==""){
		
		$sql="insert into $table_user (CompanyID, DivisionID, DepartmentID, CustomerID, CustomerLogin, CustomerPassword, CustomerName, CustomerFirstName, CustomerLastName, CustomerSalutation, CustomerEmail, CustomerAddress1, CustomerAddress2, CustomerAddress3, CustomerCity, CustomerState, CustomerZip, CustomerPhone) values ('DINOS', '".rand(1000, 9000)."', 'DEFAULT', 'USD', '".$_POST["login"]."', 
		'".$_POST["password"]."', '".$_POST["companyname"]."', '".$_POST["firstname"]."', '".$_POST["lastname"]."', '".$_POST["salutation"]."', '".$_POST["email"]."', '".$_POST["address1"]."', '".$_POST["address2"]."', 
		'".$_POST["address3"]."', '".$_POST["city"]."', '".$_POST["state"]."', '".$_POST["zip"]."', '".$_POST["phone"]."')";		
		$result=mysql_query($sql);    
	    $temp.="<font color=red>Register complete</font>";
	    echo '<meta http-equiv="Refresh" content="3;url=default.php"/>';
	}else{
		$error="<font color=red>".$error."</font>";		
	    $temp.=$error;
	}
}
include 'CartMasterPage.php';
?>