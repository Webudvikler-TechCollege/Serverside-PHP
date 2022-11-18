<?php
echo $text = 'Til Bo Nicolajsen
Vi skriver fordi der endnu er penge på din konto og den er blevet spærret. Grundet vi har skiftet platform bedes du oprette din konto på ny med email adressen: bo@someplace.dk - Efter oprettelse vil dine penge vente på din konto hvor du enten kan bruge dem eller få dem udbetalt. 
Beløb tilgængeligt opgjort pr. : 21.405,52 kr. 
venlig hilsen Tina';
/**
 * Function Declaration
 */
function getCharPosition($str, $char, $numpos = 1) {
	$arrChars = str_split($str);
	$i = 0;

	//var_dump($arrChars);

	foreach($arrChars as $key => $value) {
		if($value === $char) {
			$i++;
			if($i === $numpos) {
				return $key + 1;
			}
		}
	}
}

/**
 * Function Call
 */
echo "<br>";
echo getCharPosition($text, 'l', 2);
?>