<?php
	// View file to show reports from EnterpiseUniversalAPI

	$transactions = $data->getCustomerOrder();
	$content = isset($_GET['content']) ? $_GET['content']: '' ;
    //$orders = $data->getCustomerOrder();
?>
    <div class="checkout-area" style="margin-top:50px">
    <div class="container">

    	<?php 
    	// Reports to show for customerstatements
    	
    	if($content == 'customerstatements' ) { ?>
	    <div class="row">
    		<div class="col-lg-12 col-md-12">
                <div class="checkbox-form">
                    <h3>
                        <?php echo $translation->translateLabel("Your Statements"); ?>
                    </h3>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
        		<table class="table table-responsible">
                    <thead>
                        <th><?php echo $translation->translateLabel("Customer ID"); ?></th>
                    </thead>
                    <tbody id="shoppingCartFormList" >
                    	<?php foreach($transactions as $transaction): ?>
                            <tr>
                                <td>
                                	<!-- Link to get CustomerStatements report, type is customerstatements -->

                                    <a href="<?php echo $linksMaker->makeEnterpriseXDocreportsLink("customerstatements", $transaction->CustomerID) ?>" style="color:blue;" target="_blank"><?php echo $transaction->CustomerID ? $transaction->CustomerID : $transaction->OrderNumber; ?></a>
                                </td>
                            </tr>
                        <?php 

                        break;
                		endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php } ?>
        <?php 
        // Reports to show for Invoices

        if($content == 'invoices' ) { ?>
        <div class="row">
    		<div class="col-lg-12 col-md-12">
                <div class="checkbox-form">
                    <h3>
                        <?php echo $translation->translateLabel("Your Invoices"); ?>
                    </h3>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
        		<table class="table table-responsible">
                    <thead>
                        <th><?php echo $translation->translateLabel("Invoice No"); ?></th>
                        <th><?php echo $translation->translateLabel("Order Number"); ?></th>
                        <th><?php echo $translation->translateLabel("Order Date"); ?></th>
                    </thead>
                    <tbody id="shoppingCartFormList" >
                    	<?php foreach($transactions as $transaction): 
                    		if($transaction->InvoiceNumber && $transaction->Invoiced) {
                    		?>
                            <tr>
                                <td>
                                	<!-- Link to get Invoice report, type is invoice -->

                                    <a href="<?php echo $linksMaker->makeEnterpriseXDocreportsLink("invoice", $transaction->InvoiceNumber) ?>" style="color:blue;" target="_blank"><?php echo $transaction->InvoiceNumber ? $transaction->InvoiceNumber : ''; ?></a>
                                </td>
                                 <td>
	                                <?php echo formatDate($transaction->OrderDate); ?>
	                            </td>
	                            <td>
	                                <?php echo formatDate($transaction->ShipDate); ?>
	                            </td>
                            </tr>
                        	<?php 
                        	}
                		endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php } ?>

        <?php
        // Reports to show for Quotes

        if($content == 'quotes' ) { ?>
        <div class="row">
    		<div class="col-lg-12 col-md-12">
                <div class="checkbox-form">
                    <h3>
                        <?php echo $translation->translateLabel("Your Quotes"); ?>
                    </h3>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
        		<table class="table table-responsible">
                    <thead>
                        <th><?php echo $translation->translateLabel("Quote No"); ?></th>
                        <th><?php echo $translation->translateLabel("Order Number"); ?></th>
                        <th><?php echo $translation->translateLabel("Order Date"); ?></th>
                    </thead>
                    <tbody id="shoppingCartFormList" >
                    	<?php foreach($transactions as $transaction): 

                    			if($transaction->TransactionTypeID == 'Quote') {


                		?>
                            <tr>
                                <td>
                                	<!-- Link to get Quote report, type is quote -->
                                    <a href="<?php echo $linksMaker->makeEnterpriseXDocreportsLink("quote", $transaction->OrderNumber) ?>" style="color:blue;" target="_blank"><?php echo $transaction->OrderNumber ? $transaction->OrderNumber : ''; ?></a>
                                </td>
                                 <td>
	                                <?php echo formatDate($transaction->OrderDate); ?>
	                            </td>
	                            <td>
	                                <?php echo formatDate($transaction->ShipDate); ?>
	                            </td>
                            </tr>
                        <?php 
                        }
                		endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php } ?>

        <?php
        // Reports to show for Orders, This will be the default report.

        if($content == 'orders' || $content == '') { ?>	
        <div class="row">
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
                                        		<!-- Link to get order report, type is order -->
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
        </div>
    <?php } ?>
    </div>
</div>
