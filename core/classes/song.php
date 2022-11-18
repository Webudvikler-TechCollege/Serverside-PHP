<?php 
class Song {
	public $id;
	public $title;
	public $content;
	public $artist_id;
	public $created_at;
	public $updated_at;

	private $db;

	public function __construct()
	{	
		global $db;
		$this->db = $db;
	}

	/**
	 * Funktion til at hente lister med
	 */
	public function list() {
		$sql = "SELECT id, title 
				FROM song 
				ORDER BY title";
		return $this->db->query($sql);
	}

	/**
	 * Funktion til at hente detaljer med
	 */
	public function details($id) {
		$params = array(
			'id' => array($id, PDO::PARAM_INT)
		);

		$sql = "SELECT title, content, name, artist_id 
				FROM song 
				JOIN artist 
				ON song.artist_id = artist.id 
				WHERE song.id = :id";
		return $this->db->query($sql, $params, Db::RESULT_SINGLE);
	}


}