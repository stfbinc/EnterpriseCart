<?php
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
        return $_SESSION[$key];
    }
    public static function set($key, $value){
        return $_SESSION[$key] = $value;
    }
}

$config = $GLOBALS["config"] = config();
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