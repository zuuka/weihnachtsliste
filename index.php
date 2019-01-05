<!doctype html> 
<head> 
	<meta charset="utf-8"> 
	<title>Die Weihnachtswunschliste</title> 
</head>
<body>
	<?php
        require_once "classes/wishinput.class.php";
        require_once "classes/addressinput.class.php";
        require_once "classes/verifier.class.php";

        $wishes = new WishInput("Weihnachtsliste",3);
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
            $address = new AddressInput();
            $valid = Verifier::verifyName(trim($_SESSION['name'])) && 
                     Verifier::verifyPlace(trim($_SESSION['place'])) &&
                     Verifier::verifyPhone(preg_replace('/^\s*$/','',$_SESSION['phone']));
            echo "<form method=\"post\">";
            if(!$valid) {
                $address->showName($_SESSION['name'], Verifier::verifyName(trim($_SESSION['name'])));
                $address->showPlace($_SESSION['place'], Verifier::verifyPlace(trim($_SESSION['place'])));
                $address->showPhone($_SESSION['phone'], Verifier::verifyPhone(preg_replace('/^\s*$/','',$_SESSION['phone'])));
                $address->writeButton("submit", "Ok");
            } 
            else {
                $address->showFinalLabel("Vor & Zuname: {$_SESSION['name']}");
                $address->showFinalLabel("Ort & PLZ:    {$_SESSION['place']}");
                $address->showFinalLabel("Telefon:      {$_SESSION['phone']}");
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
                $_SESSION['wishes'][$x] = $_POST["wish".$x];
                header("Refresh:0");
              }
	        }
	?>
</body>
