<?php
<<<<<<< HEAD
require_once $_SERVER["DOCUMENT_ROOT"] . "/assets/incl/init.php";
Helpers::Header("Velkommen");

$params = array(
	"id" => array(4, PDO::PARAM_INT)
);

$sql = "SELECT id, title FROM song";

$result = $db->query($sql, $params);
var_dump($result);

Helpers::Footer();
=======
require_once('../core/classes/user.php');

$user = new User();
$user->firstname = 'Heinz';
$user->lastname = 'K';
$user->email = 'heinz@gmail.dk';
$user->showUserDetails();

$user2 = new User();
$user2->firstname = "Ulla";
$user2->lastname = "Jensen";
$user2->email = "uj@mail.dk";
$user2->showUserDetails();

//var_dump($user);
?>
>>>>>>> d3b8e7e (Class User Update)
