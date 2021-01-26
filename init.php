<?php
session_name("EnterpriseCart");
session_start();

if((key_exists("config", $_GET) && ($configName = $_GET["config"]) != 'default') ||
   (key_exists("configName", $_SESSION) && ($configName = $_SESSION["configName"]) != 'default') && (!key_exists("page", $_GET) || ($_GET["page"] != 'ByPassLogin' && $_GET["page"] != 'login'))){
    require $configName . '.php';
    $_SESSION["configName"] = $configName;
}else{
    $_SESSION["configName"] = 'default';
    require 'common.php';
}                                                                                                                            require 'vendor/autoload.php';

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



function newsletter_submit($url, $type, $body){

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($body));
    curl_setopt($ch, CURLOPT_HEADER, true);    // we want headers
    curl_setopt($ch, CURLOPT_NOBODY, true);

    // In real life you should use something like:
    // curl_setopt($ch, CURLOPT_POSTFIELDS, 
    //          http_build_query(array('postvar1' => 'value1')));

    // Receive server response ...
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $output = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close ($ch);

    return [
        "response" => 'Success',
        "statusCode" => $httpcode
    ];
}

function API_request($url, $type, $body){
    $config = $GLOBALS["config"];
    $ch = curl_init($config["EnterpriseUniversalAPI"]["address"] . "index.php?" . $url);
    $certificate_location = "./cacert.pem";
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $certificate_location);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $certificate_location);
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
    // echo $output;
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

//echo json_encode($result, JSON_PRETTY_PRINT);
Session::set("session_id", $result["response"]->session_id);
?>