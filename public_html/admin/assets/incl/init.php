<?php
/**
 * Init fil
 * Sætter globale variabler som filstier og database objekt
 */

// Definerer konstant med sti til document root
define("DOCROOT", $_SERVER["DOCUMENT_ROOT"]); 
// Definerer konstant med sti til core mappe
define("COREROOT", substr(DOCROOT, 0, strrpos(DOCROOT,"/")) . "/core/");
// Henter class loader
include_once COREROOT . "/classes/autoload.php";

$db = new dbconf;
