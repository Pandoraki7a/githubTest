<?php
session_start();
if(isset($_POST['ckbox'])){
    setcookie('userid',$_POST['uid'], time() + 10);
    setcookie('password',$_POST['upass'], time() + 10);    
}
if(isset($_COOKIE['userid']) && isset($_COOKIE['password'])){
    $cookie_uid = $_COOKIE['userid'];
    $cookie_upass = $_COOKIE['password'];
    
}
else{
    $cookie_uid = $cookie_upass = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styleFile/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
</head>
<body>

<div class="con">
    <img src="pics/poster.jpg" class="pic-con1">
    
        <div class="title">Barangay Management Information System</div>
        <div class="con">
    <?php if(isset($_GET['error'])){?>
        <div class="alert alert-danger error">
  <strong><?php echo $_GET['error'];?></strong>
        </div>
       <?php } ?>
        <div class="login-con">
            <div class="pic-con"><img src="pics/Poster - Barangay Hall - Central.jpg"></div>
            <form action="process.php" method="post">
                <div class="input1">
                    <label>User id</label><br>
            <input type="text" placeholder="20-00307" class="lbl1" name="uid" value="<?php echo $cookie_uid; ?>"><br>
                </div>
               <div class="input2">
                <label>Password</label><br>
            <input type="password" placeholder="******"  class="lbl1" name="upass" value="<?php echo $cookie_upass; ?>"><br>
                <div class="rbm">
                    <input type="checkbox" class="cb" name="ckbox" checked="checked">
                    <label class="rm">Remember me</label>
                </div>
             
                <button type="submit" name="login">Log in</a></button>
               </div>
                
            </form>
        </div>


    


</div>



</body>
</html>