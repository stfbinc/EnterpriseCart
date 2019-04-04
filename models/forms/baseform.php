<?php
/*
  Name of Page: Base form model
   
  Method: Model for working with base form data
   
  Date created: 04/04/2019 Nikita Zaharov
   
  Use: this model used by base form view
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
   
  Last Modified: 03/04/2019
  Last Modified by: Nikita Zaharov
*/
class baseForm {
    public function getCartSettings($remoteCall = false){
        $user = Session::get("user");
        $defaultCompany = Session::get("defaultCompany");
        
        $result = DB::select("SELECT * from inventorycart WHERE CompanyID=? AND DivisionID=? AND DepartmentID=?", array($defaultCompany["CompanyID"], $defaultCompany["DivisionID"], $defaultCompany["DepartmentID"]));

        if($remoteCall)
            echo json_encode($result[0], JSON_PRETTY_PRINT);
        return $result[0];
    }
}