<?php

// require '../vendor/j4mie/idiorm/idiorm.php';
require 'vendor/autoload.php';

$db_config = array(
        'connection_string' => 'mysql:host=localhost;dbname=prueba',
        'username' => 'root',
        'password' => ''
    );

ORM::configure($db_config);
ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));


