<?php
function config(){
    return array(
        "theme" => 'none',
        //"theme" => 'dark', uncomment for dark theme
        "title" => 'Enterprise Cart',
        "software" => "Cart",
        "loginForm" => "login",
        "loginLogo" => "assets/images/stfb-logo.gif",
        "mediumLogo" => "assets/images/stfb-logo.gif",
        "smallLogo" => "assets/images/stfblogosm.jpg",
        "defaultCompanyID" => "DINOS",
        "defaultDivisionID" => "DEFAULT",
        "defaultDepartmentID" => "DEFAULT",
        "EnterpriseUniversalAPI" => [
            //"address" => "http://localhost/EnterpriseUniversalAPI/",
            "address" => "https://stfb.net/EnterpriseUniversalAPI/",
            "CompanyID" => "DINOS",
            "DivisionID" => "DEFAULT",
            "DepartmentID" => "DEFAULT",
            "EmployeeID" => "Demo",
            "EmployeePassword" => "Demo",
            "language" => "english"
        ],
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
