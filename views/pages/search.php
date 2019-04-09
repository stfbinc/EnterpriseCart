<?php
if(key_exists("family", $_GET))
	$items = $data->searchProducts();
    else
	$items = [];
?>
<?php if(count($items)): ?>
    <div style="padding:50px;">
	<table class="table table-responsible">
	    <thead>
		<th><?php echo $translation->translateLabel("Item"); ?></th>
		<th><?php echo $translation->translateLabel("Item ID"); ?></th>
		<th><?php echo $translation->translateLabel("Description"); ?></th>
		<th><?php echo $translation->translateLabel("Price"); ?></th>
	    </thead>
	    <tbody>
		<?php foreach($items as $item): ?>
		    <?php if($item->CartItem): ?>
			<tr>
			    <td>
				<div class="single-product">
				    <div class="product-img">
					<a href="javascript:shoppingCartAddItem('<?php echo $item->ItemID; ?>');">
					    <img class="primary-img" src="<?php echo $linksMaker->makeItemImageLink($item); ?>" alt="add to cart" />
					    <img class="secondary-img" src="<?php echo $linksMaker->makeItemImageLink($item); ?>" alt="add to cart" />
					</a>
				    </div>
				    <!-- 			<img style="width:100px; height:100px" src="<?php echo $linksMaker->makeItemImageLink($item); ?>" /> -->
				    <!-- <div class="product-action">
					 <div class="pro-button-top" style="position:relative; left:0px;">
					 <a href="javascript:shoppingCartAddItem('<?php echo $item->ItemID; ?>');">add to cart</a>
					 </div>
					 </div> -->
				</div>
			    </td>
			    <td>
				<?php echo $item->ItemID; ?>
			    </td>
			    <td>
				<?php echo $item->ItemDescription; ?>
			    </td>
			    <td>
				<?php echo formatCurrency($item->Price); ?>
			    </td>
			</tr>
		    <?php endif; ?>
		<?php endforeach; ?>
	    </tbody>
	</table>                   
    </div>
<?php else: ?>
    <div style="font-size:20pt; color:green; text-align:center;padding:20px">
	<?php echo $translation->translateLabel("Nothing found"); ?>    
    </div>
<?php endif; ?>
