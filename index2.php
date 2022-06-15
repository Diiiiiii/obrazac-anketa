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
</head>

<script src="jquery.main.js" type="text/javascript"></script>

<script>
  function formProcess(){
  var capture = document.forms["input"]["ime"].value + '<br>';
  capture += document.forms["input"]["prezime"].value + '<br>';
  capture += document.forms["input"]["oib"].value + '<br>';
  capture += document.forms["input"]["mobitel"].value + '<br>';
  capture += document.forms["input"]["email"].value + '<br>';
  capture += document.forms["input"]["izvodac"].value + '<br>';
  capture += document.forms["input"]["studijski_program"].value + '<br>';
  capture += document.forms["input"]["razina"].value + '<br>';
  capture += document.forms["input"]["datum"].value + '<br>';
  capture += document.forms["input"]["izjava"].value + '<br>';
 } 

$(document).ready(function(){
    $('#izvodac').on('change', function(){
        var izvodacID = $(this).val();
        if(izvodacID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'izvodac_id='+izvodacID,
                success:function(html){
                    $('#studijski_program').html(html);
                    $('#razina').html('<option value="">Prethodno odaberite studijski program</option>');
                }
            });
        } else {
            $('#studijski_program').html('<option value="">Prethodno odaberite izvođača</option>');
            $('#razina').html('<option value="">Prethodno odaberite studijski program </option>');
        }
    });
    $('#studijski_program').on('change', function(){
        var studijskiprogramID = $(this).val();
        if(studijskiprogramID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'studijski_program_id='+studijskiprogramID,
                success:function(html){
                    $('#razina').html(html);
                }
            });
        } else {
            $('#razina').html('<option value="">Prethodno odaberite studijski program</option>');
          }
        });
  });

  $(function(){
  $('form input').on('keyup',function() {
          var empty = false;
          $('form input').each(function() {
              if ($(this).val() == '') {
                  empty = true;
              }
          });

          if (empty) {
              $('#submit').attr('disabled', 'disabled'); //Leave as disabled if any of the  fields are empty
          } else {
              $('#submit').removeAttr('disabled');//Remove the disabled attribute once all fields are filled
          }
      });
  });
</script>

<body>

  <?php

    try {
      $imeErr = $prezimeErr = $oibErr = $emailErr = $mobitelErr = $izvodac_nazivErr = $studijski_program_nazivErr = $razinaErr = $datumErr = $izjavaErr = "";
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
     
     if (empty($_POST["izvodac"])) {
     $izvodac_nazivErr = "Izvođač is required";
     } else {
     $izvodac_naziv = test_input($_POST["izvodac"]);
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
      
                echo "<h1>Primili smo Vaše podatke! Zahvaljujemo na suradnji.</h1>";
                echo "<h3>Vaši podaci:</h3>";
          // echo "Ime:" . ' '. $ime;
          // echo "<br>";
          // echo "Prezime:" . ' ' .$prezime;
          // echo "<br>";
          // echo "OIB" . ' ' . $oib;
          // echo "<br>";
          // echo "Email:" . ' ' .$email;
          // echo "<br>";
          // echo "Šifra izvođača:" . ' ' . $izvodac_naziv;
          // echo "<br>";
          // echo "Šifra studijskog programa:" . ' '. $studijski_program_naziv;
          // echo "<br>";
          // echo "Šifra razine obrazovanja: " . ' ' . $razina;
          // echo "<br>";
          // echo "Datum završetka studija: " . ' ' . $datum;
          // echo "<br>";
          // echo "Izjavljujem da su podaci u tablici točni te da sam suglasan/suglasna da se koriste u navedenu svrhu.";
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
      <div class="grid-container">
        <div class="grid-x grid-padding-x">
         <div class="large-12 cell">
          <div class="content">
          <figure class="form-registration-img">
              <img src="./images.png" alt="studij.hr" />
          </figure>
            <h4>Poštovana/Poštovani,</h4><br>
            <p>Agencija za znanost i visoko obrazovanje provodi istraživanje o zapošljavanju po završetku studija. Rezultati koje dobijemo ovim istraživanjem poslužit će za unapređenje sustava visokog obrazovanja i boljoj povezanosti s tržištem rada.</p>
            <p>U svrhu provođenja ankete Vaši podaci su nam neophodni za uspješnu realizaciju ovoga, nacionalnoga istraživanja. Stoga Vas molimo da niže u tablici unesete svoje osobne i kontaktne podatke putem kojih ćete biti dostupni za pružanje informacija po završetku studija. Naime, u svrhu prikupljanja podataka o zapošljivosti, kontaktirali bismo Vas sa zamolbom za ispunjenje upitnika o zaposlenju u određenim periodima nakon završetka studija.</p>
            <p><span class="error">* obavezna polja</span></p>
          </div>  
          </div>
        </div>

        <form name = "form" method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
          <div class="grid-x grid-padding-x">
            <div class="large-6 medium-6 cell">
             
                <label >Ime:</label>
                  <input type="text" name="ime"  id="ime"  required>
                  <span class="error" >* <?php echo $imeErr;?></span>
              
            </div>

            <div class="large-6 medium-6 cell">            
                <label>Prezime:</label>
                  <input type="text" name="prezime"  id="prezime" class="InputBox" required>
                  <span class="error">* <?php echo $prezimeErr;?></span>  
             </div>
           </div>
           <div class="grid-x grid-padding-x">
            <div class="large-6 medium-6 cell">
              <label>OIB:</label>
                <input type="text" name="oib"  class="InputBox" id="oib" required >
                <span class="error">* <?php echo $oibErr;?></span>
            </div>
            <div class="large-6 medium-6 cell">
              <label>Broj mobitela: </label>
                <input type="tel" name="mobitel"   class="InputBox" id="mobitel" placeholder = "099 123 1234" required>
                <span class="error">* <?php echo $mobitelErr;?></span>
            </div>
          </div> 
          <div class="grid-x grid-padding-x">
          <div class="large-10 cell">
              <label>E-mail (privatni):</label>
              <input type="email" name="email"  class="InputBox" id="email" required>
              <span class="error">* <?php echo $emailErr;?></span>
          </div>
        </div> 
  </form>

             
      
</body>
<html>