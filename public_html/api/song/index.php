<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/assets/incl/init.php";

/**
 * Liste af sange
 */
Route::add('/api/song/', function() {
	$song = new Song;
	$result = $song->list();
	echo Tools::jsonParser($result);
});

/**
 * Liste af sange
 */
Route::add('/api/song/([0-9]*)', function($id) {
	$song = new Song;
	$result = $song->details($id);
	echo Tools::jsonParser($result);
});

Route::run('/');
?>