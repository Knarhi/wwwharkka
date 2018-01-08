<?php
require_once("utils.php");
session_start();
siteHeader();

siteNavigation();
require("joblist.php");
siteFooter();
/*

Sivun rakenne utils.php:sta funktioiden avulla; header, navigation ja footer ovat staattisia ja keskimmäinen
rakenne luo käyttäjän pyytämän sivun. 

*/
?>

