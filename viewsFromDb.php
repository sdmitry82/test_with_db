<?php

class viewsFromDb {
    
    public $prefix;
    public $db_name;
    public $db_connection;
 
    //// Class constructor
    public function __construct($prefix, $db_name)
    {
        $this -> prefix = $prefix;
        $this -> db_name = $db_name;
        $this -> db_connection = $this->dbConnect();
    }
    
    // DB Connect
    private function dbConnect (){
        try {	
            $conn = mysql_connect('localhost', 'root', '');
        } catch (Exception $e) {
            echo ('Ошибка подключения к базе данных.<br> MySQL: '). mysql_error(); exit;
        }
        $db = mysql_select_db($this -> db_name);
        return $conn;
    }


    // Save labels to DB
    public function saveLabels ($table_name, $labels){
        try {
            $sql = "DELETE FROM labels_db WHERE `table` = '$table_name'";
            mysql_query($sql);
        } catch (Exception $e) {
            null;
        }
       
        try {
            foreach ( array_keys($labels) as $key){
                $k = trim($key); $v = trim($labels[$key]);
                $sql = "INSERT INTO `test_db`.`labels_db` (`id`, `table`, `field`, `label`) VALUES (NULL, '$table_name', '$k', '$v' )";
                mysql_query($sql);
            }
        } catch(Exception $e) {
            echo ('Ошибка сохранения в базу данных.<br> MySQL: '). mysql_error();
            return false;
        }
        return false;
    }
    
    
    // Получаем views
    public function getTables(){
        //$sql = "SHOW TABLES FROM {$this->db_name} like 'v_%'";
        $sql = "SHOW TABLES FROM {$this->db_name} LIKE '$this->prefix%'";
        
        $result = mysql_query($sql);
        if (!$result) { 
            echo 'Ошибка базы, не удалось получить список таблиц.<br> MySQL: ' . mysql_error(); exit; 
        }
        $arr = [];
        while ($row = mysql_fetch_row($result)) {
                array_push($arr, $row[0]);
        }
        mysql_free_result($result);
        return $arr;
    }

    // Получаем поля таблицы
    public function getFields($table_name){
        $arr = [];
        $result = mysql_query("SHOW COLUMNS FROM {$table_name}");
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
        return $arr;
    }
    
    //// Class Destructor
    function __destruct() {
        mysql_close($this->db_connection);
    }

}