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
    
    public function getFamilies($remoteCall = false){
        $user = Session::get("user");
        $defaultCompany = Session::get("defaultCompany");
         $res = [];
        $result = DB::select("SELECT * from inventoryfamilies WHERE CompanyID=? AND DivisionID=? AND DepartmentID=?", array($defaultCompany["CompanyID"], $defaultCompany["DivisionID"], $defaultCompany["DepartmentID"]));

        foreach($result as $record)
            $res[$record->ItemFamilyID] = $record;

        if($remoteCall)
            echo json_encode($res, JSON_PRETTY_PRINT);
        return $res;
    }
    
    public function getCategories($familyName = false, $remoteCall = false){
        $user = Session::get("user");
        $defaultCompany = Session::get("defaultCompany");
        $res = [];
        if($remoteCall)
            $familyName = $_POST["familyname"];
        
        $result = DB::select("SELECT * from inventorycategories WHERE CompanyID=? AND DivisionID=? AND DepartmentID=? AND ItemFamilyID=?", array($defaultCompany["CompanyID"], $defaultCompany["DivisionID"], $defaultCompany["DepartmentID"], $familyName));

        foreach($result as $record)
            $res[$record->ItemCategoryID] = $record;

        if($remoteCall)
            echo json_encode($res, JSON_PRETTY_PRINT);
        return $res;
    }

    public function getItems($categoryName = false, $remoteCall = false){
        $user = Session::get("user");
        $defaultCompany = Session::get("defaultCompany");
        $res = [];
        if($remoteCall)
            $categoryName = $_POST["categoryName"];
        
        $result = DB::select("SELECT * from inventoryitems WHERE CompanyID=? AND DivisionID=? AND DepartmentID=? AND ItemCategoryID=?", array($defaultCompany["CompanyID"], $defaultCompany["DivisionID"], $defaultCompany["DepartmentID"], $categoryName));

        foreach($result as $record)
            $res[$record->ItemID] = $record;

        if($remoteCall)
            echo json_encode($res, JSON_PRETTY_PRINT);
        return $res;
    }

    //Shopping cart procedures
    public function shoppingCartAddItem(){
        $user = Session::get("user");
        $defaultCompany = Session::get("defaultCompany");
        $res = [];
        $id = $_POST["ItemID"];
        
        $result = DB::select("SELECT * from inventoryitems WHERE CompanyID=? AND DivisionID=? AND DepartmentID=? AND ItemID=?", array($defaultCompany["CompanyID"], $defaultCompany["DivisionID"], $defaultCompany["DepartmentID"], $id));

        $item = $result[0];
        
        $shoppingCart = Session::get("shoppingCart");
        if($shoppingCart == null)
            $shoppingCart = [
                "items" => array()
            ];

        if(!key_exists($item->ItemID, $shoppingCart["items"])){
            $shoppingCart["items"][$item->ItemID] = json_decode(json_encode($item), true);
            $shoppingCart["items"][$item->ItemID]["counter"] = 1;
        }
        else
            $shoppingCart["items"][$item->ItemID]["counter"]++;
        
        Session::set("shoppingCart", $shoppingCart);
        
        echo json_encode($shoppingCart, JSON_PRETTY_PRINT);
    }

        //Shopping cart procedures
    public function shoppingCartRemoveItem(){
        $user = Session::get("user");
        $defaultCompany = Session::get("defaultCompany");
        $res = [];
        $id = $_POST["ItemID"];
        
        $shoppingCart = Session::get("shoppingCart");
        if($shoppingCart == null)
            $shoppingCart = [
                "items" => array()
            ];

        if(key_exists($id, $shoppingCart["items"])){
            if($shoppingCart["items"][$id]["counter"] == 1)
                unset($shoppingCart["items"][$id]);
            else
                $shoppingCart["items"][$id]["counter"]--;
        }
        
        Session::set("shoppingCart", $shoppingCart);
        
        echo json_encode($shoppingCart, JSON_PRETTY_PRINT);
    }

    public function shoppingCartGetCart(){
        $shoppingCart = Session::get("shoppingCart");
        if($shoppingCart == null)
            $shoppingCart = [
                "items" => array()
            ];
        
        echo json_encode($shoppingCart, JSON_PRETTY_PRINT); 
    }
}
?>