<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
<!-- NAVEBARRE -->
<?php require_once'php/nav.php';?>

    <form method="POST">
        Introduce tu correo electronico y tu contrasena: <br>
        Email:<input type="email" name="email" required>
        Contasenea: <input type="password" name="password" id="" required>
        <button type="submit" name="signin">Acceder</button> <br>
        <a href="reset.php">Restablecimiento de contraseña</a>
        
    </form>

<?php
/////////////////////////////////// DATABASE CONNECT////////////////////////////////////
    // **
    // $hostname = 'localhost';
    // $database = 'elbossinmobiliaria';
    // $username = 'root';
    // $password = '';
    // $database = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8",$username,$password);
    // **
    $hostname = 'db5006942057.hosting-data.io';
    $database = 'dbs5731927';
    $username = 'dbu207866';
    $password = 'NFsUi2da@p#J6yL';
    $database = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8",$username,$password);


//SELECT DATA FROM DATA BASE
if (isset($_POST['signin'])) {
    $signIn = $database->prepare("SELECT * FROM users WHERE EMAIL = :email AND PASSWORD = :password");
    
    $signIn->bindParam("email",$_POST['email']);
// CRIPTTING DATABASE
    $password = sha1($_POST['password']);
    $signIn->bindParam("password",$password);
// EXECUTAR SQL
    $signIn->execute();
//SIGNIN ROWWCOUNT =1
    if($signIn->rowCount()===1){
// MAKE DATA TO OBJECTS
        $user = $signIn->fetchObject();
// IF ACCOUNT ACTIVE
        if($user->ACTIVATED === "1"){
            
            session_start();
            echo 'Hola ' .$user->NAME;
            $_SESSION['user'] = $user;
            
                if($user->ROLE ==="USER"){
                    // **
                    header("location:user/index.php",true);
                    echo' USER';
                }else if($user->ROLE ==="ADMIN"){
                    // **
                    header("location:admin/index.php",true);
                    echo' ADMIN';
                }



            }else{
                echo 'Cuenta no Activada¡ Verifica tu buzon de '.$user->EMAIL.'';
            }


    }else {
        echo'Contasena no es correcta¡';
    }


}else {

}






?> 
    </body>
</html>