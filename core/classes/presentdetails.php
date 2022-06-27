<?php
class PresentDetails {
	public $fields;
	public $data;
	public $html;

	public function __construct($fields, $data) {
		$this->fields = $fields;
		$this->data = $data;
		$this->html = '';
	}

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