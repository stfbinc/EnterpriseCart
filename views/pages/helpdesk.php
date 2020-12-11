<?php
   
	// View file to show reports from EnterpiseUniversalAPI

    require 'components/commonJavascript.php';
     
    if(isset($_GET['new'])){
        require __DIR__ . "/helpdesk/addnew.php";
    }
    else if(isset($_GET['edit']) && $_GET['edit']){
        $caseId = $_GET['edit'];

        require __DIR__ . "/helpdesk/edit.php";
    }
    else if(isset($_GET['view'])  && $_GET['view']){
        $caseId = $_GET['view'];

        require __DIR__ . "/helpdesk/view.php";
    }
    else {

    $result = $data->getTicketsByCustomer();

	$tickets = json_decode($result);

    //$orders = $data->getCustomerOrder();
?>
    <div class="checkout-area" style="margin-top:50px">
    <div class="container">

    	<?php 
    	// Reports to show for customerstatements
    	?>
	    <div class="row">
    		<div class="col-lg-8 col-md-8">
                <div class="checkbox-form">
                    <h3>
                        <?php echo $translation->translateLabel("Your Tickets"); ?>
                    </h3>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <a href="#/?page=forms&action=helpdesk&new=1">New Ticket </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
        		<table class="table table-responsible">
                    <thead>
                        <th><?php echo $translation->translateLabel("Customer ID"); ?></th>
                        <th><?php echo $translation->translateLabel("Case ID"); ?></th>
                        <th><?php echo $translation->translateLabel("Support Req Date"); ?></th>
                        <th><?php echo $translation->translateLabel("Support Question"); ?></th>
                        <th><?php echo $translation->translateLabel("Status"); ?></th>
                        <th><?php echo $translation->translateLabel("Actions"); ?></th>
                    </thead>
                    <tbody id="shoppingCartFormList" >
                    	<?php
                            if($tickets) {


                         foreach($tickets as $ticket): ?>
                            <tr>
                                <td>
                                	<?php echo $ticket->CustomerId; ?>
                                </td>
                                <td>
                                    <?php echo $ticket->CaseId; ?>
                                </td>
                                <td>
                                    <?php echo $ticket->SupportDate; ?>
                                </td>
                                <td>
                                    <?php echo $ticket->SupportQuestion; ?>
                                </td>
                                <td>
                                    <?php echo $ticket->SupportStatus; ?>
                                </td>
                                <td>
                                    <a href="index.php#/?page=forms&action=helpdesk&edit=<?php echo $ticket->CaseId; ?>">Edit</a> |
                                    <a href="index.php#/?page=forms&action=helpdesk&delete=<?php echo $ticket->CaseId; ?>">Delete</a>
                                </td>
                            </tr>
                        <?php 

                        
                		endforeach; 

                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php }
?>