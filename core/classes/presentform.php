<?php 
/**
 * Form Presenter
 * Bygger og returnerer html til formular 
 * input felter og submit knap
 */
class PresentForm {
	public $fields; // Array til felter
	public $data; 	// Array til data
	public $html;	// HTML string
	public $method;	// Form method
	public $action;	// Form action

	/**
	 * Constructor
	 * @param array $fields Array med felter
	 * @param array $data Array af data - Optional
	 * @return string HTML string
	 */
	public function __construct($fields, $data = null) {
		$this->method = 'POST';
		$this->action = '';
		$this->fields = $fields;
		$this->data = $data;
		$this->html = '';
	}

	/**
	 * Presenter Create method
	 * Bygger en formular ud fra array af felter
	 * Medtager og viser data hvis der er nogle
	 */
	public function create() {
		// Starter html string med form tag
		$this->html .= "<form method=\"".$this->method."\" action=\"".$this->action."\">\n";
		// Sætter hidden input med id hvis det er en update
		if(isset($this->data["id"]) && !empty($this->data["id"])) {
			$this->html .= "<input type=\"hidden\" name=\"id\" value=\"" . $this->data["id"] . "\"/>\n";
		}

		// Looper felter og bygger formular
		// key = 
		foreach($this->fields as $key => $arrFieldValues) {
			$this->html .= " <div>\n";
			$this->html .= "  <label for=\"" . $key ."\">" . $arrFieldValues[0] . "</label>\n";
			// Sætter var med værdi hvis den eksisterer i data array
			$dataValue = isset($this->data[$key]) ? $this->data[$key] : ''; 

			// Switcher input type
			switch(strtoupper($arrFieldValues[1])) {
				default:
				case "TEXT":
				case "EMAIL":
				case "NUMBER":
				case "PASSWORD":
					$this->html .= "  <input type=\"".$arrFieldValues[1]."\" name=\"" . $key . "\" id=\"" . $key . "\" value=\"" . $dataValue . "\" />\n";
					break;
				case "TEXTAREA":
					$this->html .= "  <textarea name=\"" . $key . "\" id=\"" . $key . "\">" . $dataValue . "</textarea>\n";
					break;
				case "SELECT":
					$this->html .= "  <select name=\"" . $key . "\" id=\"" . $key . "\">\n";
					// Looper select options
					foreach($arrFieldValues[2] as $fieldValue) {						
						// Vælg option hvis den matcher med data
						$selected = isset($this->data[$key]) ? 
										(($fieldValue['id'] === $this->data[$key]) ? "selected" : '') : '';
						$this->html .= "   <option " . $selected . " value=\"" . $fieldValue['id'] . "\">" . $fieldValue['name'] . "</option>\n";
					}
					$this->html .= "  </select>\n";
					break;
			}
			$this->html .= " </div>\n";

		}
		// Button panel 
		$this->html .= " <div class=\"buttonpanel\">\n";
		$this->html .= "  <button type=\"submit\">Gem</button>\n";
		$this->html .= "  <button type=\"reset\">Nulstil felter</button>\n";
		$this->html .= " </div>\n";

		$this->html .= "</form>";

		return $this->html;
	}
}