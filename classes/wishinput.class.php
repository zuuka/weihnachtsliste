<?php

/**
 * Klasse generiert im Konstruktor n Eingabefelder innerhalb eines form html Tags
 */

require_once "verifier.class.php";

class WishInput {
	public $numWishes = 0;
    private $title = "";

	public function __construct($heading, $size) {
		if (isset($heading)) {
            $this->title = $heading;
		}
		if (isset($size)) {
            $this->numWishes = $size;
		}
	}

	private function writeTextField($label, $name, $value) {
        if(isset($value)) {
		    echo "$label: <input type=\"text\" value=\"$value\" name=\"$name\"\><br>\r\n";
	            
        } 
        else {
            echo "$label: <input type=\"text\" name=\"$name\"\><br>\r\n";          
        }
	}

    private function writeErrorLabel($value) {
        echo "<label style=\"color : red;\"> $value </label><br>\r\n";
    }

	private function writeButton($type, $value) {
		echo "<input type=\"$type\" value=\"$value\">";
	}

    public function showPage($values){
        //echo var_dump($values);
        if(isset($this->title)) {
			echo "<h1>{$this->title}</h1><br>";
		}
        echo "<form method=\"post\">";
        static $inValid = 0;
        if(!empty($values)) {
            for($x = 0; $x < $this->numWishes; $x++) {
                    if(!Verifier::verifyWish($values[$x]) || empty($values[$x])){
                        $inValid = 1;
                    }
            }
            if($inValid) {
                for($x = 0; $x < $this->numWishes; $x++) {
                   if(isset($values)) {
                        if(!Verifier::verifyWish($values[$x])) {
		                    $this->writeTextField("Wunsch ".$x, "wish".$x, null);
                            $this->writeErrorLabel("Keine Sonderzeichen");
                        } 
                         else {        
                            $this->writeTextField("Wunsch ".$x, "wish".$x, $values[$x]);          
		                } 
                   }
                }
            }
            else {
                for($x = 0; $x < $this->numWishes; $x++) {       
                    echo "<label style=\"color : green;\">Wunsch {$x}: {$values[$x]} </label><br>\r\n";
                }
            }
        } 
        else {
            for($x = 0; $x < $this->numWishes; $x++) {    
                $this->writeTextField("Wunsch ".$x, "wish".$x, "");    
            }
            $inValid = 1;
        }
        if($inValid) {
            $this->writeButton("submit","OK");
        }
        echo "</form>"; 
    }
}
?>
