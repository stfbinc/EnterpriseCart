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
        return "#/?page=forms&action=products&categories=true&family={$_GET["family"]}&items=true&item=$item";
    }
}
?>