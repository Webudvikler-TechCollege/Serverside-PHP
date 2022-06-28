<?php
class Artist
{
	private $db;

	public $id;
	public $name;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		global $db;
		$this->db = $db;
	}

	/**
	 * Metode til at hente lister med
	 */
	public function list()
	{
		$sql = "SELECT id, name 
				FROM artist 
				ORDER BY name ASC";
		return $this->db->query($sql);
	}
}
