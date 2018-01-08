<?php
// sivun headerin luonti
function siteHeader() { 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel='stylesheet' href="styles.css">
    </head>
    <body>
        <h1>Clusterin Projektipankki</h1>
<?php
}
//navigointipalkki, ottaa huomioon käyttäjän kirjautumisstatuksen ja käyttäjätilin levelin (onko admin)
function siteNavigation() {
if (isset($_SESSION["id"])) {
    echo "<p class='user'>Kirjautuneena käyttäjä: " . $_SESSION["username"] . "<p>";
}

?>
<nav>
    <ul>
        <a href="index.php">Etusivu</a>
<?php
if (isset($_SESSION["id"])) {
    if ($_SESSION["level"] == 2) {
        echo '<a href="admin.php">Admin</a>';
    }
    echo '  <a href="submit.php">Lisää työ</a>
        <a href="logout.php">Kirjaudu ulos</a>';
    
} else {
    echo '<a href="login.php">Kirjaudu</a>
          <a href="register.php">Rekisteröidy</a>';
} ?>
        </ul>
    </p>
</nav>
<?php
}
//yleinen tietokantayhteys palautusarvona.
function connectDb() {
    $db = new PDO('mysql:host=localhost;dbname=c9;charset=utf8', 'qizma', '');
    return $db;
}

// sivun alapalkki
function siteFooter() {
    ?>
    <div class="footer">(c) Kuisma Närhi 2017<br>
    <canvas id="logo" width="300" height="50" style="border:3px solid #800000";>Selain ei tue canvas-elementtiä</canvas>
    <script> //canvas-elementti, 3pts ezgaem
    "use strict";
    var canvas = document.getElementById("logo");
var ctx = canvas.getContext("2d");
ctx.font = "30px sans-serif";
ctx.fillText(" Tähän clusterin logo",10,40);
    </script>
    </div>
    </body>
    </html>
    <?php
}

?>