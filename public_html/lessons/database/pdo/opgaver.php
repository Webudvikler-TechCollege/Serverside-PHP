<?php
// Henter init.php
require_once($_SERVER['DOCUMENT_ROOT'] . '/assets/incl/init.php');

/**
 * 1. Hent titler på alle sange sorteret stigende
 */
$sql = "SELECT title 
		FROM song 
		ORDER BY title ASC";
$stmt = $db->prepare($sql);
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


/**
 * 5. Søg i sange
 */
$keyword = "%" . $_GET['keyword'] . "%";
var_dump($keyword);

$sql = "SELECT title, content 
		FROM song 
		WHERE title LIKE :keyword";
$stmt = $db->prepare($sql);
$stmt->bindParam(':keyword', $keyword);
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

var_dump($result)


?>