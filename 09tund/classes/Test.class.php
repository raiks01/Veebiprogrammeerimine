<?php
  class Test {
	  //muutujad ehk properties
	  private $privateNumber;
	  public $publicNumber;
	  
	  //funktsioonid ehk methods
	  //consturctor, see on funktsioon, mis käivitub üks kord, classi kasutusele võtmisel
	  function __construct($sentNumber){
		  $this->privateNumber = 72;
		  $this->publicNumber = $sentNumber;
		  echo "Salajase ja avaliku arvu korrutis on: " .$this->privateNumber * $this->publicNumber;
		  $this->tellSecret();
	  }
	  //destructor, käivitatakse, kui klass eemaldatakse, enam ei kasuta
	  function __destruct(){
		  echo "Klass lõpetas tegevuse!";
      }

	  private function tellSecret(){
		  echo "salajane number on: " .$this->privateNumber;  
	  }
	  
	  public function tellPublicSecret(){
		  echo "salajane number on tõesti: " .$this->privateNumber;
	  }
	  
  }//class lõppeb