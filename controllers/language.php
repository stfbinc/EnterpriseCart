<?php
/*
  Name of Page: language

  Method: used for changing ui language

  Date created: Nikita Zaharov, 13.03.2019

  Use: 

  Input parameters:
  $db: database instance
  $app : application instance, object

  Output parameters:
  exposed language management api

  Called from:
  + index.php

  Calls:
  models/translation.php
  app from index.php

  Last Modified: 25.05.2020
  Last Modified by: Nikita Zaharov
*/

//require 'models/translation.php';

class languageController{
    public $user = false;
    
    public function process($app){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        }else if($_SERVER['REQUEST_METHOD'] === 'GET') {            
            if(!$_SESSION["user"]){//redirect to prevent access un logined users
                $_SESSION["user"] = false;
                header("Location: index.php?page=login");
                exit;
            }
            
            $this->user = $_SESSION["user"];
               
            if(key_exists("setLanguage", $_GET)){
                $this->user["language"] = $_GET["setLanguage"];
                $_SESSION["user"] = $this->user;
                echo json_encode([ "message" => "ok"]);
            }
        }
    }
}
?>