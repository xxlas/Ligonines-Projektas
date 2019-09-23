<?php


class Database
{
    public static function getConnection()
    {
        try {
            $conn = new PDO('mysql:host=localhost;dbname=nfq',
                'root',
                'password',
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        } catch (PDOException $ex) {
            die(json_encode(array('outcome' => false, 'message' => 'Unable to connect')));
        }
        return $conn;
    }
}