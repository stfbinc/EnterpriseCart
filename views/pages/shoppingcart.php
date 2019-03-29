<div style="padding:50px">
    <table class="table table-responsible">
	<thead>
	    <th><?php echo $translation->translateLabel("Item");?></th>
	    <th><?php echo $translation->translateLabel("Item ID");?></th>
	    <th><?php echo $translation->translateLabel("Price");?></th>
	    <th><?php echo $translation->translateLabel("Quantity");?></th>
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
    <div class="row">
	<a href="#/?page=forms&action=checkout" class="btn btn-success float-right"><?php echo $translation->translateLabel("Checkout"); ?></a>
    </div>
</div>
<script>
 function shoppingCartFormRender(shoppingCart){
     var element = $("#shoppingCartFormList"), _html = '', itemsCounter = 0, ind, subtotal = 0,
	 items = shoppingCart.items;
     
     for(ind in items){
	 _html += "<tr>";
	 _html += "<td><a href=\"#\"><img style=\"width:100px; height:100px\" src=\"" + linksMaker.makeItemImageLink(items[ind]) + "\" alt=\"\" /></a></td>";
	 _html += "<td>" + items[ind].ItemID + "</td>";
	 _html += "<td>" + formatCurrency(items[ind].Price) + "</td>";
	 _html += "<td><span onclick=\"shoppingCartRemoveItem('" + items[ind].ItemID + "');\" class=\"del-icon\"><i class=\"fa fa-minus\"></i></span><span style=\"font-size:14pt; color:black; padding: 5px\">" + items[ind].counter + "</span><span onclick=\"shoppingCartAddItem('" + items[ind].ItemID + "');\" class=\"del-icon\"><i class=\"fa fa-plus\"></i></span></td></tr>";
	 itemsCounter++;
	 subtotal += items[ind].Price * items[ind].counter;
     }
     _html += "<tr><td></td><td><div class=\"subtotal-text\">Subtotal: </div><div class=\"subtotal-price\">" + formatCurrency(subtotal) + "</div></td><td></td></tr>";
     element.html(_html);

     $("#shoppingCartTopbarCounter").html(itemsCounter + " Item(s)");
 }

 serverProcedureAnyCall("shoppingcart", "shoppingCartGetCart", undefined, function(data, error){
     if(data)
	 shoppingCartFormRender(JSON.parse(data));
     else
	 console.log("login failed");
 });
</script>
