<?php
require_once("utils.php");
session_start();

echo "<div class='intro'>Tervetuloa tietotekniikan kilta Cluster Ry:n projektipankkiin. Sivu tarjoaa yrityksille ja muille tahoille suoran rekrytointikanavan tietotekniikan opiskelijoihin ja opiskelijoille keskitetyn listan juuri heille tarkoitetuista töistä. Kyseessä on www-harkkatyö joka on vielä \"work in progress\", joten selkeät bugit yms. kehitysehdotukset voi välittää osoitteeseen kuisma.narhi@student.lut.fi</div>";
echo "<p class='separator'></p>";
$db = connectDb();

$stmt = $db->prepare("SELECT * FROM jobs");
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
//printtaa yksittäiset työlistaukset omiksi kokonaisuuksikseen jotka css:llä erotellaan visuaalisesti.
foreach ($rows as $row) {
    //users-taulusta haku firmId:n mukaan, jotta kannassa ei ole päällekkäisyyksiä
    $stmt2 = $db->prepare("SELECT username, email FROM users WHERE id =" . $row["firmid"]);
    $stmt2->execute();
    $firm = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    //työluokkien printtauksen muotoilu 
    if ($row["jobtype"] == 1) {
        $jobtype = "diplomityö";
    } elseif ($row["jobtype"] == 2) {
        $jobtype = "kandityö";
    } elseif ($row["jobtype"] == 3) {
        $jobtype = "kesätyö";
    } elseif ($row["jobtype"] == 4) {
        $jobtype = "osa-aikatyö";
    } elseif ($row["jobtype"] == 5) {
        $jobtype = "muu";
    }
    echo "<div class='joblisting'><p class='jobheader'>". $firm[0]["username"] . " " . $jobtype . " " . $row["jobname"] . "</p><br>";
    echo "<p class='jobdesc'>" . $row["description"] . "</p>";
    echo "<p class='jobdates'>Alkamispäivä: " . $row["jobstart"] . "<br>Päättymispäivä: " . $row["jobend"] . "</p>";
    echo "<p class='jobmail'>Yhteystieto: " . $firm[0]["email"] . "</p></div>";
};

?>