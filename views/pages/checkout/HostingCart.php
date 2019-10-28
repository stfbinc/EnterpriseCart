<?php
    $shipToFields = $billToFields = [
        /* "login" => [
           "label" => "login"
           ],*/
        "CustomerName" => [
            "label" => "Company Name"
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
                            <?php echo $translation->translateLabel("Company Info"); ?>
                        </h3>
                        <div class="row">
                            <?php foreach($billToFields as $fieldName=>$def): ?>
                                <div class="col-md-12">
                                    <div class="checkout-form-list" style="margin-bottom:10px">
                                        <label>
                                            <?php echo $translation->translateLabel($def["label"]);  ?>
                                        </label>
                                        <input type="text" name="bill<?php echo $fieldName; ?>" placeholder="" value="<?php echo (key_exists("Customer", $user) ? $user["Customer"]->$fieldName : ""); ?>" />
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
                            <table class="table table-responsible">
                                <thead>
                                    <th><?php echo $translation->translateLabel("Item ID"); ?></th>
                                    <th><?php echo $translation->translateLabel("Item Name"); ?></th>
                                    <th><?php echo $translation->translateLabel("Description"); ?></th>
                                    <th><?php echo $translation->translateLabel("Quantity"); ?></th>
                                    <th><?php echo $translation->translateLabel("Price"); ?></th>
                                    <th><?php echo $translation->translateLabel("Amount"); ?></th>
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
                            <?php if(key_exists("Customer", $user)): ?>
                                <div class="order-button-payment" style="margin-top:100px">
                                    <input type="submit" id="processorder" value="<?php echo $translation->translateLabel("Process Order"); ?>" />
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
 $("#confirmButton").click(     function(){
     //var form = $("#checkoutForm");
     serverEnterpriseXProcedureAnyCall("AccountsReceivable/OrderScreens/ViewOrders", "getNewItemAllRemote", { id : '', type : "...fields"}, function(data, error){
         var values = JSON.parse(data);
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
         var customer = values;
         //creating order header
         serverEnterpriseXProcedureAnyCall("AccountsReceivable/OrderScreens/ViewOrders", "insertItemRemote", values, function(data, error){
             var OrderHeader = JSON.parse(data);
             //getting template data for order detail
             serverEnterpriseXProcedureAnyCall("AccountsReceivable/OrderProcessing/ViewOrdersDetail", "getNewItemAllRemote", { id : '', type : "...fields"}, function(data, error){
                 var ind, values = JSON.parse(data), orderDetails = [], orderDetail, items = checkoutItems.items;
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
                 serverEnterpriseXProcedureAnyCall("AccountsReceivable/OrderProcessing/ViewOrdersDetail", "insertItemsRemote", orderDetails, function(data, error){
                     //values = JSON.parse(data);
                     //recalculation order header
                     serverEnterpriseXProcedureAnyCall("AccountsReceivable/OrderScreens/ViewOrders", "Recalc", { OrderNumber : OrderHeader.OrderNumber }, function(data, error){
                         $("#processorder").val("<?php echo $translation->translateLabel("Print"); ?>");
                         $("#processorder").off("click");
                         $("#processorder").click(function(){
                             Object.assign(document.createElement('a'), { target: '_blank', href: linksMaker.makeEnterpriseXDocreportsLink("order", OrderHeader.OrderNumber)}).click();
                         });
                         Object.assign(document.createElement('a'), { target: '_blank', href: linksMaker.makeEnterpriseXDocreportsLink("order", OrderHeader.OrderNumber)}).click();
                         serverEnterpriseXProcedureAnyCall("SystemSetup/Admin/AppInstallations", "CreateInstallation", {
                             customer : customer,
                             items : checkoutItems.items
                         }, function(data, error){
                             serverProcedureAnyCall("shoppingcart", "shoppingCartClean", undefined, function(cdata, error){
                                 window.location = "index.php#/?page=forms&action=account";
                                 console.log(data)
                             });
                         }, true);
                         //console.log(data, error);
                     });
                     //createinstallation
                 }, true);
             });
         });
     });
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
         _html += "<td>" + items[ind].ItemID + "</td>";
         _html += "<td>" + items[ind].ItemName + "</td>";
         _html += "<td>" + items[ind].ItemDescription + "</td>";
         _html += "<td>" + items[ind].counter + "</td>";
         _html += "<td>" + formatCurrency(items[ind].Price) + "</td>";
         _html += "<td>" + formatCurrency(items[ind].Price * items[ind].counter) + "</td></tr>";
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
