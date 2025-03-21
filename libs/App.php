<?php require "../config/config.php"; ?>

<?php 

class App {
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

   public function connect(){
    $this->link = new PDO("mysql:host=".$this->host.";dbname=".$this->dbName."", $this->user, $this->pass );

    if( $this->link ) {
        echo "db connectiion is working";
    }
   }
}

$obj = new App;



