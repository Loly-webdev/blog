<?php

class Manager
{
    protected function dbConnect()
    {
        ob_start();
        session_start();

        //database credentials
        define('DBHOST', 'localhost');
        define('DBUSER', '');
        define('DBPASS', '');
        define('DBNAME', 'blog');

        $db = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8", DBUSER, DBPASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //set timezone
        date_default_timezone_set('Europe/London');

        return $db;
    }
}