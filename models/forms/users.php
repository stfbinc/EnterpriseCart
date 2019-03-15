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

  Last Modified: 15.03.2019
  Last Modified by: Nikita Zaharov
*/

class users{
    public function login(){
        print_r($_POST);
        /*        $result = $GLOBALS["capsule"]::select("SELECT * from payrollemployees WHERE CompanyID='" . $company . "' AND EmployeeUserName='". $name ."' AND EmployeePassword='" . $password . "' AND DivisionID='" . $division . "' AND DepartmentID='" . $department . "'", array());
        if(!$result)
            return false;
        $result = json_decode(json_encode($result), true);
        $result = $result[0];
        $GLOBALS["capsule"]::insert("INSERT INTO auditlogin(CompanyID,DivisionID,DepartmentID,EmployeeID,LoginDateTime,IPAddress) values('" . $result["CompanyID"] . "','" . $result["DivisionID"] ."','" . $result["DepartmentID"] . "','" . $result["EmployeeID"] . "', NOW(),'" . $_SERVER['REMOTE_ADDR'] ."')");
            
        $result["accesspermissions"] = json_decode(json_encode($GLOBALS["capsule"]::select("SELECT * FROM accesspermissions WHERE CompanyID='" . $result["CompanyID"] . "' AND DivisionID='" . $result["DivisionID"] ."' AND DepartmentID='" . $result["DepartmentID"] . "' AND EmployeeID='" . $result["EmployeeID"] . "'")), true)[0];
        $companyRecord = $GLOBALS["capsule"]::select("SELECT * from companies WHERE CompanyID='" . $result['CompanyID'] . "'", array());
        if(!$companyRecord)
            return false;
        $companyRecord = json_decode(json_encode($companyRecord), true);
        $result['CompanyName'] = $companyRecord[0]['CompanyName'];
        $result["company"] = $companyRecord[0];
        $config = config();
        if($result["company"]["SmallLogo"] == "")
            $result["company"]["SmallLogo"] = $config["smallLogo"];
        else
            $result["company"]["SmallLogo"] = 'uploads/' . $result["company"]["SmallLogo"];
        if($result["company"]["MediumLogo"] == "")
            $result["company"]["MediumLogo"] = $config["mediumLogo"];
        else
            $result["company"]["MediumLogo"] = 'uploads/' . $result["company"]["MediumLogo"];
        if($result["company"]["Logo"] == "")
            $result["company"]["Logo"] = $config["smallLogo"];
        else
            $result["company"]["Logo"] = 'uploads/' . $result["company"]["Logo"];
        $result["company"]["CompanyLogoUrl"] = $result["company"]["SmallLogo"];
        
        return $result;*/
    }
}
?>