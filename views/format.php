<?php
function numberToStr($strin){
    return preg_replace('/\B(?=(\d{3})+(?!\d))/', ',', $strin);
}
function formatCurrency($value, $afterdot = 2){
    if(preg_match('/([-+\d]+)\.(\d+)/', $value, $numberParts)){
        return numberToStr($numberParts[1]) . '.' . substr($numberParts[2], 0, $afterdot);
    }
        return $value;
}

function formatDate($value){
    return date("m/d/y", strtotime($value));
}
?>