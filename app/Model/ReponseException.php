<?php

namespace Model;
use Exception;

class ReponseException extends Exception{
    public function __construct(string $msg) {
        parent::__construct($msg);
    }
    
}
?>