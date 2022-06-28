<?php
/**
 * Detail presenter
 * Bygger og retunerer html string med detaljer 
 * for et givent data objekt
 */
class PresentDetails {
	public $fields;
	public $data;
	public $html;

	/**
	 * Constructor
	 * @param Array $fields Felter der skal medtages
	 * @param Array $data Data Objekt
	 */
	public function __construct($fields, $data) {
		$this->fields = $fields;
		$this->data = $data;
		$this->html = '';
	}

	/**
	 * Presenter Create method
	 * Bygger en tabel ud fra array af felter og data
	 * @return String HTML string
	 */
	public function create() {
		$this->html = "<table border=\"1\">\n<tr>\n";
		foreach($this->fields as $key => $value) {
			$this->html .= "<tr>\n";
			$this->html .= "<td>$value</td>\n";
			$this->html .= "<td>" . $this->data[$key] . "</td>\n";
			$this->html .= "</tr>\n";
		}
		$this->html .= "</tr>\n</table>\n";
		return $this->html;
	}
}