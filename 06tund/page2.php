<?php
  require("../../../config_vp2019.php");
  require("functions_user.php");
  //require("functions_main.php");
  $database = "if19_rainer_ha_1";
  
  //require("header.php");
  
  //echo "<h1>" .$userName .", veebiprogrammeerimine </h1>";
  ?>
<?php
  //salvestan profiili andmed
$id = null;
$userid = null;
$mydescription = null;
$mybgcolor = null;
$mytxtcolor = null;
$picutre = null;

  if(isset($_POST["mydescription"])
	  $description = test_input($_POST["mydescription"]);
  if(isset($_POST["mybgcolor"])
	  $bgcolor = test_input($_POST["mybgcolor"]);
  if(isset($_POST["mytxtcolor"])
	  $txtcolor = test_input($_POST["mytxtcolor"]);
  ?>
 
  <!DOCTYPE html>
<html lang="et">
  <head>
    <meta charset="utf-8">
	<title>It's Ya Boi</title>
  </head>
  <p>Profiili loomine:</p>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>Minu kirjeldus</label><br>
	  <textarea rows="10" cols="80" name="description"><?php $mydescription; ?></textarea><br>
	  <label>Minu valitud taustavärv: </label><input name="bgcolor" type="color" value="<?php echo $mybgcolor; ?>"><br>
	  <label>Minu valitud tekstivärv: </label><input name="txtcolor" type="color" value="<?php echo $mytxtcolor; ?>"><br>
	  <input name="submitProfile" type="submit" value="Salvesta profiil">
	</form>
	<p><a href="home.php">tagasi!</a></p>

  <hr>  
</body>
</html>