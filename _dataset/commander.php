<?php
const NOMBRE_COMMANDES = 1500;
$tab = [];
for($i = 0;$i<NOMBRE_COMMANDES;$i++)
{
    $com_id = 'NULL';
    $com_reservation = mt_rand(1,$nb_reservations);
    $com_hotel = $hotel_reservation[$com_reservation];
    // $hotel_propose[$com_hotel];
    $com_services = $hotel_propose[$com_hotel][array_rand($hotel_propose[$com_hotel])];
    $com_quantite = mt_rand(1,10);

    $tab[] = "(NULL,'$com_quantite','$com_services','$com_reservation')";
}

$sql = 'INSERT INTO commander VALUES ' . implode(',', $tab);
mysqli_query($link, $sql);
echo '<br/>';
echo 'génération de ' . NOMBRE_COMMANDES . ' commandes.';
?>