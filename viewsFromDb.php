<?php

class viewsFromDb {
    
    public $prefix = 'v_';
    public $views_list;
    
    public $db_connection;
 
        function __construct()
        {
            $this -> prefix = $prefix;
        }
    
    public function getTables(){
		$dbname = 'test_db';

		try {	
			$conn = mysql_connect('localhost', 'root', '');
			$db = mysql_select_db('test_db', $conn);
		} catch (Exception $e) {
			echo ('An error has occured'). mysql_error();
		}

		$sql = "SHOW TABLES FROM $dbname like 'v_%'";
		$result = mysql_query($sql);

		if (!$result) {
			echo "Ошибка базы, не удалось получить список таблиц\n";
			echo 'Ошибка MySQL: ' . mysql_error();
			exit;
		}

		$arr = [];
		
		while ($row = mysql_fetch_row($result)) {
			array_push($arr, $row[0]);
		}

		mysql_free_result($result);
		mysql_close($conn);
		
		return $arr;
		
    }
	
	
	public function getFields($table_name){
		
		
		$dbname = 'test_db';

		try {	
			$conn = mysql_connect('localhost', 'root', '');
			$db = mysql_select_db('test_db', $conn);
		} catch (Exception $e) {
			echo ('An error has occured'). mysql_error();
		}

		$sql = "SHOW TABLES FROM $dbname like 'v_%'";
		$result = mysql_query($sql);

		if (!$result) {
			echo "Ошибка базы, не удалось получить список таблиц\n";
			echo 'Ошибка MySQL: ' . mysql_error();
			exit;
		}

		$arr = [];
		
		$result = mysql_query("SHOW COLUMNS FROM " . $table_name);
		if (!$result) {
			echo 'Ошибка при выполнении запроса: ' . mysql_error();
			exit;
		}
		if (mysql_num_rows($result) > 0) {
			while ($row = mysql_fetch_assoc($result)) {
				//print_r($row);
				array_push($arr, $row['Field']);
			}
		}
		
		mysql_free_result($result);
		mysql_close($conn);
		
		return $arr;
		
	}

}


?>