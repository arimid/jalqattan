<?php
    try{
        /* @var $db PDO*/
        $option = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"];
        $db = new PDO('mysql:host=localhost;dbname=jalqattan','root','',$option);
    } catch (Exception $ex) {
        $error = $ex->getMessage();
    }