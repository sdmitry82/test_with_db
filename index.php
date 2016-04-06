<?php

include_once './viewsFromDb.php';
include_once './layoutClass.php';

echo var_dump( $_POST );


if ( isset( $_POST ) ){
	
	
}


if (!isset( $_GET['tname'] )) {
	$obj = new viewsFromDb;
	$layout = new layoutClass;
	
	echo $layout::getHeader('Page title');

	echo '<h4>Список таблиц</h4>';
	$tables = $obj::getTables();
	echo '<ul>';
	if ( count($tables) >0 ){
		foreach ($tables as $table){
			echo '<li><a href="/?tname=' . $table . '">' . $table . '</a></li>';
		}
	} else {
		echo '<li>Не найдено</li>';
	}
	echo '</ul>';


	
} else {
	$obj = new viewsFromDb;
	$layout = new layoutClass;
	$tbl_name = $_GET['tname'];
	
	echo '<h4>Список полей</h4>';
	$fields = $obj::getFields($tbl_name);
	echo '<form name="fform" method="POST"><ul>';
	if ( count($fields) >0 ){
		foreach ($fields as $field){
			echo '<li> <b>' . $field . '</b> -  <input type="text" name="'. $field .'" value="'. $field .'"></li>';
		}
		echo '<li><button type="submit">Сохранить</button></li>';
	} else {
		echo '<li>Не найдено</li>';
	}
	echo '</ul>';
	
}


echo "<br><br>END SCRIPT";
echo $layout::getFooter();

?>