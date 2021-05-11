
<?php 

//Kreiranje fajla konektor i pdo drajveri 

//echo "<pre>" , print_r(PDO::getAvailableDrivers()) , "</pre>" ; 


//sleketovanje baze i servera 

try{
	
	$konektor = new PDO('mysql:host=localhost; dbname=kfc-baza','root','');
	$konektor->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
}
catch(PDOException $e) {
	
	
	echo $e->getMessage();
	die();
	
}