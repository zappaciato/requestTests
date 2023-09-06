<?php

namespace Kris\TestProject\Classes;


use Kris\TestProject\Classes\DefinedVaribles;
use mysqli;

class Database implements DefinedVaribles {

    private static $instance = null;
    private $link;

    private  $host       = DefinedVaribles::DB_DATA['host'];
    private  $user       = DefinedVaribles::DB_DATA['user'];
    private  $pwd        = DefinedVaribles::DB_DATA['pwd'];
    private  $db_name    = DefinedVaribles::DB_DATA['db_name'];

    

    private function __construct()
    {
        $this->link = new mysqli($this->host, $this->user, $this->pwd, $this->db_name);

    }
    public static function getInstance()
    {
        echo "I am GETTING THE INSTANCE OF THIS SINGLETON FOR DB!!";

        if (!self::$instance) {

            self::$instance = new Database();
        }
        return self::$instance;

    }

    public function getConnection() {
        echo "  I am connecting to the DB ------>>>>";
        return $this->link;
    }
}

