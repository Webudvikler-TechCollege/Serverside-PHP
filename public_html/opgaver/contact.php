<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/assets/incl/init.php";

$strPageTitle = "Kontakt os";
require_once $_SERVER["DOCUMENT_ROOT"] . "/assets/incl/header.php";

// Indhold
$user = new User();
$user->setData('Tim', 'Sørensen', 'Megavej 13', 9876, 'Aalborg', 'Danmark', 'bentf@lk.dk');
echo $user->getUserInfo();
$user2 = new User();
$user2->setData('Magnus', 'Jensen', 'Leavej 13', 9000, 'Aalborg', 'Danmark', 'bentf@lk.dk');
echo $user2->getUserInfo();
var_dump($user);
var_dump($user2);

require_once $_SERVER["DOCUMENT_ROOT"] . "/assets/incl/footer.php";
?>