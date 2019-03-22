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

  Last Modified: 22.03.2019
  Last Modified by: Nikita Zaharov
*/

require 'models/translation.php';
require 'models/linksMaker.php';

class controller{
    public $user = false;
    public $interface = "default";
    public $interfaceType = "ltr";
    public $action = "";
    public $mode = "grid";
    public $category = "Main";
    public $item = "0";
    public $path;
    public $pathPage;
    
    public function process($app){
        $user;
        if(key_exists("user", $_SESSION))
            $user = Session::get("user");
        else
            Session::set("user",$user = [
                "language" => "English"
            ]);
        
        $action = $this->action = $this->path =  $_GET["action"];

        if(!file_exists('models/forms/' . $this->action . '.php'))
            throw new Exception("model " . 'models/forms/' . $this->action . '.php' . " is not found");
        require 'models/forms/' . $this->action . '.php';
        
        $data = new $action;
            
        $this->user = $user;   
        
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
            
                
                $scope = $this;
                $user = $this->user;
                $linksMaker = new linksMaker();
                $ascope = json_decode(json_encode($scope), true);

                require "views/pages/{$_GET["action"]}.php";
            }
        }
    }
}
?>