<!DOCTYPE html>
<html lang="en">
<head>
<title>KFC | BIH</title>
<link rel="shortcut icon" type="image/png" href="logo's/kfc-3.png"/>
<link rel="stylesheet" type="text/css" href="main.css"/>
<link rel="stylesheet" href="https://googleapis.com/css?family=Open+Sans|Lora
|Catamaran|IM+Fell+French+Canon|Cabin|Shrikhand|Fugaz+One|Julius+Sans+One"/>
<link href="https://fonts.googleapis.com/css?family=Fugaz+One|Julius+Sans+One|Shrikhand" rel="stylesheet"> 

<meta charset="utf-8"/>
<meta name="viewport" content="width= device-width , initial-scale= 1.0" />
<meta name="author" content="Dino Emso"/>

</head>


<body>

		<div id="computer-desktop-1">
		
		<div id="container-1">
		
		<div id="main">
		
		<?php 
		
		//Kreiranje funkcionalnosti register forme
		
		?>
		
		<div class="register-logo">
		<img src="logo/kfc-3.png" alt="register-logo" width=""/>
		<h2>KFC-REGISTER</h2>
		
		</div>
		
		<div class="register-php">
		<?php
				
		
		$err = ""; 
		 
		if(isset($_POST['submit'])) {
			
			if(!empty($_POST['username'])) {
				
				$qKor = "SELECT * FROM `korisnici` WHERE `username` = :username";
				$korisnici = $konektor->prepare($qKor);
				$korisnici->execute(array(
				
				':username' => $_POST['username']
				
				)); 
				if($korisnici->rowCount()) {
					
					$err .= "- Vase korisnicko ime vec postoji u bazi, molimo vas odaberite novo <br>";
					
					
				}
				else {
					
					
					$username = $_POST['username']; 
					
					
				
				}
				
				if(strlen($_POST['username']) > 30) {
					
					$err .= "- Vase korisnicko ime mora imati manje od 30 znakova(karaktera) da bi bilo važeće <br>";
					
				}
				
				
				
			}
			else {
				
				
				$err .= "- Morate ukucati Vase korisnicko ime <br>";
				
			}
			
			if(!empty($_POST['pass'])) {
				
				//Registracija se izvrsava 
				
				$pass = $_POST['pass']; 
				if(strlen($_POST['pass']) < 4) {
				
				$err .= "- Vasa lozinka je prekratka, mora biti minimum 5 simbola <br>";
				
			}
				
				
			}
			else {
				
				
				$err .= "- Morate ukucati Vasu lozinku <br>";
			}
			
			
			
			if(!empty($_POST['repass'])) {
				
				
				
			}
			else {
				
				$err .= "- Morate ukucati Vasu ponovljenu lozinku <br>";
				
				
			}
			
			if($_POST['pass'] != $_POST['repass']) {
				
				
				$err .= "- Vase lozinke se ne poklapaju ,probajte ponovo <br>";
			}
			if(!empty($_POST['name'])) {
				
				
				$name = $_POST['name']; 
				
			}
			else {
				
				
				$err .= "- Morate ukucati svoje Ime i Prezime <br>";
			}
			
			if(isset($_POST['email']) && !empty($_POST['email'])) {
				
				if(filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL)) {
					
					//Email je validan 
					
				}
				else {
					
					$err .= "- Vas email nije validan <br>";
					
				}
				
				$qKor = "SELECT * FROM `korisnici` WHERE `email` = :email";
				$korisnici = $konektor->prepare($qKor);
				$korisnici->execute(array(
				
				':email' => $_POST['email']
				
				)); 
				if($korisnici->rowCount()) {
					
					$err .= "- Vasa email adresa vec postoji u bazi, molimo vas odaberite novu <br>";
					
					
				}
				else {
					
					
					$email = $_POST['email']; 
					
					
				
				}
				
				if(strlen($_POST['email']) > 45) {
					
					$err .= "- Vasa email adresa mora imati manje od 45 znakova(karaktera) da bi bila važeća <br>";
					
				}
				

				
			}
			else {
				
				
				$err .= "- Morate ukucati Vasu email adresu <br>";
				
			}
			
			//Kreiranje parametara za datum 
			
			$dan = $_POST['dan']; 
			$mjesec = $_POST['mjesec'];
            $godina = $_POST['godina']; 

            $datumi = $godina . "." . $mjesec . "." . $dan ; 
             
            $datum = date($datumi);


            //Kreiranje parametara za slike 

            if(isset($_FILES['picture']['tmp_name'])) {
				
				if(!empty($_FILES['picture']['tmp_name'])) {
					
					
					$folder = "slike/"; 
					$folder = $folder . basename($_FILES['picture']['name']);
					
					$tmpName = $_FILES['picture']['tmp_name']; 
					
					//Kreiranje parametara za ekstenziju 
					
					$dijelovi_naziva = pathinfo($_FILES['picture']['name']); 
					$extension = $dijelovi_naziva['extension'];
					
					//Petlja za ekstenziju 
					
					if($extension == "jpg" || $extension == "png" || $extension == "gif") {
						
						
						//Registracija ce se izvrsitit
						
					}
					else {
						
						$err .= "- Format vase slike nije odgovarajuci ,format mora biti 
						jpg,png ili gif <br>";
						
					}
					
					//Kreiranje slucajnog naziva 
					$first = rand(1,100000);
					$second = rand(1,100000);
					$third = rand(1,100000);
					
					$slucajni_naziv = $first . "-" . $second . "-" . $third ; 
					$naziv = "slike/" . $slucajni_naziv; 
					
			} }
				
				//Kreiranje parametara za biranje spola 
				
				if(!empty($_POST['gender'])) {
					
				$gender = $_POST['gender']; 	
					
				}
				else {
					
					$err .= "- Izaberite spol <br>";
				}
				
				//Kreiranje parametara za slucajni kod 
				
				
				$prvi = rand(1,100000);
				$drugi = rand(1,100000);
				$treci = rand(1,100000);
				
				$kod = $prvi . "-" . $drugi . "-" . $treci;
				
				
				
				//Kreiranje konacne petlje 
				
				if($err == "") {
					
					if(move_uploaded_file($tmpName , $naziv)) {
						
						$qKor = " INSERT INTO `korisnici` SET 
						
						`username` = :username, 
						`password` = :pass,
						`name` = :name , 
						`email` = :email, 
						`picture` = :picture, 
						`datum` = :datum,
						`gender` = :gender, 
						`code` = :kod, 
						`condition` = :condition
								
						
						";
						$korisnici = $konektor->prepare($qKor);
						$korisnici->execute(array(
						
						
						':username' => $username, 
						':pass' => $pass,
						':name' => $name, 
						':email' => $email ,
						':picture' => $naziv, 
						':datum' => $datum, 
						':gender' => $gender, 
						':kod' => $kod, 
						':condition' => $condition
						
						
						
						
						
						
						
						
						)); 
						
						
					}
					else{
						$qKor = " INSERT INTO `korisnici` SET 
						
						`username` = :username, 
						`password` = :pass,
						`name` = :name , 
						`email` = :email, 
						`picture` = :picture, 
						`datum` = :datum,
						`gender` = :gender, 
						`code` = :kod, 
						`condition` = :condition
								
						
						";
						$korisnici = $konektor->prepare($qKor);
						$korisnici->execute(array(
						
						
						':username' => $username, 
						':pass' => $pass,
						':name' => $name, 
						':email' => $email ,
						':picture' => "slike/profil.jpg", 
						':datum' => $datum, 
						':gender' => $gender, 
						':kod' => $kod, 
						':condition' => $condition
						
						
						));
					}
					
					header("Location:afterregister.php");
					
					
				}
				else {
					
					
					echo $err; 
					
				}
				
				
				
					
			
			
			
			
			
		}
		
		?>
		
		</div>
		
		
		
		<form method="POST" action="index.php?opcija=register" enctype="multipart/form-data">
		
		<div class="register-1">
		
		<!-- Username form -->
		<div class="register-row">
		
		<div class="register-label">
		<label for="username">Korisnicko ime</label>
		</div>
		
		<div class="register-input">
		<input type="text" name="username" placeholder="username" id="username"/>
		</div>
		
		</div>
		
		
		<!-- Password form -->
		<div class="register-row">
		
		<div class="register-label">
		<label for="password">Lozinka</label>
		</div>
		
		<div class="register-input">
		<input type="password" name="pass" placeholder="min. 5 charachters" id="password"/>
		</div>
		
		</div>
		
		
	<!-- RE-Password form -->
		<div class="register-row">
		
		<div class="register-label">
		<label for="repass">Lozinka</label>
		</div>
		
		<div class="register-input">
		<input type="password" name="repass" placeholder="re-password" id="repass"/>
		</div>
		
		</div>
		
		
	<!-- Name form -->
		<div class="register-row">
		
		<div class="register-label">
		<label for="name">Ime i Prezime</label>
		</div>
		
		<div class="register-input">
		<input type="text" name="name" placeholder="full name" id="name"/>
		</div>
		
		</div>
		
		
		<!-- Email form -->
	    <div class="register-row">
		
		<div class="register-label">
		<label for="email">Email adresa</label>
		</div>
		
		<div class="register-input">
		<input type="text" name="email" placeholder="email adress" id="email"/>
		</div>
		
		</div>
		
		
	     <!-- Email form -->
	    <div class="register-row">
		
		<div class="register-label-3">
		<label for="datum">Datum rođenja</label>
		</div>
		
		<div class="register-input-3">
  
        <select name="dan">
		<?php
		
		for($dan = 1; $dan <= 31; $dan++) {
			
			?> <option <?php echo $dan;  ?> > <?php echo $dan;  ?></option><?php
			
		}
		?>
		</select>
		
		 <select name="mjesec">
		<?php
		
		for($mjesec = 1; $mjesec <= 12; $mjesec++) {
			
			?> 
			<option <?php echo $mjesec; ?>> <?php echo $mjesec; ?>  </option>
			
	<?php 
		}
		?>
		</select>
		
		<select name="godina">
		<?php
		
		for($godina = 1940; $godina <= 2018; $godina++) {
			
			?> <option <?php echo $godina;  ?>> <?php echo $godina;  ?></option><?php
			
		}
		?>
		</select>
		
		</div>
		
		</div>
		
		
		<!-- Picture form -->
		<div class="register-row">
		
		<div class="register-label">
		<label for="profil">Profilna slika</label>
		</div>
		
		<div class="register-input">
		<input type="file" name="picture" id="profil"/>
		</div>
		
		</div>
		
		
		<!-- Radio button form -->
		<div class="register-row">
		
		<div class="register-label-1">
		<label for="male">Male</label>
		</div>
		
		<div class="register-input-1">
		<input type="radio" name="gender" value="male" id="male"/>
		</div>
		
		</div>
		
		<!-- Radio button form -->
		<div class="register-row">
		
		<div class="register-label-1">
		<label for="female">Female</label>
		</div>
		
		<div class="register-input-1">
		<input type="radio" name="gender" value="female" id="female"/>
		</div>
		
		</div>
		
		<!-- Checkbox form -->
		<div class="register-row">
		
		<div class="register-label-2">
		<label for="checkbox">Da li prihvatate sve uslove registracije?</label>
		</div>
		
		<div class="register-input-2">
		<input type="checkbox" name="checkbox" id="checkbox" <?php 
		
		if(empty($_POST['checkbox'])) {
			
			
			?> value="yes" <?php
			
		}
		else {
			
			?> value="no" <?php
			
		}
		
		
		
		?>/>
		</div>
		
		</div>
		
			<!-- Submit -->
		<div class="register-row">
				
		<div class="register-input">
		<input type="submit" name="submit" value="Registruj se" class="submit"/>
		</div>
		
		</div>
		
		<div class="login-link">
		<p><small>Ukoliko vec imate kreiran racun mozete se prijaviti na ovom
		<a href="index.php">linku</a></small></p>
		</div>
		
		</div>
		
		
		</form>
		
		
		
		</div>
		
		<footer class="footer-1 ">
		<nav>
		<ul>
		<li><a href="index.php">naslovnica</a></li>
		<li><a href="index.php?opcija=historija">historija</a></li>
		<li><a href="index.php?opcija=onama">o nama</a></li>
		<li><a href="index.php?opcija=register">registracija</a></li>
		
		<li><a href="index.php">prijavi se</a></li>
		</ul>
		</nav>
		</footer>
		<footer class="copy-1">
		<h2 class="copyright">&copy; Sva prava zadržana KFC-2018</h2>
		</footer>
		
		</div>
		
		
		
			
		</div>
		
		



</body>


</html>