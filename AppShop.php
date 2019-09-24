<?php
function config(){
    return array(
        "theme" => 'none', 
        //"theme" => 'dark', uncomment for dark theme
        "title" => 'Enterprise X Hosting Cart', //name of Application
        "software" => "HostingCart", //type of software, can be HostingCart or Cart
        "loginForm" => "login", //not used now
        "db_host" => "localhost", //host of mysql database
        "db_user" => "enterprise", //user of mysql database
        "db_password" => "enterprise", //password of mysql database user
        "db_base" => "enterpriseadmin",//name of mysql database
        "loginLogo" => "assets/images/stfb-logo.gif",
        "mediumLogo" => "assets/images/stfb-logo.gif",
        "smallLogo" => "assets/images/stfblogosm.jpg",
        "defaultCompanyID" => "DINOS", //CompanyID for getting items from database
        "defaultDivisionID" => "DEFAULT",//DivisionID for getting items from database
        "defaultDepartmentID" => "DEFAULT",//DepartmentID for getting items from database
        "EnterpriseXURL" => "/EnterpriseX", //path to EnterpriseX application, it must be on same host for now
        "EnterpriseXEmployeeID" => "Demo", //name of EnterpriseX user
        "EnterpriseXEmployeePassword" => "Demo" // password for EnterpriseX user
    );
}



function defaultUser(){
    return [
        "Company" => "DINOS",
        "Division" => "DEFAULT",
        "Department" => "DEFAULT",
        "Username" => "Demo",
        "Password" => "Demo",
        "Language" => "English"
    ];
}

function isDebug(){
    return true;
}
?>
