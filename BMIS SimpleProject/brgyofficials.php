<?php
session_start();
require_once 'inc_file/dbc.php';
$nca='';
if(!isset($_SESSION['userid'])){
    header("location: index.php?error=Empty credentials!");
}
function connection(){
  $servername = "localhost";
  $username = "root";
  $password = "12345";
  $Db_name = "bmis_db";

  $conn = new mysqli($servername, $username, $password, $Db_name);

  if($conn->connect_error){
    echo "Connection failed!: ".$conn->connect_error;
  }
  else{
    return $conn;
  }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styleFile/dashboard.css">
    <link rel="stylesheet" href="styleFile/brgyoff.css">
    <script src="jqueryscript.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  </head>
<body>
    <style>
      input[type="file"]{
        display: none;
      }
       #lblPic{
        background-color: #4c68ce;
        padding: 5px;
        color: #fff;
       }
    </style>
    <div class="con2">
        <header>
            <div class="left-set">
                <button><span class="material-symbols-outlined" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions">
                    settings
                    </span></button>
                <h2>Barangay Officials</h2>
            </div>
             <!-- logout -->
            <form action="process.php"method="get">
            <div class="right-set">
            <button name="logout" style="background: none; border:none; color:#fff; font-family: 'Poppins';">Log out</button>
            </div>
            </form>
          
            
        </header>
        <button class="add-member"  data-bs-toggle="modal" data-bs-target="#addOffMember">Add member</button>

        

        <!-- offcanvas -->
        <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
          <div class="offcanvas-header">
            <img src="pics/logo.png">
            <p>Barangay, LPC</p>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <div class="dashboard-con">
               
                <ul class="dashboard-ul">
                    <p>Dashboard</p>
                    <li><span class="material-symbols-outlined">
                        info
                        </span><a href="dashboard.html">Barangay Information</a></li>
                    <li><span class="material-symbols-outlined">
                        groups_2
                        </span><a href="brgyofficials.html">Barangay Officials</a></li>
                    <li><span class="material-symbols-outlined">
                        family_restroom
                        </span><a href="brgyresidnt.html">Resident</a></li>
                    <li><span class="material-symbols-outlined">
                        person_pin
                        </span><a href="brgyblotter.html">Blotter</a></li>
                </ul>
                <ul class="forms-ul">
                    <p>Forms</p>
                    <li><span class="material-symbols-outlined">
                        folder_open
                        </span><a href="#">Files</a></li>
                    <li><span class="material-symbols-outlined">
                       card_membership
                        </span><a href="#">Certificates</a></li>
                    
                </ul>
                <ul class="report-ul">
                    <p>Report</p>
                    <li><span class="material-symbols-outlined">
                        lab_profile
                        </span><a href="#">Reports</a></li>
                    <li><span class="material-symbols-outlined">
                       summarize
                        </span><a href="#">Released Reports</a></li>
                    
                </ul>
            </div>

          </div>
        </div>

 
  <!-- Modal -->
  <div class="modal fade" id="addOffMember" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Official Member</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <?php if(isset($_GET['error'])){?>
            <p class="error"><?php echo $_GET['error'];?></p>
       <?php } ?>
       <form action="process.php" method="post" enctype="multipart/form-data">
        <input type="file" id="file" name="photo">
        <label for="file" id="lblPic">Choose Photo</label><br>
        <input type="text" placeholder="firstname" name="fname"><br>
        <input type="text" placeholder="middlename" name="mname"><br>
        <input type="text" placeholder="lastname" name="lname"><br>
        <input type="text" placeholder="role" name="role"><br>
        <input type="number" placeholder="age" name="age"><br>
            <label>Birthdate: </label>
            <input type="date" name="birth_date"><br>
            <label>Term started: </label>
            <input type="date" name="term_started"><br>
            <label>End of term: </label>
            <input type="date" name="term_ended">
        
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success" name="addOffBtn">Add</button>
      </div>
      </form>
      </div>
      
    </div>
  </div>
</div> 


                 <!-- content -->

        <div class="brgyoff-con">
        <?php
      $sql = "SELECT * FROM official_members";
      $result = connection()->query($sql) or die(connection()->error);
      $row = $result->fetch_assoc();
     ?>
     <?php 
     if($row > 0){
      do{?>
   <div class="card" id="c">
   <?php echo $output = "<img src='uploads/".$row['profile_pic']."' style='width:150px; height:150px; border-radius: 50%; margin: auto;' >";?><br>
    <div class="card-body">
        <h5 id="card-title"><?php echo $row['last_name'].' '.$row['first_name'];?></h5>
        <p class="card-text"><?php echo $row['role']; ?></p>
            <div class="btn-con">

   <button style="background: none; border: none;" class="btn-upda" id="<?php echo $row['id']; ?>"data-bs-toggle="modal" data-bs-target="#updateInfo">
    <span class="material-symbols-outlined" id="edit"> edit_square</span>
    </button>
    <button  style="background: none; border: none;" class="btn-view" id="<?php echo $row['id']; ?>" data-bs-toggle="modal" data-bs-target="#viewInfo">
    <span class="material-symbols-outlined" id="view"> visibility </span>
    </button>
    <button style="background: none; border: none;" class="btn-view" id="<?php echo $row['id']; ?>" data-bs-toggle="modal" data-bs-target="#deleteInfo">
    <span class="material-symbols-outlined" id="delete">delete</span>
    </button>

    </div>
    </div>
    </div>
     <?php }while($row = $result->fetch_assoc())?>
      <?php }
      else{
        echo $nca .= '<h2 style="color: #4c68ce;; background-color: #cdcdcd; font-family: Poppins;
       text-align: center; margin-top: 50px; word-spacing: 10px; height: 300px; width: 500px; padding-top: 130px;
       border-radius: 10px; box-shadow: 1px 1px 10px black;">
        No Content Available</h2>';
      }?>
      

  <div class="modal fade" id="updateInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" id="update-con" style="height: 31rem;">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Update Information</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="modal-body">
          <form action="process.php" method="post" id="updatememberInput"enctype="multipart/form-data">
        <input type="file" class="" name="photo">
        <input type="text" placeholder="firstname" name="fname"><br>
        <input type="text" placeholder="middlename" name="mname"><br>
        <input type="text" placeholder="lastname" name="lname"><br>
        <input type="text" placeholder="role" name="role"><br>
        <input type="number" placeholder="age" name="age"><br>
            <label>Birthdate: </label>
            <input type="date" name="birth_date"><br>
            <label>Term started: </label>
            <input type="date" name="term_started"><br>
            <label>End of term: </label>
            <input type="date" name="term_ended">
        
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success" name="updOffBtn">Save</button>
      </div>
      </form>
        </div>
      </div>
    </div>
  </div>
 <div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Viewing Information</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body-view">
        Modal body..
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Close</button>
      </div>

    </div>
  </div>
</div>

  <div class="modal fade" id="deleteInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" id="del-con">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure?</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Paglinawan Elton John</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
          <button type="button" class="btn btn-primary">Yes</button>
        </div>
      </div>
    </div>
  </div>





        </div>

       


        </div>


    </div>




<script>
    const offcanvasElementList = document.querySelectorAll('.offcanvas')
const offcanvasList = [...offcanvasElementList].map(offcanvasEl => new bootstrap.Offcanvas(offcanvasEl))

$(document).ready(function(){

$(".btn-view").click(function(){
 uid = $(this).attr('id')
$.ajax({
  url: "process.php",
  method: "post",
  data: {user_id: uid},
  success: function(response){
    $('.modal-body-view').html(response);
    $('#myModal').modal('show');
  }
});
});


$(".btn-del").click(function(){
  uid = $(this).attr('id')
  $("#del-id").val(uid)
  $("#myModalDel").modal("show");
});




});


</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>