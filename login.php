<?php

require_once("utils.php");
siteHeader();
siteNavigation();
if (isset($_POST["username"]) && isset($_POST["password"])) {
    $db = new PDO('mysql:host=localhost;dbname=c9;charset=utf8', 'qizma', '');

    $password = $_POST["password"];
    $stmt = $db->prepare("SELECT id, username, password, level FROM users WHERE username=:input");
    $stmt->execute(array(":input" => $_POST["username"]));
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!password_verify($_POST["password"],$rows[0]["password"])){
        echo "Salasanat eivät täsmää.";
    } else if (count($rows) === 1) {
        session_start();
        $_SESSION["id"] = $rows[0]["id"];
        $_SESSION["username"] = $rows[0]["username"];
        $_SESSION["level"] = $rows[0]["level"];
        echo "<p>Kirjautuminen onnistui.</p>";
    }
} else {
    echo "<h2>Kirjaudu sisään</h2>
    <form action='login.php' method='post'>
    Käyttäjänimi: <br><input name=username type='text'><br>
    Salasana: <br><input name=password type='password'><br>
    <br><input type='submit' value='Kirjaudu'>
    </form>";
}
sitefooter();
?>
