<?php
/*
  Name of Page: Reports model

  Method: Reports model, used for log in users, For reports

  Date created: 

  Use: to get reports of Customer statements, Invoices, Orders and Quotes
  
*/

use Gregwar\Captcha\CaptchaBuilder;

require_once 'models/APIProxy.php';

class report extends APIProxy{

    // To get customer transactions, we can use API Proxy method getTransactions to get the data.
    public function getCustomerOrder(){
        $data = $this->getTransactions();
        return $data;
    }
}
?>