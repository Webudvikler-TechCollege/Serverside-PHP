<?php
class PresentList {
	public $fields;
	public $data;
	public $html;

	public function __construct($fields, $data) {
		$this->fields = $fields;
		$this->data = $data;
		$this->html = '';
	}

	public function create() {
		$this->html = "<table border=\"1\">\n<thead>\n<tr>\n";
		foreach($this->fields as $value) {
			$this->html .= "<th>$value</th>\n";
		}
		foreach($this->data as $key => $value) {
			$this->html .= "<tr>\n";
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