<?php

class personClass {
    
    public $name;
    public $age;
    public $job;
    
    public function greeting(){
        return 'Hello, ' . $this->name . '!';
    }
    
}

$eric = new personClass;
$eric-> name = 'Эрик';
$eric-> age = 25;
$eric-> job = 'Web-developer';

echo $eric ->greeting();

