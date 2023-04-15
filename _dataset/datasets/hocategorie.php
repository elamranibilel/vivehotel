<?php

//génération de categorie_chambre  
$hoCategorie = [
    "2 étoiles",
    "3 étoiles",
    "4 étoiles",
    "5 étoiles",
    "Palace"
];

$tab = [];
foreach ($hoCategorie as $hoc_nom) {
    $tab[] = "(null,'$hoc_nom')";
}

$sql = "INSERT INTO hocategorie VALUES " . implode(",", $tab);
mysqli_query($link, $sql);

echo '<p>génération de ' . count($hoCategorie) . ' catégorie de l\'hôtel</p>';
