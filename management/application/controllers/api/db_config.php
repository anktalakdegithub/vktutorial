<?php

class DBconfig{

    // private $host = 'myeventbooking.in';
    // private $database = 'a1647nhw_events';
    // private $user = 'a1647nhw_events';
    // private $pass = '147852369';
    // public $conn;
    private $host = 'localhost';
      private $database = 'spotDB';   
      private $user = 'root';   
      private $pass = 'SpotDB^6';
    public $conn;

    public function __construct()
    {
        $this -> conn = new PDO("mysql:host=".$this -> host."; dbname=".$this -> database, $this -> user, $this -> pass);
        $this -> conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

}
?>