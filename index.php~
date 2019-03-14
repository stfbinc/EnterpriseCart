<?php
/*
   Name of Page: index

   Method: main entry point of application

   Date created: Nikita Zaharov, 08.02.2017

   Use:  Initialization ofr application,  router for actions. Response for thing like page=index transoforms to call 
   index.php from /controllers

   Input parameters:
   GET and POST params and data

   Output parameters:
   html site pages

   Called from:
   + app object used by most of /controllers and /models

   Calls:
   + /controllers/*


   Last Modified: 2-.11.2018
   Last Modified by: Nikita Zaharov
 */
//require 'vendor/autoload.php';
include './init.php';

function errorHandler($message, $error){
    if(isDebug()){        
        echo <<<EOT
<html>
    <body>
        <b style="text-align:center; padding-top:50px;">Fatal error: </b> . $message;
    </body>
</html>
EOT;
    }else{
        $record = [
            "timestamp" => date('U = Y-m-d H:i:s'),
            "query" => $_SERVER["REQUEST_URI"],
            "file" => $error["file"],
            "message" => $error["message"],
            "code" => $error["type"],
            "line" => $error["line"]
        ];
        file_put_contents(__DIR__ . "/error.log", json_encode($record) . ",\n", FILE_APPEND);
        echo "<div class=\"centered\"><h2>This page cannot be loaded because of errors happened while execution. The incident is logged</h2></div>";
        exit;
    }
}


class app{
    public $controller = false;
    public $title = "Integral Accounting";
    public $theme = 'none';
    public $loginLogo = "";
    public $page = 'index';
    public function __construct(){
	$config = config();
	$this->theme = $config["theme"];
	$this->title = $config["title"];
        if(isset($_GET["page"]))
            $this->page = $_GET["page"];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        }else if($_SERVER['REQUEST_METHOD'] === 'GET'){
        }
        if(!file_exists('controllers/' . $this->page . '.php'))
            throw new Exception("controller ". 'controllers/' . $this->page . '.php' . "is not found");
        require 'controllers/' . $this->page . '.php';
        $this->controller = new controller();
    }
}

function fatal_handler() {
    $error = error_get_last();
    if( $error !== NULL && $error["type"] <= 16){
	http_response_code(500);
	$message = "{$error["message"]} in {$error["file"]} on line {$error["line"]}";
	errorHandler($message, $error);
    }
}

register_shutdown_function("fatal_handler");
try{
    $_app = new app();
    
    $_app->loginLogo = $config["loginLogo"];
    $_app->controller->process($_app);
}catch(Exception $e){
    errorHandler($e->getMessage(), [
        "file" => $e->getFile(),
        "line" => $e->getLine(),
        "message" => $e->getMessage(),
        "type" => $e->getCode()
    ]);
}
?>
