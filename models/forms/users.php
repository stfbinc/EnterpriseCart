<?php
/*
  Name of Page: Users model

  Method: Users model, used for log in users, searching and working with permissions

  Date created: Nikita Zaharov, 14.03.2019

  Use: For searching, verificating users. Also this model provide method for work with permissions

  Input parameters:
  $db: database instance

  Output parameters:
  $users: model, it is responsible for working with users and them permissions

  Called from:
  + most controllers most controllers from /controllers

  Calls:
  sql

  Last Modified: 25.05.2019
  Last Modified by: Nikita Zaharov
*/

use Gregwar\Captcha\CaptchaBuilder;

require_once 'models/APIProxy.php';

class users extends APIProxy{
    public $captchaBuilder = false;

    public function __construct(){
        $this->captchaBuilder = new CaptchaBuilder;
    }

    public function login(){
        $defaultCompany = Session::get("defaultCompany");
        $result = $this->proxyMethod("getCustomerInformation&CustomerLogin={$_POST["username"]}&CustomerPassword={$_POST["password"]}", false);
        //        echo json_encode($result, JSON_PRETTY_PRINT);
        if(!count((array)$result) || $_POST["captcha"] != $_SESSION["captcha"]){
            http_response_code(401);
            $this->captchaBuilder->build();
            $_SESSION['captcha'] = $this->captchaBuilder->getPhrase();
            header('Content-Type: application/json');
            echo json_encode([
                "captcha" =>  $this->captchaBuilder->inline(),
                "wrong_user" => true
            ], JSON_PRETTY_PRINT);
        }else{
            $user = [
                "Customer" => $result[0],
                "language" => Session::get("user") ? Session::get("user")["language"] : "English"
            ];
            Session::set("user", $user);
            echo json_encode($user, JSON_PRETTY_PRINT);
        }
    }

    public function logout(){
        Session::set("user", [
            "language" => Session::get("user") ? Session::get("user")["language"] : "English"
        ]);
        Session::set("defaultCompany", null);
        echo json_encode([]);
    }

    public function sessionUpdate(){
        $user = Session::get("user");
        $defaultCompany = Session::get("defaultCompany");
        $result = $this->proxyMethod("getCustomerInformation&CustomerLogin={$user["Customer"]->CustomerLogin}&CustomerPassword={$user["Customer"]->CustomerPassword}", false);
        if(!count($result)){
            http_response_code(401);
            echo "session updating failed";
        }else{
            $user = [
                "Customer" => $result[0],
                "language" => Session::get("user") ? Session::get("user")["language"] : "English"
            ];
            Session::set("user", $user);
            echo json_encode($user, JSON_PRETTY_PRINT);
        }
    }

    public function getCaptcha(){
        $this->captchaBuilder->build();
        $_SESSION['captcha'] = $this->captchaBuilder->getPhrase();
        header('Content-Type: application/json');
        echo json_encode([
            "captcha" =>  $this->captchaBuilder->inline(),
            "captchaPhrase" => $_SESSION['captcha']
        ], JSON_PRETTY_PRINT);
    }

    public function loginWithoutCaptcha(){
        $result = $this->proxyMethod("getCustomerInformation&CustomerLogin={$_POST["username"]}&CustomerPassword={$_POST["password"]}", false);
      if(!count($result)){
            http_response_code(401);
        }else{
            $user = [
                "Customer" => $result[0],
                "language" => Session::get("user") ? Session::get("user")["language"] : "English"
            ];
            Session::set("user", $user);
            echo json_encode($user, JSON_PRETTY_PRINT);
        }
    }
}
?>