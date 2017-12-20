<?php

class Database extends PDO {

    public function __construct($file = 'connection.ini') {

        $conn = $settings['database']['driver'] . ':host=' . $settings['database']['host'] . ';dbname=' . $settings['database']['schema'];
        parent::__construct($conn, $settings['database']['username'], $settings['database']['password']);
    }
}