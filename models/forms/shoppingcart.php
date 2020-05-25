<?php
/*
  Name of Page: Shopping cart model
   
  Method: Model for working with shopping cart data
   
  Date created: 28/03/2019 Nikita Zaharov
   
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
   
  Last Modified: 25/05/2020
  Last Modified by: Nikita Zaharov
*/

require_once 'models/APIProxy.php';

class shoppingcart extends APIProxy{
    //Shopping cart procedures
    public function shoppingCartAddItem(){
        $user = Session::get("user");
        $defaultCompany = Session::get("defaultCompany");
        $res = [];
        $qty = key_exists("qty", $_POST) ? $_POST["qty"] : 1;
        
        $result = $this->proxyMethod("getInventoryItem&ItemID={$_POST["ItemID"]}", false);
        $item = $result[0];
        
        $shoppingCart = Session::get("shoppingCart");
        if($shoppingCart == null)
            $shoppingCart = [
                "items" => array()
            ];

        if(!key_exists($item->ItemID, $shoppingCart["items"])){
            $shoppingCart["items"][$item->ItemID] = json_decode(json_encode($item), true);
            $shoppingCart["items"][$item->ItemID]["counter"] = $qty;
        }
        else 
            $shoppingCart["items"][$item->ItemID]["counter"] += $qty;
        
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

    public function shoppingCartClean(){
        Session::set("shoppingCart", [ "items" => []]);
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