<?php
/*
  Name of Page: Index

  Method: This is controller for index page.

  Date created: Nikita Zaharov, 02.09.2017

  Use: controller is used by index.php, load by GET request parameter - page=index.

  The controller is responsible for:
  + loading user and translation models
  + render index page

  Input parameters:
  $app : application instance, object

  Output parameters:
  $scope: object, used by view, most like model
  $translation: model, it is responsible for translation in view

  Called from:
  + index.php

  Calls:
  models/translation.php
  app from index.php

  Last Modified: 07.03.2019
  Last Modified by: Nikita Zaharov
*/

require 'models/users.php';
require 'models/translation.php';
require 'models/security.php';
require 'models/drillDowner.php';
require 'models/linksMaker.php';

class controller{
    public $user = false;
    public $interface = "default";
    public $interfaceType = "ltr";
    public $dashboardTitle = "Accounting Dashboard";
    public $breadCrumbTitle = "Accounting Dashboard";
    
    public function process($app){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        }else if($_SERVER['REQUEST_METHOD'] === 'GET') {
            $users = new users();
            $users->checkLoginInUrl();
            if(key_exists("logout", $_GET) || !key_exists("user", $_SESSION) || !$_SESSION["user"] || !key_exists("EmployeeUserName", $_SESSION["user"])){ //Logout action or redirect to prevent access un logined users
                $_SESSION["user"] = false;
                header("Location: index.php?page=login");
                exit;
            }
            
            $this->interface = $_SESSION["user"]["interface"] = $interface = key_exists("interface", $_GET) ? $_GET["interface"] : (key_exists("interface", $_SESSION["user"]) ? $_SESSION["user"]["interface"] : "default");
            if(!key_exists("interfaceName", $_SESSION["user"])){
                if($interface == "default")
                    $_SESSION["user"]["interfaceName"] = "Default";
                else if($interface == "simple")
                    $_SESSION["user"]["interfaceName"] = "Simple";
            }
                
            $this->interfaceType = $_SESSION["user"]["interfaceType"] = $interfaceType = key_exists("interfacetype", $_GET) ? $_GET["interfacetype"] : (key_exists("interfaceType", $_SESSION["user"]) ? $_SESSION["user"]["interfaceType"] : $this->interfaceType);
            $drill = new drillDowner();
            $linksMaker = new linksMaker();
            $this->user = $user = $_SESSION["user"];
               
            $security = new Security($this->user["accesspermissions"], []);
            $translation = new translation($this->user["language"]);
            $this->dashboardTitle = $translation->translateLabel($this->dashboardTitle);
            $this->breadCrumbTitle = $translation->translateLabel($this->breadCrumbTitle);
            $scope = $this;
            $ascope = json_decode(json_encode($scope), true);
            $keyString = $this->user["CompanyID"] . "__" . $this->user["DivisionID"] . "__" . $this->user["DepartmentID"];
            require 'models/menuCategoriesGenerated.php';
            require 'views/interfaces/' . $interface . '/index.php';
        }
    }
}
?>