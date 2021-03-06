<?php
class Helpers {

	static public function Header($title) {
		$strPageTitle = $title;
		require_once DOCROOT . "/assets/incl/header.php";
	}
	
	static public function Footer() {
		require_once DOCROOT . "/assets/incl/footer.php";
	}

	static public function showMe($array) {
		echo "<pre>\n";
		var_dump($array);
		echo "</pre>\n";
	}

	static public function jsonParser($json) {
		header('Content-Type: application/json; charset=utf-8');
		return json_encode($json);
	}

	static public function createIcon($href, $text, $title, $script = null) {
		$html = "<a title=\"".$title."\"";
		
		$html .= ($script) ? " onClick=\"".$script."\" href=\"javascript:void(0)\" " : " href=\"".$href."\"";
		
		$html .= ">$text</a>";
		return $html;

	}
}