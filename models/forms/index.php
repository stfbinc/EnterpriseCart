<?php
/*
  Name of Page: Index model
   
  Method: Model for working with index data
   
  Date created: 03/04/2019 Nikita Zaharov
   
  Use: this model used by index view
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

require 'baseform.php';

class index extends baseForm{
    public function getCompany($remoteCall = false){
        $user = Session::get("user");
        $defaultCompany = Session::get("defaultCompany");
        
        $result = DB::select("SELECT * from companies WHERE CompanyID=? AND DivisionID=? AND DepartmentID=?", array($defaultCompany["CompanyID"], $defaultCompany["DivisionID"], $defaultCompany["DepartmentID"]));

        if($remoteCall)
            echo json_encode($result[0], JSON_PRETTY_PRINT);
        return $result[0];
    }
        
    public function getCurrencies($remoteCall = false){
        $user = Session::get("user");
        $defaultCompany = Session::get("defaultCompany");
        
        $res = [];
        $result = DB::select("SELECT * from currencytypes WHERE CompanyID=? AND DivisionID=? AND DepartmentID=?", array($defaultCompany["CompanyID"], $defaultCompany["DivisionID"], $defaultCompany["DepartmentID"]));

        foreach($result as $record)
            $res[$record->CurrencyID] = $record;

        if($remoteCall)
            echo json_encode($res, JSON_PRETTY_PRINT);
        return $res;
    }
}
?>