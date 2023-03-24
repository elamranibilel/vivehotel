<?php
/**
Controleur créé par le générateur.
Controleur associé à une table (implémente le CRUD)
*/
class Ctr_chambre extends Ctr_controleur implements I_crud {

    public function __construct($action) {
        parent::__construct("chambre", $action);        
        $a = "a_$action";
        $this->$a();
    }

	function a_index() {
		$u=new Chambre();
		$data=$u->selectAll();
		require $this->gabarit;
	}
	
	//$_GET["id"] : id de l'enregistrement
	function a_edit() {		
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		$u=new Chambre();
		if ($id>0)
			$row=$u->select($id);
		else
			$row=$u->emptyRecord();
			
		extract($row);	
		require $this->gabarit;		
	}

	//$_POST
	function a_save() {
		if (isset($_POST["btSubmit"])) {
			$u=new Chambre();
			$u->save($_POST);
			if ($_POST["cha_id"]==0)
				$_SESSION["message"][]="Le nouvel enregistrement Chambre a bien été créé.";
			else
				$_SESSION["message"][]="L'enregistrement Chambre a bien été mis à jour.";
		}
		header("location:" . hlien("chambre"));
	}

	

	//param GET id 
	function a_delete() {
		if (isset($_GET["id"])) {
			$u=new Chambre();
			$u->delete($_GET["id"]);
			$_SESSION["message"][]="L'enregistrement Chambre a bien été supprimé.";
		}
		header("location:" . hlien("chambre"));
	}
}

?>