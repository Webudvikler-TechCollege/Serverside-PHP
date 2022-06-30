<?php
class Song
{
	private $db;

	public $id;
	public $title;
	public $content;
	public $artist_id;

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
	 * @return Array
	 */
	public function list()
	{
		$sql = "SELECT s.id, s.title, a.name 
				FROM song s 
				JOIN artist a 
				ON s.artist_id = a.id 
				ORDER BY s.title";
		return $this->db->query($sql);
	}

	/**
	 * Metode til at hente detaljer med
	 * @param Integer id Object Identifier
	 * @return Array
	 */
	public function details($id)
	{
		$params = array(
			"id" => array($id, PDO::PARAM_INT)
		);

		$sql = "SELECT s.id, s.title, s.content, s.artist_id, a.name 
				FROM song s 
				JOIN artist a 
				ON s.artist_id = a.id 
				WHERE s.id = :id";
		$row = $this->db->query($sql, $params, Db::RESULT_SINGLE);
		$this->id = $row["id"];
		$this->title = $row["title"];
		$this->content = $row["content"];
		$this->artist_id = $row["artist_id"];
		return $row;
	}

	/**
	 * Metode til at at oprette med
	 * @return Integer
	 */
	public function create() {
		$params = array(
			"title" => array($this->title, PDO::PARAM_STR),
			"content" => array($this->content, PDO::PARAM_STR),
			"artist_id" => array($this->artist_id, PDO::PARAM_INT)
		);
		$sql = "INSERT INTO song(title, content, artist_id) 
				VALUES(:title, :content, :artist_id)";
		if($this->db->query($sql, $params)) {
			$this->id = $this->db->lastInsertId();
			return $this->id;
		}
	}	

	/**
	 * Metode til at at opdatere med
	 * @return Integer
	 */	
	public function update() {
		$params = array(
			"id" => array($this->id, PDO::PARAM_INT),
			"title" => array($this->title, PDO::PARAM_STR),
			"content" => array($this->content, PDO::PARAM_STR),
			"artist_id" => array($this->artist_id, PDO::PARAM_INT)
		);

		$sql = "UPDATE song 
				SET title = :title, content = :content, artist_id = :artist_id 
				WHERE id = :id";
		if($this->db->query($sql, $params)) {
			return $this->id;
		}
	}

	/**
	 * Metode til at slette en record med
	 * @param int id Object Identifier
	 * @return Boolean
	 */
	public function delete($id)
	{
		$params = array(
			"id" => array($id, PDO::PARAM_INT)
		);

		$sql = "DELETE FROM song 
				WHERE id = :id";
		return $this->db->query($sql, $params);
	}
}
