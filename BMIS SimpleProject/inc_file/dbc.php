<?php

class Dbc{
    private $servername;
    private $username;
    private $password;
    private $db_name;

    protected function connection(){
         $this->servername = "localhost";
         $this->username = "root";
         $this->password = "12345";
         $this->db_name = "bmis_db";

        $conn = new mysqli($this->servername,$this->username,$this->password,$this->db_name);
        
        if($conn->connect_error){
            header("location: form.php?error=Connection failed!");
            exit();
        }
        else{
            return $conn;
        }

}
}
?>