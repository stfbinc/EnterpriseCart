<?php
/*
  Name of Page: Search model
   
  Method: Model for working with search data
   
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

class search{
    function searchProducts($remoteCall = false){
        $user = Session::get("user");
        $defaultCompany = Session::get("defaultCompany");
        $res = [];
        $categoryName = '';
        if($remoteCall){
            $text = $_POST["text"];
            $family = $_POST["family"];
        }else{
            $text = $_GET["text"];
            $family = $_GET["family"];
        }
        
        $categories = DB::select("SELECT * from inventorycategories WHERE CompanyID=? AND DivisionID=? AND DepartmentID=? AND ItemFamilyID=?", array($defaultCompany["CompanyID"], $defaultCompany["DivisionID"], $defaultCompany["DepartmentID"], $family));

        $categoryCondition = "";
        foreach($categories as $category)
            if($categoryCondition == "")
                $categoryCondition .= "AND (ItemCategoryID='" . $category->ItemCategoryID . "'";
            else
                $categoryCondition .= " OR ItemCategoryID='" . $category->ItemCategoryID . "'";
        if($categoryCondition)
            $categoryCondition .= ")";

        if($categoryCondition){
            $result = DB::select("SELECT * from inventoryitems WHERE CompanyID=? AND DivisionID=? AND DepartmentID=? $categoryCondition AND (ItemID like '%" . $text ."%' or ItemName like '%".  $text  ."%' or ItemDescription like '%". $text ."%' or ItemLongDescription like '%". $text ."%')", array($defaultCompany["CompanyID"], $defaultCompany["DivisionID"], $defaultCompany["DepartmentID"]));

            foreach($result as $record)
                $res[$record->ItemID] = $record;
        }
        
        if($remoteCall)
            echo json_encode($res, JSON_PRETTY_PRINT);
        return $res;
    }
}
?>