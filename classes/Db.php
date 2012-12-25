<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nookz
 * Date: 12/19/12
 * Time: 11:56 PM
 */
class Db
{
    private static $dbh = null;
    private function __construct()
    {

    }
    public static function getDBH()
    {
        if(Db::$dbh == null)
        {
            $host = 'localhost';
            $dbname = 'formbuilder';
            $user = 'root';
            $pass = '';
            try {
                Db::$dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
        return Db::$dbh;
    }
}
