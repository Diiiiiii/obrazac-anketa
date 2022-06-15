<?php

// Include the database config file
include_once 'dbConfig.php';

if(!empty($_POST["izvodac_id"])){
    // Fetch state data based on the specific country
    $query = "SELECT * FROM studijski_program WHERE izvodac_id = ".$_POST['izvodac_id']." AND status = 1 ORDER BY studijski_program_naziv ASC";
    $result = $db->query($query);

    // Generate HTML of state options list
    if($result->num_rows > 0){
        echo '<option value="">Studijski program</option>';
        while($row = $result->fetch_assoc()){
            echo '<option value="'.$row['studijski_program_id'].'">'.$row['studijski_program_naziv'].'</option>';
        }
    }else{
        echo '<option value="">Nema studijskih programa u bazi</option>';
    }

}elseif(!empty($_POST["studijski_program_id"])){
    // Fetch city data based on the specific state
    $query = "SELECT * FROM razina_studija WHERE studijski_program_id = ".$_POST['studijski_program_id']." AND status = 1 
            --   INNER JOIN ON studijski_program WHERE studijski_program.razina_studija_id =  razina_studija.razina_studija_id
                ORDER BY razina_studija_id ASC";
    $result = $db->query($query);

    // Generate HTML of city options list
    if($result->num_rows > 0){
        echo '<option value="">Odaberite razinu obrazovanja</option>';
        while($row = $result->fetch_assoc()){
            echo '<option value="'.$row['razina_studija_naziv'].'">'.$row['razina_studija_naziv'].'</option>';
        }
    }else{
        echo '<option value="">Razina za izabrani program nije dostupna u bazi</option>';
    }
}
?>
