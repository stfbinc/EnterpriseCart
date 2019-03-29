<?php
    $items = $data->searchProducts();
?>
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
	    <tr>
		<td>
		    <img style="width:100px; height:100px" src="<?php echo $linksMaker->makeItemImageLink($item); ?>" />
		</td>
		<td>
		    <?php echo $item->ItemID; ?>
		</td>
		<td>
		    <?php echo $item->ItemDescription; ?>
		</td>
		<td>
		    <?php echo $item->Price; ?>
		</td>
	    </tr>
	<?php endforeach; ?>
    </tbody>
</table>                   
</div>
