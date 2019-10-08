<?php
  require("../../../config_vp2019.php");
  require("functions_film.php");
  //echo $serverHost;
  $userName = "Rainer ya boi Halanurm";
  $database = "if19_rainer_ha_1";
  
  $filmInfoHTML = readAllFilms();
  
  require("header.php");
  echo "<h1>" .$userName .", veebiprogrammeerimine </h1>";
  ?>
  <p><b style="color:#0606F5">See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiselt võetavat sisu! Eelmine lause ei ole tõene!! </b></p>
  <hr>
  <h2>Eesti filmid</h2>
  <p>Praegu meie andmebaasis on järgmised filmid:</p>
  <?php
	echo $filmInfoHTML;
  ?>
  
</body>
</html>