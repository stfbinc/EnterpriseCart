<?php
    $session_id = Session::get("session_id");
    $apiResult = API_request("page=api&module=forms&path=API/Reports/Doc&action=procedure&procedure=geDocReportsData&type={$_GET["type"]}&id={$_GET["id"]}&session_id=$session_id", "GET", null)["response"];
    $headerData = json_decode(json_encode($apiResult->header), true);
    $detailData = json_decode(json_encode($apiResult->detail), true);
    $user = json_decode(json_encode($apiResult->user), true);
    $currencySymbol = $apiResult->currencySymbol;
    //echo json_encode($headerData);
    //echo "<br/><br/>";
    //echo json_encode($detailData);
    //return;
    //echo json_encode($user);
    $numberTitlesByType = [
	"purchaseorder" => "Purchase"
    ];
    $titlesByType = [
	"invoice" => "Invoice",
	"invoicehistory" => "Invoice",
	"order" => "Order",
	"orderpick" => "Order",
	"orderhistory" => "Order",
	"quote" => "Quote",
	"serviceorder" => "Service Order",
	"serviceorderhistory" => "Service Order",
	"serviceinvoice" => "Service Invoice",
	"serviceinvoicehistory" => "Service Invoice",
	"creditmemo" => "Credit Memo",
	"creditmemohistory" => "Credit Memo",
	"purchaseorder" => "Purchase Order",
	"debitmemo" => "Debit Memo",
	"debitmemohistory" => "Debit Memo",
	"rmaorder" => "RMA",
	"returninvoice" => "Return",
	"receiving" => "Receiving"
    ];
    $fieldsByType = [
	"debitmemo" => [
	    "InvoiceDate" => "PurchaseDate",
	    "InvoiceNumber" => "PurchaseNumber",
	],
	"purchaseorder" => [
	    "InvoiceDate" => "PurchaseDate",
	    "InvoiceNumber" => "PurchaseNumber",
	    "CustomerName" => "VendorName",
	    "CustomerAddress1" => "VendorAddress1",
	    "CustomerAddress2" => "VendorAddress2",
	    "CustomerAddress3" => "VendorAddress3",
	    "CustomerCity" => "VendorCity",
	    "CustomerState" => "VendorState",
	    "CustomerZip" => "VendorZip",
	    "CustomerCountry" => "VendorCountry",
	    "CustomerEmail" => "VendorEmail",
	    "CustomerPhone" => "VendorPhone"
	],
	"receiving" => [
	    "InvoiceDate" => "PurchaseDate",
	    "InvoiceNumber" => "PurchaseNumber",
	    
	    "CustomerName" => "VendorName",
	    "CustomerAddress1" => "VendorAddress1",
	    "CustomerAddress2" => "VendorAddress2",
	    "CustomerAddress3" => "VendorAddress3",
	    "CustomerCity" => "VendorCity",
	    "CustomerState" => "VendorState",
	    "CustomerZip" => "VendorZip",
	    "CustomerCountry" => "VendorCountry",
	    "CustomerEmail" => "VendorEmail",
	    "CustomerPhone" => "VendorPhone"
	],
	"rmaorder" => [
	    "InvoiceDate" => "PurchaseDate",
	    "InvoiceNumber" => "PurchaseNumber",
	],
	"returninvoice" => [
	    "InvoiceDate" => "InvoiceDate",
	    "InvoiceNumber" => "InvoiceNumber",
	    "CustomerName" => "VendorName",
	    "CustomerAddress1" => "VendorAddress1",
	    "CustomerAddress2" => "VendorAddress2",
	    "CustomerAddress3" => "VendorAddress3",
	    "CustomerCity" => "VendorCity",
	    "CustomerState" => "VendorState",
	    "CustomerZip" => "VendorZip",
	    "CustomerCountry" => "VendorCountry",
	    "CustomerEmail" => "VendorEmail",
	    "CustomerPhone" => "VendorPhone"
	]
    ];
?>
<div id="report" class="row">
    <div class="col-md-12" style="border: 1px solid black; padding:0px">
	<div class="row">
	    <div class="col-md-9 col-xs-9">
		<table class="col-md-12 col-xs-12">
		    <tr>
			<td rowspan="3" style="width:10%">
			    <img src="<?php echo  $user["company"]["CompanyLogoUrl"];?>">
			</td>
			<td style="width:90%; font-size:16pt; font-weight:bold;">
			    <?php echo  $user["company"]["CompanyName"];?>
			</td>
		    </tr>
		    <tr>
			<td style="width:90%">
			    <?php echo  $user["company"]["CompanyAddress1"] . ", " . $user["company"]["CompanyCity"] . ", " . $user["company"]["CompanyState"] . ", " . $user["company"]["CompanyZip"];?>
			</td>
		    </tr>
		    <tr>
			<td style="width:90%">
			    <?php echo  $user["company"]["CompanyPhone"] . ", " . $user["company"]["CompanyEmail"] . ", <span>" . $user["company"]["CompanyWebAddress"];?></span>
			</td>
		    </tr>
		</table>
	    </div>
	    <div class="col-md-3 col-xs-3 pull-right">
		<div class="col-md-12">
		    <div style="font-size:20pt; text-align:center;">
			<b><?php echo $titlesByType[$type]; ?></b>
		    </div>
		</div>
		<div class="col-md-6 col-xs-6" style="text-align:center">
		    <div><b>Date</b></div>
		    <div><?php echo  (key_exists($type, $fieldsByType) ? $headerData[$fieldsByType[$type]["InvoiceDate"]] : $headerData["InvoiceDate"]);?></div>
		</div>
		<div class="col-md-6 col-xs-6" style="text-align:center">
		    <div><b><?php echo (key_exists($type, $numberTitlesByType) ? $numberTitlesByType[$type] : $titlesByType[$type]); ?> #</b></div>
		    <div><?php echo  (key_exists($type, $fieldsByType) ? $headerData[$fieldsByType[$type]["InvoiceNumber"]] : $headerData["InvoiceNumber"]);?></div>
		</div>
	    </div>
	</div>
	<?php if($type != "debitmemo" && $type != "debitmemohistory"): ?>
	    <div class="col-md-12 col-xs-12" style="border:1px solid black;">
	    </div>
	    <div class="col-md-12 col-xs-12" style=margin-top:5px;">
		<div class="col-md-6 col-xs-6">
		    <div><b>Ship To</b></div>
		    <div><?php echo  $headerData["ShippingName"];?></div>
		    <div><?php echo  $headerData["ShippingAddress1"];?></div>		    
		    <div><?php echo  $headerData["ShippingAddress2"];?></div>		    
		    <div><?php echo  $headerData["ShippingAddress3"];?></div>		    
		    <div><?php echo  $headerData["ShippingCity"] . "  " . $headerData["ShippingState"] . "  " . $headerData["ShippingZip"] . "  " . $headerData["ShippingCountry"];?></div>		    
		</div>
		<?php if($type == "receiving"): ?>
		    <div class="col-md-6 col-xs-6">
			<div><b>Remitt To</b></div>
			<div><?php echo   $headerData["RemittToName"];?></div>
			<div><?php echo  $headerData["RemittToAddress1"];?></div>
			<div><?php echo  $headerData["RemittToAddress2"];?></div>
			<div><?php echo  $headerData["RemittToAddress3"];?></div>
			<div>
			    <?php echo  $headerData["RemittToCity"] . "  " 
				     . $headerData["RemittToState"] . ", "
				     . $headerData["RemittToZip"] . "  " 
				     . $headerData["RemittToCountry"];
			    ?>
			</div>   
			<div><?php echo $headerData["RemittToEmail"];?></div>
			<div><?php echo $headerData["RemittToPhone"];?></div>
		    </div>
		<?php else: ?>
		    <div class="col-md-6 col-xs-6">
			<div><b>Bill To</b></div>
			<div><?php echo  (key_exists($type, $fieldsByType) && key_exists("CustomerName", $fieldsByType[$type]) ? $headerData[$fieldsByType[$type]["CustomerName"]] : $headerData["CustomerName"]);?></div>
			<div><?php echo  (key_exists($type, $fieldsByType) && key_exists("CustomerAddress1", $fieldsByType[$type]) ? $headerData[$fieldsByType[$type]["CustomerAddress1"]] : $headerData["CustomerAddress1"]);?></div>
			<div><?php echo  (key_exists($type, $fieldsByType) && key_exists("CustomerAddress2", $fieldsByType[$type]) ? $headerData[$fieldsByType[$type]["CustomerAddress2"]] : $headerData["CustomerAddress2"]);?></div>
			<div><?php echo  (key_exists($type, $fieldsByType) && key_exists("CustomerAddress3", $fieldsByType[$type]) ? $headerData[$fieldsByType[$type]["CustomerAddress3"]] : $headerData["CustomerAddress3"]);?></div>
			<div>
			    <?php echo  (key_exists($type, $fieldsByType) && key_exists("CustomerCity", $fieldsByType[$type]) ? $headerData[$fieldsByType[$type]["CustomerCity"]] : $headerData["CustomerCity"]) . "  " 
				     . (key_exists($type, $fieldsByType) && key_exists("CustomerState", $fieldsByType[$type]) ? $headerData[$fieldsByType[$type]["CustomerState"]] : $headerData["CustomerState"]) . ", "
				     . (key_exists($type, $fieldsByType) && key_exists("CustomerZip", $fieldsByType[$type]) ? $headerData[$fieldsByType[$type]["CustomerZip"]] : $headerData["CustomerZip"]) . "  " 
				     . (key_exists($type, $fieldsByType) && key_exists("CustomerCountry", $fieldsByType[$type]) ? $headerData[$fieldsByType[$type]["CustomerCountry"]] : $headerData["CustomerCountry"]);
			    ?>
			</div>   
			<div><?php echo  (key_exists($type, $fieldsByType) && key_exists("CustomerName", $fieldsByType[$type]) ? $headerData[$fieldsByType[$type]["CustomerEmail"]] : $headerData["CustomerEmail"]);?></div>
			<div><?php echo  (key_exists($type, $fieldsByType) && key_exists("CustomerPhone", $fieldsByType[$type]) ? $headerData[$fieldsByType[$type]["CustomerPhone"]] : $headerData["CustomerPhone"]);?></div>
		    </div>
		<?php endif; ?>
	    </div>
	    <table class="col-md-12 col-xs-12 invoice-table-ship">
		<tbody>
		    <tr class="row-header">
			<?php if($type == "rmaorder" || $type == "purchaseorder"): ?>
			    <td>
				Ordered By
			    </td>
			    <td>
				Order #
			    </td>
			<?php else: ?>
			    <td>
				Customer ID
			    </td>
			    <td>
				Purchase Order
			    </td>
			<?php endif; ?>
			<td>
			    Terms
			</td>
			<td>
			    Ship Via
			</td>
			<td>
			    Ship Date
			</td>
		    </tr>
		    <tr>
			<?php if($type == "rmaorder" || $type == "purchaseorder" || $type == "receiving"): ?>
			    <td>
				<?php echo  $headerData["OrderedBy"];?>
			    </td>
			    <td>
				<?php echo  $headerData["OrderNumber"];?>
			    </td>
			<?php else: ?>
			    <td>
				<?php echo  $headerData["CustomerID"];?>
			    </td>
			    <td>
				<?php echo  $headerData["PurchaseOrderNumber"];?>
			    </td>
			<?php endif; ?>
			<td>
			    <?php echo  $headerData["TermsID"];?>
			</td>
			<td>
			    <?php echo  $headerData["ShipMethodID"];?>
			</td>
			<td>
			    <?php echo  $headerData["ShipDate"];?>
			</td>		
		    </tr>
		</tbody>
	    </table>
	<?php else: ?>
	    <table class="col-md-12 col-xs-12 invoice-table-ship">
		<tbody>
		    <tr class="row-header">
			<td>
			    Vendor ID
			</td>
			<td>
			    Debit #
			</td>
			<td>
			    Terms
			</td>
		    </tr>
		    <tr>
			<td>
			    <?php echo  $headerData["VendorID"];?>
			</td>
			<td>
			    <?php echo  $headerData["PurchaseNumber"];?>
			</td>
			<td>
			    <?php echo  $headerData["TermsID"];?>
			</td>
		    </tr>
		</tbody>
	    </table>
	<?php endif; ?>
    </div>
    <div class="col-md-12 col-xs-12 invoice-table-detail" style="margin-top:20px; border:1px solid black;  height:300px; padding:0px">
	<table class="col-md-12 col-xs-12">
	    <thead>
		<tr class="row-header">
		    <th style="width:140px">
			Item ID
		    </th>
		    <?php if($type == "purchaseorder"): ?>
			<th style="width:120px">
			    Warehouse ID
			</th>
			<th style="width:140px">
			    WarehouseBin ID
			</th>
		    <?php endif; ?>
		    <th>
			Description
		    </th>
		    <th style="width:80px">
			Quantity
		    </th>
		    <?php if($type != "orderpick"): ?>
			<th style="width:100px">
			    Unit Price
			</th>
			<th style="width:100px">
			    Amount
			</th>
		    <?php endif; ?>
		</tr>
	    </thead>
	    <tbody>
		<?php if($detailData): ?>
		    <?php 
			foreach($detailData as $row){
			    echo "<tr style=\"height:10px;\">";
			    echo "<td>" . $row["ItemID"] . "</td>";
			    if($type == "purchaseorder"){
				echo "<td>" . $row["WarehouseID"] . "</td>";
				echo "<td>" . $row["WarehouseBinID"] . "</td>";
			    }
			    echo "<td>" . $row["Description"] . "</td>";
			    echo "<td>" . $row["OrderQty"] . "</td>";
			    if($type != "orderpick"){
				echo "<td>" . $currencySymbol->symbol . $row["ItemUnitPrice"] . "</td>";
				echo "<td>" . $currencySymbol->symbol . $row["Total"] . "</td>";
			    }
			    echo "</tr>";
			}
		    ?>
		<?php else: ?>
		    <tr style="height:10px;">
			<td colspan="5" style="text-align:center;">
			    There is no records available.
			</td>
		    </tr>
		<?php endif; ?>
	    </tbody>
	</table>
    </div>
    <?php if($type != "orderpick"): ?>
	<div class="col-md-12 col-xs-12" style="border:1px solid black; padding:0px">
	    <div class="col-md-8 col-xs-8" style="padding:10px;">
		<?php echo $headerData["HeaderMemo1"];?><br/>
		<?php echo $headerData["HeaderMemo2"];?><br/>
		<?php echo $headerData["HeaderMemo3"];?><br/>
		<?php echo $headerData["HeaderMemo4"];?><br/>
		<?php echo $headerData["HeaderMemo5"];?><br/>
	    </div>
	    <div class="pull-right" style="padding:5px">
		<table class="invoice-table-summary">
		    <tbody>
			<?php 
			    if(!key_exists("SubTotal", $headerData) && !key_exists("Subtotal", $headerData))
				$headerData["SubTotal"] = "0.00";
			    else if(key_exists("Subtotal", $headerData))
				$headerData["SubTotal"] = $headerData["Subtotal"];			
			?>
			<tr>
			    <td>
				<b>SubTotal: </b>
			    </td>
			    <td class="summ">
				<?php echo $currencySymbol->symbol . $headerData["SubTotal"];  ?>
			    </td>
			</tr>
			<tr>
			    <td>
				<b>Shipping: </b>
			    </td>
			    <td class="summ">
				<?php echo $currencySymbol->symbol . $headerData["Freight"];  ?>
			    </td>
			</tr>
			<tr>
			    <td>
				<b>Handling: </b>
			    </td>
			    <td class="summ">
				<?php echo $currencySymbol->symbol . $headerData["Handling"];  ?>
			    </td>
			</tr>
			<tr>
			    <td>
				<b>Tax: </b>
			    </td>
			    <td class="summ">
				<?php echo $currencySymbol->symbol . $headerData["TaxAmount"];  ?>
			    </td>
			</tr>
			<tr>
			    <td>
				<b>Total: </b>
			    </td>
			    <td class="summ">
				<?php echo $currencySymbol->symbol . $headerData["Total"];  ?>
			    </td>
			</tr>
			<tr>
			    <td>
				<b>Payments: </b>
			    </td>
			    <td class="summ">
				<?php echo $currencySymbol->symbol . $headerData["AmountPaid"];  ?>
			    </td>
			</tr>
			<tr style="color:black;">
			    <td>
				<b>Balance Due:</b>
			    </td>
			    <td class="summ">
				<?php echo $currencySymbol->symbol . $headerData["BalanceDue"];  ?>
			    </td>
			</tr>
		    </tbody>
		</table>
	    </div>
	</div>
    <?php endif; ?>
</div>
<!-- <script>
     function printPDF(){
     var doc = new jsPDF();          
     var elementHandler = {
     '#ignorePDF': function (element, renderer) {
     return true;
     }
     };
     var source =  window.document.getElementsByTagName("body")[0];
     doc.fromHTML(
     source,
     0,
     0,
     {
     'elementHandlers': elementHandler
     });
     doc.output("dataurlnewwindow"); 
     console.log(doc);
     }
     </script>
     <button onclick="printPDF()">
     PDF
     </button>
-->
