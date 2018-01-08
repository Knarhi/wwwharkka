<?php
require_once("utils.php");
session_start();
siteHeader();
siteNavigation();
session_unset();
session_destroy();
echo "<p class='infobox'>Olet kirjautunut ulos</p>";
sitefooter();
?>