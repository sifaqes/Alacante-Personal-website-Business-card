<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Activation compte matelaslux</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

  </head>
  <body style="margin: auto; max-width: 70%; text-align: left;">
<?php
require_once'php/nav.php';
?>
  </body>
</html>


<?php

if(isset($_GET['code'])){

// SQL DATABASE CONNECT  
    // DATABASE LOCALHOST 
    // $hostname = 'localhost';
    // $database = 'matelaslux';
    // $username = 'root';
    // $password = '';
    // $database = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8",$username,$password);
    // DATABASE ALACANTE   
    $hostname = 'db5006915566.hosting-data.io';
    $database = 'dbs5709499';
    $username = 'dbu2525309';
    $password = 'NFsUi2da@p#J6yL';
    $database = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8",$username,$password);

$checkCode = $database->prepare("SELECT SECURITY_CODE FROM users WHERE SECURITY_CODE = :SECURITY_CODE");
$checkCode->bindParam("SECURITY_CODE",$_GET['code']);
$checkCode->execute();
if($checkCode->rowCount()>0){
   
$update = $database->prepare("UPDATE users SET SECURITY_CODE = :NEWSECURITY_CODE ,
 ACTIVATED=true WHERE SECURITY_CODE = :SECURITY_CODE");
  $securityCode = md5(date("h:i:s"));
$update->bindParam("NEWSECURITY_CODE",$securityCode);
$update->bindParam("SECURITY_CODE",$_GET['code']);


if($update->execute()){
    echo '<div class="alert alert-success" role="alert">
  تم تحقق من حسابك بنجاح
  </div>';
  echo '<a class="btn btn-warning" href="login.php">تسجيل دخول</a>';
}
}else{
    echo '<div class="alert alert-danger" role="alert">
    هذا كود لم يعد صالحا للأستخدام
  </div>';
}

}
?>