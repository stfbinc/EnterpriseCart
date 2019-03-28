<div id="shoppingCartFormList" class="row">
</div>                   

<script>
 function shoppingCartFormRender(shoppingCart){
     var element = $("#shoppingCartFormList"), _html = '', itemsCounter = 0, ind, subtotal = 0,
	 items = shoppingCart.items;
     for(ind in items){
	 _html += "<div class=\"col-md-4\"><div class=\"cart-img\"><a href=\"#\"><img src=\"" + linksMaker.makeItemImageLink(items[ind]) + "\" alt=\"\" /></a></div><div class=\"cart-info\"><h4><a href=\"#\">" + items[ind].ItemID + "</a></h4><span>" + items[ind].Price + " <span>x " + items[ind].counter + "</span></span></div><div onclick=\"shoppingCartRemoveItem('" + items[ind].ItemID + "');\" class=\"del-icon\"><i class=\"fa fa-minus\"></i></div><div onclick=\"shoppingCartAddItem('" + items[ind].ItemID + "');\" class=\"del-icon\"><i class=\"fa fa-plus\"></i></div></div>";
	 itemsCounter++;
	 subtotal += items[ind].Price * items[ind].counter;
     }
     _html += "<div class=\"subtotal-text\">Subtotal: </div><div class=\"subtotal-price\">" + subtotal + "</div><a href=\"javascript:shoppingCartCheckout();\" class=\"btn button float-right\">Checkout</a>"
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
