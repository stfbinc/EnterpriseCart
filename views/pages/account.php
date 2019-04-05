<?php $transactions = $data->getTransactions() ?>
<div class="checkout-area" style="margin-top:50px">
    <div class="container">
        <div class="row">
            <form action="#" id="accountForm"  onsubmit="return false">
		<div class="col-lg-12 col-md-12">
		    <div class="your-order">
			<h3>
			    <?php echo $translation->translateLabel("Your Orders"); ?></h3>
			<div class="your-order-table table-responsive">
			    <table class="table table-responsible">
				<thead>
				    <th><?php echo $translation->translateLabel("Tracking #"); ?></th>
				    <th><?php echo $translation->translateLabel("Order Date"); ?></th>
				    <th><?php echo $translation->translateLabel("Ship Date"); ?></th>
				    <th><?php echo $translation->translateLabel("Status"); ?></th>
				    <th><?php echo $translation->translateLabel("Total"); ?></th>
				</thead>
				<tbody id="shoppingCartFormList" >
				    <?php foreach($transactions as $transaction): ?>
					<tr>
					    <td>
						<a href="<?php echo $linksMaker->makeEnterpriseXDocreportsLink("order", $transaction->OrderNumber) ?>" style="color:blue;" target="_blank"><?php echo $transaction->OrderNumber; ?></a>
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
