<?php

class layoutClass {
    
    public function getHeader($title){
		return '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>' . $title . '</title></head><body>';
    }

	public function getFooter(){
		return '</body></html>';
	}
}

?>