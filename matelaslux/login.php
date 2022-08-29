<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal de MATELASLUX</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet" />

</head>
<body style="margin: auto; max-width: 70%; text-align: left;">
  <!-- NaveBarre  -->
<?php 
require_once'php/nav.php';
?>

<div>
    <form method="POST">
    Email
    <input class="form-control" type="email" name="email" required/>
    Mot de passe
    <input class="form-control" type="password" name="password" required/>
    <a href="reset.php"> Mot de passe oublié? </a><br>
    <a class="btn btn-outline-dark mt-3" type="submit" href="register.php">Signup </a>
    <button class="btn btn-warning mt-3" type="submit" name="login">Login</button> 
    </form>

</div>
    <?php
if(isset($_POST['login'])){
    // CONNECT DATABASE
    //  $hostname = 'localhost';
    // 	$database = 'matelaslux';
    // 	$username = 'root';
    // 	$password = '';
    //  $database = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8",$username,$password);
    // DATABASE ALACANTE   
    $hostname = 'db5006915566.hosting-data.io';
    $database = 'dbs5709499';
    $username = 'dbu2525309';
    $password = 'NFsUi2da@p#J6yL';
    $database = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8",$username,$password);



//SELECT DATA FROM DATA BASE
    $login = $database->prepare("SELECT * FROM users WHERE EMAIL = :email AND PASSWORD = :password");
    $login->bindParam("email",$_POST['email']);
// CRIPTING PASSWORD
    $passwordUser = sha1($_POST['password']); 
    $login->bindParam("password",$passwordUser);
// EXECUTAR SQL
    $login->execute();

    if($login->rowCount()===1){
    $user = $login->fetchObject();
    if($user->ACTIVATED === "1"){
    // star  session 
    session_start();
$_SESSION['user'] = $user;
$_SESSION['email'] = $user->EMAIL;
$_SESSION['password'] = $user->PASSWORD;
$_SESSION['name'] = $user->NAME;
$_SESSION['user'] = $user;

if($user->ROLE ==="USER"){
    header("location:http://alacante.es/user/index.php",true);
    echo'UTILISATEUR';
}else if($user->ROLE ==="ADMIN"){
    header("location:http://alacante.es/admin/index.php",true);
    echo'ADMINISTRATEUR';
}else{
    echo'<div class="alert alert-warning mt-3" role="alert">
    autorisation daccès manquante¡¡
  </div>';
}


}else{
    echo '
    <div class="alert alert-warning"> 
    Veuillez dabord activer votre compte, nous vous avons envoyé
    Code de vérification de votre compte à votre adresse e-mail
    </div>
    ';
}
}else{
 echo '
 <div class="alert alert-danger">
 Mot de passe ou email incorrect
 </div>
 ';   
}
}
?> 
</body>
</html>










