<!DOCTYPE html">
<html>
<head>
<title>Океанариум</title>
<link rel="stylesheet" type="text/css" href="Style.css">
</head>
<body>
<div id="main">
<CENTER><img src="image/unnamed.PNG" width="470" height="289"></CENTER>
<div id="menu">
<CENTER><button><a href="index.html" title="Главная">Главная</a></button>
<button><a href="otziv.PHP" title="Отзывы посетителей">Отзывы посетителей</a></button>
<button><a href="obitateli.html" title="Наши обитатели">Наши обитатели</a></button></CENTER>

<?
	$db_host ='localhost';
	$db_name ='otziv';
	$db_username ='root';
	$db_password = '88888888';
	$db_table_to_show = 'ozivi';

	$connect_to_db = mysql_connect($db_host, $db_username, $db_password)
	or die("Could not connect: " .mysql_error());

	mysql_select_db($db_name, $connect_to_db)
	or die("Could not select DB: " .mysql_error());

	$qr_result = mysql_query("select  * from ozivi ")

	or die(mysql_error());
	
	 echo '<table align="center" width="850" height="420"  <table border="1"> ';
		echo '<thead>';
		echo '<tr>';
		echo '<th><p align="center">id</th>';
		echo '<th><p align="center">ФИО</th>';
		echo '<th><p align="center">Телефон</th>';
		echo '<th><p align="center">Отзыв</th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		
	while($data = mysql_fetch_array($qr_result)){
		echo '<tr>';
		echo '<td> <p align="center">' . $data['id'] . '</td>';
		echo '<td> <p align="center">' . $data['FIO'] . '</td>';
		echo '<td> <p align="center">' . $data['telefon'] . '</td>';
		echo '<td> <p align="center">' . $data['otziv'] . '</td>';
		echo '</tr>';
	}

	echo '</tbody>';
	echo '</table>';
	
	mysql_close($connect_to_db);
?>
<center>
<h2>Оставить отзыв</h2>
<form method="POST">

<p>Введите Ф.И.О:<br> 
<input type="text"  name="FIO" /></p>

<p>Введите телефон:<br> 
<input type="text"  name="telefon" /></p>

<p>Введите отзыв:<br> 
<input type="text"  name="otziv" /></p>

<input type="submit" value="Добавить">
</form>

<?php
require_once 'conect.php';
 
if(isset($_POST['id'])&& isset($_POST['FIO']) && isset($_POST['telefon']) && isset($_POST['otziv'])){
 
    $link = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка" . mysqli_error($link)); 
     
	$id = htmlentities(mysqli_real_escape_string($link, $_POST['id']));
	$FIO = htmlentities(mysqli_real_escape_string($link, $_POST['FIO']));
	$telefon = htmlentities(mysqli_real_escape_string($link, $_POST['telefon']));
	$otziv = htmlentities(mysqli_real_escape_string($link, $_POST['otziv']));

    $query ="INSERT INTO ozivi VALUES('$id','$FIO','$telefon','$otziv')";
     
    $result = mysqli_query($link, $query) or die("Ошибка" . mysqli_error($link)); 
   
    mysqli_close($link);
	 if($result)
    {
        echo "<span style='color:blue;'>Данные добавлены</span>";
    }
}
?>

</div>
</div>
</body>
</html>