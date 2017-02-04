<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DBConfig {

    private $dbHost = '';
    private $dbUsername = '';
    private $dbPassword = '';
    private $dbName = '';
    private $security_dbName = '';
    private $security_dbHost = '';
    private $security_dbUsername = '';
    private $security_dbPassword = '';

    public function __construct() {
        $this->dbHost = 'localhost';
        $this->dbUsername = 'chalkuch_vinyasa';
        $this->dbPassword = 'vinyasa@123';
        $this->dbName = 'chalkuch_vinyasa';
        $this->security_dbName = 'chalkuch_vin_sec_sessions';
        $this->security_dbHost = 'localhost';
        $this->security_dbUsername='chalkuch_vinyasa';
        $this->security_dbPassword='vinyasa@123';
        
    }

    public function getMysqliConnection() {
        //Connect with the database
        $db = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
        /* check connection */
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        return $db;
    }

    public function getPDOConnection() {
        try{$db = new PDO('mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName, $this->dbUsername, $this->dbPassword);
        }
        catch (PDOException $e) {
            printf("Connect failed: %s\n", $e->getMessage());
            exit();
        }
        return $db;
    }

    public function getSecurityMysqliConnection() {
        //Connect with the database
        $db = new mysqli($this->security_dbHost, $this->security_dbUsername, $this->security_dbPassword, $this->security_dbName);
        /* check connection */
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        return $db;
    }

}

class DBConfigFactory{
    public static function getDBConfig(){
        return new DBConfig();
    }
}

?>
