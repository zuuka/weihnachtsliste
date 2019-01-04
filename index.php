<!doctype html> 
<head> 
	<meta charset="utf-8"> 
	<title>Die Weichnachtswunschliste</title> 
</head>
<body>
	<?php
        require_once "classes/wishinput.class.php";
        require_once "classes/addressinput.class.php";
        require_once "classes/verifier.class.php";

        $wishes = new WishInput("Weichnachtsliste",3);
        $state = 0;        
        session_start();
        if(!isset($_SESSION['wishes'])) {
            $_SESSION['wishes'] = [];
        } 
        if(!isset($_SESSION['name'])) {
            $_SESSION['name'] = "";
        }
        if(!isset($_SESSION['place'])) {
            $_SESSION['place'] = "";
        }
        if(!isset($_SESSION['phone'])) {
            $_SESSION['phone'] = "";
        } 
        if(!empty($_SESSION['wishes'])) {
            for($x = 0; $x < $wishes->numWishes; $x++) {
                if(Verifier::verifyWish($_SESSION['wishes'][$x]) && !empty($_SESSION['wishes'][$x])) {
                    $state++;   
                }
            }
        }

        $wishes->showPage($_SESSION['wishes']);   

        if($state == 3) {
            echo "state = 1";
            $address = new AddressInput();
            $valid = 0;
            echo var_dump($_SESSION['name']);
            echo "<form method=\"post\">";
            $address->showName($_SESSION['name'], Verifier::verifyName(trim($_SESSION['name'])));
            $address->showPlace($_SESSION['place'], Verifier::verifyPlace(trim($_SESSION['place'])));
            $address->showPhone($_SESSION['phone'], Verifier::verifyPhone(preg_replace('/^\s*$/','',$_SESSION['phone'])));
            if(!$valid) {
                $address->writeButton("submit", "Ok");
            }        
            echo "</form>";
            if(isset($_POST['name'])) {
                $_SESSION['name'] = trim($_POST['name']); 
                header("Refresh:0");        
            } 
            if(isset($_POST['place'])) {
                $_SESSION['place'] = trim($_POST['place']); 
                header("Refresh:0");        
            }     
            if(isset($_POST['phone'])) {
                $_SESSION['phone'] = trim($_POST['phone']); 
                header("Refresh:0");        
            }                
        }

        for($x = 0; $x < $wishes->numWishes; $x++) {
	        if(isset($_POST["wish".$x])) {
                //echo "$_POST[$value]<br>";
                $_SESSION['wishes'][$x] = $_POST["wish".$x];
                header("Refresh:0");
              }
	        }
	?>
</body>
