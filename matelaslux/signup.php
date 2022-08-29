<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title>
</head>
<body>
<!-- NAVEBARRE -->
<?php require_once'php/nav.php';?>
 <form method="POST">
    Nombre <input type="text" name="name" required> <br>
    Edad <input type="text" name="edad" required><br>
    Email <input type="email" name="email" required><br>
    Contrasena <input type="password" name="password"required><br>
    <button type="submit" name="signup">Signup</button>
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

//CLICK BUTTON SIGNUP 
    if(isset($_POST['signup'])){
// IF EMAIL REGISTRED
    $checkEmail = $database->prepare("SELECT NAME,EDAD,EMAIL,PASSWORD,DATE,SECURITY_CODE,ACTIVATED,ROLE FROM users WHERE EMAIL = :email");
    $email = $_POST['email'];
    $checkEmail->bindParam("email",$email);
    $checkEmail->execute();
    if ($checkEmail->execute()) {
    }else {
        echo'Coneccion DB Falla';
    }
// CHECK EMAIL EN DATABASE
    if ($checkEmail->rowCount()>0) {
        echo'Tu correo electronico ya existe¡';
    }else {
// READ INPUTS TO VARIABLES
        $name =$_POST['name'] ;
        $edad = $_POST['edad'];
        $email = $_POST['email'];
        $password = sha1($_POST['password']);
// CALL DATABASE
// SQL DATABASE CONNECT  
        $addUser = $database->prepare("INSERT INTO users (NAME,EDAD,EMAIL,PASSWORD,DATE,SECURITY_CODE,ROLE) 
        VALUES(:NAME,:EDAD,:EMAIL,:PASSWORD,:DATE,:SECURITY_CODE,'USER');");
// BIND PARAM  SETTING
        $addUser->bindParam("NAME",$name);
        $addUser->bindParam("EDAD",$edad);
        $addUser->bindParam("EMAIL",$email);
        $addUser->bindParam("PASSWORD",$password);
//BINDPARAM DATE
        $userdate = date("Y-m-d");
        $addUser->bindParam("DATE",$userdate);
//BINDPARAM SECURITY CODE
        $securityCode = md5(date("h:i:s"));
        $addUser->bindParam("SECURITY_CODE",$securityCode);

        if($addUser->execute()){
// PROTOCOL OF MAIL MAILER
            require_once "mail.php";
            $mail->addAddress($email);
            $mail->Subject = "ELBOSS INMOBILIARIA - NUEVA CUENTA REGISTRADA";
            // **
            $mail->Body = '
            Cuenta creada, Verifica tu buzon para confirmar 
            <a href="http://localhost/elbossinmobiliaria/active.php?code='.$securityCode.'"> <b style="color: red;">Click Enlace</b></a>, O pegar esta enlace: 
            <a href="http://localhost/elbossinmobiliaria/active.php?code='.$securityCode.'"> <b style="color: red;">http://localhost/elbossinmobiliaria/active.php?code='.$securityCode.'</b></a>    
                Muchas Gracias'.$name.'
            ';
            $mail->setFrom("NoRaply@elbossinmobiliaria.es", "ELBOSS INMOBILIARIA");
            $mail->send();
            echo 'Ha Creado  una cuenta Nueva, Verifica tu buzon porfavor';
        }else {
            echo'No puede registrar tu cuenta¡';
        }
    }


    }
  

  
  ?>
 
 </form>   
</body>
</html>