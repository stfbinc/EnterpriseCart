<?php
/*
  Name of Page: Forms controller

  Method: controller for many forms pages, used for rendering page and interacting with it

  Date created: Nikita Zaharov, 15.03.2019

  Use: The controller is responsible for:
  - page rendering using view
  - handling XHR request(delete, update and new item in grid)

  Input parameters:
  $app : application instance, object

  Output parameters:
  $scope: object, used by view, most like model
  $translation: model, it is responsible for translation in view

  Called from:
  + index.php

  Calls:
  models/translation.php
  models/formDataSource derivatives -- models who inherits from formDataSource
  app from index.php

  Last Modified: 02.09.2019
  Last Modified by: Nikita Zaharov
*/

require_once 'models/translation.php';
require_once 'models/linksMaker.php';
require_once 'models/APIProxy.php';
require_once 'views/format.php';

class formsController{
    public $user = false;
    public $interface = "default";
    public $interfaceType = "ltr";
    public $action = "";
    public $mode = "grid";
    public $category = "Main";
    public $item = "0";
    public $config;
    public $path;
    
    public function process($app){
        $user;
        if(key_exists("user", $_SESSION))
            $user = Session::get("user");
        else
            Session::set("user",$user = [
                "language" => "English"
            ]);
        
        $action = $this->action = $this->path =  $_GET["action"];

        switch($this->action){
        case "loadcontent":
        case "products" :
        case "index":
        case "search" :
        case "order":
        case "account":
        case "checkout":
            $data = new APIProxy();
            break;
        default:
            if(!file_exists('models/forms/' . $this->action . '.php'))
                throw new Exception("model " . 'models/forms/' . $this->action . '.php' . " is not found");
            require 'models/forms/' . $this->action . '.php';
        
            $data = new $action;
            break;
        }
            
        $this->user = $user;   
        $this->config = config();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(key_exists("update", $_GET)){
                $data->updateItem($_POST["id"], $_POST["category"], $_POST);
                header('Content-Type: application/json');
                echo "{ \"message\" : \"ok\"}";
            }else if(key_exists("new", $_GET)){
                $data->insertItem($_POST);
                header('Content-Type: application/json');
                echo "{ \"message\" : \"ok\"}";
            }else if(key_exists("procedure", $_GET)){
                $name = $_GET["procedure"];
                $data->$name(true);
            }
        }else if($_SERVER['REQUEST_METHOD'] === 'GET') {            
            if(key_exists("getItem", $_GET)){
                echo json_encode($data->getItem($_GET["getItem"]));
            }else if(key_exists("delete", $_GET)){
                $data->deleteItem($_GET["id"]);
                header('Content-Type: application/json');
                echo "{ \"message\" : \"ok\"}";
            }else{
                $translation = new translation($this->user["language"]);
            
                
                $user = $this->user;
                $scope = json_decode(json_encode($this), true);
                $linksMaker = new linksMaker($scope);

                require "views/pages/{$_GET["action"]}.php";
            }
        }
    }
}
?>