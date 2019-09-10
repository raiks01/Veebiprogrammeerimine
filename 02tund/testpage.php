<?php
  $userName = "Rainer ya boi Halanurm";
  $fullTimeNow = date("d.m.Y H:i:s");
  $hourNow = date("H");
  $partOfDay = "Hägune aeg";
  
  if($hourNow < 8){
	 $partOfDay = "hommik"; 
  }
?>
<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="utf-8">
  <title>
  <?php
    echo $userName;
  ?>
  test website</title>

</head>
<body>
  <?php
  echo "<h1>" .$userName .", veebiprogrammeerimine </h1>";
  ?>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiselt võetavat sisu! Eelmine lause ei ole tõene!! </p>
  <p>ERROR 404 NOT FOUND </p>
  <p><b style="color:#00FF00">The End Is Near! Be ready to die in few days!</b></p></body>
  <hr>
  <?php
    echo "<p>Lehe avamise hetkel oli aeg: " .$fullTimeNow .", ". $partOfDay ."</p>";
  ?>
  </body>
  </head>