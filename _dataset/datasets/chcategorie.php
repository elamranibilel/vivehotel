<?php
//génération de Categorie_chambre  
$chcategorie = [
    "Standard",
    "Supérieure",
    "Luxe",
    "Suite"
];
$tab = [];
foreach ($chcategorie as $chc_nom) {
    $tab[] = "(null,'$chc_nom')";
}
$sql = "INSERT INTO chcategorie VALUES " . implode(",", $tab);
mysqli_query($link, $sql);
echo "<p>Génération de " . count($chcategorie) . " catégories de chambres.</p>";
