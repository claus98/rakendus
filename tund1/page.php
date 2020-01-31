<?php
	$myName = "Claus Kristjan Maido";
	$datetime = date("d.m.Y H:i:s");
	//<p>Lehe avamise hetkel oli:<strong>31.01.2020 11:32:07</strong></p>
	$timeHTML = "<p>Lehe avamise hetkel oli: <strong>" .$datetime ."</strong></p> \n";
	$hourNow = date("H");
	$partOfDay = "hägune aeg";
	
	if($hourNow < 10){
		$partOfDay = "hommik";
	}
	if($hourNow >= 10 and $hourNow < 18) {
		$partOfDay = "aeg aktiivselt tegutseda";
	}
	$partOfDayHTML = "<p>Käes on " .$partOfDay ."!</p> \n";
	
	//info semestri kulgemise kohta
	$semesterStart = new dateTime("2020-01-27");
	$semesterEnd = new dateTime ("2020-06-22");
	$semesterDuration = $semesterStart->diff($semesterEnd);
	//echo $semesterDuration;
	//var_dump($semesterDuration);
	$today = new dateTime("now");
	$fromSemesterStart = $semesterStart->diff($today);
	//<p> semester on hoos: <meter value="" min="0" max""></meter></p>
	$semesterProgressHTML = '<p>semester on hoos:<meter min="0" max"';
	$semesterProgressHTML .= $semesterDuration->format("%r%a");
	$semesterProgressHTML .= '"value="';
	$semesterProgressHTML .= $fromSemesterStart->format("%r%a");
	$semesterProgressHTML .= '"></meter>.</p>' ."\n";
	
	//loen etteantud kataloogist pildifailid
	$picsDir = "../../pics/";
	$photoTypesAllowed = ["image/jpeg", "image/png"];
	$photoList = [];
	$allFiles = array_slice(scandir($picsDir), 2);
	//var_dump($allFiles);
	foreach($allFiles as $file) {
		$fileInfo = getImageSize($picsDir .$file);
		if(in_array ($fileInfo["mime"], $photoTypesAllowed) == true){
			array_push($photoList, $file);
		}
	}	
	$photoCount = count($photoList);
	$photoNum = mt_rand (0, $photoCount-1);
	$randomImageHTML = '<img src="' .$picsDir .$photoList[$photoNum] .'" alt="juhuslik pilt Haapsalust">' ."/n";
	
?>
<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<title>Veebirakendused ja nende loomine 2020</title>
	<p><?php echo $datetime ?></p>
</head>
<body>
	<h1><?php echo $myName; ?></h1>
	<p>See leht on valminud õppetöö raames!</p>
	<?php
		echo $timeHTML;
		echo $partOfDayHTML;
		echo $semesterProgressHTML;
		echo $randomImageHTML;
	?>
</body>
</html>