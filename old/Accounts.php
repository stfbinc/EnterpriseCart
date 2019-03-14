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
$sql="select * from $table_user where CompanyID='DINOS' and DepartmentID='DEFAULT' and CustomerLogin='".$_SESSION["loadusername"]."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
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
                            &gt;Accounts Maintanence </em></strong>
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
                                    <input type="text"  name="login"   Width="175px" value="'.$row["CustomerLogin"].'"  readonly="readonly"> 
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
                                    <input type="password"  name="password"  size="21" value="'.$row["CustomerPassword"].'"> 
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
                                    <input type="password"  name="confirmpassword"  size="21"  value="'.$row["CustomerPassword"].'"> 
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
                                    <input type="text"  name="companyname"   Width="175px" value="'.$row["CustomerName"].'"> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="style3">First name : </span>
                                </td>
                                <td>
                                    <input type="text"  name="firstname"   Width="175px" MaxLength="50" value="'.$row["CustomerFirstName"].'"> 
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
                                    <input type="text"  name="lastname"   Width="175px" MaxLength="50"  value="'.$row["CustomerLastName"].'"> 
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
                                    <input type="text"  name="salutation"   Width="175px" MaxLength="50"  value="'.$row["CustomerSalutation"].'"> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="style3">Email:</span></td>
                                <td>
                                    <input type="text"  name="email"   Width="175px"  value="'.$row["CustomerEmail"].'"> 
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
                                    <input type="text"  name="address1"  value="'.$row["CustomerAddress1"].'"> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="style3">Address2:</span></td>
                                <td>
                                    <input type="text"  name="address2"   Width="175px" value="'.$row["CustomerAddress2"].'"> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="style3">Address3</span>:</td>
                                <td>
                                    <input type="text"  name="address3"    value="'.$row["CustomerAddress3"].'"> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="style3">City:</span></td>
                                <td>
                                    <input type="text"  name="city"   Width="175px"  value="'.$row["CustomerCity"].'"> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="style3">State:</span></td>
                                <td>
                                    <input type="text"  name="state"   Width="175px"  value="'.$row["CustomerState"].'"> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="style3">Zip:</span></td>
                                <td>
                                    <input type="text"  name="zip"  Width="175px"  value="'.$row["CustomerZip"].'"> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="style3">Phone:</span></td>
                                <td>
                                    <input type="text"  name="phone"   Width="175px"  value="'.$row["CustomerPhone"].'"> 
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
	if($_POST["login"]==""||$_POST["password"]==""||$_POST["email"]==""||$_POST["firstname"]==""||$_POST["lastname"]==""){
		$error.="The * can't be empty";
	}
	if($_POST["password"]!=$_POST["confirmpassword"]){
		$error.="The two passwords is not same<br>";
	}
	if($error==""){
		$user["CustomerPassword"]=$_POST["password"];
		$user["CustomerName"]=$_POST["companyname"];
		$user["CustomerFirstname"]=$_POST["firstname"];
		$user["CustomerLastname"]=$_POST["lastname"];
		$user["CustomerSalutation"]=$_POST["salutation"];
		$user["CustomerEmail"]=$_POST["email"];
		$user["CustomerAddress1"]=$_POST["address1"];
		$user["CustomerAddress2"]=$_POST["address2"];
		$user["CustomerAddress3"]=$_POST["address3"];
		$user["CustomerCity"]=$_POST["city"];
		$user["CustomerState"]=$_POST["state"];
		$user["CustomerZip"]=$_POST["zip"];
		$user["CustomerPhone"]=$_POST["phone"];
		foreach ($user as $k=>$v){
			$sql="update $table_user set $k=$v where CustomerLogin='".$_SESSION["loadusername"]."'";
	        mysql_query($sql);
		}	
	    $temp.="<font color=red>Update complete</font>";
	}else{
		$error="<font color=red>".$error."</font>";		
	    $temp.=$error;
	}
}
include 'CartMasterPage.php';
?>