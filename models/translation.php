<?php
/*
  Name of Page: Translation

  Method: Translation model, used for translation ui items

  Date created: Nikita Zaharov, 14.03.2019

  Use: translationg used by all page controllers for translating purpose

  Input parameters:
  $db: database instance
  $language: language to translate to

  Output parameters:
  $translation: model, it is responsible for translation in view

  Called from:
  + most controllers from /controllers

  Calls:
  sql

  Last Modified: 14.03.2019
  Last Modified by: Nikita Zaharov
*/


class translation{
    protected $terms = array();
    
    public $lang = "English";
    //list of available languages
    public $languages = [
        "English",
        "Dutch",
        "French",
        "Fund",
        "German",
        "Arabic",
        "ChineseSimple",
        "ChineseTrad",
        "Hindi",
        "Italian",
        "Japanese",
        "Korean",
        "Portuguese",
        "Russian",
        "Spanish",
        "Swedish",
        "Thai"
    ];

    public function __construct($language){
        if($language)
            $this->lang = $language;
        $session_id = Session::get("session_id");
        $result = API_request("page=api&module=forms&path=SystemSetup/Application/Interface&action=procedure&procedure=getTranslation&session_id=$session_id&language=$language", "GET", null);
        $this->terms = $result["response"];
    }

    //translate term(label) to language with whic model is initialized
    public function translateLabel($label){
        //      echo $label . $this->terms[$label]["Translated"] . $this->lang;
        if(key_exists($label, $this->terms) && $this->terms->$label->Translated){
            $lang = $this->lang;
            return $this->terms->$label->$lang;
        }else
            return $label;
    }
}
?>