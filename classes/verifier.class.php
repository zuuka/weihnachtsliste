<?php

class Verifier {
    public static function verifyWish($value) {
        if(!preg_match('/[^0-9_a-zA-Z]/', $value)) {
            return true;
        } 
        else {
            return false;
        }
	}
    
    public static function verifyName($value) {
        // Vor und Zunamen finden getrennt durch ein Leerzeichen, Bindestriche im Nachnamen sind erlaubt
        if(preg_match("/(\A([A-Z]{1})([a-zäöüß]+)\s{1,2}([A-Z]{1})([a-zäöüß]+)\Z)/", $value)) {
            return true;
        } 
        else {
            return false;
        }
	}

    public static function verifyPlace($value) {
        //PLZ und Ortsname , muss mit Grossbuchstaben beginnen oder mit Ziffer
        //Es muss ein Leerzeichen zwischen Ziffern und Ortsnamen sein und die PLZ muss
        //5 Ziffern betragen 
        if(preg_match("/(\A([0-9]{5})\s{1,2}([A-Z]{1})([a-zäöüß]+)\Z)/", $value) || 
           preg_match("/(\A([A-Z]{1})([a-zäöüß]+)\s{1,2}([0-9]{5})\Z)/", $value)
            ) {
            return true;
        } 
        else {
            return false;
        }
	}

    public static function verifyPhone($value) {
        // Telefonnummer muss mindesten 8 Ziffern haben und maximal 20 , darf nur aus Ziffern bestehen
        if(preg_match("/(\A([0-9+]{3,40})\Z)/", $value)) {
            return true;
        } 
        else {
            return false;
        }
	}
}

?>
