<?php 
include 'global.php';
if(isset($_GET["action"])&& $_GET["action"]=="remove"){
	unset($_SESSION["id"]);
	$_SESSION["totalitem"]="0";
	$_SESSION["totalprice"]="0";
}
$head=' <table width="428" border="0" cellpadding="0" cellspacing="0">
        <tr height="31">
            <td width="85" align="center" valign="middle" background="'.$color.'/images/nav/01_over.gif">
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
$temp='<table width="428" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td rowspan="2" width="1">
                <img src="'.$color.'/images/layout/spacer.gif" width="1" height="1"></td>
            <td background="'.$color.'/images/layout/title_bg.gif" height="23"
                valign="middle">
                <div class="titlebox">
                    :: Welcome to Software Technology For Business</div>
            </td>
            <td rowspan="2" width="1">
                <img src="'.$color.'/images/layout/spacer.gif" width="1" height="1"></td>
        </tr>
        <tr>
            <td>
                <div class="boxspacer">
                    <strong>
                        <br>
                        Ex Eum Velinam</strong>
                    <br>
                    <br>
                    Ancillae volutpat, ea populo pericula est. Ex qui iracundia intellegam. Sit in facer
                    lobortis neglegentur, cum at accusamus assentior. Audire feugiat ius te, ubique
                    virtute legimus pri ut, sit id tamquam dolorum definiebas. Mea cibo periculis corrumpit
                    in, mel porro ancillae hendrerit at.<br>
                    <br>
                    <a href="insertlink.php">
                        <img src="'.$color.'/images/sale.gif" width="415" height="160"
                            border="0"></a><br>
                    <br>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td colspan="2" valign="top">
                                <br>
                                <span class="sideorange"><font size=2><strong>Ei Porro Questio Seanodo Probo Ut</strong></font></span></td>
                        </tr>
                        <tr>
                            <td colspan="2" height="5">
                                <img src="'.$color.'/images/layout/spacer.gif" height="5" width="1"></td>
                        </tr>
                        <tr>
                            <td width="145" valign="top">
                                <a href="insertlink.php">
                                    <img src="'.$color.'/images/item01.gif" width="145" height="120"
                                        border="0"></a></td>
                            <td valign="top"><font size=2>
                                <strong>Ex mos detraxit</strong> mediocritatem, juso necessitatibus ei has Sit te
                                mena prehensam, pro simul quansipidis ne, mea cu discta.<br>
                                <div align="right">
                                    <a href="products_ind.php">more info</a>&nbsp;</font></div>
                            </td>
                        </tr>
                    </table>
                    <br>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td colspan="2" valign="top">
                                <span class="sideorange"><font size=2><strong>Tid Est Alia Consequentur</strong></font></span></td>
                        </tr>
                        <tr>
                            <td colspan="2" height="5">
                                <img src="'.$color.'/images/layout/spacer.gif" height="5" width="1"></td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <font size=2><strong>Ex mos detraxit</strong> mediocritatem, juso necessitatibus ei has Sit te
                                mena prehensam, pro simul quansipidis ne, mea cu discta.<br>
                                <div align="right">
                                    <a href="products_ind.php">more info</a>&nbsp;</font></div>
                            </td>
                            <td width="156" valign="top">
                                <a href="insertlink.php">
                                    <img src="'.$color.'/images/item02.gif" width="156" height="120"
                                        border="0"></a></td>
                        </tr>
                    </table>
                    <br>
                </div>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td colspan="2" valign="top">
                            <span class="sideorange"><font size=2><strong>Graeci Eirmod Vivendo</strong></font></span></td>
                    </tr>
                    <tr>
                        <td colspan="2" height="5">
                            <img src="'.$color.'/images/layout/spacer.gif" height="5" width="1"></td>
                    </tr>
                    <tr>
                        <td width="145" valign="top">
                            <a href="insertlink.php">
                                <img src="'.$color.'/images/item03.gif" width="145" height="120"
                                    border="0"></a></td>
                        <td valign="top">
                            <font size=2><strong>Ex mos detraxit</strong> mediocritatem, juso necessitatibus ei has Sit te
                            mena prehensam, pro simul quansipidis ne, mea cu discta.<br>
                            <div align="right">
                                <a href="products_ind.php">more info </a>&nbsp;</font></div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>';
include 'CartMasterPage.php';
?>