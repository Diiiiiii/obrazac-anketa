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

<script>
 /*  function formProcess(){
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
 }  */

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

  include "message.php";

  /* function CheckOIB($oib) {

    if (strlen($oib) != 11 || !is_numeric($oib)) {
      return false;
    }
  
    $a = 10;
  
    for ($i = 0; $i < 10; $i++) {
  
      $a += (int)$oib[$i];
      $a %= 10;
  
      if ( $a == 0 ) { $a = 10; }
  
      $a *= 2;
      $a %= 11;
  
    }
  
    $kontrolni = 11 - $a;
  
    if ( $kontrolni == 10 ) { $kontrolni = 0; }
  
    return $kontrolni == intval(substr($oib, 10, 1), 10);
  } */
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

        <form name = "form" method="post" action="modified.php"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
          <div class="grid-x grid-padding-x">
            <div class="large-6 medium-6 cell">
             
                <label for="ime" >Ime <span class="error">* <?php echo $imeErr;?></span></label>
                  <input type="text" name="ime"  id="ime"  required>
                  
              
            </div>
          <!-- </div> -->
          <!-- <div class="grid-x grid-padding-x"> -->
            <div class="large-6 medium-6 cell">            
                <label>Prezime <span class="error">* <?php echo $prezimeErr;?></span></label>
                  <input type="text" name="prezime"  id="prezime" class="InputBox" required>
                   
             </div>
           </div>   
          <div class="grid-x grid-padding-x">
            <div class="large-6 medium-6 cell">
              <label>OIB <span class="error">* <?php echo $oibErr;?></span></label>
                <input type="text" name="oib" class="InputBox"  placeholder = "12345678901" id="oib" required >
                
            </div>
          <!-- </div>       -->
          <!-- <div class="grid-x grid-padding-x"> -->
            <div class="large-6 medium-6 cell">
              <label>Broj mobitela <span class="error">* <?php echo $mobitelErr;?></span> </label>
                <input type="tel" name="mobitel"   class="InputBox" id="mobitel" placeholder = "099 123 1234" required>
                
            </div>
          </div> 
        <!-- <small>Format: 099/456-789</small></div> -->
        <!-- Broj telefona:
         input type="textbox" name="telefon"><br><br> -->
         <div class="grid-x grid-padding-x">
          <div class="large-10 cell">
              <label>E-mail (privatni) <span class="error">* <?php echo $emailErr;?></span></label>
              <input type="email" name="email"  class="InputBox" id="email" required>
              
          </div>
         </div>    


            <?php
            //Include the database config file
                    include_once 'dbConfig.php';
      
            //Fetch all visoko uciliste data
                          $query = "SELECT * FROM spu.izvodac WHERE status = 1 ORDER BY izvodac_naziv ASC";
                          $result = $db->query($query);
            ?>

            
            <!-- Visoko učilište dropdown -->
                      <div class="grid-x grid-padding-x">
                        <div class="large-12 cell">
                          <label>Visoko učilište / izvođač <span class="error">* <?php echo $izvodac_nazivErr;?></span></label>
                          <select id="izvodac" name="izvodac_naziv" >
                           <option>Odaberite izvođača (fakultet)</option>
              
            <?php
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo '<option value="'.$row['izvodac_id'].'">'.$row['izvodac_naziv'].'</option>';
                    }
                }else{
                    echo '<option value="">Visoko učilište nije dostupno u bazi</option>';
            }
            ?>
        
              </select>
              
              
            </div>
           </div>
           <div class="grid-x grid-padding-x">
             <div class="large-12 cell">
              <label>Studijski program  <span class="error">* <?php echo $studijski_program_nazivErr;?></span></label>
              <select id="studijski_program" name="studijski_program_naziv">
              <options value="" >Odaberite studijski program></option>
           </select>
           
              </div>
            </div>
            <div class="grid-x grid-padding-x">
             <div class="large-12 cell">
               <label>Razina završenog studija <span class="error">* <?php echo $razina_nazivErr;?></span> </label>
                <select id="razina" name="razina">
                    <options value>Odaberite razinu studijskog programa></option>
                </select>
                                  
              </div>
            </div>

            <div class="grid-x grid-padding-x">
             <div class="large-12 cell">
               <label>Datum završetka studija <span class="error">* <?php echo $datumErr;?></span></label>
               <input type="date" id="datum" name="datum" >
               
              </div>
            </div>

          <div class="grid-x grid-padding-x">
            <div class="large-12 cell">
            <input id="checkbox1" type="checkbox" id="izjava" name="izjava">
            <label for="checkbox1">Izjavljujem da su podaci u tablici točni te da sam suglasan/suglasna da se koriste u gore navedenu svrhu.<span class="error">* <?php echo $izjavaErr;?></span></label>
            
              <br><br>
              <div class="large-6 medium-6 cell">
              <button type="submit" name="submit"  value="Pošalji"  class="button expanded hollow button">Pošalji  </a>
              </form>   
            </div>
          </div>
      </div>
    </div>
</body>
</html>