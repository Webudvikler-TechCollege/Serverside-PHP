<?php 
class presentHeader {
	public $html;
	public $title;
	public $subtitle;

	public function __construct() {

	}

	static public function adminHeader($title, $subtitle, $navbuttons) {
		require_once DOCROOT . "/admin/assets/incl/header.php";
		echo "<h2>" . $title . "</h2>";
		echo "<h3>" . $subtitle . "</h3>";
		if(is_array($navbuttons)) {
			foreach($navbuttons as $button) {
				echo $button;
			}
		}


	}

	static public function adminFooter() {
		require_once DOCROOT . "/admin/assets/incl/footer.php";
	}	

	static public function setLink($href, $text) {
		return "<a href=\"". $href . "\">".$text."</a>";
	}

}