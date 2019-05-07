<?php
/*
  Name of Page: API

  Method: implements access to internal application api

  Date created: Nikita Zaharov, 07.05.2019

  Use: api used by any controller or models

  The controller is responsible for:
  + loading any controllers
  + calling controller actinos

  Input parameters:
  $app : application instance, object

  Output parameters:
  $scope: object, used by view, most like model
  $translation: model, it is responsible for translation in view

  Called from:
  + index.php

  Calls:
  different views, models, controllers

  Last Modified: 07.05.2019
  Last Modified by: Nikita Zaharov
*/

class api{
    private $app;
    
    public function __construct($app){
        $this->app = clone $app;
    }

    public function get($page, $action){
        require 'controllers/' . $page . '.php';
        $controllerName = $page. 'Controller';
        $controller = new $controllerName();
        $this->app->page = $page;
        $_GET["action"] = $action;
        $controller->process($this->app);
    }
}

?>