<?php
$dbh = new PDO('mysql:host=localhost', 'root', '');
$dbh->query('DROP DATABASE IF EXISTS vivehotel ');

$queries = file_get_contents('vivehotel.sql');
$sth = $dbh->query($queries);

$link = mysqli_connect("localhost", "root", "", "vivehotel");
mysqli_set_charset($link, "utf8");
