<?php

// we connect to the database
function linkDbConnect()
{
    try {
        $database = new PDO ('mysql:host=localhost;dbname=tackdirect;charset=utf8','root','root');
    }  catch (Exception $e)  {
            die('Erreur : '.$e->getMessage());
    }
    return $database;
}