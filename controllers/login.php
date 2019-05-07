<?php
/*
  Name of Page: Login

  Method: This is controller for login page. It contains logic for user verification and captcha generation

  Date created: Nikita Zaharov, 14.03.2019

  Use: controller is used by index.php, load by GET request parameter - page=login.

  The controller is responsible for:
  + loading data models and rendering login page
  + user verification and login on request
  + captcha generating and updating

  Input parameters:
  $app : application instance, object

  Output parameters:
  $scope: object, used by view, most like model
  $translation: model, it is responsible for translation in view

  Called from:
  + index.php

  Calls:
  models/translation.php
  models/users.php
  models/companies.php
  app from index.php

  Last Modified: 07.05.2019
  Last Modified by: Nikita Zaharov
*/

use Gregwar\Captcha\CaptchaBuilder;

require_once 'models/translation.php';
require_once 'models/companies.php';
require_once 'models/users.php';

$GLOBALS["capsule"]->setAsGlobal();

class loginController{
    public $styles = [
        "blue",
        "gray"
    ];

    public $captchaBuilder = false;

    public $user = false;

    //controllers constructor, initialize CaptchaBuilder
    public function __construct(){
        $this->captchaBuilder = new CaptchaBuilder;
    }

    /*
      entry point of controller. Rendering page, loading models, log in with checking
     */
    public function process($app){
        $user = false;
        $users = new users();
        $config = config();
        if(key_exists("loginform", $_GET))
            $config["loginForm"] = $_GET["loginform"]; 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {//login request process
            $wrong_captcha = false;
            if($_POST["captcha"] != $_SESSION["captcha"])
                $wrong_captcha = true;
            $interface = $_SESSION["user"]["interface"];
            $interfaceType = $_SESSION["user"]["interfaceType"];
            if(($config["loginForm"] == "login" ?
                ($user = $users->search($_POST["company"], $_POST["name"], $_POST["password"], $_POST["division"], $_POST["department"])) &&
               ($user["accesspermissions"]["RestrictSecurityIP"] ? $user["accesspermissions"]["IPAddress"] == $_SERVER['REMOTE_ADDR'] : true):
               $user = $users->searchSimple($_POST["name"], $_POST["password"])) &&
               !$wrong_captcha){
                //access granted, captcha is matched
                $companies = [];
                $app->renderUi = false;
                if($config["loginForm"] == "login"){
                    $user["language"] = $_POST["language"];
                    $_SESSION["user"] = $user;
                }else {
                    $companies = $user;
                    //    $user["language"] = "English";
                }

                $_SESSION["user"]["interface"] = $interface;
                $_SESSION["user"]["interfaceType"] = $interfaceType;
                header('Content-Type: application/json');
                echo json_encode(array(
                    "companies" => $companies,
                    "message" =>  "ok"
                ), JSON_PRETTY_PRINT);
            }else{//something wrong: captcha, company, username, password. Generating new captcha
                $this->captchaBuilder->build();
                $_SESSION['captcha'] = $this->captchaBuilder->getPhrase();
                $app->renderUi = false;
                http_response_code(401);
                header('Content-Type: application/json');
                $response = array(
                    "captcha" =>  $this->captchaBuilder->inline()
                );
                if($wrong_captcha)
                    $response["wrong_captcha"] = true;
                if(!$user)
                    $response["wrong_user"] = true;
                
                echo json_encode($response);
            }
        }else if($_SERVER['REQUEST_METHOD'] === 'GET') { //rendering login page
            $this->captchaBuilder->build();
            $_SESSION['captcha'] = $this->captchaBuilder->getPhrase();
            if(!key_exists("user", $_SESSION) || !$_SESSION["user"])
                $_SESSION["user"] = ["language" => "English"];

            $this->user = $_SESSION["user"];
            $_SESSION["user"]["interface"] = key_exists("interface", $_GET) ? $_GET["interface"] : "default";
            $_SESSION["user"]["interfaceType"] = key_exists("interfacetype", $_GET) ? $_GET["interfacetype"] :  "ltr";
            
            $translation = new translation( $_SESSION["user"]["language"]);
            $companies = new companies();
            $scope = $this;

            require "views/{$config["loginForm"]}.php";
        }
    }
}
?>