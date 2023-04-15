<?php
const NOMBRE_COMMANDES = 1500;
$tab = [];
for ($no_comm = 1; $no_comm <= NOMBRE_COMMANDES; $no_comm++) {
    $com_id = 'NULL';
    $com_reservation = mt_rand(1, $nb_reservations);
    $com_hotel = $hotel_reservation[$com_reservation];
    $com_services = $hotel_propose[$com_hotel][array_rand($hotel_propose[$com_hotel])];
    $com_quantite = mt_rand(1, 10);

    $tab[] = "(NULL,'$com_quantite','$com_services','$com_reservation')";
}

$sql = 'INSERT INTO commander VALUES ' . implode(',', $tab);
mysqli_query($link, $sql);
echo '<br/>';
echo 'génération de ' . NOMBRE_COMMANDES . ' commandes.';
