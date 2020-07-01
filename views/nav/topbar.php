<?php
    $customerFieldsRight = [
        "CustomerAddress1" => [
            "label" => "Address 1"
        ],
        "CustomerAddress2" => [
            "label" => "Address 2"
        ],
        "CustomerAddress3" => [
            "label" => "Address 3"
        ],
        "CustomerCountry" => [
            "label" => "Country"
        ],
        "CustomerState" => [
            "label" => "State"
        ],
        "CustomerCity" => [
            "label" => "City"
        ],
        "CustomerZip" => [
            "label" => "Zip"
        ]
    ];

    $customerFieldsLeft = [
        "CustomerPhone" => [
            "label" => "Phone"
        ],
        "CustomerPassword" => [
            "label" => "Password"
        ],

        /* "login" => [
           "label" => "login"
           ],*/
        "CustomerFirstName" => [
            "label" => "First Name"
        ],
        "CustomerLastName" => [
            "label" => "Last Name"
        ],
        "CustomerName" => [
            "label" => "Company Name"
        ],
        "CustomerEmail" => [
            "label" => "Email"
        ],
        "CustomerWebPage" => [
            "label" => "Web page"
        ]
    ];
?>

<style>
 .has-error {
     border: 1px solid red !important;
 }
</style>

<div id="registerDialog" class="modal fade  bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm modal-dialog-center" style="width:800px;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <?php echo $translation->translateLabel("Register Form"); ?>
                </h4>
            </div>
            <div class="modal-body">
                <form action="#" id="registerForm"  onsubmit="return false"> 
                    <div class="col-lg-6 col-md-6">
                        <div class="checkbox-form">
                            <div class="row">
                                <?php foreach($customerFieldsLeft as $fieldName=>$def): ?>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list" style="margin-bottom:5px">
                                            <label>
                                                <?php echo $translation->translateLabel($def["label"]);  ?>
                                            </label>
                                            <input type="text" name="<?php echo $fieldName; ?>" placeholder="" value="<?php echo (key_exists("Customer", $user) ? $user["Customer"]->$fieldName : ""); ?>" />
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="checkbox-form">
                            <div class="row">
                                <?php foreach($customerFieldsRight as $fieldName=>$def): ?>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list" style="margin-bottom:5px">
                                            <label>
                                                <?php echo $translation->translateLabel($def["label"]);  ?>
                                            </label>
                                            <input type="text" name="<?php echo $fieldName; ?>" placeholder="" value="<?php echo (key_exists("Customer", $user) ? $user["Customer"]->$fieldName : ""); ?>" />
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="checkbox-form">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <img id="imgRegisterCaptcha" style="padding:15px;" src="<?php echo $oscope->captchaBuilder->inline(); ?>" />
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="checkout-form-list" style="margin-bottom:5px">
                                    <label class="dropdown-label pull-left"><?php echo $translation->translateLabel("Captcha"); ?>:</label>
                                    <input name="captcha" id="registerCaptcha" type="text" required placeholder="<?php echo $translation->translateLabel("Enter captcha"); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="registerButton">
                    <?php echo $translation->translateLabel("Register"); ?>
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <?php echo $translation->translateLabel("Cancel"); ?>
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="loginDialog" class="modal fade  bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm modal-dialog-center" style="width:400px;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <?php echo $translation->translateLabel("Log In"); ?>
                </h4>
            </div>
            <div class="modal-body">
                <form id="loginform">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-6">
                                <label class="dropdown-label pull-left"><?php echo $translation->translateLabel("Username"); ?>:</label>
                            </div>
                            <div class="col-xs-6">
                                <input name="username" class="form-control pull-right b-none"/>
                            </div>
                        </div>
                    </div>
                    <div  id="user_wrong_message" style="color:red; padding-bottom:20px; display:none">
                        <strong>These credentials do not match our records.</strong>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-6">
                                <label class="dropdown-label pull-left"><?php echo $translation->translateLabel("Password"); ?>:</label>
                            </div>
                            <div class="col-xs-6">
                                <input name="password" type="password" class="form-control pull-right b-none"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-6">
                                <label class="dropdown-label pull-left"><?php echo $translation->translateLabel("Captcha"); ?>:</label>
                            </div>
                            <div class="col-xs-6">
                                <input name="captcha" id="captcha" class="form-control" type="text" required placeholder="<?php echo $translation->translateLabel("Enter captcha"); ?>">
                            </div>
                            <div class="col-xs-6">
                                <img id="imgcaptcha" src="<?php echo $oscope->captchaBuilder->inline(); ?>" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-1 col-lg-1">
                    </div>
                    <div class="col-md-8 col-lg-8" style="padding-bottom:20px">
                        <a href="#" style="color:blue">
                            <?php echo $translation->translateLabel("Forgot Username / Password"); ?>
                        </a>
                    </div>
                </div>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal" onclick="$('#registerDialog').modal('show');">
                    <?php echo $translation->translateLabel("Register"); ?>
                </button>
                <button type="button" class="btn btn-primary" id="loginButton">
                    <?php echo $translation->translateLabel("Login"); ?>
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <?php echo $translation->translateLabel("Cancel"); ?>
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="header-top-area hidden-xs">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-4">
                <div class="welcome">
                    <!--  <span class="phone">Phone: +12345 67890</span> <span class="hidden-sm">/</span>
                         <span class="email hidden-sm">Email: yourname@domain.com</span> -->
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-8">
                <div class="top-menu">
                    <span class="dropdown" style="float:right !important">
                        <button class="btn btn-default dropdown-toggle" type="button" id="langChooserDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:white; border:0px; background-color:inherit; margin-top:2px">
                            <?php echo $scope["user"]["language"]; ?>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu lang-chooser-popup dropdown-chooser" aria-labelledby="langChooserDropdown" aria-expanded="false">
                            <li><a href="javascript:;" data-value="<?php echo $scope["user"]["language"]; ?>" class="lang-item"><img src="assets/img/langs/<?php echo $scope["user"]["language"]; ?>.png">  <?php echo $scope["user"]["language"]; ?></a></li>
                            <?php
                                foreach($translation->languages as $value)
                                if($value != $scope["user"]["language"])
                                    echo "<li><a href=\"javascript:;\" data-value=\"$value\" class=\"lang-item\"><img src=\"assets/img/langs/{$value}.png\">  " . $value . "</a></li>";
                            ?>
                        </ul>
                    </span>
                    <ul id="currency">
                        <li><a href="#">USD <i class="fa fa-angle-down"></i></a>
                            <ul id="currencyChooser">
                            </ul>
                        </li>
                    </ul>
                    <ul>
                        <?php if(key_exists("Customer", $user)): ?>
                            <span class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" id="customerDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:white; border:0px; background-color:inherit; margin-top:-2px">
                                    <?php echo $user["Customer"]->CustomerLogin; ?>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu customer-popup dropdown-chooser" aria-labelledby="customerDropdown" aria-expanded="false">
                                    <li><a href="javascript:;" id="logoutButton" data-value="logout" class="lang-item"> <?php echo $translation->translateLabel("Log out"); ?></a>
                                    </li>
                                </ul>
                            </span>
                            <li>
                                <a href="#/?page=forms&action=account">
                                    <?php
                                        echo $translation->translateLabel("Account");
                                    ?>
                                </a>
                            </li>
                        <?php else: ?>
                            <li><a href="javascript:;" onclick="$('#loginDialog').modal('show');">
                                <?php
                                    if(key_exists("Customer", $user))
                                        echo $user["Customer"]->CustomerLogin;
                                    else
                                        echo $translation->translateLabel("Login");
                                ?>
                            </a>
                            </li>
                        <?php endif ?>
                        <!-- <li><a href="#"><?php echo $translation->translateLabel("Wishlist"); ?></a></li> -->
                        <li><a href="#/?page=forms&action=shoppingcart"><?php echo $translation->translateLabel("Cart"); ?></a></li>
                        <li><a href="#/?page=forms&action=checkout"><?php echo $translation->translateLabel("Checkout"); ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- header-top-area end -->
<div class="sticky-wrapper">
    <header>   
        <!-- header-bottom-area start -->            
        <div class="header-bottom-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="logo">
                            <a href="index.php"><img style="width:40px; height:40px; margin-bottom:10px" src="<?php echo $linksMaker->makeEnterpriseXImageLink($scope, $company, "SmallLogo"); ?>" /> <?php echo $company->CompanyName; ?></a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5 col-sm-5 col-xs-6 hidden-xs">
                        <div class="header-search">
                            <form id="searchForm" onsubmit="return false">
                                <?php if($scope["config"]["software"] == "Cart"): ?>
                                    <select name="family" id="searchFamilies" style="width:auto; position: static;">
                                    </select>
                                <?php endif; ?>
                                <input type="text" placeholder="search product..." name="text" style="width:auto; margin-left: -5px;" />
                                <button onclick="search();"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 account-wrap">
                        <!-- Header shopping cart -->
                        <!-- <div class="my-account-holder">                
                             <div class="my-account-title">
                             <div class="user-icon float-left">
                             <i class="fa fa-exchange" aria-hidden="true"></i>
                             </div>                                   
                             <div class="clearfix"></div>                     
                             </div>
                             </div> -->
                        <!-- Header shopping cart -->
                        <!-- <div class="my-account-holder">                
                             <div class="my-account-title">
                             <div class="user-icon float-left">
                             <i class="fa fa-heart" aria-hidden="true"></i>
                             </div>                                   
                             <div class="clearfix"></div>                     
                             </div>
                             </div> -->                             
                        <div class="my-account-holder">                
                            <div class="total-cart my-account-title" data-toggle="my-cart">
                                <div class="user-icon float-left">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                </div>
                                <div class="float-left cart-link">
                                    <a id="shoppingCartTopbarCounter" href="#" style="font-size:12pt; font-weight:600"></a>
                                </div>
                                <div class="clearfix"></div>  
                                <ul id="shoppingCartTopbarList">
                                </ul>                   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php require "menu.php"; ?>
    </header>
</div>
<script>
 $(".lang-chooser-popup li a").click(function(){
     var item = $(this), lang = item.data('value');
     item.parents(".dropdown").find('.btn').html(item.text() + ' <span class="caret"></span>');
     item.parents(".dropdown").find('.btn').val(lang);
     var current = "<?php echo $scope["user"]["language"]; ?>";
     if(lang != current)
         $.getJSON("index.php?page=language&setLanguage=" + lang)
          .success(function(data) {
              //       console.log(data);
              location.reload();
          })
          .error(function(err){
              console.log('something going wrong');
          });
 });

 function search(){
     var searchForm = $("#searchForm");

     serverProcedureAnyCall("search", "searchproducts", searchForm.serialize(), function(data, error){
         if(data)
             window.location = "index.php#/?page=forms&action=search&" + searchForm.serialize();
         //location.reload();
         else
             console.log("search failed");
     });
 }

 serverProcedureAnyCall("products", "getFamilies", [], function(data){
     var _html = '', ind, families = JSON.parse(data);
     for(ind in families)
         _html += "<option value=\"" + ind + "\">" + families[ind].FamilyName + "</option>\n";

     $("#searchFamilies").html(_html);

     _html = '';
     for(ind in families)
         _html += "<li><a href=\"index.php#/?page=forms&action=products&categories=true&family=" + ind + "\">" + families[ind].FamilyName + "</a></li>"
     <?php if($scope["config"]["software"] == "Cart"): ?>
     $("#productsFamilies").html(_html);
     <?php endif; ?>
     $("#mobileMenu").html($("#desktopMenu").html());
 });

 serverProcedureAnyCall("products", "getCurrencies", [], function(data){
     var _html = '', ind, list = JSON.parse(data);
     for(ind in list)
         _html += " <li><a href=\"#\">" + list[ind].CurrencyID + "</a></li>\n";

     $("#currencyChooser").html(_html);
 });

 var registerCaptcha = "<?php echo $oscope->captchaBuilder->getPhrase(); ?>";
 $('#registerButton').click(async function(){
     var registerform = $('#registerForm');
     var requiredFields = [
         "CustomerPhone", 
         "CustomerPassword", 
         "CustomerFirstName",
         "CustomerLastName",
         "CustomerName",
         "CustomerEmail"
     ], ind, success = true;
     
     for(ind in requiredFields){
         $("input[name=" + requiredFields[ind] + "]").removeClass("has-error");
         if($("input[name=" + requiredFields[ind] + "]").val() == ""){
             $("input[name=" + requiredFields[ind] + "]").addClass("has-error");
             success = false;
         }
     }
     if($("#registerCaptcha").val() != registerCaptcha){
         $("#registerCaptcha").addClass("has-error");
         success = false;
     }else
     $("#registerCaptcha").removeClass("has-error");
     
     if(success){
         var values = await APICall("POST", `index.php?page=api&module=forms&path=AccountsReceivable/Customers/ViewCustomers&action=procedure&procedure=getNewItemAllRemote&session_id=${session_id}`, { id : ""});
         values.CustomerID = values.CustomerFirstName = $("input[name=CustomerFirstName]").val();
         values.CustomerLastName = $("input[name=CustomerLastName]").val();
         values.CustomerName = $("input[name=CustomerName]").val();
         values.CustomerEmail = $("input[name=CustomerEmail]").val();
         values.CustomerLogin = values.CustomerPhone = $("input[name=CustomerPhone]").val();
         values.CustomerPassword = $("input[name=CustomerPassword]").val();
         values.CustomerWebPage = $("input[name=CustomerWebPage]").val();
         values.CustomerAddress1 = $("input[name=CustomerAddress1]").val();
         values.CustomerAddress2 = $("input[name=CustomerAddress2]").val();
         values.CustomerAddress3 = $("input[name=CustomerAddress3]").val();
         values.CustomerCounty = $("input[name=CustomerCountry]").val();
         values.CustomerState = $("input[name=CustomerState]").val();
         values.CustomerCity = $("input[name=CustomerCity]").val();
         values.CustomerZip = $("input[name=CustomerZip]").val();
         console.log(values);
         
         await APICall("POST", `index.php?page=api&module=forms&path=AccountsReceivable/Customers/ViewCustomers&action=procedure&procedure=insertItemRemote&session_id=${session_id}`, values);
         serverProcedureAnyCall("users", "loginWithoutCaptcha", {
             username : values.CustomerLogin,
             password : values.CustomerPassword
         }, function(data, error){
             if(data)
                 location.reload();

         });
     }else{
         serverProcedureAnyCall("users", "getCaptcha", {}, function(data, error){
             document.getElementById('imgRegisterCaptcha').src = data.captcha;
             registerCaptcha = data.captchaPhrase;
         });     
     }
     return;
 });
 
 $('#loginButton').click(function(){
     var loginform = $('#loginform');
     serverProcedureAnyCall("users", "login", loginform.serialize(), function(data, error){
         if(data)
             location.reload();
         else {
             console.log(data, error);
             var res = error.responseJSON;

             if(res.wrong_user){
                 $("#captcha").addClass("has-error");
                 $("#username").addClass("has-error");
                 $("#password").addClass("has-error");
                 $("#user_wrong_message").css("display", "block");
             }else{
                 $("#username").removeClass("has-error");
                 $("#password").removeClass("has-error");
                 $("#user_wrong_message").css("display", "none");
                 $("#captcha").removeClass("has-error");
             }
             document.getElementById('imgcaptcha').src = res.captcha; 
         }
     });
     
 });

 $('#logoutButton').click(function(){
     serverProcedureAnyCall("users", "logout", undefined, function(data, error){
         if(data)
             location.reload();
         else
             console.log("login failed");
     });     
 });

 function shoppingCartRender(shoppingCart){
     var element = $("#shoppingCartTopbarList"), _html = '', itemsCounter = 0, ind, subtotal = 0,
         items = shoppingCart.items;
     for(ind in items){
         _html += "<li><div class=\"cart-img\"><a href=\"#\"><img src=\"" + linksMaker.makeItemImageLink(items[ind]) + "\" alt=\"\" /></a></div><div class=\"cart-info\"><h4><a href=\"#\">" + items[ind].ItemID + "</a></h4><span>" + formatCurrency(items[ind].Price) + " <span>x " + items[ind].counter + "</span></span></div><div onclick=\"shoppingCartRemoveItem('" + items[ind].ItemID + "');\" class=\"del-icon\"><i class=\"fa fa-minus\"></i></div><div onclick=\"shoppingCartAddItem('" + items[ind].ItemID + "');\" class=\"del-icon\"><i class=\"fa fa-plus\"></i></div></li>";
         itemsCounter++;
         subtotal += items[ind].Price * items[ind].counter;
     }
     _html += "<li><div class=\"subtotal-text\">Subtotal: </div><div class=\"subtotal-price\">" + subtotal + "</div></li><li><a href=\"#/?page=forms&action=checkout\" class=\"button float-right\">Checkout</a></li>"
     element.html(_html);

     $("#shoppingCartTopbarCounter").html(itemsCounter + " Item(s)");
 }
 
 serverProcedureAnyCall("shoppingcart", "shoppingCartGetCart", undefined, function(data, error){
     if(data)
         shoppingCartRender(JSON.parse(data));
     else
         console.log("login failed");
 });
 
 function shoppingCartCheckout(){
     console.log('checkout');
 }

 function shoppingCartAddItem(ItemID, qty){
     serverProcedureAnyCall("shoppingcart", "shoppingCartAddItem", "ItemID=" + ItemID + (typeof(qty) != 'undefined' ? "&qty=" + qty : ""), function(data, error){
         if(data){
             shoppingCartRender(JSON.parse(data));
             if(typeof shoppingCartFormRender == 'function')
                 shoppingCartFormRender(JSON.parse(data));
         }
         else
             console.log("login failed");
     });
 }
 
 function shoppingCartRemoveItem(ItemID){
     serverProcedureAnyCall("shoppingcart", "shoppingCartRemoveItem", "ItemID=" + ItemID, function(data, error){
         if(data){
             shoppingCartRender(JSON.parse(data));
             if(typeof shoppingCartFormRender == 'function')
                 shoppingCartFormRender(JSON.parse(data));
             //      location.reload();
         }else
         console.log("login failed");
     });
 }

 <?php if(!key_exists("Customer", $user)): ?>
/* serverProcedureAnyCall("users", "loginWithoutCaptcha", {
     username : "dland",
     password : "dland"
 }, function(data, error){
     if(data)
         location.reload();

 });*/
 <?php endif; ?>
</script>
