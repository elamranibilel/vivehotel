<?php
const NB_CHAMBRE_P_HOTEL = 10;

$chambreStatut = ['Initialisé', 'En attente', 'Validé', 'Annnulé'];

$typeLits = [
    '2 Lits simples',
    'Lit double standard Queen Size',
    'Lit double Confort',
    'Lit double King Size',
    '1 Lit double et un lit simple'
];

$tab = [];
$noChambreHotels = [];

//Génération des chambres
$idChambre = 1;
for ($idHotel = 1; $idHotel <= NOMBRE_HOTEL; $idHotel++) {
    $noChambreHotels[$idHotel] = [];
    for ($chambreNo = 1; $chambreNo <= NB_CHAMBRE_P_HOTEL; $chambreNo++) {

        $noChambreHotels[$idHotel][] = $idChambre;

        $cha_chcategorie = mt_rand(1, count($chcategorie));
        $cha_hotel = mt_rand(1, NOMBRE_HOTEL);

        $cha_numero = $chambreNo;

        $cha_statut = $chambreStatut[array_rand($chambreStatut)];
        $cha_surface = mt_rand(10, 40);
        $cha_typeLit = $typeLits[array_rand($typeLits)];

        $cha_description = "text $idHotel <a href=\'index.php\'>Accueil</a>";
        $cha_jacuzzi = mt_rand(0, 1);
        $cha_balcon = mt_rand(0, 1);
        $cha_wifi = mt_rand(0, 1);
        $cha_minibar = mt_rand(0, 1);
        $cha_coffre = mt_rand(0, 1);
        $cha_vue = mt_rand(0, 1);


        $tab[] = "(null,'$cha_numero','$cha_statut','$cha_surface','$cha_typeLit', 
        '$cha_description','$cha_jacuzzi','$cha_balcon','$cha_wifi',
        '$cha_minibar','$cha_coffre','$cha_vue',
		'$cha_chcategorie','$cha_hotel')";

        $idChambre++;
    }
}
$sql = "insert into chambre values " . implode(",", $tab);

mysqli_query($link, $sql);
echo "<p>Génération de " . strval(NB_CHAMBRE_P_HOTEL * NOMBRE_HOTEL) . " chambres</p>";

/*
chambre
    cha_id int auto_increment primary key,
    cha_numero varchar(500) not null,
    cha_statut varchar(500) not null,
    cha_surface int not null,    
    cha_typelit1 varchar(500) not null, 
    cha_typelit2 varchar(500),
    cha_description text not null,
    cha_jacuzzi boolean not null,
    cha_balcon boolean not null,
    cha_wifi boolean not null,
    cha_minibar boolean not null,
    cha_coffre boolean not null,
    cha_vue boolean not null,
    cha_chcategorie int not null 
*/
