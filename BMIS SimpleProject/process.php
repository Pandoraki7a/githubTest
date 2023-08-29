<?php
session_start();
if(isset($_POST['login'])){

    $uid = $_POST['uid'];
    $upass = $_POST['upass'];
  
   
    // Instantiate class-inc.php
    include 'inc_file/dbc.php';
    include 'inc_file/login.php';

  

    $login = new LoginAdmin($uid, $upass);
    $login->loginformAdmin();   
}

if(isset($_POST['addOffBtn'])){

    $file = $_POST['photo'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $role = $_POST['role'];
    $age = $_POST['age'];
    $b_date = $_POST['birth_date'];
    $t_started = $_POST['term_started'];
    $t_ended = $_POST['term_ended'];

   
    include 'inc_file/dbc.php';
    include 'dashboard_bmis.php';

    $addoffmember = new dashboardbmis($file, $fname, $mname, $lname, $role, $age, $t_started, $t_ended, $b_date);
    $addoffmember->addmemberFunc();

    
    // header("location: brgyofficials.php");
}

if(isset($_GET['logout'])){
    if(isset($_GET['logout'])){
        session_unset();
        session_destroy();
        header("location: index.php?msg=you are logged out!");
    }
}

if(isset($_POST['user_id'])){
    $conn = new mysqli("localhost", "root", "12345", "bmis_db");

    $sql = "SELECT * FROM official_members WHERE id ='".$_POST["user_id"]."'";
    $result = $conn->query($sql) or die($conn->error);

    $output .= '
    <div class="table">
        <table class="table table-bordered">';

        
                while($row = $result->fetch_assoc()){
                    $output .= '
                        <tr>
                            
                        <img src="uploads/'.$row['profile_pic'].'" style="width:150px; border-radius: 10px; display: block; margin: auto; margin-bottom: 20px">
                            
                        </tr>
                        <tr>
                        <td width="30%"><label>Firstname</label></td>
                            <td width="70%">'.$row['first_name'].'</td>
                        </tr>
                        <td width="30%"><label>Middlename</label></td>
                            <td width="70%">'.$row['middle_name'].'</td>
                        </tr>
                        <td width="30%"><label>Lastname</label></td>
                            <td width="70%">'.$row['last_name'].'</td>
                        </tr>
                        <td width="30%"><label>Role</label></td>
                            <td width="70%">'.$row['role'].'</td>
                        </tr>
                    ';
                }
    $output .= "</table></div>";
    echo $output;
}

