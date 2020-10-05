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

  Last Modified: 03.09.2019
  Last Modified by: Nikita Zaharov
*/

class linksMaker{
    public $scope;
    public $fileNotFoundPath = "assets/img/notfound.png";
    function __construct($scope){
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
        return "index.php?page=docreports&type=$type&id=$id";
    }
    
    function makeEnterpriseXImageLink($scope, $item, $field){
        //echo json_encode($item);
        //$field = strtolower($field);
        //        echo __DIR__ . "/../../{$this->scope["config"]["EnterpriseXURL"]}/uploads/{$item->$field}";
        if($item->$field != null && strlen($item->$field) && file_exists(__DIR__ . "/../../uploads/{$item->$field}"))
            return "{$this->scope["config"]["EnterpriseXURL"]}/uploads/{$item->$field}";
        else
            return $this->fileNotFoundPath;
    }
    
    function makeFamilyImageLink($family){
        if($this->makeEnterpriseXImageLink("", $family, "FamilyPicture") != $this->fileNotFoundPath)
            return $this->makeEnterpriseXImageLink("", $family, "FamilyPicture");
        else
            return ($family->FamilyPictureURL != null  && strlen($family->FamilyPictureURL)? "assets/img/" . $family->FamilyPictureURL : $this->fileNotFoundPath);
    }

    function makeFamilyLink($familyName){
        return "#/?page=forms&action=products&categories=true&family=$familyName";
    }
    
    function makeCategoryImageLink($category){
        if($this->makeEnterpriseXImageLink("", $category, "CategoryPicture") != $this->fileNotFoundPath)
            return $this->makeEnterpriseXImageLink("", $category, "CategoryPicture");
        else
            return ($category->CategoryPictureURL != null  && strlen($category->CategoryPictureURL)? "assets/img/" . $category->CategoryPictureURL : $this->fileNotFoundPath);
    }

    function makeCategoryLink($category){
        return "#/?page=forms&action=products&categories=true&family={$_GET["family"]}&category=$category&items=true";
    }

    function makeItemImageLink($item){
        if($this->makeEnterpriseXImageLink("", $item, "Picture") != $this->fileNotFoundPath)
            return $this->makeEnterpriseXImageLink("", $item, "Picture");
        else
            return ($item->PictureURL != null  && strlen($item->PictureURL)? "assets/img/" . $item->PictureURL : $this->fileNotFoundPath);
    }

    function makeItemLink($item){
        return "#/?page=forms&action=products&categories=true&family={$_GET["family"]}&items=true&category={$_GET["category"]}&item=$item";
    }

    function makeAppLink($configName){
        echo "{$this->scope["config"]["EnterpriseXURL"]}/index.php?page=login&config=$configName";
    }

    function makeProductsLink(){
        return "index.php#/?page=forms&action=products";
    }
}
?>