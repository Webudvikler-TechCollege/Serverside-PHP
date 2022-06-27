<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/assets/incl/init.php";

// GET Route til liste 
Route::add('/api/song/', function() {
	$object = new Song;
	$response = $object->list();
	echo Helpers::jsonParser($response);
});

// GET Route til detaljer
Route::add('/api/song/([0-9]*)', function($id) {
	$object = new Song;
	$response = $object->details($id);
	echo Helpers::jsonParser($response);
});

// POST Route til at oprette
Route::add('/api/song/', function() {
	$object = new Song;
	$object->title = isset($_POST['title']) && !empty($_POST['title']) ? (string)$_POST['title'] : null;
	$object->content = isset($_POST['content']) && !empty($_POST['content']) ? (string)$_POST['content'] : null;
	$object->artist_id = isset($_POST['artist_id']) && !empty($_POST['artist_id']) ? (int)$_POST['artist_id'] : 0;
	echo $object->create();
}, 'post');

// PUT Route til at opdatere
Route::add('/api/song/', function() {
	$data = file_get_contents("php://input");
	parse_str($data, $parsed_data);

	$object = new Song;
	$object->id = isset($parsed_data['id']) && !empty($parsed_data['id']) ? (int)$parsed_data['id'] : 0;
	$object->title = isset($parsed_data['title']) && !empty($parsed_data['title']) ? (string)$parsed_data['title'] : null;
	$object->content = isset($parsed_data['content']) && !empty($parsed_data['content']) ? (string)$parsed_data['content'] : null;
	$object->artist_id = isset($parsed_data['artist_id']) && !empty($parsed_data['artist_id']) ? (int)$parsed_data['artist_id'] : 0;
	echo $object->update();
}, 'put');

// DELETE Route til at slette
Route::add('/api/song/([0-9]*)', function($id) {
	$object = new Song;
	$response = $object->delete($id);
	echo Helpers::jsonParser($response);
}, 'delete');

Route::run('/');