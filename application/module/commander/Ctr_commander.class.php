<?php
/**
Controleur créé par le générateur.
Controleur associé à une table (implémente le CRUD)
*/
class Ctr_commander extends Ctr_controleur implements I_crud {

    public function __construct($action) {
        parent::__construct("commander", $action);        
        $a = "a_$action";
        $this->$a();
    }

	function a_index() {
		$u=new Commander();
		$data=$u->selectAll();
		require $this->gabarit;
	}
	
	//$_GET["id"] : id de l'enregistrement
	function a_edit() {		
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		$u=new Commander();
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
			$u=new Commander();
			$u->save($_POST);
			if ($_POST["com_id"]==0)
				$_SESSION["message"][]="Le nouvel enregistrement Commander a bien été créé.";
			else
				$_SESSION["message"][]="L'enregistrement Commander a bien été mis à jour.";
		}
		header("location:" . hlien("commander"));
	}

	

	//param GET id 
	function a_delete() {
		if (isset($_GET["id"])) {
			$u=new Commander();
			$u->delete($_GET["id"]);
			$_SESSION["message"][]="L'enregistrement Commander a bien été supprimé.";
		}
		header("location:" . hlien("commander"));
	}
}

?>