<?php

    include_once './viewsFromDb.php';
    include_once './layoutClass.php';
    $view_prefix = 'v_%';
    $db_name = 'test_db';

    $layout = new layoutClass;
    echo $layout->getHeader('Page title');

    // Save Labels
    if ( isset( $_POST ) && count($_POST) > 0 ){
        
        $tbl_name = $_POST['tname'];
        unset($_POST['tname']);
        
        $obj = new viewsFromDb($view_prefix, $db_name);
        if ($obj -> saveLabels($tbl_name, $_POST)){
            echo 'Saved';
        }
        echo $layout->getFooter();
        exit;
    }
    

    // Список таблиц
    if (!isset( $_GET['tname'] )) {

        $obj = new viewsFromDb($view_prefix, $db_name);

        echo '<h4>Список таблиц (вьюх)</h4>';
        $tables = $obj -> getTables();
        echo '<ul class="ul-list">';
        if ( count($tables) > 0 ){
            foreach ($tables as $table){
                echo '<li><a href="/?tname=' . $table . '">' . $table . '</a></li>';
            }
        } else {
            echo '<li>Не найдено</li>';
        }
        echo '</ul>';

    } else { // Список полей
        $obj = new viewsFromDb($view_prefix, $db_name);
        $tbl_name = $_GET['tname'];

        echo '<h4>Список полей ' . $tbl_name . '</h4>';
        $fields = $obj -> getFields($tbl_name);
        echo '<form name="fform" method="POST"><ul class="ul-list">';
        echo '<input type="hidden" name="tname" value="' . $tbl_name . '">';
        if ( count($fields) > 0 ){
                foreach ($fields as $field){
                    echo '<li> <p> Label for field<b> ' . $field . '</b>:</p><input type="text" name="'. $field .'" value="'. $field .'"></li>';
                }
                echo '<li><button type="submit">Сохранить</button></li>';
        } else {
                echo '<li>Не найдено</li>';
        }
        echo '</ul>';

    }

    echo $layout->getFooter();