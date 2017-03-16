<?php
    try{
        /* @var $db PDO*/
        $option = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"];
        $db = new PDO('mysql:host=sql301.rf.gd;dbname=rfgd_19674717_jalqattan','rfgd_19674717','01121584759',$option);
    } catch (Exception $ex) {
        $error = $ex->getMessage();
        echo $error;
    }