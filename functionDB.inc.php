<?php
define('SERVER', "localhost");
define('DBNAME', "m152");
define('USER', "root");
define('PASS', "");

function getConnexion() {
    static $db = NULL;
    if ($db === NULL) {
        try {
            $connectionString = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . '';
            $db = new PDO($connectionString, USER, PASS);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    } else {
        return $db;
    }
}
