<?php

function currency($value, $locale = null) {
    if ($locale == null)
        $locale = 'ID_id'; //Config::get('app.locale');
    $formater = new NumberFormatter('$locale', NumberFormatter::CURRENCY);
    $formater->setTextAttribute(NumberFormatter::CURRENCY_CODE, "Rp ");
   
    $formater->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
    $form = $formater->format($value);
    $a = array( ",", ".", "koma" );
    $b = array( "koma", ",", "." );

    $formatter = str_replace( $a, $b, $form);

    return $formatter;
}

function numbertoword($value, $local = null) {
    if ($local == null){
        $local = 'id'; //Config::get('app.locale');
    }
    $formater = new NumberFormatter($local, NumberFormatter::SPELLOUT);
    //$formater->setTextAttribute(NumberFormatter::DEFAULT_RULESET, "%spellout-numbering");
    return $formater->format($value);
}