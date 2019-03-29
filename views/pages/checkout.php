<?php
    $shipToFields = $billToFields = [
	/*	"login" => [
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
?>
<?php if(!key_exists("Customer", $user)): ?>
    <div style="font-size:20pt; color:red; text-align:center;padding:20px">
	<?php echo $translation->translateLabel("You should login to check out the cart"); ?>    
    </div>
<?php endif; ?>
<div class="checkout-area" style="margin-top:50px">
    <div class="container">
        <div class="row">
            <form action="#" id="shipbillForm">
                <div class="col-lg-2 col-md-2">
                    <div class="checkbox-form">
                        <h3>
                            <?php echo $translation->translateLabel("Bill To"); ?>
			</h3>
                        <div class="row">
			    <?php foreach($billToFields as $fieldName=>$def): ?>
				<div class="col-md-12">
                                    <div class="checkout-form-list">
					<label>
                                            <?php echo $translation->translateLabel($def["label"]);  ?>
					</label>
					<input type="text" name="bill<?php echo $fieldName; ?>" placeholder="" value="<?php echo (key_exists("Customer", $user) ? $user["Customer"]->$fieldName : ""); ?>" />
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
                <div class="col-lg-2 col-md-2">
                    <div class="checkbox-form">
                        <h3>
                            <?php echo $translation->translateLabel("Ship To"); ?></h3>
                        <div class="row">
			    <?php foreach($billToFields as $fieldName=>$def): ?>
				<div class="col-md-12">
                                    <div class="checkout-form-list">
					<label>
                                            <?php echo $translation->translateLabel($def["label"]);  ?>
					</label>
					<input type="text" name="ship<?php echo $fieldName; ?>" placeholder="" />
                                    </div>
				</div>
			    <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
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
                            <div class="country-select">
                                <label>
                                    <?php echo $translation->translateLabel("Payment Method"); ?> <!--  <span class="required">*</span></label> -->
				</label>
                                <select name="PaymentMethod">
				    <option value="volvo">bangladesh</option>
                                </select>
                            </div>
                            <div class="country-select">
                                <label>
                                    <?php echo $translation->translateLabel("Payment Method"); ?>
				</label>
                                <select name="ShipVia">
                                    <option value="volvo">bangladesh</option>
                                </select>
                            </div>
                            <div class="order-button-payment">
                                <input type="submit" value="<?php echo $translation->translateLabel("Process Order"); ?>" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div style="padding:50px">
    <div class="row">
	<button onclick="shoppingCartCheckout();" class="btn btn-success float-right"><?php echo $translation->translateLabel("Checkout"); ?></button>
    </div>
</div>
<script>
 function shoppingCartFormRender(shoppingCart){
     var element = $("#shoppingCartFormList"), _html = '', itemsCounter = 0, ind, subtotal = 0,
	 items = shoppingCart.items;
     
     for(ind in items){
	 _html += "<tr>";
	 _html += "<td>" + items[ind].ItemID + "</td>";
	 _html += "<td>" + items[ind].ItemName + "</td>";
	 _html += "<td>" + items[ind].ItemDescription + "</td>";
	 _html += "<td>" + items[ind].ItemID + "</td>";
	 _html += "<td>" + items[ind].counter + "</td>";
	 _html += "<td>" + items[ind].Price + "</td>";
	 _html += "<td>" + items[ind].ItemID + "</td>";
	 _html += "<td>" + items[ind].Price * items[ind].counter + "</td></tr>";
	 itemsCounter++;
	 subtotal += items[ind].Price * items[ind].counter;
     }
     //     _html += "<tr><td></td><td><div class=\"subtotal-text\">Subtotal: </div><div class=\"subtotal-price\">" + subtotal + "</div></td><td></td></tr>";
     element.html(_html);
     $("#subtotal").html('$' + subtotal);
     $("#taxtotal").html('$0');
     $("#grandtotal").html('$' + subtotal);

     $("#shoppingCartTopbarCounter").html(itemsCounter + " Item(s)");
 }

 serverProcedureAnyCall("shoppingcart", "shoppingCartGetCart", undefined, function(data, error){
     if(data)
	 shoppingCartFormRender(JSON.parse(data));
     else
	 console.log("login failed");
 });
</script>
