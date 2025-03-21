<?php require "../config/config.php"; ?>

<?php

//crud function with database connectivity

class App
{
    public $host = HOST;
    public $dbName = DBNAME;
    public $user = USER;
    public $pass = PASS;

    public $link;


    //create a constructor 
    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        $this->link = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName . "", $this->user, $this->pass);

        if ($this->link) {
            echo "db connectiion is working";
        }
    }

    //select all 

    public function selectAll($query)
    {
        $rows = $this->link->query($query);
        $rows->execute();

        $allRows = $rows->fetchall(PDO::FETCH_OBJ);

        if ($allRows) {
            return $allRows;
        } else {
            return false;
        }
    }

    //select one row
    public function selectOne($query)
    {
        $row = $this->link->query($query);
        $row->execute();

        $singleRow = $row->fetch(PDO::FETCH_OBJ);

        if ($singleRow) {
            return $singleRow;
        } else {
            return false;
        }
    }
    

    //insert function 

    public function insert($query, $arr,$path) {
        if($this->validate($arr) == "empty") {
            echo "<script>alert('one or more input are empty')</script/>";
        } else {
            $insert_record = $this->link->prepare($query);
            $insert_record->execute($arr);

            header("locationL: ".$path."");
        }
    }

    //update

    public function update($query, $arr,$path) {
        if($this->validate($arr) == "empty") {
            echo "<script>alert('one or more input are empty')</script/>";
        } else {
            $update_record = $this->link->prepare($query);
            $update_record->execute($arr);

            header("locationL: ".$path."");
        }
    }

    // delete function
    public function delete($query,$path) {
       
            $update_record = $this->link->prepare($query);
            $update_record->execute();
            header("locationL: ".$path."");
        
    }


    public function validate($arr){
        if(in_array("",$arr)){
            echo "empty";
        }
    }
}

$obj = new App;
