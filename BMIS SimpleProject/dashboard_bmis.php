<?php
require_once 'inc_file/dbc.php';

class dashboardbmis 
extends Dbc{
    private $fname;
    private $mname;
    private $lname;
    private $b_date;
    private $role;
    private $age;
    private $file;
    private $t_started;
    private $t_ended;
    private $destination;
    public $fileType = ['image/gif', 'image/png', 'image/jpeg', 'image/jpg'];
    public $result;

    public function __construct($file, $fname, $mname, $lname, $role, $age, $t_started, $t_ended, $b_date)
   
    {
        $this->file = $this->validateInputData($file);
        $this->fname = $this->validateInputData($fname);
        $this->mname = $this->validateInputData($mname);
        $this->lname =  $this->validateInputData($lname);
        $this->role =  $this->validateInputData($role);
        $this->age = $age;
        $this->t_started = $t_started;
        $this->t_ended = $t_ended;
        $this->b_date = $b_date;
    }

    


    public function addmemberFunc(){

        if($this->uploadToImg() == false) {
            header("location: brgyofficials.php");
            exit();
           }
        if($this->emptyInput() == false) {
            header("location: brgyofficials.php?error=fields are required!");
            exit();
           }

       if($this->regExValidate() == true ) {
        header("location: brgyofficials.php?error=invalid of type character!");
        exit();
       }
       
        if($this->checkUser() == false) {
            header("location: brgyofficials.php?error=identity already existed!");
            exit();
        }

        

    }

    public function validateInputData($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    private function uploadToImg(){
        $this->file = $_FILES['photo']['name']; 
        $this->destination = __DIR__ . "/uploads/" . $this->file;

        if(empty($this->file)){
            header("location: brgyofficials.php?msg=no file is selected");
            exit();
            $this->result = false;
        }

        elseif(!in_array($_FILES['photo']['type'], $this->fileType)){
            header("location: brgyofficials.php?msg=invalid file type!");
            exit();
            $this->result = false;
        }

        elseif(!move_uploaded_file($_FILES['photo']['tmp_name'], $this->destination)){
            header("location: brgyofficials.php?msg=not uploaded in the folder!");
            exit();
            $this->result = false;
        }
       
        else{
            $this->result = true;
            }
        return $this->result;

    }

    private function emptyInput(){

        if(empty($this->fname) || empty($this->mname) || empty($this->lname) || empty($this->role || empty($this->b_date))
        ||empty($this->t_started) || empty($this->t_ended) || empty($this->age)){

            $this->result = false;
            header("location: brgyofficials.php?msg=fields are required!");
            exit();
            
        }
        else{
            return $this->result = true;
        }
    }

    private function regExValidate(){
        $pattern = "/[^a-zA-Z-\s]/";
        $names = array($this->fname.$this->mname.$this->lname.$this->role);

        foreach($names as $values){
            if(!preg_match($pattern, $values)) {
                $this->result = false;
                
            } 
            else{
                $this->result = true;
            }
        } 
        return $this->result;
        
    }

    private function checkUser(){
        $conn = $this->connection();

        $query = mysqli_query($conn, "SELECT * FROM official_members WHERE first_name = '$this->fname' AND
        middle_name = '$this->mname' AND last_name = '$this->lname' OR role = '$this->role'");
        if(mysqli_num_rows($query) > 0){
            $this->result = false;
         
        }
        else{
            $this->result = true;
            $sql = "INSERT INTO official_members (profile_pic, first_name, middle_name, last_name, role, age, term_started, term_ended, birth_date)
            VALUES ('$this->file','$this->fname','$this->mname','$this->lname', '$this->role', '$this->age', '$this->t_started', '$this->t_ended', '$this->b_date')";
            
             if($conn->query($sql) == true){
                header("location: brgyofficials.php?error=successfully added NEW RECORD");
                exit();
             }
             else{
                return $conn->error;
             }
        }
        return $this->result;
    }

}