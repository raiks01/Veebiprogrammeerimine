<?php
  require("../../../config_vp2019.php");
  require("functions_user.php");
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
  
  //cookie ehk küpsis
  //nimi, väärtus, aegumisaeg, path ehk kataloogid, domeen, kas https, kas üle http ehk üle veebi
  setcookie("vpusername", $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"], time() + (86400 * 31), "/~rainehal/", "greeny.cs.tlu.ee", isset($_SERVER["HTTPS"]), true);
  if(isset($_COOKIE["vpusername"])){
	  echo "leiti küpsis: " .$_COOKIE["vpusername"];
  } else {
	  echo "küpsist ei leitud!";
  }
  //count($_COOKIE)
  
  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
    
  require("header.php");
	
  echo "<h1>" .$userName .", Welcome to your homepage!</h1>";
  ?>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <hr>
  <br>
  <p>Sisseloginud kasutaja: <?php echo $userName; ?> |<a href="?logout=1" style="color:#FF0000">Logi välja</a></p>
  <h2>Funktsioonid</h2>
  <ul>
    <li><a href="userprofile.php">Kasutajaprofiil</a></li>
	<li><a href="messages.php">Sõnumid</a></li>
	<li><a href="picupload.php">Piltide üleslaadimine</a></li>
	<li><a href="gallery.php">Pildigalerii</a></li>
	<li><a href="userpics.php">Minu enda üleslaetud pildid</a></li>
	<li><a href="addnews.php">Uudised</a></li>
</ul>
  
</body>
</html>
