<?php
$reservation_statut = ['Initialisé', 'En attente','Validé', 'Annnulé'];

// $no_chambres_hotels;
$id_clients = range(1,NOMBRE_DE_CLIENTS);
shuffle($id_clients);

$hotel_reservation = [];
$nb_reservations = 1;
$tab = [];

for ($hotel = 1; $hotel <= NOMBRE_HOTEL; $hotel++) // 50 hôtels
{
    $jour = 1;
    while($jour < 365) { // dates
        shuffle($no_chambres_hotels[$hotel]);
        $selected_no = array_slice($no_chambres_hotels[$hotel], 0, 4);

        foreach ($no_chambres_hotels[$hotel] as $cle_chambre) { //  5 chambres.
            
            $res_id	= 'NULL';

            $duree_reservation = mt_rand(1,7);

            $res_timestamp_creation = mktime(15,0,0,1,$jour-3,2021);
            $res_date_creation	= date('Y-m-d', $res_timestamp_creation);

            $res_timestamp_debut = mktime(15,0,0,1,$jour,2021);
            $res_date_debut	= date('Y-m-d', $res_timestamp_debut);

            $res_timestamp_maj = mktime(11,0,0,1,$jour+ceil($duree_reservation/2),2021);
            $res_date_maj = date('Y-m-d H:i:s', $res_timestamp_maj);

            $res_timestamp_fin = mktime(11,0,0,1,$jour+$duree_reservation,2021);
            $res_date_fin	= date('Y-m-d', $res_timestamp_fin);

            $res_etat	= $reservation_statut[array_rand($reservation_statut)];
            $res_client	= $id_clients[$nb_reservations % NOMBRE_DE_CLIENTS];
            $res_hotel	= $hotel;
            $res_chambre= $cle_chambre;

            $hotel_reservation[$nb_reservations] = $hotel;
            
            $nb_reservations++;     
            $tab[] = "(NULL,'$res_date_creation','$res_date_debut','$res_date_maj','$res_date_fin','$res_etat','$res_client','$res_hotel','$res_chambre')";
        }

        $jour += mt_rand(4,7);
    }
}

    $tabs = array_chunk($tab, 100);
    foreach($tabs as $tab)
    {
        $sql = 'INSERT INTO reservation VALUES ' . implode(',', $tab);
        mysqli_query($link, $sql) or die(mysqli_error($link));
    }

echo "Génération de $nb_reservations réservations";
