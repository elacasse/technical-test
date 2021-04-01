<?php

namespace Models;

use mysqli;

class BaseModel
{
    protected function connect()
    {
        global $config;

        // Create connection
        $conn = new mysqli($config['db']['servername'], $config['db']['username'], $config['db']['password'], $config['db']['dbName']);

        // Check connection
        if ($conn->connect_error) {
            return false;
        }

        return $conn;
    }
}