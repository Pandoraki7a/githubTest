<?php
session_start();
if(!isset($_SESSION['userid'])){
    header("location: index.php?error=Empty credentials!");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styleFile/dashboard.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    
    <div class="con">
        <header>
            <div class="left-set">
                <button><span class="material-symbols-outlined" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions">
                    settings
                    </span></button>
                <h2>Dashboard</h2>
            </div>
             <!-- logout -->
            <form action="process.php"method="get">
            <div class="right-set">
    <button name="logout" style="background: none; border:none; color:#fff; font-family: 'Poppins';">Log out</button>
            </div>
            </form>
           
        </header>
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
                        </span><a href="brgyresident.css">Resident</a></li>
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
                    <p>Reports</p>
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

<!-- content -->

        <div class="bi-con">
            <div class="row-1">
                <div class="bi">
                    <p><span class="material-symbols-outlined">
                        info
                    </span>Barangay Information</p>
         
                    <div class="mi-con">
                        <a href="dashboard.html">more info</a>
                        <a href="dashboard.html">
                            <h6 class="material-symbols-outlined">
                                trending_flat
                                </h6>
                        </a>
                    </div>
                   
                    <h5></h5>
                </div>
                <div class="bo">
                    <p><span class="material-symbols-outlined">
                        groups_2
                    </span>Barangay Officials</p>
                    <?php 
                     $con = new mysqli("localhost","root","12345","bmis_db");

                    $sql = "SELECT id FROM official_members ORDER BY id";
                    $result = $con->query($sql);
                    $rows = mysqli_num_rows($result);
                    
                    echo '<h5>'.$rows.'</h5>'
                    ?>
                    <!-- <h5>10</h5> -->
                    <div class="mi-con">
                        <a href="brgyofficials.php">more info</a>
                        <a href="brgyofficials.php">
                            <h6 class="material-symbols-outlined">
                                trending_flat
                                </h6>
                        </a>
                    </div>
                </div>
                <div class="res">
                    <p><span class="material-symbols-outlined">
                        family_restroom
                    </span>Resident</p>
                    <h5>60</h5>
                    <div class="mi-con">
                        <a href="brgyresidnt.html">more info</a>
                        <a href="brgyresident.css">
                            <h6 class="material-symbols-outlined">
                                trending_flat
                                </h6>
                        </a>
                    </div>
                </div>
                <div class="blot">
                    <p><span class="material-symbols-outlined">
                        person_pin
                    </span>Blotter</p>
                    <h5>6</h5>
                    <div class="mi-con">
                        <a href="brgyblotter.html">more info</a>
                        <a href="brgyblotter.html">
                            <h6 class="material-symbols-outlined">
                                trending_flat
                                </h6>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row-2">
                <div class="files">
                    <p><span class="material-symbols-outlined">
                        folder_open
                    </span>Files</p>
                    <h5>8</h5>
                    <div class="mi-con">
                        <a href="#">more info</a>
                        <h6 class="material-symbols-outlined">
                            trending_flat
                            </h6>
                    </div>
                </div>
                <div class="certi">
                    <p><span class="material-symbols-outlined">
                        card_membership
                    </span>Certificates</p>
                    <h5>8</h5>
                    <div class="mi-con">
                        <a href="#">more info</a>
                        <h6 class="material-symbols-outlined">
                            trending_flat
                            </h6>
                    </div>
                </div>
                <div class="reports">
                    <p><span class="material-symbols-outlined">
                        lab_profile
                    </span>Reports</p>
                    <h5>8</h5>
                    <div class="mi-con">
                        <a href="#">more info</a>
                        <h6 class="material-symbols-outlined">
                            trending_flat
                            </h6>
                    </div>
                </div>
                <div class="rr">
                    <p><span class="material-symbols-outlined">
                        summarize
                    </span>Released Reports</p>
                    <h5>8</h5>
                    <div class="mi-con">
                        <a href="#">more info</a>
                        <h6 class="material-symbols-outlined">
                            trending_flat
                            </h6>
                    </div>
                </div>
            </div>





        </div>


    </div>




<script>
    const offcanvasElementList = document.querySelectorAll('.offcanvas')
const offcanvasList = [...offcanvasElementList].map(offcanvasEl => new bootstrap.Offcanvas(offcanvasEl))



</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>