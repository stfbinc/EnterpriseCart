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
        "CustomerID" => [
            "label" => "User ID"
        ],
        "CustomerPhone" => [
            "label" => "Phone"
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

    //    $cartSettings = $data->getCartSettings();
    $transactions = $data->getTransactions();
    $installations = $data->getInstallations();
?>
<div class="checkout-area" style="margin-top:50px">
    <div class="container">
        <div class="row">
            <form action="#" id="accountForm"  onsubmit="return false"> 
                <div class="col-lg-12 col-md-12">
                    <div class="checkbox-form">
                        <h3>
                            <?php echo $translation->translateLabel("Account Information"); ?>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="checkbox-form">
                        <div class="row">
                            <?php foreach($customerFieldsLeft as $fieldName=>$def): ?>
                                <div class="col-md-12">
                                    <div class="checkout-form-list" style="margin-bottom:10px">
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
                                    <div class="checkout-form-list" style="margin-bottom:10px">
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
                <div class="col-lg-12 col-md-12">
                    <div class="col-lg-9 col-md-9">
                    </div>
                    <div class="payment-method col-lg-3 col-md-3">
                        <?php if(key_exists("Customer", $user)): ?>
                            <div class="order-button-payment" style="margin-top:0px">
                                <input type="submit" id="saveButton" value="<?php echo $translation->translateLabel("Save Information"); ?>" />
                            </div>
                        <?php endif ?>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="checkbox-form">
                        <h3>
                            <?php echo $translation->translateLabel("Your Softwares"); ?>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="your-order">
                        <div class="your-order-table table-responsive">
                            <table class="table table-responsible">
                                <thead>
                                    <th><?php echo $translation->translateLabel("Software"); ?></th>
                                    <th><?php echo $translation->translateLabel("Installation Date"); ?></th>
                                    <th><?php echo $translation->translateLabel("Expiration Date"); ?></th>
                                    <th><?php echo $translation->translateLabel("Active"); ?></th>
                                </thead>
                                <tbody id="shoppingCartFormList" >
                                    <?php foreach($installations as $installation): ?>
                                        <tr>
                                            <td>
                                                <a href="<?php echo $linksMaker->makeAppLink($installation["ConfigName"]) ?>" style="color:blue;" target="_blank"><?php echo $installation["SoftwareID"]; ?></a>
                                            </td>
                                            <td>
                                                <?php echo formatDate($installation["InstallationDate"]); ?>
                                            </td>
                                            <td>
                                                <?php echo formatDate($installation["ExpirationDate"]); ?>
                                            </td>
                                            <td>
                                                <?php echo $installation["Active"] ? "ON" : "OFF"; ?>
                                            </td>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>                   
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="checkbox-form">
                        <h3>
                            <?php echo $translation->translateLabel("Your Orders"); ?>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="your-order">
                        <div class="your-order-table table-responsive">
                            <table class="table table-responsible">
                                <thead>
                                    <th><?php echo $translation->translateLabel("Tracking #"); ?></th>
                                    <th><?php echo $translation->translateLabel("Order Number"); ?></th>
                                    <th><?php echo $translation->translateLabel("Order Date"); ?></th>
                                    <th><?php echo $translation->translateLabel("Ship Date"); ?></th>
                                    <th><?php echo $translation->translateLabel("Status"); ?></th>
                                    <th><?php echo $translation->translateLabel("Total"); ?></th>
                                </thead>
                                <tbody id="shoppingCartFormList" >
                                    <?php foreach($transactions as $transaction): ?>
                                        <tr>
                                            <td>
                                                <a href="<?php echo $linksMaker->makeEnterpriseXDocreportsLink("order", $transaction->OrderNumber) ?>" style="color:blue;" target="_blank"><?php echo $transaction->TrackingNumber ? $transaction->TrackingNumber : $transaction->OrderNumber; ?></a>
                                            </td>
                                            <td>
                                                <?php echo $transaction->OrderNumber; ?>
                                            </td>
                                            <td>
                                                <?php echo formatDate($transaction->OrderDate); ?>
                                            </td>
                                            <td>
                                                <?php echo formatDate($transaction->ShipDate); ?>
                                            </td>
                                            <td>
                                                <?php echo $translation->translateLabel("Pending"); ?>
                                            </td>
                                            <td>
                                                <?php echo formatCurrency($transaction->Total); ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>                   
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
 <?php if(key_exists("Customer", $user)): ?>
 $("#saveButton").click(function(){
     console.log("saved");
     //var form = $("#checkoutForm");
     serverEnterpriseXProcedureAnyCall("AccountsReceivable/Customers/ViewCustomers", "getEditItemRemote", { id : "<?php echo $linksMaker->makeEnterpriseXKeyString() . '__' . $user["Customer"]->CustomerID; ?>", type : "Main"}, function(data, error){
         var values = JSON.parse(data);
         //  values.CustomerID = "<?php echo $user["Customer"]->CustomerID; ?>";
         values.CustomerFirstName = $("input[name=CustomerFirstName]").val();
         values.CustomerLastName = $("input[name=CustomerLastName]").val();
         values.CustomerName = $("input[name=CustomerName]").val();
         values.CustomerEmail = $("input[name=CustomerEmail]").val();
         values.CustomerPhone = $("input[name=CustomerPhone]").val();
         values.CustomerWebPage = $("input[name=CustomerWebPage]").val();
         values.CustomerAddress1 = $("input[name=CustomerAddress1]").val();
         values.CustomerAddress2 = $("input[name=CustomerAddress2]").val();
         values.CustomerAddress3 = $("input[name=CustomerAddress3]").val();
         values.CustomerCounty = $("input[name=CustomerCountry]").val();
         values.CustomerState = $("input[name=CustomerState]").val();
         values.CustomerCity = $("input[name=CustomerCity]").val();
         values.CustomerZip = $("input[name=CustomerZip]").val();
         console.log(values);
         
         //updating customer information
         values.id = "<?php echo $linksMaker->makeEnterpriseXKeyString() . '__' . $user["Customer"]->CustomerID; ?>";
         values.type = "Main";
         serverEnterpriseXProcedureAnyCall("AccountsReceivable/Customers/ViewCustomers", "updateItemRemote", values, function(data, error){
             serverProcedureAnyCall("users", "sessionUpdate", {}, function(data, error){
                 onlocation(window.location);
             });
             //      window.location = "index.php#/?page=forms&action=account";
             //console.log(data, error);
         });
     });
 });
 <?php endif; ?> 
</script>
