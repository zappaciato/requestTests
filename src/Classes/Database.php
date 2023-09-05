<?php

namespace Kris\TestProject\Classes;

use Kris\TestProject\Classes\DefinedVaribles;
use mysqli;

class Database implements DefinedVaribles {

    private $user;
    private $host;
    private $pwd;
    private $db_name;

    

    public function __construct($host, $user, $pwd, $db_name)
    {
        // $this->user = "root";
        // $this->host = "localhost";
        // $this->pwd = "";
        // $this->db_name = "Kris_db";

        $this->user = $user;
        $this->host = $host;
        $this->pwd = $pwd;
        $this->db_name = $db_name;
    }
    public function connect()
    {
        echo "I am CONNECTING TO THE DB!!";
        // $link = mysqli_connect($this->host, $this->user, $this->pwd, $this->db_name);
        $link = new mysqli($this->host, $this->user, $this->pwd, $this->db_name);

        if (!$link) {

            die("Connection failed: " . mysqli_connect_error());
        }
        echo "Connected successfully";
        // mysqli_close($link);
        print_r($link);
        return $link;
    }
}

