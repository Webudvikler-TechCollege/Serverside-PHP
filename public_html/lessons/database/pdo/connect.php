<?php
/**
 * Eksempel på manuel tilslutning til database med PDO
 */
$dns = "mysql:host=localhost;dbname=localdb";
$username = 'root';
$password = 'password';

try {
	$db = new PDO($dns, $username, $password);
} catch(PDOException $err) {
	echo "Fejl i tilslutning af database: " . $err;
}

/**
 * Eksempel på DDL Query med PDO objekt
 */
$sql = "CREATE TABLE education (
			id BIGINT(20) NOT NULL AUTO_INCREMENT,
			name VARCHAR(100) NOT NULL DEFAULT 'Ikke navngivet',
			active BOOL NOT NULL DEFAULT 0,
			PRIMARY KEY(id)
		)";
var_dump($db->query($sql));

/**
 * Eksempel på fetchAll query med PDO Objekt
 */
$sql2 = "SELECT firstname, lastname FROM student";
$statement = $db->query($sql2, PDO::FETCH_ASSOC);
$result = $statement->fetchAll();

var_dump($result);

/**
 * Eksempel med prepared statements i PDO
 */

// Deklarerer variabler til søgning
$zipcode = 2300;
$lastname = 'Hansen';

// Deklarerer SQL med markers
$sql = "SELECT email 
		FROM student 
		WHERE zipcode > :zipcode 
		AND lastname = :lastname";

// Prepare statement
$statement = $db->prepare($sql);

// Binder values til statement
$statement->bindParam(':zipcode', $zipcode);
$statement->bindParam(':lastname', $lastname);

// Eksekverer statement
$statement->execute();

// Kører fetch på statement
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

var_dump($result);

?>