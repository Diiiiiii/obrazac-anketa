<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">

<head>
<meta charset="UTF-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Anketa o zapošljivost</title>
 <link rel="stylesheet" href="./Foundation-Sites-CSS/css/foundation.css">
<link rel="stylesheet" href="./Foundation-Sites-CSS/css/app.css"> 
<link rel="stylesheet" type="text/css" href="main.css">  
 <!-- <script defer src="script.js"></script>  -->
</head>

<script src="jquery.main.js" type="text/javascript"></script>


<?php

include "dbConfig.php";

    try {
      $imeErr = $prezimeErr = $oibErr = $emailErr = $mobitelErr = $izvodac_nazivErr = $studijski_program_nazivErr = $razina_nazivErr = $datumErr = $izjavaErr = "";
      $ime = $prezime = $oib = $email = $mobitel = $izvodac_naziv = $studijski_program_naziv = $razina = $datum = $izjava = "";
    
      //Input fields validation
      if ($_SERVER["REQUEST_METHOD"] == "POST") {

      if (isset($_POST['submit'])) {

      if (empty($_POST["ime"])) {
      $imeErr = "Ime is required";
      } else {
        $ime = test_input($_POST["ime"]);
      }
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z-' ]*$/",$ime)) {
          $imeErr = "Only letters and white space allowed";
        }
           }    
     
      if (empty($_POST["prezime"])) {
       $prezimeErr =  "Prezime is required";
     } else {
       $prezime = test_input($_POST["prezime"]);
     
       // check if name only contains letters and whitespace
     }
     
       if (empty($_POST["oib"])) {
       $oibErr = "OIB is required";
       } else {
       $oib = test_input($_POST["oib"]);
       // check if e-mail address is well-formed
     
       if (!filter_var($oib)) {
         $oibErr = "Invalid OIB format";
       }
       }
     
       if (empty($_POST["mobitel"])) {
       $mobitelErr = "Mobitel is required";
     } else {
       $mobitel = test_input($_POST["mobitel"]);
       // check if e-mail address is well-formed
      
       if (!preg_match("/^[0-9]{3}\s[0-9]{3}\s[0-9]{4}+$/", $mobitel)) {
         $mobitelErr = "Invalid mobitel format";
       } 
     }
     
       if (empty($_POST["email"])) {
       $emailErr = "Email is required";
     } else {
       $email = test_input($_POST["email"]);
       // check if e-mail address is well-formed
     
       if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $emailErr = "Invalid email format";
       }
     }
     
     if (empty($_POST["izvodac_naziv"])) {
     $izvodac_nazivErr = "Izvođač is required";
     } else {
     $izvodac_naziv = test_input($_POST["izvodac_naziv"]);
     // check if e-mail address is well-formed
     
     } 
     
      if (empty($_POST["studijski_program_naziv"])) {
     $studijski_program_nazivErr = "Studijski program is required";
     } else {
     $studijski_program_naziv = test_input($_POST["studijski_program_naziv"]);
     // check if e-mail address is well-formed
     } 
     
      if (empty($_POST["razina_naziv"])) {
     $razinaErr = "Razina is required";
     } else {
     $razina = test_input($_POST["razina_naziv"]);
     // check if e-mail address is well-formed
     }
      
      if (empty($_POST["datum"])) {
     $datumErr = "Datum is required";
     } else {
     $datum = test_input($_POST["datum"]);
     // check if e-mail address is well-formed
     } 
     
       if (isset($_POST['submit'])) {
         if (empty($_POST["izjava"])) {
         $izjavaErr = "Izjava is required";
      } else {
    $izjava = test_input($_POST["izjava"]);
    // check if e-mail address is well-formed
      }
  }
}

if (isset($_POST['submit'])) {
    if (isset($_POST["ime"]) && isset($_POST["prezime"])&& isset($_POST["oib"])&& isset($_POST["mobitel"])&& isset($_POST["email"])&& isset($_POST["izvodac_naziv"])&& isset($_POST["studijski_program_naziv"]) && isset($_POST["razina"])&& isset($_POST["datum"])&& isset($_POST["izjava"])) {
        $ime = test_input($_POST["ime"]);
        $prezime = test_input($_POST["prezime"]);
        $oib = test_input($_POST["oib"]);
        $mobitel = test_input($_POST["mobitel"]);
        $email = test_input($_POST["email"]);
        $izvodac_naziv = test_input($_POST["izvodac_naziv"]);
        $studijski_program_naziv = test_input($_POST["studijski_program_naziv"]);
        $razina = test_input($_POST["razina"]);
        $datum = test_input($_POST["datum"]);
        $izjava = test_input($_POST["izjava"]);

        $user = "root";
        $pass = "";
        $dbh = new PDO ('mysql:host=localhost;dbname=spu', $user, $pass);
        $dbh->setAttribute (PDO:: ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $sql = "INSERT INTO studenti (ime, prezime, oib, mobitel, email, izvodac_naziv, studijski_program_naziv, razina, datum) VALUES ('$ime', '$prezime', '$oib', '$mobitel', '$email', '$izvodac_naziv', '$studijski_program_naziv', '$razina', '$datum')";
        $dbh->exec($sql);

echo '<div class="alert-success"><h3>Primili smo Vaše podatke!</h3> <p>Zahvaljujemo na suradnji.</p>';


echo "<strong>Primljeni podaci:</strong>";
echo "</br>";
echo "Ime:" . ' ' .$ime;
echo "<br>";
echo "Prezime:" . ' ' .$prezime;
echo "<br>";
echo "OIB" . ' ' . $oib;
echo "<br>";
echo "Email:" . ' ' .$email;
echo "<br>";
echo "Šifra izvođača:" . ' ' . $izvodac_naziv;
echo "<br>";
echo "Šifra studijskog programa:" . ' '. $studijski_program_naziv;
echo "<br>";
echo "Razina obrazovanja: " . ' ' . $razina;
echo "<br>";
echo "Datum završetka studija: " . ' ' . $datum;
echo '</div>';

    }
    
}
 }
    catch (PDOException $e) 
          { print "Error!: " . $e->getMessage() . "<br/>";
     die();
   }

   function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;

    }
  ?>


<!-- <p>Hello boys and girls</p> -->
</body>
</html>