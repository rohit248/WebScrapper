<?php

namespace Core;

use PDO;

/**
 * Core model Class
 *
 */
abstract class Model
{

    /**
     * Get the PDO database connection based on env
     *
     * @return mixed
     */
    protected static function getDB()
    {
        static $db = null;

        if ($db === null) {
            $dsn = 'mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_NAME') . ';charset=utf8';
            $db = new PDO($dsn, getenv('DB_USER'), getenv('DB_PASSWORD'));

            // Throw an Exception when an error occurs
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $db;
    }
}
