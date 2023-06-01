<?php

namespace Model;
use Exception;

class QuestionException extends Exception{
    public function __construct(string $msg) {
        parent::__construct($msg);
    }
    
}


?>