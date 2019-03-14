<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>Software Technology For Business - Products</title>
    <link href="<?php echo $color?>/styles/style.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
<!--
.style2 {font-size: 10px}
.style3 {
	font-size: 12px;
	font-weight: bold;
}
.style4 {font-size: 12px}
.style6 {font-size: 12px; font-weight: bold; }
.style7 {font-size: 10px; font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; }
.style9 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px;}
.style8 {color: #FFFFFF}
.style9 {font-size: x-small}
.style12 {
	font-size: 12px;
	font-weight: bold;
	font-style: italic;
}
.style13 {
	font-size: 14px;
	font-weight: bold;
}
.style14 {
	font-size: 14px;
}
.style18 {font-size: 18px}
form{MARGIN: 0px;}         //form br problem 
-->
</style>
<script type="text/javascript">
function submitT($o){
    window.location.href="?colorSelect="+$o.value;  
}   
</script>
</head>
<body>
   
        <table style="width: 800px; background-color: #FFFFFF;" border="0" cellspacing="0"
            cellpadding="0" align="center">
            <tr>
                <td width="1" rowspan="3">
                    <img src="<?php echo $color?>/images/layout/spacer.gif" width="1" height="1" /></td>
                <td width="180" align="right" class="topbackground">
                    <img src="<?php echo $color?>/images/layout/logo_01.gif" width="180"
                        height="22" /></td>
                <td colspan="4" align="right" class="topbackground">
                    <div class="toptext">
                        <a href="cart.php">
                            <img src="<?php echo $color?>/images/layout/cart.gif" border="0" align="middle" />&nbsp;
                            View Cart</a> | <a href="checkout.php">Checkout</a> | <a href="support.php">Help</a>|
                        <select name="colorSelect" id="colorSelect" onchange="submitT(this)" 
                         Class="toptext" BorderStyle="none" BorderWidth="0px" Rows="1">
                            <option Value="Default">Default</option>
                            <option Value="Brown">Brown</option>
                            <option Value="Gold">Gold</option>
                            <option Value="Halo">Halo</option>
                            <option Value="Lime">Lime</option>
                            <option Value="Multi">Multi</option>
                            <option Value="OceanBlue">Ocean</option>
                            <option Value="OrangeGlow">Orange</option>
                            <option Value="Seaside">Seaside</option>
                            <option Value="Sublime">Sublime</option>
                        </select>|
                        <SELECT class=toptext>
                        	<option>English</option>
                        </SELECT>
                        | <SELECT class=toptext 
      id=ctl00_CartCurrencyDropDown 
      style="BORDER-RIGHT: 0px; BORDER-TOP: 0px; BORDER-LEFT: 0px; BORDER-BOTTOM: 0px" 
      onchange="javascript:setTimeout('__doPostBack(\'ctl00$CartCurrencyDropDown\',\'\')', 0)" 
      name=ctl00CartCurrencyDropDown> <OPTION value=ARS>ARS</OPTION> <OPTION 
        value=AUD>AUD</OPTION> <OPTION value=BEF>BEF</OPTION> <OPTION 
        value=BRL>BRL</OPTION> <OPTION value=CAD>CAD</OPTION> <OPTION 
        value=CHF>CHF</OPTION> <OPTION value=DEM>DEM</OPTION> <OPTION 
        value=EUR>EUR</OPTION> <OPTION value=GBP>GBP</OPTION> <OPTION 
        value=ksh>ksh</OPTION> <OPTION value=USD selected>USD</OPTION> <OPTION 
        value=XEU>XEU</OPTION></SELECT>
                    </div>
                </td>
                <td width="1" rowspan="3" class="topbackground">
                    <img src="<?php echo $color?>/images/layout/spacer.gif" width="1" height="1" /></td>
            </tr>
            <tr>
                <td rowspan="2" style="width: 180px; height: 102px; font-size: 0px;">
                    <a href="default.php">
                        <img src="<?php echo $color?>/images/layout/logo.gif" alt="storefront"
                            width="180px" height="102px" border="0" /></a></td>
                <td style="width: 5px; height: 102px;" rowspan="2" background="<?php echo $color?>/images/layout/banner_bg.gif">
                    &nbsp;</td>
                <td style="width: 428px; height: 51px; background-color: #FFFFFF;" align="center"
                    valign="middle">                
                    <INPUT type="text" style="WIDTH: 85px" maxLength=30 name=keyword value="<?php if(isset($_SESSION["keyword"])) echo $_SESSION["keyword"];?>">
                    <span class="style3">in</span>
                    <SELECT id=ctl00_CBCategory name=ctl00$CBCategory> 
	                    <OPTION value=Name selected>Name</OPTION> 
	                    <OPTION value=Category>Category</OPTION>
                    </SELECT> 
                    <INPUT id=ctl00_btnSearch style="WIDTH: 65px" type=button value=Search onclick="searchP()"> 
                    <script type="text/javascript">
                    	function searchP(){
							window.location.href="search.php?keyword="+document.all.keyword.value;
                        }
                    </script>     
                </td>
                <td style="width: 5px; height: 102px;" rowspan="2" background="<?php echo $color?>/images/layout/banner_bg.gif">
                    &nbsp;</td>
                <td style="width: 180px; height: 102px;" rowspan="2" background="<?php echo $color?>/images/layout/banner_bg.gif">
                    &nbsp;</td>
            </tr>
            <tr>
                <td valign="top" background="<?php echo $color?>/images/layout/nav_bg.gif"
                    style="width: 428px; height: 51px;" align="left">
                    <!-- Tabs placeholder -->
                     <?php echo $head?>
                </td>
            </tr>
            <tr>
                <td height="5" colspan="7">
                    <img src="<?php echo $color?>/images/layout/spacer.gif" height="5" width="1" /></td>
            </tr>
            <tr>
                <td colspan="7">
                    <table width="800" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td colspan="3" bgcolor="#666666" height="1">
                                <img src="<?php echo $color?>/images/layout/spacer.gif" height="1" width="1" /></td>
                            <td height="1">
                                <img src="<?php echo $color?>/images/layout/spacer.gif" height="1" width="1" /></td>
                            <td colspan="3" bgcolor="#666666" height="1">
                                <img src="<?php echo $color?>/images/layout/spacer.gif" height="1" width="1" /></td>
                            <td height="1">
                                <img src="<?php echo $color?>/images/layout/spacer.gif" height="1" width="1" /></td>
                            <td colspan="3" bgcolor="#666666" height="1">
                                <img src="<?php echo $color?>/images/layout/spacer.gif" height="1" width="1" /></td>
                        </tr>
                        <tr>
                            <td style="width: 1px; background-color: #666666">
                                <img src="<?php echo $color?>/images/layout/spacer.gif" height="1" width="1" /></td>
                            <td style="width: 178px;" valign="top">
                            <?php 
                            if(isset($_POST["login"])){
                            	if(isset($_POST["loadusername"])&&isset($_POST["loadpassword"])){
                            	$sql="select * from $table_user where CustomerLogin='".$_POST["loadusername"]."' and CustomerPassword='".$_POST["loadpassword"]."'";
                            	$result=mysql_query($sql);
                            	if(mysql_num_rows($result)>0&&strtolower($_POST["loadcode"])==$_SESSION["string"]){
                            		$_SESSION["loadusername"]=$_POST["loadusername"];
                            		$_SESSION["loadpassword"]=$_POST["loadpassword"];
                            	}}
                            }
                            if(isset($_POST["logoff"])){
                            	unset($_SESSION["loadusername"]);
                            	unset($_SESSION["loadpassword"]);
                            }
                            ?>
                            <form method="post">
                                <table width="178px" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td rowspan="8" style="width: 1px">
                                            <img src="<?php echo $color?>/images/layout/spacer.gif" width="1" height="1" /></td>
                                        <td style="width: 176px; height: 23px" colspan="2" valign="middle" background="<?php echo $color?>/images/layout/title_bg.gif">
                                            <div class="titlebox">
                                                :: Login
                                            </div>
                                        </td>
                                        <td rowspan="8" style="width: 1px">
                                            <img src="<?php echo $color?>/images/layout/spacer.gif" width="1" height="1" /></td>
                                    </tr>
                                    <?php 
                                    if(!isset($_SESSION["loadusername"]))
                                    {
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="boxspacer">
                                                <SPAN id=ctl00_lblUname>UserName :</SPAN> 
                                            </div>
                                        </td>
                                        <td style="width: 92px" align="right">
                                            <INPUT id=ctl00_TBUsername style="WIDTH: 85px" maxLength=50 name=loadusername>
                  						</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="boxspacer">
                                                <SPAN id=ctl00_lblPassword>Password 
                  :</SPAN>					</div>
                                        </td>
                                        <td style="width: 92px" align="right">
                                            <INPUT id=ctl00_TBPassword style="WIDTH: 85px" type=password maxLength=30 name=loadpassword>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="boxspacer">
                                               <SPAN id=ctl00_lblCode>Code :</SPAN>				
                                             </div>
                                        </td>
                                        <td style="width: 92px" align="right">
                                            <INPUT id=ctl00_TBSecretWord style="WIDTH: 85px"  name=loadcode>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="boxspacer">
                                                <asp:Label ID="Label1" runat="server" Text="Code :" Visible="false"></asp:Label></div>
                                        </td>
                                        <td style="width: 92px" align="right">
                                            <image ID="NumImage"  Style="vertical-align: middle" src="verifycode.php">              
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center">
                                            <input type="submit" value="login">
                                            <input type="hidden" name="login">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="right">
                                            <div align="center">
                                                <A id=ctl00_LBRegister 
                  style="FONT-SIZE: xx-small; COLOR: blue; FONT-FAMILY: verdana" 
                  href="newcustomer.php">Register 
                  |</A> <A id=ctl00_LBForgetPwd 
                  style="FONT-SIZE: xx-small; COLOR: blue; FONT-FAMILY: verdana" 
                  href="forgetpassword.php">ForgetPassword</A> 
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <?php 
                                    }else{            
                                    ?>
                                    <tr><td><br><p align="center">
                                       <input type="hidden" name="logoff">
                                       <input type="submit" value="logoff"></p></td></tr>
                                    <?php 
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="2" align="right">
                                            <div class="Login" align="center">
                                                <asp:Label ID="Errortext" runat="server" Font-Name="verdana" Font-Size="XX-Small"
                                                    ForeColor="#FF0000" Font-Bold="true"></asp:Label>
                                            </div>
                                        </td>
                                    </tr>    
                                </table> 
                                </form> 
                                <table width="178" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td rowspan="2" width="1">
                                            <img src="<?php echo $color?>/images/layout/spacer.gif" width="1" height="1" /></td>
                                        <td background="<?php echo $color?>/images/layout/title_bg.gif" height="23"
                                            valign="middle">
                                            <div class="titlebox">
                                                :: Featured Item</div>
                                        </td>
                                        <td rowspan="2" width="1">
                                            <img src="<?php echo $color?>/images/layout/spacer.gif" width="1" height="1" /></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="boxspacer">
                                                <ul>
                                                    <li>Delenit admodum sed et, cu mea esse justo euismod. Ad mundi disputationi has, quo
                                                        et gloriatur accommodare. Vim ne altera omittam, at graece dictas nam, est denique
                                                        scripserit ea.</li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <table width="178" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td rowspan="2" width="1">
                                            <img src="<?php echo $color?>/images/layout/spacer.gif" width="1" height="1" /></td>
                                        <td background="<?php echo $color?>/images/layout/title_bg.gif" height="23"
                                            valign="middle">
                                            <div class="titlebox">
                                                :: Exclusive Offers
                                            </div>
                                        </td>
                                        <td rowspan="2" width="1">
                                            <img src="<?php echo $color?>/images/layout/spacer.gif" width="1" height="1" /></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="boxspacer">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td>
                                                            <a href="insertlink.php">
                                                                <img src="<?php echo $color?>/images/items/img04.gif" width="60" height="60"
                                                                    border="0" /></a></td>
                                                        <td>
                                                            <div class="boxspacer">
                                                                &nbsp;Adhuc dolore qui ad. Eum te assum vocibus <a href="insertlink.php">gubergren.</a></div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="insertlink.php">
                                                                <img src="<?php echo $color?>/images/items/img07.gif" width="60" height="60"
                                                                    border="0" /></a></td>
                                                        <td>
                                                            <div class="boxspacer">
                                                                &nbsp;Adhuc dolore qui ad. Eum te assum vocibus <a href="insertlink.php">gubergren.</a></div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <table width="178" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td rowspan="2" width="1">
                                            <img src="<?php echo $color?>/images/layout/spacer.gif" width="1" height="1" /></td>
                                        <td background="<?php echo $color?>/images/layout/title_bg.gif" height="23"
                                            valign="middle">
                                            <div class="titlebox">
                                                :: Testimonies
                                            </div>
                                        </td>
                                        <td rowspan="2" width="1">
                                            <img src="<?php echo $color?>/images/layout/spacer.gif" width="1" height="1" /></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="boxspacer">
                                                <span class="sideorange">&quot;... Lorem ipsum vim dolor mea met disum Lorem ipsum vim
                                                    dolor mea met disum Lorem ipsum vim dolor mea met disum Lorem ipsum vim dolor mea
                                                    met disum Lorem ipsum vim dolor mea met disum Lorem ipsum vim dolor mea met disum...&quot;
                                                    Mark Farrington (2007)</span></div>
                                        </td>
                                    </tr>
                                </table>
                                <table width="178" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td rowspan="2" width="1">
                                            <img src="<?php echo $color?>/images/layout/spacer.gif" width="1" height="1" /></td>
                                        <td background="<?php echo $color?>/images/layout/title_bg.gif" height="23"
                                            valign="middle">
                                            <div class="titlebox">
                                                :: site certifications</div>
                                        </td>
                                        <td rowspan="2" width="1">
                                            <img src="<?php echo $color?>/images/layout/spacer.gif" width="1" height="1" /></td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <div class="boxspacer">
                                                <img src="<?php echo $color?>/images/certification.gif" width="158"
                                                    height="89" /></div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td width="1" bgcolor="#666666">
                                <img src="<?php echo $color?>/images/layout/spacer.gif" height="1" width="1" /></td>
                            <td width="5">
                                <img src="<?php echo $color?>/images/layout/spacer.gif" height="1" width="5" /></td>
                            <td width="1" bgcolor="#666666">
                                <img src="<?php echo $color?>/images/layout/spacer.gif" height="1" width="1" /></td>
                            <td width="428" valign="top">
                                <!-- Main Content Palaceholder -->
                                
                                
                                <div id="contentC"><?php echo $temp?></div>
                                
                                
                                
                            </td>
                            <td width="1" bgcolor="#666666">
                                <img src="<?php echo $color?>/images/layout/spacer.gif" height="1" width="1" /></td>
                            <td width="5">
                                <img src="<?php echo $color?>/images/layout/spacer.gif" height="1" width="5" /></td>
                            <td width="1" bgcolor="#666666">
                                <img src="<?php echo $color?>/images/layout/spacer.gif" height="1" width="1" /></td>
                            <td width="178" valign="top">
                                <table width="178" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td rowspan="6" width="1">
                                            <img src="<?php echo $color?>/images/layout/spacer.gif" width="1" height="1" /></td>
                                        <td height="23" colspan="3" valign="middle" background="<?php echo $color?>/images/layout/title_bg.gif">
                                            <div class="titlebox">
                                                :: My Cart
                                            </div>
                                        </td>
                                        <td rowspan="6" width="1">
                                            <img src="<?php echo $color?>/images/layout/spacer.gif" width="1" height="1" /></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="boxspacer" align="left">
                                                <font face="Verdana, Arial, Helvetica, sans-serif" size="1">Login Status:
                                                	
                                                </font>
                                            </div>
                                        </td>
                                        <td bgcolor="#666666">
                                            <img src="<?php echo $color?>/images/layout/spacer.gif" width="1" height="25" /></td>
                                        <td width="87">
                                            <div class="boxspacer" align="center">
                                                <?php 
                                                	if(isset($_SESSION["loadusername"])){
                                                		echo "Logged In";
                                                	}else{
                                                		echo "Logged Out";
                                                	}
                                                	?></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" bgcolor="#666666">
                                            <img src="<?php echo $color?>/images/layout/spacer.gif" width="1" height="1" /></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="boxspacer" align="left">
                                                <font face="Verdana, Arial, Helvetica, sans-serif" size="1">Total Items:</font>
                                            </div>
                                        </td>
                                        <td bgcolor="#666666">
                                            <img src="<?php echo $color?>/images/layout/spacer.gif" width="1" height="25" /></td>
                                        <td>
                                            <div class="boxspacer" align="center">
                                                <?php 
                                                if(!isset($_SESSION["totalitem"])){
                                                	echo 0;
                                                }else{
                                                	echo $_SESSION["totalitem"];
                                                }
                                                ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" bgcolor="#666666">
                                            <img src="<?php echo $color?>/images/layout/spacer.gif" width="1" height="1" /></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="boxspacer">
                                                <font face="Verdana, Arial, Helvetica, sans-serif" size="1">Total Price :</font>
                                            </div>
                                        </td>
                                        <td bgcolor="#666666">
                                            <font face="Verdana, Arial, Helvetica, sans-serif" size="-1">
                                                <img src="<?php echo $color?>/images/layout/spacer.gif" width="1" height="30" /></font></td>
                                        <td>
                                            <div class="boxspacer" align="center">$ 
                                                <?php 
                                                if(!isset($_SESSION["totalprice"])){
                                                	echo 0;
                                                }else{
                                                	echo $_SESSION["totalprice"];
                                                }
                                                ?>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <table width="178" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td rowspan="2" width="1">
                                            <img src="<?php echo $color?>/images/layout/spacer.gif" width="1" height="1" /></td>
                                        <td background="<?php echo $color?>/images/layout/title_bg.gif" height="23"
                                            valign="middle">
                                            <div class="titlebox">
                                                :: Wish List
                                            </div>
                                        </td>
                                        <td rowspan="2" width="1">
                                            <img src="<?php echo $color?>/images/layout/spacer.gif" width="1" height="1" /></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="boxspacer">
                                                <br />
                                                <ul>
                                                    <li><a href="insertlink.php">Ised Saepe Persius </a></li>
                                                    <li><a href="insertlink.php">Verterum Expetenda</a> </li>
                                                    <li><a href="insertlink.php">Ocurrert O Per</a> </li>
                                                    <li><a href="insertlink.php">Est Omnes Abh</a> </li>
                                                    <li><a href="insertlink.php">Reant Llud Soluta</a></li>
                                                    <li><a href="insertlink.php">Accusamus Usu te</a></li>
                                                </ul>
                                                <br>
                                                <span class="sideorange"><strong>Habitur Palantur</strong></span><br />
                                                <ul>
                                                    <li>Ad mundi disputationi has, quo et gloriatur accommodare. Vim ne altera omittam,
                                                        at graece dictas nam, est denique scripserit ea. Cum possit perfecto dissentiunt
                                                        ut, ad eam autem ceteros. Dicat feugiat sanctus per in.</li>
                                                    <li>Ad mundi disputationi has, quo et gloriatur accommodare. Vim ne altera omittam,
                                                        at graece dictas nam, est denique scripserit ea. Cum possit perfecto dissentiunt
                                                        ut, ad eam autem ceteros. Dicat feugiat sanctus per in. Eu evertitur aliquando nam,
                                                        duo ut tantas denique, putant mediocrem at mea.</li>
                                                    <li>Ad mundi disputationi has, quo et gloriatur accommodare. Vim ne altera omittam,
                                                        at graece dictas nam, est denique scripserit ea. Cum possit perfecto dissentiunt
                                                        ut, ad eam autem ceteros. Dicat feugiat sanctus per in. Eu evertitur aliquando nam,
                                                        duo ut tantas denique, putant mediocrem at mea.
                                                        <br />
                                                        <br />
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td width="1" bgcolor="#666666">
                                <img src="<?php echo $color?>/images/layout/spacer.gif" height="1" width="1" /></td>
                        </tr>
                        <tr>
                            <td colspan="3" bgcolor="#666666">
                                <img src="<?php echo $color?>/images/layout/spacer.gif" height="1" width="1" /></td>
                            <td width="5" height="1">
                                <img src="<?php echo $color?>/images/layout/spacer.gif" height="1" width="1" /></td>
                            <td colspan="3" bgcolor="#666666">
                                <img src="<?php echo $color?>/images/layout/spacer.gif" height="1" width="1" /></td>
                            <td width="5" height="1">
                                <img src="<?php echo $color?>/images/layout/spacer.gif" height="1" width="1" /></td>
                            <td colspan="3" bgcolor="#666666">
                                <img src="<?php echo $color?>/images/layout/spacer.gif" height="1" width="1" /></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="7" height="5">
                    <img src="<?php echo $color?>/images/layout/spacer.gif" height="5" width="1" /></td>
            </tr>
            <tr>
                <td width="1" rowspan="5" bgcolor="#666666">
                    <img src="<?php echo $color?>/images/layout/spacer.gif" height="1" width="1" /></td>
                <td colspan="5" bgcolor="#666666" height="1">
                    <img src="<?php echo $color?>/images/layout/spacer.gif" width="1" height="1" /></td>
                <td width="1" rowspan="5" bgcolor="#666666">
                    <img src="<?php echo $color?>/images/layout/spacer.gif" height="1" width="1" /></td>
            </tr>
            <tr>
                <td colspan="5" bgcolor="#FFFFFF" align="center">
                    <div class="footer">
                        <br />
                        Solum suscipit iuset, nam solet doctus ocurrevent cu. Ei mea muere postulant, his
                        dicit facilisis te, ei doctus siique<br />
                        Eruditsi nec. Eos ex tale dicit focalisis te, ei doctus ibsque erudit nec. Eos ex
                        tale dicanted tis igt.</div>
                    <br />
                </td>
            </tr>
            <tr>
                <td colspan="5" align="center" height="20" valign="middle" class="footertext">
                    <a href="default.php">Store</a> | <a href="products.php">Products</a> | <a href="search.php">
                        Search</a> | <a href="cart.php">My Cart</a> | <a href="support.php">Support</a></td>
            </tr>
            <tr>
                <td colspan="5" bgcolor="#FFFFFF" align="center">
                    <div class="footer">
                        &copy; 2007 Please read our Disclaimer, Privacy Notice, Services Agreement Policy</div>
                </td>
            </tr>
            <tr>
                <td colspan="5" bgcolor="#666666">
                    <img src="<?php echo $color?>/images/layout/spacer.gif" height="1" width="1" /></td>
            </tr>
        </table>
   
</body>
</html>
<script type="text/javascript">
document.all('colorSelect').value="<?php echo $colorSelect?>";   
</script>
