<?php
  require("../../../config_vp2019.php");
  require("functions_user.php");
  $database = "if19_rainer_ha_1";
  
  //kontrollime, kas on sisse logitud
  if(!isset($_SESSION["userId"])){
	  header("Location: page.php");
      exit;	  
  }
  
  //logime välja
  if(isset($_GET["logout"])){
	  session_destroy();
	  header("Location: page.php");
      exit;
  }
  //värvid

  
  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
  
  require("header.php");
  
  echo "<h1>" .$userName .", veebiprogrammeerimine </h1>";
  ?>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiselt võetavat sisu! Eelmine lause ei ole tõene!!</p>
  <p><a href="page2.php">profiili looma!</a></p>
  <hr>
  <br>
  <p><?php echo $userName; ?> | <a href="?logout=1"><b style="color:#FF0000"> Logi välja!</a></b></p>
  
</body>
</html>