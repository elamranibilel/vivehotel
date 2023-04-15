<?php

$tar_id = [];
$tar_prix = [];
$tar_hocategorie = [];
$tar_chcategorie = [];

$tab = [];

$noTarif = 0;
$hoc = 1;
foreach ($hoCategorie as $hocat) {
    $chc = 1;
    foreach ($chcategorie as $chcat) {
        $tar_prix = $tarifsChambre[$hocat][$chcat];
        $tar_hocategorie = $hoc;
        $tar_chcategorie = $chc;

        /* Si le tarif existe pour un type de chambre
        pris dans une catégorie d'hôtel, on l'ajoute. */
        if ($tar_prix != '0') {
            $tab[] = "(null,'$tar_prix', '$tar_hocategorie', '$tar_chcategorie')";
            $noTarif++;
        }
        $chc++;
    }
    $hoc++;
}


$sql = "insert into tarifer values " . implode(",", $tab);
mysqli_query($link, $sql);

echo '<p>génération de ' . ($noTarif) . ' tarifsChambre</p>';
