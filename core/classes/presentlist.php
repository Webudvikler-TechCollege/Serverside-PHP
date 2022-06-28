<?php
/**
 * List Presenter
 * Bygger og retunerer html string 
 * med liste over data records
 */
class PresentList {
	public $fields;
	public $data;
	public $html;

	/**
	 * Constructor
	 * @param array $fields Felter der skal medtages
	 * @param array $data Data Records
	 * @return string HTML string
	 */	
	public function __construct($fields, $data) {
		$this->fields = $fields;
		$this->data = $data;
		$this->html = '';
	}

	/**
	 * Presenter Create method
	 * Bygger en tabel med liste ud fra array af felter og data
	 */	
	public function create() {
		$this->html = "<table border=\"1\">\n<thead>\n<tr>\n";
		// Table headers med friendly names
		foreach($this->fields as $value) {
			$this->html .= "<th>$value</th>\n";
		}
		// Table body med data records
		// Looper data array
		foreach($this->data as $key => $value) {
			$this->html .= "<tr>\n";
			// Looper fields array og tilføjer key matches
			foreach($this->fields as $k => $fieldValue) {
				$this->html .= "<td>$value[$k]</td>\n";
			}
			$this->html .= "</tr>\n";
		}
		$this->html .= "</tr>\n</thead>\n<tbody>\n";
		$this->html .= "</tbody>\n</table>\n";
		return $this->html;
	}
}