<?php
  require("../../../config_vp2019.php");
  require("functions_user.php");
  require("functions_main.php");
  require("functions_message.php");
  $database = "if19_rainer_ha_1";
  
  //require("header.php");
  
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
  
  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
  
  $notice = null;
  $myMessage = null;
  
  if(isset($_POST["submitMessage"])){
	$myMessage = test_input($_POST["message"]);
	if(!empty($myMessage)){
		$notice = storeMessage($myMessage);
	} else {
		$notice = "Tühja sõnumit ei salvestata!";
	}
  }
  
  //$messagesHTML = readAllMessages();
  $messagesHTML = readMYMessages();
  
  require("header.php");
?>


  <?php
    echo "<h1>" .$userName ." koolitöö leht</h1>";
  ?>
  <p>See leht on loodud koolis õppetöö raames
  ja ei sisalda tõsiseltvõetavat sisu!</p>
  <hr>
  <p><a href="?logout=1" style="color:#FF0000">Logi välja</a> | <a href="home.php">Tagasi avalehele</a></p>
  
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>Minu sõnum (256 märki)</label><br>
	  <textarea rows="5" cols="51" name="message" placeholder="kirjuta siia oma sõnum ..."></textarea>
	  <br>
	  <input name="submitMessage" type="submit" value="Salvesta sõnum"><span><?php echo $notice; ?></span>
	</form>
	<hr>
	<h2>Senised sõnumid</h2>
	<?php
	  echo $messagesHTML;
	?>
  
</body>
</html>