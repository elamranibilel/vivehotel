<?php
$timestart = microtime(true);
// Fichier qui génère l'ensemble de la base de donnée
include('connexion.php');

include('client.php');
include("services.php");

include("chcategorie.php");
include("hocategorie.php");


include("hotel.php");
include("personnel.php");

include('chambre.php');

include('tarif.php');

include('proposer.php');

include('reservation.php');
include('commander.php');

//Fin du code PHP
$timeend = microtime(true);
$time = $timeend - $timestart;

//Afficher le temps d'éxecution
$page_load_time = number_format($time, 3);
echo "<br />Debut du script: " . date("H:i:s", $timestart);
echo "<br>Fin du script: " . date("H:i:s", $timeend);
echo "<br>Script execute en " . $page_load_time . " sec";
