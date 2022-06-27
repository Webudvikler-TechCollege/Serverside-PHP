<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/incl/init.php';

Route::add('/admin/song/', function() {
	Helpers::Header('Admin - Detaljer');

	$fields = array(
		"options" => "Handling",
		"title" => "Titel",
		"name" => "Artist"
	);
	$object = new Song;
	$list = $object->list();

	foreach($list as $key => $arrValues) {
		$list[$key]["options"] = 
			Helpers::createIcon('/admin/song/' . $arrValues['id'], '&check;', 'Rediger') . 
			Helpers::createIcon('/admin/song/', '&cross;', 'Slet');
	}


	$presenter = new PresentList($fields,$list);
	echo $presenter->create();

	Helpers::Footer();	
});

Route::add('/admin/song/([0-9]*)', function($id) {
	Helpers::Header('Admin - Detaljer');

	$fields = array(
		"title" => "Titel",
		"name" => "Artist"
	);

	$object = new Song;
	$details = $object->details($id);
	$presenter = new PresentDetails($fields, $details);
	echo $presenter->create();

	Helpers::Footer();

});

Route::run('/');