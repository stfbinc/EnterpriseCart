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
    else if(isset($_GET['thankyou'])  && $_GET['thankyou']){
    
        require __DIR__ . "/helpdesk/thankyou.php";
    }
    else {

    $result = json_decode($data->getTicketsByCustomer());

    $tickets = $result->tickets;
    
    if(isset($_GET['closed']) && $_GET['closed'] ) 
        $tickets = $result->closed_tickets;

    if(isset($_GET['pending']) && $_GET['pending'] ) 
        $tickets = $result->pending_tickets;

	$avg_time_open = $result->avg_time_open;
    $weekly_tickets = $result->weekly_tickets;

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
                        <?php echo $translation->translateLabel("Reports"); ?>
                    </h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-3">
                <p>Total no.of Tickets</p>
                <p> <?php echo count($result->tickets); ?></p>
            </div>
            <div class="col-lg-3 col-md-3">
                <p>Total no.of Closed Tickets</p>
                <p> <?php echo count($result->closed_tickets); ?></p>
            </div>
            <div class="col-lg-3 col-md-3">
                <p>Average Time Open</p>
                <p> <?php echo round($avg_time_open[0]->averagedays); echo 'days'; ?></p>
            </div>
            <div class="col-lg-3 col-md-3">
                <p>Tickets per week</p>
                <p> <?php echo  $weekly_tickets[0]->count;?></p>
            </div>
        </div>

	    <div class="row">
    		<div class="col-lg-8 col-md-8">
                <div class="checkbox-form">
                    <h3>
                        <?php echo $translation->translateLabel("Your Tickets"); ?>
                    </h3>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <a href="#/?page=forms&action=helpdesk&new=1" class="btn btn-default">New Ticket </a>
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

                                
                         foreach($tickets as $ticket): 
                            ?>

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
                                        <a href="index.php#/?page=forms&action=helpdesk&view=<?php echo $ticket->CaseId; ?>">View</a> | 
                                        <a href="#" onclick="deleteTicket(<?php echo $ticket->CaseId; ?>); return false;">Delete</a>
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

<script type="text/javascript">
    $(document).ready(function() {

    });

    function makeHelpKeyString(){
        //production
        //return "STFB__DEFAULT__DEFAULT";
        //test
        return "DINOS__DEFAULT__DEFAULT";
    }

    function deleteTicket(ticketId){

        if (confirm("Are you sure?")) {
            // your deletion code

            $.ajax({
                  url : 'index.php/?page=forms&action=helpdesk&id='+ticketId+'&delete=1',
                  type : 'GET',
                  data : '',
                  processData: false,  // tell jQuery not to process the data
                  contentType: false,  // tell jQuery not to set contentType
                  error: function(e) {
                      var errors = JSON.parse(e.responseText);
                      alert(errors.message);
                  },
                  success : function(e) {
                      try {                     
                          alert('Success');
                          location.reload();
                      }
                      catch (e){}
                  }
            });
        }
        return false;
        
    }

    function backtoList(){
      window.location.href="index.php#/?page=forms&action=helpdesk";
    }

</script>