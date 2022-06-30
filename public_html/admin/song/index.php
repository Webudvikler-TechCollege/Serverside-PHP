<?php
/**
 * Routes for Song Admin Panel
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/assets/incl/init.php';

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
			Helpers::createIcon('/admin/song/edit/' . $arrValues['id'], '&check;', 'Rediger') . 
			Helpers::createIcon('/admin/song/delete/' . $arrValues['id'], '&cross;', 'Slet') . 
			Helpers::createIcon('/admin/song/' . $arrValues['id'], 'Se', 'Se');
	}

	// Kalder instans af list presenter
	$presenter = new PresentList($fields,$list);

	// Sætter array med links til navigation
	$navlinks = array(
		presentHeader::setLink("/admin/song/add", "Opret ny")
	);

	// Output med admin header og footer
	presentHeader::adminHeader('Sange', 'Oversigt', $navlinks);
	echo $presenter->create();
	presentHeader::adminFooter();
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
	
	// Sætter array med links til navigation
	$navlinks = array(
		presentHeader::setLink("/admin/song/add", "Opret ny"),
		presentHeader::setLink("/admin/song/", "Oversigt")
	);

	// Output med admin header og footer
	presentHeader::adminHeader('Sange', 'Detaljer', $navlinks);
	echo $presenter->create();
	presentHeader::adminFooter();
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

	// Sætter array med links til navigation
	$navlinks = array(
		presentHeader::setLink("/admin/song/", "Oversigt")
	);	

	// Output med admin header og footer
	presentHeader::adminHeader('Sange', 'Opret ny sang', $navlinks);
	echo $presenter->create();
	presentHeader::adminFooter();
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
	if($object->create()) {
		header('Location: /admin/song/' . $object->id);
	}
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

	// Sætter array med links til navigation
	$navlinks = array(
		presentHeader::setLink("/admin/song/", "Oversigt"),
		presentHeader::setLink("/admin/song/add", "Opret ny"),

	);	

	// Output med admin header og footer
	presentHeader::adminHeader('Sange', 'Rediger', $navlinks);	
	echo $presenter->create();
	presentHeader::adminFooter();
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
	// Opdaterer og udskriver id
	if($object->update()) {
		header('Location: /admin/song/' . $object->id);
	}
}, 'post');

// Route til at bekræfte en sletning med
Route::add('/admin/song/delete/([0-9]*)', function($id) {

	$object = new Song;
	$data = $object->details($id);

	// Array til input felter - med artist liste til select options
	// [field_name] => [Label, Type, Values]
	$fields = array(
		"id" => array("ID", "hidden", $id)
	);

	// Kalder instans af form presenter og sætter form action
	$presenter = new PresentForm($fields, array("id" => $id));
	$presenter->action = "/admin/song/dodelete/";
	// Sætter array med ok knap til form presenter
	$presenter->buttons = array(
		presentHeader::setButton('Ok')
	);

	// Sætter array med links til navigation
	$navlinks = array(
		presentHeader::setLink("/admin/song/", "Oversigt")
	);	

	// Output med admin header og footer
	presentHeader::adminHeader('Sange', 'Slet sang', $navlinks);	
	echo $presenter->create();
	presentHeader::adminFooter();
});

// Route til at slette med
Route::add('/admin/song/dodelete/', function() {
	$object = new Song;
	// Skifter til liste route hvis sletning er ok
	if($object->delete($_POST['id'])) {
		header('Location: /admin/song/');
	}
}, 'post');


Route::run('/');