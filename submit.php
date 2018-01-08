<?php
session_start();
require_once("utils.php");

siteHeader();
siteNavigation();
//formin tulee olla täytetty, id otetaan sessiosta jotta kirjautunut käyttäjä kirjaa vain omia listauksiaan.
if (isset($_POST["jobtype"]) && isset($_POST["jobname"]) && isset($_POST["location"]) 
&& isset($_POST["jobstart"]) && isset($_POST["jobend"]) && strlen($_POST["description"]) > 0) {
    $db = connectDb();
    $stmt = $db->prepare("INSERT INTO jobs (firmid, jobtype, jobname, location, jobstart, jobend, description) VALUES (:f1, :f2, :f3, :f4, :f5, :f6, :f7)");
    $stmt->bindParam(":f1", $_SESSION["id"]);
    $stmt->bindParam(":f2", $_POST["jobtype"]);
    $stmt->bindParam(":f3", $_POST["jobname"]);
    $stmt->bindParam(":f4", $_POST["location"]);
    $stmt->bindParam(":f5", $_POST["jobstart"]);
    $stmt->bindParam(":f6", $_POST["jobend"]);
    $stmt->bindParam(":f7", $_POST["description"]);
    if ($stmt->execute()) {
         echo "<p>Ilmoitus lisätty.</p>";
    } else {
        echo "<p>yhteydessä on jokin virhe. " . $stmt->error . "</p>";
    }
} else {
    echo "<h2>Lisää työpaikka listaan</h2>
    <p class='infobox'>Älä jätä kenttiä tyhjäksi. Kuvauksessa on tuhannen merkin raja.</p>
    <form action='submit.php' method='post' id='submitform'>
    Tehtävän nimi: <br><input name=jobname type='text'><br>
    Työn luonne: <br><input type='radio' name='jobtype' value='1'>Diplomityö<br>
    <input type='radio' name='jobtype' value='2'>Kandityö<br>
    <input type='radio' name='jobtype' value='3'>kesätyö<br>
    <input type='radio' name='jobtype' value='4'>osa-aikatyö<br>
    <input type='radio' name='jobtype' value='5'>muu<br>
    Työn sijainti: <br><input name=location type='text'><br>
    Työn aloitusaika: <br><input name='jobstart' type='date'><br>
    Työn loppumisaika: <br><input name='jobend' type='date'><br>
    Työn kuvaus: <br><textarea rows=10 cols='50' name='description' form='submitform'></textarea><br>
    <br><input type='submit' value='syötä'>
    </form>";
}

siteFooter();
?>