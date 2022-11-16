<?php
// Definerer en kontant til document root
define("DOCROOT", $_SERVER['DOCUMENT_ROOT']);
define("COREROOT", str_replace('public_html', 'core/',$_SERVER['DOCUMENT_ROOT']));
require_once(COREROOT . 'classes/autoload.php');

/**
 * Eksempel på tilslutning til database med PDO
 */
$dns = "mysql:host=localhost;dbname=localdb";
$username = 'root';
$password = 'password';

try {
	$db = new PDO($dns, $username, $password);
} catch(PDOException $err) {
	echo "Fejl i tilslutning af database: " . $err;
}
?>