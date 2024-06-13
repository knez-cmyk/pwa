<?php
// Inicijalizacija sessiona
session_start();

// Unsetiranje svih session varijabli
$_SESSION = array();

// Zatvaranje sessiona
session_destroy();

// Redirekcija na prijavnu stranicu ili na početnu stranicu
header("Location: login.php"); // Promijenite 'login.php' na odgovarajuću stranicu
exit();
?>
