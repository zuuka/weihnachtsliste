<?php

class AddressInput {
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

	public function writeButton($type, $value) {
		echo "<input type=\"$type\" value=\"$value\">";
	}

    public function showName($value, $valid = 0) {
        // adress values are empty only show inputs and labels        
        if(empty($value)) {
            $this->writeTextField("Vor & Nachname", "name" , null);      
        }
        // value is given check if ok else show errorlabel
        else {
           if($valid) {
            $this->writeTextField("Vor & Nachname", "name" , $value);  
           } else {
             $this->writeTextField("Vor & Nachname", "name" , null);
             $this->writeErrorLabel("Bitte Vor & Nachname eingeben");
           }          
        }
    }

    public function showPlace($value, $valid = 0) {
        if(empty($value)) {
          $this->writeTextField("Ort & PLZ", "place" , null);  
        }
        // value is given check if ok else show errorlabel
        else {
           if($valid) {
            $this->writeTextField("Ort & PLZ", "place" , $value);  
           } else {
             $this->writeTextField("Ort & PLZ", "place" , null);
             $this->writeErrorLabel("Bitte eine 5 stellig PLZ und Ort eingeben");
           }
        }     
    }

    public function showPhone($value, $valid = 0) {
        if(empty($value)) {
          $this->writeTextField("Telefon", "phone" , null);  
        }
        // value is given check if ok else show errorlabel
        else {
           if($valid) {
             $this->writeTextField("Telefon", "phone" , $value);  
           } else {
             $this->writeTextField("Telefon", "phone" , null);
             $this->writeErrorLabel("Bitte eine gueltige Telefonnummer eingeben");
           }
        }   
    }

}
?>
