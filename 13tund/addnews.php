<?php
  require("../../../config_vp2019.php");
  require("functions_main.php");
  require("functions_news.php");
  $database = "if19_rainer_ha_1";
  
  //sessioonihaldus
  require("classes/Session.class.php");
  SessionManager::sessionStart("vp", 0, "/~rainehal/", "greeny.cs.tlu.ee");
  
  //kontrollime, kas on sisse logitud
  if(!isset($_SESSION["userId"])){
	  header("Location: page.php");
	  exit();
  }
  
  //logime välja
  if(isset($_GET["logout"])){
	  session_destroy();
	  header("Location: page.php");
	  exit();
  }
  
  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
  
	$notice = null;
	$error = "";
	$newsTitle = "";
	$news = "";
	$expiredate = date("Y-m-d");
	
	//kas vajutati mõtte salvestamise nuppu
	if(isset($_POST["newsBtn"])){
		//var_dump($_POST);
		if(strlen($_POST["newsTitle"]) == 0){
			$error .= "Uudise pealkiri on puudu!";
		}
		if(strlen($_POST["newsEditor"]) == 0){
			$error .= "Uudise sisu on puudu! ";
		}
		if($_POST["expiredate"] >= $expiredate){
			$expiredate = $_POST["expiredate"];
		}
		
		$newsTitle = test_input($_POST["newsTitle"]);
		$news = test_input($_POST["newsEditor"]);
		if($error == ""){
			$result = saveNews($newsTitle, $news, $expiredate);
			if($result == 1){
				$notice = "Uudis on salvestatud!";
				$error = "";
				$newsTitle = "";
				$news = "";
				$expiredate = date("Y-m-d");
			}
		}
	}

	$newsHTML = latestNews(5);
	//Javascript osa:
	//<!-- Lisame tekstiredaktory TinyMCE -->
	$toScript = "\t" .'<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>' ."\n";
	$toScript .= "\t" .'<script>tinymce.init({selector:"textarea#newsEditor", plugins: "link", menubar: "edit",});</script>' ."\n";
	
	require("header.php");
?>
	<?php
		echo "<h1>" .$userName ." koolitöö leht</h1>";
	  ?>
	  <p>See leht on loodud koolis õppetöö raames
	  ja ei sisalda tõsiseltvõetavat sisu!</p>
	  <hr>
	<p><a href="?logout=1" style="color:#FF0000">Logi välja</a> | <a href="home.php">Tagasi avalehele</a>

	<h2>Lisa uudis</h2>
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<label>Uudise pealkiri:</label><br><input type="text" name="newsTitle" id="newsTitle" style="width: 100%;" value="<?php echo $newsTitle; ?>"><br>
			<label>Uudise sisu:</label><br>
			<textarea name="newsEditor" id="newsEditor"><?php echo $news; ?></textarea>
			<br>
			<label>Uudis nähtav kuni (kaasaarvatud)</label>
			<input type="date" name="expiredate" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value="<?php echo $expiredate; ?>">
			
			<input name="newsBtn" id="newsBtn" type="submit" value="Salvesta uudis!"> <span>&nbsp;</span><span><?php echo $error; ?></span>
		</form>
	<br>
	<!--Kui lasete uudise läbi test_input funktsiooni, siis html "<" ja ">" muudetakse koodideks. Uudise näitamisel siis tuleb need tagasi muuta ja selleks on vaja andmetabelist loetud uudis lasta läbi php funktsiooni htmlspecialchars_decode()
	<?php
	  echo $newsHTML;
	?>