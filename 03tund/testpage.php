<?php
  $userName = "Rainer ya boi Halanurm";
  
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
  //info semestri kulgemise kohta
  $semesterStart = new DateTime("2019-9-2");
  $semesterEnd = new DateTime("2019-12-13");
  $semesterDuration = $semesterStart -> diff($semesterEnd);
  $today = new DateTime("now");
  $semesterElapsed = $semesterStart -> diff($today);
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
  $randomImgHTML = '<img src="' .$photoDir .$photoList[$photoNum] .'" alt="Juhuslik foto">';
  
  require("header.php");
  
  echo "<h1>" .$userName .", veebiprogrammeerimine </h1>";
  ?>
  <p><b style="color:#0606F5">See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiselt võetavat sisu! Eelmine lause ei ole tõene!! </b></p>
  <p><b style="color:#FF0000">ERROR 404 NOT FOUND </b></p>
  <p><b style="color:#0606F5">The End Is Near! Be ready to die in few days!</b></p></body>
  <img src="https://media1.tenor.com/images/de1678a4a0d3ca9264a17339e87dfb5e/tenor.gif?itemid=7204975" width="833" height="625.6755555555555" alt="The End Is Near GIF - TheSimpsons HomerSimpson TheEndIsNear GIFs" style="max-width: 833px; background-color: rgb(63, 63, 63);">
  <?php
  echo $semesterInfoHTML; 
  ?>
  <hr>
  <?php
    echo "<p>Lehe avamise hetkel oli aeg: " .$fullTimeNow .", ". $partOfDay ."</p>";
	echo $randomImgHTML;
  ?>
  
</body>
</html>