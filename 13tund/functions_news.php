<?php
	function saveNews($newsTitle, $news, $expiredate){
		$response = 0;
		$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $conn->prepare("INSERT INTO vpnews (userid, title, content, expire) VALUES (?, ?, ?, ?)");
		echo $conn->error;
		$stmt->bind_param("isss", $_SESSION["userId"], $newsTitle, $news, $expiredate);
		if($stmt->execute()){
			$response = 1;
		} else {
			$response = 0;
		}
		$stmt->close();
		$conn->close();
		return $response;
	}

	function latestNews($limit){
		$newsHTML = null;
		$today = date("Y-m-d");
		$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $conn->prepare("SELECT title, content FROM vpnews WHERE expire >=? AND deleted IS NULL ORDER BY id DESC LIMIT ?");
		echo $conn->error;
		$stmt->bind_param("si", $today, $limit);
		$stmt->bind_result($title, $content);
		$stmt->execute();
		while ($stmt->fetch()){
			$newsHTML .= "<div> \n";
			$newsHTML .= "\t <h3>" .$title ."</h3> \n";
			$newsHTML .= "\t <div>" .htmlspecialchars_decode($content) ."</div> \n";
			$newsHTML .= "</div> \n";
		}
		if($newsHTML == null){
			$newsHTML = "<p>Uudised puuduvad!</p>";
		}
		$stmt->close();
		$conn->close();
		return $newsHTML;
	}