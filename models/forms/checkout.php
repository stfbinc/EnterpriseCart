<?php
/*
  Name of Page: Checkout model
   
  Method: Model for working with checkout data
   
  Date created: 29/03/2019 Nikita Zaharov
   
  Use: this model used by index view and products view
  - as a dictionary for view during building interface(tabs and them names, fields and them names etc, column name and corresponding translationid)
  - for loading data from tables, updating, inserting and deleting
   
  Input parameters:
  $db: database instance
  methods have their own parameters
   
  Output parameters:
  - dictionaries as public properties
  - methods have their own output
   
  Called from:
  created and used for ajax requests by controllers
  used as model by views
   
  Calls:
  MySql Database
   
  Last Modified: 29/03/2019
  Last Modified by: Nikita Zaharov
*/

class checkout{
    //getting list of available payment methods
    public function getPaymentMethods(){
        $defaultCompany = Session::get("defaultCompany");
        $res = [];
        $result = DB::select("SELECT PaymentMethodID from paymentmethods WHERE CompanyID='" . $defaultCompany["CompanyID"] . "' AND DivisionID='". $defaultCompany["DivisionID"] ."' AND DepartmentID='" . $defaultCompany["DepartmentID"] . "'", array());

        foreach($result as $key=>$value)
            $res[$value->PaymentMethodID] = [
                "title" => $value->PaymentMethodID,
                "value" => $value->PaymentMethodID
            ];
        
        return $res;
    } 

    //getting list of available shipment methods
    public function getShipMethods(){
        $defaultCompany = Session::get("defaultCompany");
        $res = [];
        $result = DB::select("SELECT ShipMethodID from shipmentmethods WHERE CompanyID='" . $defaultCompany["CompanyID"] . "' AND DivisionID='". $defaultCompany["DivisionID"] ."' AND DepartmentID='" . $defaultCompany["DepartmentID"] . "'", array());

        foreach($result as $key=>$value)
            $res[$value->ShipMethodID] = [
                "title" => $value->ShipMethodID,
                "value" => $value->ShipMethodID
            ];
        
        return $res;
    }
}
?>