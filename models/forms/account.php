<?php
/*
  Name of Page: Account model
   
  Method: Model for working with Account data
   
  Date created: 04/04/2019 Nikita Zaharov
   
  Use: this model used by Account view
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
   
  Last Modified: 03/09/2019
  Last Modified by: Nikita Zaharov
*/

class account{
    //for Cart
    public function getTransactions($remoteCall = false){
        $user = Session::get("user");
        $defaultCompany = Session::get("defaultCompany");
        $result = DB::select("SELECT * from orderheader WHERE CompanyID=? AND DivisionID=? AND DepartmentID=? AND CustomerID=? AND OrderDate > '2019-04-00 00:00:00' order by OrderDate desc", array($defaultCompany["CompanyID"], $defaultCompany["DivisionID"], $defaultCompany["DepartmentID"], $user["Customer"]->CustomerID));

        if($remoteCall)
            echo json_encode($result, JSON_PRETTY_PRINT);
        return $result;
    }        

    //for Hosting Cart
    public function getInstallations($remoteCall = false){
        $user = Session::get("user");
        $defaultCompany = Session::get("defaultCompany");
        $result = DB::select("SELECT * from appinstallations WHERE CustomerID=? order by InstallationDate desc", array($user["Customer"]->CustomerID));
        $result = json_decode(json_encode($result), true);

        if($remoteCall)
            echo json_encode($result, JSON_PRETTY_PRINT);
        
        return $result;
    }        
}
?>