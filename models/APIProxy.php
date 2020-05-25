<?php
/*
  Name of Page: API Proxy class

  Method: class for working with API as Proxy Model

  Date created: Nikita Zaharov, 25.05.2020

  Use: The model is responsible for:
  - calling API and acting as Model

  Input parameters:


  Output parameters:

  Called from:
  + index.php

  Calls:
  app from index.php, forms controllers


  Last Modified: 25.05.2020
  Last Modified by: Nikita Zaharov
*/

class APIProxy {
    public function proxyMethod($procedure, $remoteCall, $method="GET", $body=null){
        $session_id = Session::get("session_id");
        $result = API_request("page=api&module=forms&path=API/Ecommerce/Ecommerce&action=procedure&procedure=$procedure&session_id=$session_id", $method, null);
        //        echo "page=api&module=forms&path=API/Ecommerce/Ecommerce&action=procedure&procedure=$procedure&session_id=$session_id";
        //echo "$procedure" . json_encode($result);
        //echo $result["response"];
        if($remoteCall){
            echo  json_encode($result["response"], JSON_PRETTY_PRINT);
            return null;
        }else
            return $result["response"];
    }
    
    public function getCartSettings($remoteCall = false){
        return $this->proxyMethod("getCartSettings", $remoteCall);
    }
    
    public function getContent($remoteCall = false){
        return $this->proxyMethod("getContent", $remoteCall);
    }
    
    public function getCompany($remoteCall = false){
        return $this->proxyMethod("getCompany", $remoteCall);
    }
    public function getCurrencies($remoteCall = false){
        return $this->proxyMethod("getCurrencies", $remoteCall);
    }
    
    public function getFamilies($remoteCall = false){
        return $this->proxyMethod("getFamilies", $remoteCall);
    }
    
    public function getCategories($familyName = false, $remoteCall = false){
        return $this->proxyMethod("getCategories" . ($familyName ? "&familyName=$familyName" : ""), $remoteCall);
    }

    public function getItems($categoryName = false, $remoteCall = false){
        return $this->proxyMethod("getItems" . ($categoryName ? "&categoryName=$categoryName" : ""), $remoteCall);
    }

    //Search API
    public function searchProducts($remoteCall = false){
        $getParams = "";
        $postBody =[];
        if($remoteCall){
            /*            $postBody["text"] = $_POST["text"];
            $postBody["family"] = $_POST["family"];
            return $this->proxyMethod("searchProducts", $remoteCall, "POST", $postBody);
            */
            $getParams = "&text={$_POST["text"]}&family={$_POST["family"]}";
            return $this->proxyMethod("searchProducts$getParams", $remoteCall, "GET", $postBody);

        }else{
            $getParams = "&text={$_GET["text"]}&family={$_GET["family"]}";
            return $this->proxyMethod("searchProducts$getParams", $remoteCall, "GET", $postBody);
        }
    }

    //Account API
    public function getTransactions($remoteCall = false){
        $user = Session::get("user");
        return $this->proxyMethod("getTransactions&CustomerID={$user["Customer"]->CustomerID}", $remoteCall);
    }
    
    public function getInstallations($remoteCall = false){
        $user = Session::get("user");
        return $this->proxyMethod("getInstallations&CustomerID={$user["Customer"]->CustomerID}", $remoteCall);
    }

    //Checkout Helpers
    public function getPaymentMethods($remoteCall = false){
        return $this->proxyMethod("getPaymentMethods", $remoteCall);
    }
    public function getShipMethods($remoteCall = false){
        return $this->proxyMethod("getShipMethods", $remoteCall);
    }
}

?>