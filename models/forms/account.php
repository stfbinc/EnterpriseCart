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
   
  Last Modified: 04/04/2019
  Last Modified by: Nikita Zaharov
*/

class account{
    public function getTransactions($fieldName, $remoteCall = false){
        $user = Session::get("user");
        $defaultCompany = Session::get("defaultCompany");
        $fieldName .= "Content";
        $result = DB::select("SELECT $fieldName from inventorycart WHERE CompanyID=? AND DivisionID=? AND DepartmentID=?", array($defaultCompany["CompanyID"], $defaultCompany["DivisionID"], $defaultCompany["DepartmentID"]));

        if($remoteCall)
            echo json_encode($result[0], JSON_PRETTY_PRINT);
        return $result[0]->$fieldName;
    }        
}
?>