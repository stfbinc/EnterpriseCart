<?php
function config(){
    return array(
        "theme" => 'none',
        //"theme" => 'dark', uncomment for dark theme
        "title" => 'Integral Accounting X STFB',
        "software" => "Cart",
        "loginForm" => "login",
        "db_host" => "localhost",
        "db_user" => "enterprise",
        "db_password" => "enterprise",
        "db_base" => "stfbenterprise",
        "loginLogo" => "assets/images/stfb-logo.gif",
        "mediumLogo" => "assets/images/stfb-logo.gif",
        "smallLogo" => "assets/images/stfblogosm.jpg",
        "defaultCompanyID" => "STFB",
        "defaultDivisionID" => "DEFAULT",
        "defaultDepartmentID" => "DEFAULT",
        "EnterpriseXURL" => "/EnterpriseX",
        "EnterpriseXEmployeeID" => "Demo",
        "EnterpriseXEmployeePassword" => "Demo"
    );
}



function defaultUser(){
    return [
        "Company" => "STFB",
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
