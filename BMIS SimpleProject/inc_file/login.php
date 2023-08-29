<?php
session_start();
class LoginAdmin extends Dbc{
    private $uid;
    private $upass;
    public $result;

    public function __construct($uid, $upass)
    {
        $this->uid = $uid;
        $this->upass = $upass;
    }

    public function loginformAdmin(){

        if($this->validateInput() == true){
            header("location: index.php?error=inputs are required, please try agian!");
            exit();
        }
        if($this->loginAdminfunc() == true){
            header("location: index.php?error=Invalid credentials, please try agaian!");
            exit();
        }
    }

    private function validateInput(){
        if(empty($this->uid) || empty($this->upass)){
           $this->result = true;
        }
        else{
            $this->result = false;
        }
        return $this->result;
    }
    private function loginAdminfunc(){
        $conn = $this->connection();
        $sql = " SELECT * FROM bmis_admin WHERE userid = '$this->uid' AND userpass = '$this->upass'";
        $result = $conn->query($sql) or die($conn->connect_error);
        $row = $result->fetch_assoc();

        if($this->uid == $row['userid'] && $this->upass == $row['userpass']){
            $_SESSION['userid'] = $row['userid'];
            $_SESSION['userpass'] = $row['userpass'];
            $this->result = false;
            header("location: dashboard.php?msg=you are logged in!");
            exit();
        }
        elseif($this->uid != $row['userid'] && $this->upass != $row['userpass']){
            $this->result = true;
            
        }
        return $this->result;
    
    }

   
}


