<?php
/*
  Name of Page: docreports controller

  Method: controller for docreports pages

  Date created: Nikita Zaharov, 20.07.2020

  Use: The controller is responsible for:
  - page rendering using view

  Input parameters:
  $app : application instance, object

  Output parameters:
  $scope: object, used by view, most like model
  $translation: model, it is responsible for translation in view

  Called from:
  + index.php

  Calls:
  models/translation.php
  models/reports/doc/*
  app from index.php

  Last Modified: 20.07.2020
  Last Modified by: Nikita Zaharov
*/

require_once 'models/translation.php';
require_once 'models/linksMaker.php';
require_once 'models/APIProxy.php';
require_once 'views/format.php';
require_once 'models/APIProxy.php';

class docreportsController{
    public $user = false;
    public $action = "";
    public $mode = "docreports";
    public $path;

    public function process($app){
        $this->user;
        if(key_exists("user", $_SESSION))
            $this->user = Session::get("user");
        else
            Session::set("user",$this->user = [
                "language" => "English"
            ]);
        
        $type = $_GET["type"];
        $id = $_GET["id"];
        $data = new APIProxy();
        //$_perm = new permissionsByFile();
        //preg_match("/\/([^\/]+)(List|Detail)$/", $model_path, $filename);
        // if(key_exists($filename[1], $_perm->permissions))
        //  $security = new Security($_SESSION["user"]["accesspermissions"], $_perm->permissions[$filename[1]]);
        // else
        //  return response('permissions not found', 500)->header('Content-Type', 'text/plain');


        // We can get reports for the below template types, which is defined already in the system, Simply pass the type of report you need.
        // Ex : to get Customer Statements, you can pass the type as customerstatements.
        
        $invoiceTemplateTypes = [
            "invoice" => "invoice",
            "invoicehistory" => "invoice",
            "quote" => "invoice",
            "order" => "invoice",
            "orderpick" => "invoice",
            "orderhistory" => "invoice",
            "serviceorder" => "invoice",
            "serviceorderhistory" => "invoice",
            "serviceinvoice" => "invoice",
            "serviceinvoicehistory" => "invoice",
            "creditmemo" => "invoice",
            "creditmemohistory" => "invoice",
            "debitmemo" => "invoice",
            "debitmemohistory" => "invoice",
            "rmaorder" => "invoice",
            "purchaseorder" => "invoice",
            "returninvoice" => "invoice",
            "receiving" => "invoice",
            "customertransactions" => "customertransactions",
            "customerstatements" => "customerstatements",
            "payment" => "payment",
            "apcheck" => "apcheck"            
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        }else if($_SERVER['REQUEST_METHOD'] === 'GET') {            
            $translation = new translation($this->user["language"]);
            if(key_exists("title", $_GET))
                $this->breadCrumbTitle = $this->dashboardTitle = $translation->translateLabel("Report: " ) . $translation->translateLabel($_GET["title"]);
            
               $scope = $this;
               
               //$keyString = $this->user["CompanyID"] . "__" . $this->user["DivisionID"] . "__" . $this->user["DepartmentID"];
               $content = $invoiceTemplateTypes[$type] . ".php";
               require 'Reporting/doc/container.php';
        }
    }
}
?>