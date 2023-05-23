<?php

namespace Controlleur;

use jmvc\Controlleur;

class UserControlleur implements Controlleur
{
    public function index()
    {
        echo "hello user";
    }
}