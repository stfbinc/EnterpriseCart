<?php
session_name("EnterpriseXCart");
session_start();

if((key_exists("config", $_GET) && ($configName = $_GET["config"]) != 'default') ||
   (key_exists("configName", $_SESSION) && ($configName = $_SESSION["configName"]) != 'default') && (!key_exists("page", $_GET) || ($_GET["page"] != 'ByPassLogin' && $_GET["page"] != 'login'))){
    require $configName . '.php';
    $_SESSION["configName"] = $configName;
}else{
    $_SESSION["configName"] = 'default';
    require 'common.php';
}                                                                                                                            require 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$GLOBALS["capsule"] = $GLOBALS["DB"] = new Capsule;

//class for emulating global DB class from laravel
class DB{    
    public static function statement($query, $args = false){
        return $GLOBALS["DB"]::statement($query, $args ? $args : array());
    }
    public static function select($query, $args = false){
        return $GLOBALS["DB"]::select($query, $args ? $args : array());
    }
    public static function update($query, $args = false){
        return $GLOBALS["DB"]::update($query, $args ? $args : array());
    }
    public static function insert($query, $args = false){
        return $GLOBALS["DB"]::insert($query, $args ? $args : array());
    }
    public static function delete($query, $args = false){
        return $GLOBALS["DB"]::delete($query, $args ? $args : array());
    }
    public static function connection($query = false, $args = false){
        return $GLOBALS["DB"]::connection();
    }
    public static function getDatabaseName(){
        return $GLOBALS["DB"]::getDatabaseName();
    }
}

//class for emulating global Session class from laravel
class Session{
    public static function get($key){
        if(key_exists($key, $_SESSION))
            return $_SESSION[$key];
        else
            null;
    }
    public static function set($key, $value){
        return $_SESSION[$key] = $value;
    }
}

function API_request($url, $type, $body){
    $config = $GLOBALS["config"];
    $ch = curl_init($config["EnterpriseUniversalAPI"]["address"] . "index.php?" . $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    if($type == "POST"){
        curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($body));
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_POST, 1);
    }
    $output = curl_exec($ch);
    //echo $output, json_encode($ch);
    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
        echo $error_msg;
    }
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    //    echo $httpcode;
    // close curl resource to free up system resources
    curl_close($ch);
    return [
        "response" => json_decode($output),
        "statusCode" => $httpcode
    ];
}

$config = $GLOBALS["config"] = config();
$result = API_request('page=api&module=auth&action=login', "POST", [
    "CompanyID" => $config["EnterpriseUniversalAPI"]["CompanyID"],
    "DivisionID" => $config["EnterpriseUniversalAPI"]["DivisionID"],
    "DepartmentID" => $config["EnterpriseUniversalAPI"]["DepartmentID"],
    "EmployeeID" => $config["EnterpriseUniversalAPI"]["EmployeeID"],
    "EmployeePassword" => $config["EnterpriseUniversalAPI"]["EmployeePassword"],
    "language" => $config["EnterpriseUniversalAPI"]["language"]
], $config);

Session::set("session_id", $result["response"]->session_id);

$capsule->addConnection([
    "driver" => "mysql",
    "host" => $config["db_host"],
    "database" => $config["db_base"],
    "username" => $config["db_user"],
    "password" => $config["db_password"],
    "charset" => "utf8",
    "collation" => "utf8_unicode_ci",
    "prefix" => ""
]);
$capsule->setAsGlobal();
?>