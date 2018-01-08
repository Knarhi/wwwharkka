<?php
require_once("utils.php");
session_start();
siteHeader();
siteNavigation();
    echo "<h2>Poista listaus</h2>
    <form action='admin.php' method='post'>
    poistettavan listauksen numero: <br><input name=delrow type='text'><br>
    <br><input type='submit' value='poista listaus'>
    </form>";
// yhteys sekä poistolle että listan printtaukselle
$db = connectDb();


// rivin poisto
if (isset($_POST["delrow"])) {
    $poisto = $db->prepare("DELETE FROM jobs WHERE id = :v1");
    $poisto->bindParam("v1", $_POST["delrow"]);
    $poisto->execute();
    echo "<p>listaus poistettu!</p>";
};

$stmt = $db->prepare("SELECT * FROM jobs");
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($rows as $row) {
    
    $stmt2 = $db->prepare("SELECT username, email FROM users WHERE id =" . $row["firmid"]);
    $stmt2->execute();
    $firm = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    
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
    echo "<div class='joblisting'><p class='jobheader'>". $firm[0]["username"] . " " . $jobtype . " " . $row["jobname"] . " " .$row["id"] . "</p><br>";
    echo "<p class='jobdesc'>" . $row["description"] . "</p>";
    echo "<p class='jobdates'>Alkamispäivä: " . $row["jobstart"] . "<br>Päättymispäivä: " . $row["jobend"] . "</p>";
    echo "<p class='jobmail'>Yhteystieto: " . $firm[0]["email"] . "</p></div>";
};
siteFooter();
?>