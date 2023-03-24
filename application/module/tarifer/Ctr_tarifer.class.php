<?php
/**
Controleur créé par le générateur.
Controleur associé à une table (implémente le CRUD)
*/
class Ctr_tarifer extends Ctr_controleur implements I_crud {

    public function __construct($action) {
        parent::__construct("tarifer", $action);        
        $a = "a_$action";
        $this->$a();
    }

	function a_index() {
		$u=new Tarifer();
		$data=$u->selectAll();
		require $this->gabarit;
	}
	
	//$_GET["id"] : id de l'enregistrement
	function a_edit() {		
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		$u=new Tarifer();
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
			$u=new Tarifer();
			$u->save($_POST);
			if ($_POST["tar_id"]==0)
				$_SESSION["message"][]="Le nouvel enregistrement Tarifer a bien été créé.";
			else
				$_SESSION["message"][]="L'enregistrement Tarifer a bien été mis à jour.";
		}
		header("location:" . hlien("tarifer"));
	}

	

	//param GET id 
	function a_delete() {
		if (isset($_GET["id"])) {
			$u=new Tarifer();
			$u->delete($_GET["id"]);
			$_SESSION["message"][]="L'enregistrement Tarifer a bien été supprimé.";
		}
		header("location:" . hlien("tarifer"));
	}
}

?>