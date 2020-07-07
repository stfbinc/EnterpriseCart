<?php
    $shipToFields = $billToFields = [
        /* "login" => [
           "label" => "login"
           ],*/
        "CustomerName" => [
            "label" => "Company Name"
        ],
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

    $paymentMethods = $data->getPaymentMethods();
    $shipMethods = $data->getShipMethods();
    $cartSettings = $data->getCartSettings();
?>
<div id="confirmDialog" class="modal fade  bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm modal-dialog-center" style="width:400px;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <?php echo $translation->translateLabel("Please confirm your action"); ?>
                </h4>
            </div>
            <div class="modal-body">
                <h3 style="text-align:center" id="confirmFormText">
                    <?php echo $translation->translateLabel("Are you sure you want to process order?"); ?>
                </h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="confirmButton">
                    <?php echo $translation->translateLabel("Process"); ?>
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <?php echo $translation->translateLabel("Cancel"); ?>
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php if(!key_exists("Customer", $user)): ?>
    <div style="font-size:20pt; color:red; text-align:center;padding:20px">
        <?php echo $translation->translateLabel("You should login to check out the cart"); ?>    
    </div>
<?php endif; ?>
<div class="checkout-area" style="margin-top:50px">
    <div class="container">
        <div class="row">
            <form action="#" id="checkoutForm"  onsubmit="return false">
                <div class="col-lg-6 col-md-6">
                    <div class="checkbox-form">
                        <h3>
                            <?php echo $translation->translateLabel("Bill To"); ?>
                        </h3>
                        <div class="row">
                            <?php foreach($billToFields as $fieldName=>$def): ?>
                                <div class="col-md-12">
                                    <div class="checkout-form-list" style="padding-bottom:5px">
                                        <div  class="col-md-4">
                                            <label>
                                                <?php echo $translation->translateLabel($def["label"]);  ?>
                                            </label>
                                        </div>
                                        <div class="col-md-8" >
                                            <input type="text" style="height:30px" name="bill<?php echo $fieldName; ?>" placeholder="" value="<?php echo (key_exists("Customer", $user) ? $user["Customer"]->$fieldName : ""); ?>" />
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="checkout-form-list create-acc">
                        <input name="asShipTo" type="checkbox" />
                        <label>
                            <?php echo $translation->translateLabel("Use As 'Ship To'"); ?></label>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="checkbox-form">
                        <h3>
                            <?php echo $translation->translateLabel("Ship To"); ?></h3>
                        <div class="row">
                            <?php foreach($shipToFields as $fieldName=>$def): ?>
                                <div class="col-md-12">
                                    <div class="checkout-form-list" style="padding-bottom:5px">
                                        <div  class="col-md-4" >
                                            <label>
                                                <?php echo $translation->translateLabel($def["label"]);  ?>
                                            </label>
                                        </div>
                                        <div  class="col-md-8" >
                                            <input type="text" style="height:30px" name="ship<?php echo $fieldName; ?>" placeholder="" value="<?php echo (key_exists("Customer", $user) ? $user["Customer"]->$fieldName : ""); ?>" />
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="your-order">
                        <h3>
                            <?php echo $translation->translateLabel("Your Order"); ?></h3>
                        <div class="your-order-table table-responsive">
                            <table class="table table-responsible checkout-items-table">
                                <thead>
                                    <!-- <th style="text-align:left"><?php echo $translation->translateLabel("Item ID"); ?></th> -->
                                    <th style="text-align:left"><?php echo $translation->translateLabel("Item Name"); ?></th>
                                    <th style="text-align:left"><?php echo $translation->translateLabel("Description"); ?></th>
                                    <th style="text-align:left"><?php echo $translation->translateLabel("Long Description"); ?></th>

                                    <th style="text-align:left; width:5%"><?php echo $translation->translateLabel("Quantity"); ?></th>
                                    <th style="text-align:left; width:5%"><?php echo $translation->translateLabel("Price"); ?></th>
                                    <th style="text-align:left; width:5%"><?php echo $translation->translateLabel("Amount"); ?></th>
                                </thead>
                                <tbody id="shoppingCartFormList" >
                                    <tr>
                                        <td>
                                        </td>
                                        <td id="shoppingCartSubtotal">
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>                   
                            <table>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <th>
                                            <?php echo $translation->translateLabel("Subtotal"); ?>
                                        </th>
                                        <td>
                                            <span class="amount" id="subtotal">$0.00</span>
                                        </td>
                                    </tr>
                                    <tr class="cart-subtotal">
                                        <th>
                                            <?php echo $translation->translateLabel("Total tax"); ?>
                                        </th>
                                        <td>
                                            <span class="amount" id="taxtotal">$0.00</span>
                                        </td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>
                                            <?php echo $translation->translateLabel("Grand Total"); ?>
                                        </th>
                                        <td>
                                            <strong><span class="amount" id="grandtotal">$0.00</span></strong>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="payment-method">
                            <div class="country-select">
                                <label>
                                    <?php echo $translation->translateLabel("Payment Method"); ?> <!--  <span class="required">*</span></label> -->
                                </label>
                                <select name="PaymentMethod">
                                    <?php foreach($paymentMethods as $paymentName=>$def): ?>
                                        <?php if(property_exists($cartSettings, $paymentName) && $cartSettings->$paymentName): ?>
                                            <option value="<?php echo $def->value ?>"><?php echo $def->title ?></option>
                                        <?php endif;  ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="country-select">
                                <label>
                                    <?php echo $translation->translateLabel("Shipment Method"); ?>
                                </label>
                                <select name="ShipMethod">
                                    <?php foreach($shipMethods as $shipName=>$def): ?>
                                        <option value="<?php echo $def->value ?>"><?php echo $def->title ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?php if(key_exists("Customer", $user)): ?>
                                <div class="order-button-payment" style="margin-top:100px">
                                    <input type="submit" id="processorder" value="<?php echo $translation->translateLabel("Process Order"); ?>" style="font-size:18pt" />
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
 var checkoutSubtotal = 0,
     checkoutItems;
 <?php if(key_exists("Customer", $user)): ?>
 $("#confirmButton").click(async function(){
     //var form = $("#checkoutForm");
     var values = await APICall("POST", `index.php?page=api&module=forms&path=AccountsReceivable/OrderScreens/ViewOrders&action=procedure&procedure=getNewItemAllRemote&session_id=${session_id}`, {
         id : "",                                                                                                                    type : "..fields"
     });
     values.CustomerID = "<?php echo $user["Customer"]->CustomerID; ?>";
     values.ShippingName = $("input[name=shipCustomerName]").val();
     values.ShippingAddress1 = $("input[name=shipCustomerAddress1]").val();
     values.ShippingAddress2 = $("input[name=shipCustomerAddress2]").val();
     values.ShippingAddress3 = $("input[name=shipCustomerAddress3]").val();
     values.ShippingCounty = $("input[name=shipCustomerCountry]").val();
     values.ShippingState = $("input[name=shipCustomerState]").val();
     values.ShippingCity = $("input[name=shipCustomerCity]").val();
     values.ShippingZip = $("input[name=shipCustomerZip]").val();
     values.ShipMethodID = $("input[name=ShipMethod]").val();
     values.PaymentMethodID = $("input[name=PaymentMethod]").val();
     values.Subtotal = values.Total = values.BalanceDue = values.TaxableSubTotal = checkoutSubtotal;
     //creating order header
     var OrderHeader = await APICall("POST", `index.php?page=api&module=forms&path=AccountsReceivable/OrderScreens/ViewOrders&action=procedure&procedure=insertItemRemote&session_id=${session_id}`, values);
     //getting template data for order detail
     var values = await APICall("POST", `index.php?page=api&module=forms&path=AccountsReceivable/OrderProcessing/ViewOrdersDetail&action=procedure&procedure=getNewItemAllRemote&session_id=${session_id}`, {
         id : "",                                                                                                                    type : "..fields"
     });
     var ind, orderDetails = [], orderDetail, items = checkoutItems.items;
     for(ind in items){
         orderDetail = Object.assign({}, values);
         orderDetail.ItemID = items[ind].ItemID;
         //       console.log(items[ind].ItemID);
         orderDetail.OrderNumber = OrderHeader.OrderNumber;
         orderDetail.OrderQty = items[ind].counter;
         orderDetail.Description = items[ind].ItemDescription;
         orderDetail.ItemCost = orderDetail.ItemUnitPrice = items[ind].Price;
         orderDetails.push(orderDetail);
     }
     //      console.log(JSON.stringify(orderDetails, null, 3));
     //creating order detail records
     var OrderDetails = await APICall("POST", `index.php?page=api&module=forms&path=AccountsReceivable/OrderProcessing/ViewOrdersDetail&action=procedure&procedure=insertItemsRemote&session_id=${session_id}`, orderDetails);
     //values = JSON.parse(data);
     //recalculation order header
     await APICall("POST", `index.php?page=api&module=forms&path=AccountsReceivable/OrderScreens/ViewOrders&action=procedure&procedure=Recalc&session_id=${session_id}`, { OrderNumber : OrderHeader.OrderNumber});
     $("#processorder").val("<?php echo $translation->translateLabel("Print"); ?>");
     $("#processorder").off("click");
     $("#processorder").click(function(){
         Object.assign(document.createElement('a'), { target: '_blank', href: linksMaker.makeEnterpriseXDocreportsLink("order", OrderHeader.OrderNumber)}).click();
     });
     Object.assign(document.createElement('a'), { target: '_blank', href: linksMaker.makeEnterpriseXDocreportsLink("order", OrderHeader.OrderNumber)}).click();
     window.location = "index.php#/?page=forms&action=account";
     //console.log(data, error);
 });
 $("#processorder").click(function(){
     $('#confirmDialog').modal('show');
 });
 <?php endif; ?> 
 function shoppingCartFormRender(shoppingCart){
     var element = $("#shoppingCartFormList"), _html = '', itemsCounter = 0, ind, subtotal = 0,
         items = shoppingCart.items;
     
     for(ind in items){
         _html += "<tr>";
         //         _html += "<td style=\"text-align:left;\">" + items[ind].ItemID + "</td>";
         _html += "<td style=\"text-align:left;\">" + items[ind].ItemName + "</td>";
         _html += "<td style=\"text-align:left;\">" + items[ind].ItemDescription + "</td>";
         _html += "<td style=\"text-align:left;\">" + items[ind].ItemLongDescription + "</td>";
         _html += "<td style=\"text-align:right;\">" + items[ind].counter + "</td>";
         _html += "<td style=\"text-align:right;\">" + formatCurrency(items[ind].Price) + "</td>";
         _html += "<td style=\"text-align:right;\">" + formatCurrency(items[ind].Price * items[ind].counter) + "</td></tr>";
         itemsCounter++;
         subtotal += items[ind].Price * items[ind].counter;
     }
     //     _html += "<tr><td></td><td><div class=\"subtotal-text\">Subtotal: </div><div class=\"subtotal-price\">" + subtotal + "</div></td><td></td></tr>";
     element.html(_html);
     $("#subtotal").html('$' + formatCurrency(subtotal));
     $("#taxtotal").html('$0');
     $("#grandtotal").html('$' + formatCurrency(subtotal));
     checkoutSubtotal = subtotal;

     $("#shoppingCartTopbarCounter").html(itemsCounter + " Item(s)");
 }

 serverProcedureAnyCall("shoppingcart", "shoppingCartGetCart", undefined, function(data, error){
     if(data)
         shoppingCartFormRender(checkoutItems = JSON.parse(data));
     else
         console.log("login failed");
 });
</script>
