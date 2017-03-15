<?php
/**
 * Created by PhpStorm.
 * User: Marijana
 * Date: 14.3.2017.
 * Time: 13.27
 */

namespace Tests;
require dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR .'autoload.php';

use PHPUnit\Framework\TestCase;
require dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'classes'.DIRECTORY_SEPARATOR.'Connect.php';
require dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'classes'.DIRECTORY_SEPARATOR.'Model.php';

class ConnectTest extends TestCase
{

    static private $pdo = null;

    // only instantiate PHPUnit_Extensions_Database_DB_IDatabaseConnection once per test

    private $conn = null;

    public function testEmpty()
    {
        $con = [];
        $this->assertEmpty($con);

        return $con;
    }



    public function getInstance()
    {
        if ($this->conn === null) {
            if (self::$pdo == null) {
                self::$pdo = new PDO( $GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD'] );
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo, $GLOBALS['DB_DBNAME']);
        }

        return $this->conn;
    }
    }
