<?php
    $session_id = Session::get("session_id");
    $apiResult = API_request("page=api&module=forms&path=API/Reports/Doc&action=procedure&procedure=geDocReportsData&type={$_GET["type"]}&id={$_GET["id"]}&session_id=$session_id", "GET", null)["response"];


    // $headerData = json_decode(json_encode($apiResult->header), true);
    // $detailData = json_decode(json_encode($apiResult->detail), true);
    $user = json_decode(json_encode($apiResult->user), true);
    $statdata = json_decode(json_encode($apiResult->data), true);

    $currencySymbol = $apiResult->currencySymbol;
    //echo json_encode($headerData);
    //echo "<br/><br/>";
    //echo json_encode($detailData);
    //return;
    //echo json_encode($user);
?>
<?php
//$user = $data->getUser();
//$statdata = $data->getData();
//echo json_encode($statdata);
?>
<div id="report" class="row">
    <div class="col-md-12 col-xs-12 invoice-table-detail" style="margin-top:20px; padding:0px">
	<div class="col-md-9 col-xs-9">
	    <table class="col-md-12 col-xs-12">
		<tr>
		    <td rowspan="3" style="width:10%">
			<img src="<?php echo  $user["company"]["CompanyLogoUrl"];?>">
		    </td>
		    <td style="width:60%; font-size:16pt; font-weight:bold;">
			<?php echo  $user["company"]["CompanyName"];?>
		    </td>
		</tr>
		<tr>
		    <td style="width:60%">
			<?php echo  $user["company"]["DivisionID"] . " / " . $user["company"]["DepartmentID"];?>
		    </td>
		</tr>
		<tr>
		    <td style="width:60%">
			Executed By Demo on <?php echo date('m/d/Y'); ?>
		    </td>
		</tr>
	    </table>
	</div>
	<h2 class="col-md-12 col-xs-12" style="font-family: Arial; color:black">
	    Customer Information
	</h2>
	<div class="col-md-12 col-xs-12 row" style="margin-top:20px;">
	    <table>
		<tbody>
		    <tr>
			<td style="padding-left:10px; padding-right:10px;"><b>Customer ID:</b></td>
			<td><?php echo $id; ?></td>
			<td style="padding-left:10px; padding-right:10px;"><b>Customer Name:</b></td>
			<td><?php echo $statdata["customer"]["@name"]; ?></td>
		    </tr>
		    <tr>
			<td style="padding-left:10px; padding-right:10px;">
			    <b>Customer Address:</b> 
			</td>
			<td colspan="3">
			    <?php echo $statdata["customer"]["@addr1"] . " " .  $statdata["customer"]["@addr2"] . " " . $statdata["customer"]["@addr3"]; ?>
			</td>
		    </tr>
		    <tr>
			<td style="padding-left:10px; padding-right:10px;">
			    <b>Customer City:</b>
			</td>
			<td>
			    <?php echo $statdata["customer"]["@city"]; ?>
			</td>
			<td style="padding-left:10px; padding-right:10px;"><b>Customer Zip:</b></td>
			<td>
			    <?php echo $statdata["customer"]["@zip"]; ?>
			</td>
		    </tr>
		    <tr>
			<td style="padding-left:10px; padding-right:10px;">
			    <b>Customer State:</b>
			</td>
			<td>
			    <?php echo $statdata["customer"]["@state"]; ?>
			</td>
			<td style="padding-left:10px; padding-right:10px;">
			    <b>Customer Country:</b>
			</td>
			<td>
			    <?php echo $statdata["customer"]["@country"]; ?>
			</td>
		    </tr>
		</tbody>
	    </table>
	<div>
	<h2 class="col-md-12 col-xs-12" style="font-family: Arial; color:black">
	    Customer Statements
	</h2>
	<table class="col-md-12 col-xs-12">
	    <thead>
		<tr class="row-header">
		    <th style="width:80px">
			Date
		    </th>
		    <th style="width:80px">
			Transaction No
		    </th>
		    <th style="width:600px">
			Type
		    </th>
		    <th style="width:100px">
			Transaction Total
		    </th>
		</tr>
	    </thead>
	    <tbody>
		<?php if( is_array($statdata) && count($statdata["transactions"])): ?>
		    <?php 
		    foreach($statdata["transactions"] as $row){
			echo "<tr style=\"height:10px;\">";
			echo "<td>" . $row["ValueDate"] . "</td>";
			echo "<td>" . $row["Number"] . "</td>";
			echo "<td>" . $row["Type"] . "</td>";
			//$data->getCurrencySymbol()["symbol"] . 
			echo "<td>" . $currencySymbol->id . $row["BaseCurrAmount"] . "</td>";
			echo "</tr>";
		    }
		    ?>
		    <tr style="height:10px; background-color:gray; color: white; ">
			<td></td>
			<td></td>
			<td></td>
			<?php echo "<td><b>Balance: " . $currencySymbol->id . $row["BaseCurrAmount"] . "</b></td>"; ?>
		    </tr>
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
</div>