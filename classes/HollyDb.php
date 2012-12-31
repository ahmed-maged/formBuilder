<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nookz
 * Date: 12/19/12
 * Time: 11:56 PM
 */
class HollyDb
{
    private static $dbh = null;
    private function __construct()
    {

    }
    public static function getDBH()
    {
        if(HollyDb::$dbh == null)
        {
            $host = 'localhost';
            $dbname = 'formbuilder_test';
            $user = 'root';
            $pass = '';
            try {
                HollyDb::$dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
        return HollyDb::$dbh;
    }
}
