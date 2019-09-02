<?php
function config(){
    return array(
        "theme" => 'none',
        //"theme" => 'dark', uncomment for dark theme
        "title" => 'Enterprise X Hosting Cart',
        "software" => "HostingCart",
        "loginForm" => "login",
        "db_host" => "localhost",
        "db_user" => "enterprise",
        "db_password" => "enterprise",
        "db_base" => "EnterpriseAdmin",
        "loginLogo" => "assets/images/stfb-logo.gif",
        "mediumLogo" => "assets/images/stfb-logo.gif",
        "smallLogo" => "assets/images/stfblogosm.jpg",
        "defaultCompanyID" => "DINOS",
        "defaultDivisionID" => "DEFAULT",
        "defaultDepartmentID" => "DEFAULT",
        "EnterpriseXURL" => "/EnterpriseX",
        "EnterpriseXEmployeeID" => "Demo",
        "EnterpriseXEmployeePassword" => "Demo"
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
