<?php

//fabrique un lien en passant les parametres un par un à savoir :
// module, action, [cle, valeur]...
function hlien()
{
	$args = func_get_args();

	if (count($args) == 0)
		return "index.php";

	if (count($args) == 1)
		return "index.php?m=" . $args[0];

	$nb = count($args) / 2;
	if (!is_int($nb)) {
		throw new Exception("ERREUR : Nombre d'arguments dans l'url incorrect");
	}
	$m = $args[0];
	$a = $args[1];

	if (!isset($args[2]))
		return "index.php?m=$m&a=$a";
	else {
		$para = array();
		for ($i = 1; $i < $nb; $i++)
			$para[] = $args[2 * $i] . "=" . $args[2 * $i + 1];
		$s = implode("&", $para);
		return "index.php?m=$m&a=$a&$s";
	}
}

/**
Autoload : 
- les controleurs sont dans le répertoire "module", le fichier est préfixé par "Ctr_"
- les classes Table sont dans le répertoire "_table"
 */
function monAutoLoad($classname)
{
	if ("Ctr_" == substr($classname, 0, 4)) {
		$rep = str_replace("Ctr_", "", $classname);
		require_once "../application/module/$rep/" . $classname . ".class.php";
	} else {
		if (file_exists("../application/table/" . $classname . ".class.php"))
			require_once "../application/table/" . $classname . ".class.php";
	}
}

function monExceptionHandler($e)
{
	die("Erreur : " . $e->getMessage());
}

/*
Affiche un tableau PHP à 2 cles sous la forme d'une table HTML
*/
function afficheTableHTML($data)
{
	$fin = false;
	echo "<table>";
	foreach ($data as $cleLigne => $ligne) {
		//affiche des entete de colonnes
		if (!$fin) {
			echo "<tr>";
			echo "<th></th>";
			foreach ($ligne as $cle => $valeur) {
				echo "<th>$cle</th>";
			}
			echo "</tr>";
			$fin = true;
		}

		//affichage du tableau
		echo "<tr>";
		echo "<th>$cleLigne</th>";
		foreach ($ligne as $cle => $valeur) {
			echo "<td>$valeur</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
}

//si user non authentifié redirection vers index
function checkAuth()
{
	if (!isset($_SESSION["uti_id"])) {
		$_SESSION["message"][] = "accès non autorisé. Veuillez vous connecter.";
		header("location:" . hlien("_default"));
		exit;
	}
}

//si user non authentifié redirection vers index
function checkAllow($profil)
{
	checkAuth();
	if ($_SESSION["uti_profil"] != $profil) {
		$_SESSION["message"][] = "accès non autorisé.";
		header("location:" . hlien("_default"));
		exit;
	}
}

//anti sql injection : NE PAS UTILISER AVEC DES REQUETES PREPAREES 
function mres($s)
{
	return Table::$link->quote($s);
}

/**
Traitement des chaines anti XSS avant affichage dans une page HTML.
 */
function mhe($x)
{
	return htmlentities($x, ENT_QUOTES, "utf-8");
}

/**
 * DEBUG
 */
function debug($t)
{
	echo "<pre>";
	print_r($t);
	echo "</pre>";
}

function FormRecherche($className)
{ ?>
	<p>
	<form method='post'>
		<p>
			<label for='rech_texte'>Rechercher <?= mhe(strtolower($className)) ?> :</label> <input type='text' name='rech_texte' value='' />
		</p>
		<label for="rech_champ">Crtière :</label>
		<?php
		foreach ($className::CRI_RECHERCHE as $name => $field) {
			echo mhe($name) . " <input type='radio' name='rech_champ' value='" . mhe($field) . "' /> ";
		}
		?>
		<input class="btn btn-success" type="submit" value="Enregistrer" /><br />
		<input type="hidden" name="bt_submit" />

	</form>
	</p>
<?php
}

function listeValeursChamp(array $data, string $pk, string $field)
{
	$list = [];
	foreach ($data as $cle => $valeur) {
		$list[$valeur[$pk]] = $data[$cle][$field];
	}
	return $list;
}

// Créer un tableau à double dimension dont les valeurs sont vides
function tableau2D(int $dimensionX, int $dimensionY, string $defaultValue = 'X')
{
	$mytable = [];
	for ($x = 0; $x < $dimensionX; $x++) {
		for ($y = 0; $y < $dimensionY; $y++) {
			$mytable[$x][$y] = $defaultValue;
		}
	}
	return $mytable;
}

/*
* $vecteursCles : contient un vectur avec les clés en axe des X, le 2nd en axe des Y
* $nomAxes : contient en clé X le nom en axe des X, en clé Y le nom des axes en Y
* $tabValeurs : valeurs du tableau croisé dynamiques contenus dans des entrées d'une table. 
* Pour chaque valeur de ce tableau, il s'agit d'un tableau contenant une entrée MySQL
--> La valeur contenue dans la clé de valeur $nomAxes['Z'] donne la valeur de l'array du TCD au point (X,Y)
--> la valeur contenu dans sa clé de valeur $nomAxes['X'] dit la valeur de X
--> la valeur contenu dans sa clé de valeur $nomAxes['X'] dit la valeur de Y
*/
function tableauCD(array $vecteursCles, array $nomsAxes, array $tabValeurs): array
{
	// Je vérifie que les dimensions sont valides
	if (!isset($nomsAxes['X1']) or !isset($nomsAxes['X2']))
		return [];

	$cardinalX1 = count($vecteursCles['X1']);
	$cardinalX2 = count($vecteursCles['X2']);

	// Je crée un tableau à partir des cardinaux des deux axes
	$tableauCD = tableau2D($cardinalX1, $cardinalX2);


	// Je remplis le tableauCD avec valeurs de $tabValeurs 
	foreach ($tabValeurs as $key => $entree) {
		$cleX1 = $entree[$nomsAxes['X1']];
		$cleX2 = $entree[$nomsAxes['X2']];
		$valY = $entree[$nomsAxes['Y']];

		$tableauCD[$cleX1][$cleX2] = $valY;
	}

	return $tableauCD;
}
