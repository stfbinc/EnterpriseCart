<?php
/*
  Name of Page: Products model
   
  Method: Model for working with products data
   
  Date created: 15/03/2019 Nikita Zaharov
   
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
   
  Last Modified: 15/03/2019
  Last Modified by: Nikita Zaharov
*/

class products{
    public function getFamilies(){
        $user = Session::get("user");
        $res = [];
        $result = DB::select("SELECT * from inventoryfamilies WHERE CompanyID=? AND DivisionID=? AND DepartmentID=?", array('DINOS', 'DEFAULT', 'DEFAULT'));

        foreach($result as $record)
            $res[$record->ItemFamilyID] = $record;

        echo json_encode($res, JSON_PRETTY_PRINT);
    }    
}
?>