<?php

class dbconfig{
  private $host = 'localhost';
      private $database = 'spotDB';   
      private $user = 'root';   
      private $pass = 'SpotDB^6';
    public $conn;

    public function __construct()
    {
        $this -> conn = new PDO("mysql:host=".$this -> host."; dbname=".$this -> database, $this -> user, $this -> pass);
    }

    public function executeQueryGetData($sql)
    {
        $query = $this ->conn ->prepare($sql);
        $query -> execute();
        $data = $query -> fetchObject();
        if ($data) {
            $result = $data;
            return $result;
        } else {
            return false;
        }
    }
    public function executeQuery($sql)
    {
        $query = $this ->conn ->prepare($sql);
        if ($query -> execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function executeQueryParam($sql, $param)
    {


        $query = $this ->conn ->prepare($sql);

        $query -> execute($param);
//        $data = $query -> fetchObject();
//        if ($data) {
//            $result = $data;
//            return $result;
//        } else {
//            return false;
//        }
    }



}
?>