<?php
  require("../../../config_vp2019.php");
  require("functions_user.php");
  require("functions_main.php");
  require("functions_pic.php");
  $database = "if19_rainer_ha_1";
  
  
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
  $maxPicW = 600;
  $maxPicH = 400;
  
  //pildi üleslaadimise osa
	//$target_dir = "uploads/";
	//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	
	$uploadOk = 1;
	
	// Check if image file is a actual image or fake image
	if(isset($_POST["submitPic"])) {
		//$target_file = $pic_upload_dir_orig . basename($_FILES["fileToUpload"]["name"]);
		//$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION));
		$filename = "vp_";
		$timeStamp = microtime(1) * 10000;
		$filename .= $timeStamp . "." .$imageFileType;
		$target_file = $pic_upload_dir_orig .$filename;
		
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	
	// Check if file already exists
	if (file_exists($target_file)) {
		echo "Sorry, file already exists.";
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 2500000) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		
		//teeme pildi väiksemaks
		//loeme pildifaili sisu pikslikogumiks ehk "pildiobjektiks"
		if($imageFileType == "jpg" or $imageFileType == "jpeg"){
			$myTempImage = imagecreatefromjpeg($_FILES["fileToUpload"]["tmp_name"]);
		}
		if($imageFileType == "png"){
			$myTempImage = imagecreatefrompng($_FILES["fileToUpload"]["tmp_name"]);
		}
		if($imageFileType == "gif"){
			$myTempImage = imagecreatefromgif($_FILES["fileToUpload"]["tmp_name"]);
		}
		
		$imageW = imagesx($myTempImage);
		$imageH = imagesy($myTempImage);
		
		if($imageW > $maxPicW or $imageH > $maxPicH){
			if($imageW / $maxPicW > $imageH / $maxPicH){
				$picSizeRation = $imageW / $maxPicW;
			} else{
				$picSizeRation = $imageH / $maxPicH;
			}
			$imageNewW = round($imageW / $picSizeRation, 0);
			$imageNewH = round($imageH / $picSizeRation, 0);
			$myNewImage = setPicSize($myTempImage, $imageW, $imageH, $imageNewW, $imageNewH);
			//kirjutame vähendatud pildi faili
			if($imageFileType == "jpg" or $imageFileType == "jpeg"){
				if(imagejpeg($myNewImage, $pic_upload_dir_w600 .$filename, 90)){
					$notice = "Vähendatud faili salvestamine õnnestus!";	
				} else{
					$notice = "Vähendatud faili salvestamine ei õnnestus!";
				}
			}
			if($imageFileType == "png"){
				if(imagepng($myNewImage, $pic_upload_dir_w600 .$filename, 6)){
					$notice = "Vähendatud faili salvestamine õnnestus!";	
				} else{
					$notice = "Vähendatud faili salvestamine ei õnnestus!";
				}
			}
			if($imageFileType == "gif"){
				if(imagegif($myNewImage, $pic_upload_dir_w600 .$filename)){
					$notice = "Vähendatud faili salvestamine õnnestus!";	
				} else{
					$notice = "Vähendatud faili salvestamine ei õnnestus!";
				}
			}
			
			imagedestroy($myTempImage);
			imagedestroy($myNewImage);
			
		}//kas on liiga suur lõppeb
		
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
	
	}//kas nuppu klikiti
  
  //______________________________________________________________________
  
  require("header.php");
?>


  <?php
    echo "<h1>" .$userName ." koolitöö leht</h1>";
  ?>
  <p>See leht on loodud koolis õppetöö raames
  ja ei sisalda tõsiseltvõetavat sisu!</p>
  <hr>
  <p><a href="?logout=1">Logi välja!</a></p>
  <p><a href="home.php">Tagasi avalehele</a></p>
  
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
	  <label>Vali üleslaetav pildifail!</label><br>
	  <input type="file" name="fileToUpload" id="fileToUpload">
	  <br>
	  <input name="submitPic" type="submit" value="Lae pilt üles!"><span><?php echo $notice; ?></span>
	</form>
	<hr>
  
</body>
</html>