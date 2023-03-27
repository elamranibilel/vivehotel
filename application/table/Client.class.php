<?php

/**
Classe créé par le générateur.
 */
class Client extends Table
{
	public function __construct()
	{
		parent::__construct("client", "cli_id");
	}

	static public function OPTIONclients(int $idClient)
	{
		return self::HTMLoptions('SELECT cli_id, cli_nom FROM client', 'cli_id', 'cli_nom', $idClient);
	}
}
