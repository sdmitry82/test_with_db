<?php

class layoutClass {
    
    public function getHeader($title){
		return '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>' . $title . '</title><link rel="stylesheet" href="styles.css"></head><body><div class="container">';
    }

    public function getFooter(){
            return '<div><a href="/" target="_self">Home</a></div></div></body></html>';
    }
}

?>