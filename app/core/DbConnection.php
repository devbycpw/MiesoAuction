<?php
class DbConnection {
    protected static $db;

    public static function connect() {
        if (!self::$db) {
            self::$db = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
                DB_USER,
                DB_PASS
            );
        }
        return self::$db;
    }
}
