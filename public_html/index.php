<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/assets/incl/init.php');

$strPageTitle = 'Velkommen til min PHP side';
echo Tools::Header($strPageTitle);

$user = new User();
$user->firstname = 'Bo';
$user->lastname = 'Jensen';
$user->email = 'bo@bo.dk';
$user->showUserDetails();
?>
<h1><?php echo $strPageTitle ?></h1>
<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quibusdam impedit ullam eius iste, eaque quidem natus! Blanditiis saepe harum, repellat assumenda autem possimus esse labore omnis iusto, voluptate laborum temporibus!</p>

<?php
echo Tools::Footer();
?>