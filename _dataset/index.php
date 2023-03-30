<?php
$timestart = microtime(true);
// Fichier qui génère l'ensemble de la base de donnée
include('datasets/connexion.php');

include('datasets/client.php');
include('datasets/services.php');

include('datasets/chcategorie.php');
include('datasets/hocategorie.php');


include('datasets/hotel.php');
include('datasets/personnel.php');

include('datasets/chambre.php');

include('datasets/tarif.php');

include('datasets/proposer.php');

include('datasets/reservation.php');
include('datasets/commander.php');

//Fin du code PHP
$timeend = microtime(true);
$time = $timeend - $timestart;

//Afficher le temps d'éxecution
$page_load_time = number_format($time, 3);
echo "<br />Debut du script: " . date("H:i:s", $timestart);
echo "<br>Fin du script: " . date("H:i:s", $timeend);
echo "<br>Script execute en " . $page_load_time . " sec";
