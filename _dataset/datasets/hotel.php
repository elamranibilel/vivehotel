<?php
$hotel_statut = ['Initialisé', 'En attente', 'Validé', 'Annnulé'];

//génération de personnels  
const NOMBRE_HOTEL = 50;


$data = [];
for ($idHotel = 1; $idHotel <= NOMBRE_HOTEL; $idHotel++) {
    $hot_statut = $hotel_statut[array_rand($hotel_statut)];

    $hot_nom = "hôtel $idHotel";
    $hot_adresse = 'Rue du ' . $idHotel;
    $hot_departement = mt_rand(1, 95);

    $hot_description = "text $idHotel";

    $hot_longitude = mt_rand(-10, 10);
    $hot_latitude = mt_rand(-10, 10);

    $hot_hocategorie = mt_rand(1, count($hoCategorie));
    $data[] = "(null,'$hot_statut','$hot_nom','$hot_adresse','$hot_departement','$hot_description','$hot_longitude','$hot_latitude','$hot_hocategorie')";
}
$sql = "insert into hotel values " . implode(",", $data);
mysqli_query($link, $sql);
echo "<p>génération de " . NOMBRE_HOTEL . " hôtels</p>";

/*
Hotel
- hot_id (AI)
- hot_statut (varchar(500))
- hot_nom (varchar(500))
- hot_adresse (varchar(500))
- hot_departement (int)
- hot_description (text)
- hot_longitude (int)
- hot_latitude (int)
- hot_hocategorie (FK)
*/
