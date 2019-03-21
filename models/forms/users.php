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
        $defaultCompany = Session::get("defaultCompany");
        $result = DB::select("SELECT * from customerinformation WHERE CompanyID=? AND DivisionID=? AND DepartmentID=? AND CustomerLogin=? AND CustomerPassword=?", array($defaultCompany["CompanyID"], $defaultCompany["DivisionID"], $defaultCompany["DepartmentID"], $_POST["username"], $_POST["password"]));
        if(!count($result)){
            http_response_code(401);
            echo "login failed";
        }else{
            $user = [
                "Customer" => $result[0],
                "language" => Session::get("user") ? Session::get("user")["language"] : "English"
            ];
            Session::set("user", $user);
            echo json_encode($user, JSON_PRETTY_PRINT);
        }
    }

    public function logout(){
        Session::set("user", [
            "language" => Session::get("user") ? Session::get("user")["language"] : "English"
        ]);
        Session::set("defaultCompany", null);
        echo json_encode([]);
    }
}
?>