<?php 
class presentHeader {
	public $html;
	public $title;
	public $subtitle;

	public function __construct() {
		require_once DOCROOT . "/admin/assets/incl/header.php";
	}

	static public function adminHeader($title, $subtitle, $navbuttons) {
		$html = "<h2>" . $title . "</h2>";
		$html .= "<h3>" . $subtitle . "</h3>";
		if(is_array($navbuttons)) {
			foreach($navbuttons as $button) {
				$html .= $button;
			}
		}
		echo $html;

	}

	static public function adminFooter() {
		require_once DOCROOT . "/admin/assets/incl/footer.php";
	}	

	static public function setLink($href, $text) {
		return "<a href=\"". $href . "\">".$text."</a>";
	}
	
	static public function setButton($text, $type = "submit", $script = null) {
		return "<button type=\"". $type . "\">".$text."</button>";
	}
}