<?php
  require("../../../config_vp2019.php");
  require("functions_main.php");
  $database = "if19_rainer_ha_1";
  
  //sessioonihaldus
  require("classes/Session.class.php");
  SessionManager::sessionStart("vp", 0, "/~rainehal/", "greeny.cs.tlu.ee");

  //echo "<h1>" .$userName .", veebiprogrammeerimine </h1>";

  //kui pole sisseloginud
  if(!isset($_SESSION["userId"])){
	  //siis jõuga sisselogimise lehele
	  header("Location: page.php");
	  exit();
  }
  
  //väljalogimine
  if(isset($_GET["logout"])){
	  session_destroy();
	  header("Location: page.php");
	  exit();
  }
  
  $notice = NULL;
  
  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
  
  
  require("header.php");
?>


  <?php
    echo "<h1>" .$userName ." koolitöö leht</h1>";
  ?>
  <p>See leht on loodud koolis õppetöö raames ja ei sisalda tõsiseltvõetavat sisu!</p>
  <hr>
  <p><a href="?logout=1" style="color:#FF0000">Logi välja</a> | <a href="home.php">Tagasi avalehele</a></p>
  
  <label>Auto: </label><input type="text" name="truck">
  <br>
  <label>Koorem: </label><input type="text" name="load">
  <br>
  <label>Lattu sisenemismass: </label><input type="text" name="in">
  <br>
  <label>Väljumismass: </label><input type="text" name="out">
  <br>
  <input name="submitData" id="submitData" type="submit" value="Salvesta kokkuvõtte leht!"><span id="notice"><?php echo $notice; ?></span>
  <hr>
</body>
</html>