<h2>Ensemble des tarifs des chambres</h2>
<p><a class="btn btn-primary" href="<?= hlien("tarifer", "edit", "id", 0) ?>">Modifier les tarifs</a></p>

<table>
	<thead>
		<tr>
			<th>€</th>
			<?php
			foreach ($chCategorie as $catChambre) {
				echo "<th>" . $catChambre . "</th>";
			}
			?>
			<!-- Foreach chambre list-->
		</tr>
	</thead>
	<tbody>
		<!-- 
		* Catégorie d'hôtel
		* Prix pour la catégorie d'hôtel et catégorie de chambre numéro i
		-->
		<?php
		foreach ($hoCategorie as $numHoc => $nomHoc) {
		?>
			<tr>
				<th><?= $nomHoc ?></th>
				<?php
				foreach ($chCategorie as $numChc => $nomChc) {
					$prix = $grilleTarifaire[$numHoc][$numChc];
				?>
					<td class="tarif" numchc="<?= $numChc ?>" numhoc="<?= $numHoc; ?>" contenteditable="true"><?= $prix ?></td>
				<?php } ?>
			</tr>
		<?php } ?>
	</tbody>
</table>