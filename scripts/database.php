<?php
namespace scripts;

define('MYSQL_SERVER', 'localhost');
define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', '');
define('MYSQL_DB', 'vomie');

class Database {
    private static $link;
    
    public static function connect() 
    {
        if(self::$link === null) {
            self::$link = mysqli_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB)
                or die("Error: " . mysqli_error(self::$link));
            
            if (!mysqli_set_charset(self::$link, "utf8")) {
                printf("Error: " . mysqli_error(self::$link));
            }
        }
        return self::$link;
    }
    
    public static function getLink() 
    {
        return self::$link;
    }
}

Database::connect();