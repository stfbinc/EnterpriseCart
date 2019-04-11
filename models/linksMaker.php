<?php
/*
  Name of Page: linksMaker

  Method: making links for many pages

  Date created: Nikita Zaharov, 22.03.2019

  Use: model for making links
  Input parameters:
  $app : application instance, object

  Output parameters:

  Called from:
  + index.php

  Calls:

  Last Modified: 22.03.2019
  Last Modified by: Nikita Zaharov
*/

class linksMaker{
    public $scope;
    function linksMaker($scope){
        $this->scope = $scope;
    }

    function makeEnterpriseXKeyString(){
        $defaultCompany = Session::get("defaultCompany");
        return "{$defaultCompany["CompanyID"]}__{$defaultCompany["DivisionID"]}__{$defaultCompany["DepartmentID"]}";
    }
    
    function makeEnterpriseXAuthParams(){
        $defaultCompany = Session::get("defaultCompany");
        return "CompanyID={$defaultCompany["CompanyID"]}&DivisionID={$defaultCompany["DivisionID"]}&DepartmentID={$defaultCompany["DepartmentID"]}&EmployeeID={$this->scope["config"]["EnterpriseXEmployeeID"]}&EmployeePassword={$this->scope["config"]["EnterpriseXEmployeePassword"]}";
    }
    
    function makeEnterpriseXDocreportsLink($type, $id){
        return "{$this->scope["config"]["EnterpriseXURL"]}/index.php?page=docreports&type=$type&id=$id&" . $this->makeEnterpriseXAuthParams();
    }
    
    function makeEnterpriseXImageLink($scope, $item, $field){
        if(file_exists(__DIR__ . "/../../{$this->scope["config"]["EnterpriseXURL"]}/uploads/{$item->$field}"))
            return "{$this->scope["config"]["EnterpriseXURL"]}/uploads/{$item->$field}";
        else
            return "assets/img/stfblogosm.jpg";
    }
    
    function makeFamilyImageLink($family){
        return ($family->FamilyPictureURL != null  && count($family->FamilyPictureURL)? "assets/img/" . $family->FamilyPictureURL : "assets/img/product/s1.jpg");
    }

    function makeFamilyLink($familyName){
        return "#/?page=forms&action=products&categories=true&family=$familyName";
    }
    
    function makeCategoryImageLink($category){
        return ($category->CategoryPictureURL != null  && count($category->CategoryPictureURL)? "assets/img/" . $category->CategoryPictureURL : "assets/img/product/s1.jpg");
    }

    function makeCategoryLink($category){
        return "#/?page=forms&action=products&categories=true&family={$_GET["family"]}&category=$category&items=true";
    }

    function makeItemImageLink($item){
        return ($item->PictureURL != null  && count($item->PictureURL)? "assets/img/" . $item->PictureURL : "assets/img/product/s1.jpg");
    }

    function makeItemLink($item){
        return "#/?page=forms&action=products&categories=true&family={$_GET["family"]}&items=true&category={$_GET["category"]}&item=$item";
    }
}
?>