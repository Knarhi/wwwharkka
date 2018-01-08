<?php
require_once("utils.php");
siteHeader();
siteNavigation();
if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["password2"]) && isset($_POST["email"])) {
  if($_POST["password"] === $_POST["password2"])  {
  // salasanan validointi
  if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z]{9,255}$/', $_POST["password"])) {
    echo '<p>Salasanan tulee sisältää 9-255 merkkiä, vähintään yhden luvun, sekä isoja että pieniä kirjaimia!</p>';
  } else {
    try {
      $db = connectDb();
      $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
      $stmt = $db->prepare("INSERT INTO users (username, password, email, level) VALUES (:f1, :f2, :f3, 1)");
      $stmt->bindParam(':f1', $_POST["username"]);
      $stmt->bindParam(':f2', $password);
      $stmt->bindParam(':f3', $_POST["email"]);
      if ($stmt->execute()) {
        echo "<p>Käyttäjätili luotu.</p>";
      } else {
        echo "yhteydessä on jokin virhe. " . $stmt->error;
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
} else {
  echo "<p>Salasanat eivät täsmää!</p>";
}

}
else {
  echo "<h2>Luo käyttäjätili</h2>
  <p class='infobox'>Tilin luominen helpottaa useamman työilmoituksen täyttöä. Yrityksen nimi toimii jatkossa käyttäjänimenä.
  Salasanan tulee sisältää 9-255 merkkiä, vähintään yhden luvun, sekä isoja että pieniä kirjaimia.</p>
    <form action='register.php' method='post'>
    Yrityksen nimi: <br><input name=username type='text'><br>
    Salasana: <br><input name=password type='password'><br>
    Salasana uudestaan: <br><input name=password2 type='password'><br>
    Yhteyssähköposti: <br><input name=email type='text'><br>
    <br><input type='submit' value='luo tili'>
    </form>";
}
siteFooter();
?>