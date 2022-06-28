<?php
/**
 * Routes for Song Admin Panel
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/incl/init.php';

// Route til liste
Route::add('/admin/song/', function() {
	// Array til felter
	$fields = array(
		"options" => "Handling",
		"title" => "Titel",
		"name" => "Artist"
	);

	// Kalder instans af song og henter array af sange
	$object = new Song;
	$list = $object->list();

	// Tilføjer options - rediger og slet
	foreach($list as $key => $arrValues) {
		$list[$key]["options"] = 
			Helpers::createIcon('/admin/song/' . $arrValues['id'], '&check;', 'Rediger') . 
			Helpers::createIcon('/admin/song/', '&cross;', 'Slet');
	}

	// Kalder instans af list presenter
	$presenter = new PresentList($fields,$list);

	// Output med header og footer
	Helpers::Header('Admin - Detaljer');
	echo $presenter->create();
	Helpers::Footer();	
});

// Route til detaljer
Route::add('/admin/song/([0-9]*)', function($id) {

	// Array til felter
	$fields = array(
		"title" => "Titel",
		"name" => "Artist"
	);

	// Kalder instans af song og henter detaljer
	$object = new Song;
	$details = $object->details($id);

	// Kalder instans af detail presenter med felter og data
	$presenter = new PresentDetails($fields, $details);
	
	// Output med header og footer	
	Helpers::Header('Admin - Detaljer');
	echo $presenter->create();
	Helpers::Footer();
});

// Route til create form
Route::add('/admin/song/add', function() {

	// Kalder instans af artist
	$artist = new Artist; 

	// Array til input felter - med artist liste til select options
	// [field_name] => [Label, Type, Values]
	$fields = array(
		"title" => array("Titel", "text"),
		"content" => array("Tekst", "textarea"),
		"artist_id" => array("Artist", "select", $artist->list())
	);

	// Kalder instans af form presenter og sætter form action
	$presenter = new PresentForm($fields);
	$presenter->action = "/admin/song/create";

	// Output med header og footer	
	Helpers::Header('Admin - Opret sang');
	echo $presenter->create();
	Helpers::Footer();
});

// Route til at oprette
Route::add('/admin/song/create', function() {
	// Kalder instans af song
	$object = new Song;
	// Sætter song properties til POST vars fra formular
	$object->title = isset($_POST['title']) && !empty($_POST['title']) ? (string)$_POST['title'] : null;
	$object->content = isset($_POST['content']) && !empty($_POST['content']) ? (string)$_POST['content'] : null;
	$object->artist_id = isset($_POST['artist_id']) && !empty($_POST['artist_id']) ? (int)$_POST['artist_id'] : 0;
	// Opretter og udskriver nyt id
	echo $object->create();
}, 'post');

// Route til rediger form
Route::add('/admin/song/edit/([0-9]*)', function($id) {
	// Kalder instans af song og henter detaljer
	$object = new Song;
	$data = $object->details($id);

	// Kalder instans af artist
	$artist = new Artist; 

	// Array til form felter - med artist liste til select options
	$fields = array(
		"title" => array("Titel", "text"),
		"content" => array("Tekst", "textarea"),
		"artist_id" => array("Artist", "select", $artist->list())
	);

	// Kalder instans af form presenter og sætter form action
	$presenter = new PresentForm($fields, $data);
	$presenter->action = "/admin/song/update";

	// Output med header og footer	
	Helpers::Header('Admin - rediger sang');
	echo $presenter->create();
	Helpers::Footer();
});

// Route til at opdatere
Route::add('/admin/song/update', function() {
	// Kalder instans af song
	$object = new Song;
	// Sætter song properties til POST vars fra formular
	$object->id = isset($_POST['id']) && !empty($_POST['id']) ? (int)$_POST['id'] : null;
	$object->title = isset($_POST['title']) && !empty($_POST['title']) ? (string)$_POST['title'] : null;
	$object->content = isset($_POST['content']) && !empty($_POST['content']) ? (string)$_POST['content'] : null;
	$object->artist_id = isset($_POST['artist_id']) && !empty($_POST['artist_id']) ? (int)$_POST['artist_id'] : 0;
	// OPdaterer og udskriver id
	echo $object->update();
}, 'post');

Route::run('/');