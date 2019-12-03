<?php
  require("../../../config_vp2019.php");
  require("functions_main.php");
  require("functions_user.php");
  $database = "if19_rainer_ha_1";
  $userName = "Sisselogimata kasutaja";
  
  //sessioonihaldus
  require("classes/Session.class.php");
  SessionManager::sessionStart("vp", 0, "/~rainehal/", "greeny.cs.tlu.ee");
  
  $notice = "";
  $email = "";
  $emailError = "";
  $passwordError = "";
  
  $photoDir = "../photos/";
  $photoTypes = ["image/jpeg", "image/png"];
  
  $fullTimeNow = date("d.m.Y H:i:s");
  $hourNow = date("H");
  $partOfDay = "Hägune aeg";
  
  if($hourNow < 8){
	 $partOfDay = "hommik"; 
  }
  if($hourNow >= 8 and $hourNow < 16) {
	  $partOfDay = "Akedeemiline aeg";
  }
  if($hourNow >= 16 and $hourNow < 22) {
	  $partOfDay = "Vaba aeg";
  }
  if($hourNow > 22) {
	  $partOfDay = "öö";
  }
  
  //nädalapäevad
  //$weekDayET = ["E", "T", "K", "N", "R", "L", "P"]
  //$weekDayToday = date("N")
  //info semestri kulgemise kohta
  $semesterStart = new DateTime("2019-9-2");
  $semesterEnd = new DateTime("2019-12-13");
  $semesterDuration = $semesterStart -> diff($semesterEnd);
  $today = new DateTime("now");
  $semesterElapsed = $semesterStart -> diff($today);
  //$semesterOver = new $semesterDuration > 112
  //echo $semesterDuration;
  //var_dump($semesterDuration);
  //<p>Semester on täies hoos:
  //<meter min="0" max="112" value="16">13%</meter>
  //</p>
  $semesterInfoHTML = null;
  if($semesterElapsed -> format("%r%a") >= 0){
	$semesterInfoHTML = "<p> Semester on täies hoos: ";
    $semesterInfoHTML .='<meter min="0" max="' .$semesterDuration -> format("%r%a") .'" ';
	$semesterInfoHTML .= 'value="' .$semesterElapsed -> format("%r%a") .'">';
	$semesterInfoHTML .= round($semesterElapsed -> format("%r%a") / $semesterDuration -> format("%r%a") * 100, 1) ."%";
	$semesterInfoHTML .= "</meter> </p>";
  }
  
  //foto näitamine lehel
  $fileList = array_slice(scandir($photoDir), 2);
  //var_dump($fileList);
  $photoList = [];
  foreach ($fileList as $file){
	  $fileInfo = getImagesize($photoDir .$file);
	  if (in_array($fileInfo["mime"], $photoTypes)){
          array_push($photoList, $file);
	  }  
  }
  
  //$photoList = ["tlu_terra_600x400_1.jpg", "tlu_terra_600x400_2.jpg", "tlu_terra_600x400_3.jpg"];//array ehk massiiv
  //var_dump($photoList);
  $photoCount = count($photoList);
  $photoNum = mt_rand(0, $photoCount -1);
  //echo $photoList[$photoNum];
  //<img src="../photos/tlu_terra_600x400_1.jpg" alt="TLÜ Terra õppehoone">
  $latestPublicPictureHTML = latestPicture(1);
  $randomImgHTML = '<img src="' .$photoDir .$photoList[$photoNum] .'" alt="Juhuslik foto">';
  //sisselogimine
	if(isset($_POST["login"])){
		if (isset($_POST["email"]) and !empty($_POST["email"])){
		  $email = test_input($_POST["email"]);
		} else {
		  $emailError = "Palun sisesta kasutajatunnusena e-posti aadress!";
		}
	  
		if (!isset($_POST["password"]) or strlen($_POST["password"]) < 8){
		  $passwordError = "Palun sisesta parool, vähemalt 8 märki!";
		}
	  
		if(empty($emailError) and empty($passwordError)){
		   $notice = signIn($email, $_POST["password"]);
		} else {
			$notice = "Ei saa sisse logida!";
		}
	  }
  
  //require("header.php");
  
  //echo "<h1>" .$userName .", veebiprogrammeerimine </h1>";
  ?>
  <!DOCTYPE html>
<html lang="et">
  <head>
    <meta charset="utf-8">
	<title>2019 Veebiprogrammeerimine, Rainer</title>
	<h1>Veebiprogrammeerimine</h1>
  </head>
  <body>
  <p><b style="color:#0606F5">See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiselt võetavat sisu! Eelmine lause ei ole tõene!! </b></p>
  <p><b style="color:#FF0000">ERROR 404 NOT FOUND </b></p>
  <p><b style="color:#0606F5">The End Is Near! Be ready to die in few days!</b></p></body>
  <?php
  echo $semesterInfoHTML; 
  ?>
  <hr>
  <?php
    echo "<p>Lehe avamise hetkel oli aeg: " .$fullTimeNow .", ". $partOfDay ."</p>";
	//echo $randomImgHTML;
	?>
	
	  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>E-mail (kasutajatunnus):</label><br>
	  <input type="email" name="email" value="<?php echo $email; ?>">&nbsp;<span><?php echo $emailError; ?></span><br>
	  
	  <label>Salasõna:</label><br>
	  <input name="password" type="password">&nbsp;<span><?php echo $passwordError; ?></span><br>
	  
	  <input name="login" type="submit" value="Logi sisse">&nbsp;<span><?php echo $notice; ?>
	</form>
	<br>
	<h2>Kui pole kasutajakontot</h2>
	<p><a href="newuser.php">Loo kasutajakonto!</a></p>
  
  <?php
	echo $randomImgHTML;
	echo $latestPublicPictureHTML;
  ?>
  
</body>
</html>