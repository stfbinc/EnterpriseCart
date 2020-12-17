<?php
/*
  Name of Page: Help Desk model

  Method: getCustomerData, getTicketsByCustomer, getCaseDetails, updateItem, insertItem.

  Date created: G2, 12.10.2020

  Use: For Support Helpdesk functions

  Input parameters:
  $db: database instance

  Output parameters:
  $users: model, it is responsible for working with users and them permissions

  Called from:
  + most controllers most controllers from /controllers

  Calls:
  sql
*/

use Gregwar\Captcha\CaptchaBuilder;

require_once 'models/APIProxy.php';

class helpdesk extends APIProxy{
    public $captchaBuilder = false;

    public function __construct(){
        $this->captchaBuilder = new CaptchaBuilder;
    }

    public function getCustomerData(){

        $user = Session::get("user");
        $session_id = Session::get("session_id");

        if(isset($user['Customer'])){
           
            $customer = $user['Customer']->CustomerID;
           
            $result = API_request("page=api&module=forms&action=procedure&session_id=$session_id&procedure=getCustomerInfo&path=API/Ecommerce/Helpdesk&customer=$customer", "GET", null);
            
            return json_encode($result['response'], true);
        }
        else{
            return '';
        }
    }

    public function getTicketsByCustomer(){

        $user = Session::get("user");
        $session_id = Session::get("session_id");

        if(isset($user['Customer'])){
            $this->captchaBuilder->build();
            $_SESSION['captcha'] = $this->captchaBuilder->getPhrase();

            $customer = $user['Customer']->CustomerID;
            $result = API_request("page=api&module=forms&action=procedure&session_id=$session_id&procedure=getTicketsByCustomer&path=API/Ecommerce/Helpdesk&customer=$customer", "GET", null);
            
            return json_encode($result['response'], true);
        }
        else{
            return '';
        }
    }

    public function getCaseDetails($caseId = ''){

        $user = Session::get("user");
        $session_id = Session::get("session_id");


        if(isset($user['Customer']) && $caseId){

            // $this->captchaBuilder->build();
            // $_SESSION['captcha'] = $this->captchaBuilder->getPhrase();

            $customer = $user['Customer']->CustomerID;
            $result = API_request("page=api&module=forms&action=procedure&session_id=$session_id&procedure=getTicketDetailsById&path=API/Ecommerce/Helpdesk&customer=$customer&caseId=$caseId", "GET", null);

            return json_encode($result['response'], true);
        }
        else{
            return '';
        }
    }

    public function updateItem($caseId, $category='', $postdata){

        $user = Session::get("user");
        $session_id = Session::get("session_id");

        $_POST['CustomerFirstName'] = $postdata['RequestCustomerFirstName'];
        $_POST['CustomerLastName'] = $postdata['RequestCustomerLastName'];
        $_POST['CustomerName'] = $postdata['RequestCustomerName'];
        $_POST['CustomerID'] = $user['Customer']->CustomerID;
        $_POST['CustomerEmail'] = $postdata['EmailCustomer'];
        $_POST['SupportQuestion'] = $postdata['subject'];
        $_POST['SupportDescription'] = $postdata['message'];

        $result = API_request("page=api&module=forms&path=API/Ecommerce/Helpdesk&CompanyID=DINOS&DivisionID=DEFAULT&DepartmentID=DEFAULT&EmployeeID=demo&EmployeePassword=demo&action=procedure&procedure=updateRequestWithCustomer&session_id=$session_id&caseId=$caseId", "POST", $_POST )["response"];

        return json_encode($result, true);
    }


    public function insertItem(){

        $user = Session::get("user");
        $session_id = Session::get("session_id");

        $_POST['CustomerFirstName'] = $_POST['RequestCustomerFirstName'];
        $_POST['CustomerLastName'] = $_POST['RequestCustomerLastName'];
        $_POST['CustomerName'] = $_POST['RequestCustomerName'];
        $_POST['CustomerID'] = $user['Customer']->CustomerID;
        $_POST['CustomerEmail'] = $_POST['EmailCustomer'];
        $_POST['SupportQuestion'] = $_POST['subject'];
        $_POST['SupportDescription'] = $_POST['message'];
        
        //This is the entire file that was uploaded to a temp location.
        $tmpfile = $_FILES['screenshot_attachment']['tmp_name'];
        $filename = basename($_FILES['screenshot_attachment']['name']);

        //$file_name_with_full_path = $_FILES['screenshot_attachment']['tmp_name'];
        if (function_exists('curl_file_create')) { // php 5.5+
            
            $_POST['SupportScreenShot'] = curl_file_create($tmpfile, $_FILES['screenshot_attachment']['type'], $filename);
        } 

        if ( isset($_FILES['screenshot_attachment']) ) {
            $img_name = $_FILES['screenshot_attachment']['tmp_name'];
            $handle    = fopen($img_name, "r");
            $data      = fread($handle, filesize($img_name));
            $_POST['encoded_image'] = base64_encode($data);
        }
        // $_POST['SupportScreenShot'] = '@'. $_FILES['screenshot_attachment']['tmp_name']
        //       . ';filename=' . $_FILES['screenshot_attachment']['name']
        //       . ';type='     . $_FILES['screenshot_attachment']['type'];
    
        //API/Ecommerce/Helpdesk
        //CRMHelpDesk/HelpDesk/ViewSupportRequests
        $result = API_request("page=api&module=forms&path=API/Ecommerce/Helpdesk&CompanyID=DINOS&DivisionID=DEFAULT&DepartmentID=DEFAULT&EmployeeID=demo&EmployeePassword=demo&action=procedure&procedure=insertRequestWithCustomer&session_id=$session_id", "POST", $_POST)["response"];

        return json_encode($result, true);

    }

    public function getProducts(){

        $items = $this->getItems();    
        return $items;
    }


    public function login(){
        $defaultCompany = Session::get("defaultCompany");
        $result = $this->proxyMethod("getCustomerInformation&CustomerLogin={$_POST["username"]}&CustomerPassword={$_POST["password"]}", false);
        //        echo json_encode($result, JSON_PRETTY_PRINT);
        if(!count((array)$result) || $_POST["captcha"] != $_SESSION["captcha"]){
            http_response_code(401);
            $this->captchaBuilder->build();
            $_SESSION['captcha'] = $this->captchaBuilder->getPhrase();
            header('Content-Type: application/json');
            echo json_encode([
                "captcha" =>  $this->captchaBuilder->inline(),
                "wrong_user" => true
            ], JSON_PRETTY_PRINT);
        }else{
            $user = [
                "Customer" => $result[0],
                "language" => Session::get("user") ? Session::get("user")["language"] : "English"
            ];
            Session::set("user", $user);
            echo json_encode($user, JSON_PRETTY_PRINT);
        }
    }

    public function logout(){
        Session::set("user", [
            "language" => Session::get("user") ? Session::get("user")["language"] : "English"
        ]);
        Session::set("defaultCompany", null);
        echo json_encode([]);
    }

    public function sessionUpdate(){
        $user = Session::get("user");
        $defaultCompany = Session::get("defaultCompany");
        $result = $this->proxyMethod("getCustomerInformation&CustomerLogin={$user["Customer"]->CustomerLogin}&CustomerPassword={$user["Customer"]->CustomerPassword}", false);
        if(!count($result)){
            http_response_code(401);
            echo "session updating failed";
        }else{
            $user = [
                "Customer" => $result[0],
                "language" => Session::get("user") ? Session::get("user")["language"] : "English"
            ];
            Session::set("user", $user);
            echo json_encode($user, JSON_PRETTY_PRINT);
        }
    }

    public function getCaptcha(){
        $this->captchaBuilder->build();
        $_SESSION['captcha'] = $this->captchaBuilder->getPhrase();
        header('Content-Type: application/json');
        echo json_encode([
            "captcha" =>  $this->captchaBuilder->inline(),
            "captchaPhrase" => $_SESSION['captcha']
        ], JSON_PRETTY_PRINT);
    }
}
?>