<?php
// Henter init.php
require_once($_SERVER['DOCUMENT_ROOT'] . '/assets/incl/init.php');

// Sætter var artist_id fra superglobal $_GET 
$artist_id = $_GET['artist_id'];

// Deklarerer sql var med join til artist tabel
$sql = "SELECT song.title, artist.name 
		FROM song 
		JOIN artist 
		ON song.artist_id = artist.id 
		WHERE song.artist_id = :artist_id";

// Kalder prepared statement
$statement = $db->prepare($sql);

// Binder params til statement
$statement->bindParam(':artist_id', $artist_id);

// Eksekverer SQL statement
$statement->execute();

// Kalder fetch på statement objekt
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

var_dump($rows);
