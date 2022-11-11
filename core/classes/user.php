<?php
class User {
	public $firstname;
	public $lastname;
	public $email;

	public $corepath;

	public function __construct()
	{
		var_dump('Class User er kaldt');
	}
	
	public function showUserDetails() {
		echo "<p><h2>Fornavn: " . $this->firstname . "</h2><br />";
		echo "<b>Efternavn:</b> " . $this->lastname . "<br />";
		echo "<b>Email:</b> " . $this->email . "</p>";
	}


}
?>