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
                                    <div class="checkout-form-list"  style="padding-bottom:5px">
                                        <div  class="col-md-4">
                                            <label>
                                                <?php echo $translation->translateLabel($def["label"]);  ?>
                                            </label>
                                        </div>
                                        <div  class="col-md-8">
                                            <input type="text" style="height:30px" name="<?php echo $fieldName; ?>" placeholder="" value="<?php echo (key_exists("Customer", $user) ? $user["Customer"]->$fieldName : ""); ?>" />
                                        </div>
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
                                    <div class="checkout-form-list" style="padding-bottom:5px">
                                        <div  class="col-md-4">
                                            <label>
                                                <?php echo $translation->translateLabel($def["label"]);  ?>
                                            </label>
                                        </div>
                                        <div  class="col-md-8">
                                            <input type="text" style="height:30px" name="<?php echo $fieldName; ?>" placeholder="" value="<?php echo (key_exists("Customer", $user) ? $user["Customer"]->$fieldName : ""); ?>" />
                                        </div>
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
 $("#saveButton").click(async function(){
     console.log("saved");
     //var form = $("#checkoutForm");
     console.log("<?php echo $linksMaker->makeEnterpriseXKeyString() . '__' . $user["Customer"]->CustomerID; ?>");
     var values = await APICall("GET", `index.php?page=api&module=forms&path=AccountsReceivable/Customers/ViewCustomers&action=get&session_id=${session_id}` + "&id=<?php echo $linksMaker->makeEnterpriseXKeyString() . '__' . $user["Customer"]->CustomerID; ?>", {});
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
     await APICall("POST", `index.php?page=api&module=forms&path=AccountsReceivable/Customers/ViewCustomers&action=update&session_id=${session_id}` + "&id=" + values.id, values);
     serverProcedureAnyCall("users", "sessionUpdate", {}, function(data, error){
         onlocation(window.location);
     });
     //      window.location = "index.php#/?page=forms&action=account";
     //console.log(data, error);
 });
 <?php endif; ?> 
</script>
