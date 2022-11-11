<?php
class Tools {
	static public function Header($title) {
		$strPageTitle = $title;
		require_once(DOCROOT . '/assets/partials/header.php');
	}

	static public function Footer() {
		require_once(DOCROOT . '/assets/partials/footer.php');
	}
}
?>