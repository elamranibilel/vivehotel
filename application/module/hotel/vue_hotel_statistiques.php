<h2>Consulter les statistiques de l'hôtel "<?= mhe($data['hot_nom']) ?>"</h2>

<table class="table table-striped">
    <thead>
        <tr>
            <td colspan="2">
                <strong><?= mhe($data['hot_nom']) ?> (dans le <?= $data['hot_departement'] ?>)</strong>
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Catégorie</td>
            <td><?= mhe($data['hoc_categorie']) ?></td>
        </tr>
        <tr>
            <td>Statut</td>
            <td><?= mhe($data['hot_statut']) ?></td>
        </tr>
    </tbody>
</table>

<table class="table table-striped">
    <thead>
        <tr>
            <td colspan="2"><strong>Statistiques</strong></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Chiffre d'affaire (hors services)</td>
            <td><?= mhe($chiffreA) ?></td>
        </tr>
        <tr>
            <td>Chiffre d'affaire des services</td>
            <td><?= mhe($caSservices) ?></td>
        </tr>
        <tr>
            <td>
                <h2>Chiffre d'affaire total</h2>
            </td>
            <td>
                <h2><?= mhe($chiffreA + $caSservices) ?></h2>
            </td>
        </tr>
    </tbody>
</table>