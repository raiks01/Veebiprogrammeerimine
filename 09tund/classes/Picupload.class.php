<?php
  class Picupload {
	  private $imageFileType;
	  private $tmpPic;
	  private $myTempImage;
	  private $myNewImage;
	  
	  function __construct($tmpPic, $imageFileType){
		  $this->imageFileType = $imageFileType;
		  $this->tmpPic = $tmpPic;
		  $this->createImageFromFile();
	  }
	  
	  function __destruct(){
		  imagedestroy($this->myTempImage);
	  }
	  
	  private function createImageFromFile(){
		if($this->imageFileType == "jpg" or $this->imageFileType == "jpeg"){
			$this->myTempImage = imagecreatefromjpeg($this->tmpPic);
		}
		if($this->imageFileType == "png"){
			$this->myTempImage = imagecreatefrompng($this->tmpPic);
		}
		if($this->imageFileType == "gif"){
			$this->myTempImage = imagecreatefromgif($this->tmpPic);
		}
	  }//createImageFromFIle lõppeb
	  
	  public function resizeImage($maxPicW, $maxPicH){
		$imageW = imagesx($this->myTempImage);
		$imageH = imagesy($this->myTempImage);
		
		if($imageW > $maxPicW or $imageH > $maxPicH){
			if($imageW / $maxPicW > $imageH / $maxPicH){
				$picSizeRation = $imageW / $maxPicW;
			} else{
				$picSizeRation = $imageH / $maxPicH;
			}
			$imageNewW = round($imageW / $picSizeRation, 0);
			$imageNewH = round($imageH / $picSizeRation, 0);
			$this->myNewImage = $this->setPicSize($this->myTempImage, $imageW, $imageH, $imageNewW, $imageNewH);  
	    }
	  }//resizeImage lõppeb
	  
	  public function addWatermark($wmFile){
		  $waterMark = imagecreatefrompng($wmFile);
		  $waterMarkW = imagesx($waterMark);
		  $waterMarkH = imagesy($waterMark);
		  $waterMarkX = imagesx($this->myNewImage) - $waterMarkW - 10;
		  $waterMarkY = imagesy($this->myNewImage) - $waterMarkH - 10;
		  imagecopy($this->myNewImage, $waterMark, $waterMarkX, $waterMarkY, 0, 0, $waterMarkW, $waterMarkH);
	  }//addWatermark lõpp
	  
	  private function setPicSize($myTempImage, $imageW, $imageH, $imageNewW, $imageNewH){
		$myNewImage = imagecreatetruecolor($imageNewW, $imageNewH);
		imagecopyresampled($myNewImage, $myTempImage, 0, 0, 0, 0, $imageNewW, $imageNewH, $imageW, $imageH);
		return $myNewImage;
      }//setPicSize lõppeb
	  
	  public function savePicFile($filename){
		if($this->imageFileType == "jpg" or $this->imageFileType == "jpeg"){
				if(imagejpeg($this->myNewImage, $filename, 90)){
					$notice = "Vähendatud faili salvestamine õnnestus!";	
				} else{
					$notice = "Vähendatud faili salvestamine ei õnnestus!";
				}
			}
			if($this->imageFileType == "png"){
				if(imagepng($this->myNewImage, $filename, 6)){
					$notice = "Vähendatud faili salvestamine õnnestus!";	
				} else{
					$notice = "Vähendatud faili salvestamine ei õnnestus!";
				}
			}
			if($this->imageFileType == "gif"){
				if(imagegif($this->myNewImage, $filename)){
					$notice = "Vähendatud faili salvestamine õnnestus!";	
				} else{
					$notice = "Vähendatud faili salvestamine ei õnnestus!";
				}
			}
		imagedestroy($this->myNewImage);
		return $notice;	
	  }//savePicFile lõppeb
	  
  }//class lõppeb