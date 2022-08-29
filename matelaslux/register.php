<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Matelaslux Matelas y couettes y oreillers en Algerie</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Gistion de Stock Matelaslx Matelas Orthopediques">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keyword" content="restaurante,restaurantes,mejor restaurante,opiniones restaurantes,musica para restaurante elegante,restaurante caro,ibai restaurante,peor restaurante,restaurante nuevo,restaurante burak,musica restaurante,restaurante de lujo,restaurante nos eua,top restaurantes,abrir um restaurante,restaurante turquia,el mejor restaurante,gaba restaurantes,tips restaurantes,dica para restaurante,restaurante italiano,música de restaurante,musica de restaurante food,street food,food insider,food ranger,food wars,the food ranger,food videos,street food videos,fast food,foodie,food vlog,best ever food review show,food hacks,malay food,indian food,food network,cooking food,chinese food,village food,vs food,malaysian food,street food vlog,best street food,uae food,nyc food,fbe food,indian street food,food ranger turkey,vice food,thai food,7-11 food,food porn,jamaican street food">
    <meta name="auteur" content="ZERROUKI SIFAQES +34658629772" />

<!-- Icon de main:apple windows android -->
    <link rel="icon" href="icon.png">
    <link rel="shortcut" href="icon.png">
    <link rel="apple-touche-icon" href="icon.png">

<!-- SEO TAG FACEBOOK -->
    <meta property="og:title" content="Restaurante Siphax Alicante">
    <meta property="og:description" content="Restaurante Alicante siphax Fast Food ">
    <meta property="og:image" content="logo.png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="720">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://restaurantealicantesiphax.com">
    <meta property="fb:app_id" content="xxxxxxxxxxxxxxxxxxxx">
<!-- bootstarp -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="estilos.css">
</head>

<body style="margin: auto; max-width: 70%; text-align: left;">
  <?php 
// <!-- NaveBarre  -->
        require_once'php/nav.php';
?>

    <div>
      <form method="POST" >
      Nom : <input class="form-control" type="text" name="name" required/>
      Date de naissance : <input class="form-control" type="date" name="age" required/>
      Email : <input class="form-control" type="email" name="email" required/>
      Password : <input class="form-control" type="password" name="password" required />
      <a href="reset.php"> Mot de passe oublié? </a><br>
      
      <a class="btn btn-outline-dark mt-3" href="login.php">Login</a>
      <button class="btn btn-warning mt-3" type="submit" name="register">Signup</button>
  
      </form>
    </div>




  </body>
</html>




<?php 
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



if(isset($_POST['register'])){
    $checkEmail = $database->prepare("SELECT * FROM users WHERE EMAIL = :EMAIL");
    $email = $_POST['email'];
    $checkEmail->bindParam("EMAIL",$email);
    $checkEmail->execute();

    if($checkEmail->rowCount()>0){
        echo '<div class="alert alert-danger" role="alert">
        Ce compte est déjà utilisé
      </div>';
    }else{
        $name =$_POST['name'] ;
        $password = sha1($_POST['password']);
        $email = $_POST['email'];
        $age = $_POST['age'];

        $addUser = $database->prepare("INSERT INTO 
        users(NAME,AGE,PASSWORD,EMAIL,SECURITY_CODE)
         VALUES(:NAME,:AGE,:PASSWORD,:EMAIL,:SECURITY_CODE)");

        $addUser->bindParam("NAME",$name);
        $addUser->bindParam("AGE",$age);
        $addUser->bindParam("PASSWORD",$password);
        $addUser->bindParam("EMAIL",$email);
        $securityCode = md5(date("h:i:s"));
        $addUser->bindParam("SECURITY_CODE",$securityCode);

        if($addUser->execute()){
            echo '<div class="alert alert-success" role="alert">
            Votre compte a été créé avec succès 
          </div>';

// PROTOCOL OF MAIL MAILER
          require_once "mail.php";
          $mail->addAddress($email);
          $mail->Subject = "MATELASLUX - Confermation de Nouveaux Compte";
          $mail->Body = '<h1> Merci &nbsp;'.$name.'&nbsp; pour votre inscription</h1>'."<div>Lien de verification est "."<div>". 
          "<a href='http://alacante.es/active.php?code=".$securityCode."'>
           "."http://alacante.es/active.php?code=".$securityCode."</a>";
          ;
          $mail->setFrom("contacto@elbossinmobiliaria.es", "Matelaslux");
          $mail->send();
        }else{
            echo '<div class="alert alert-danger" role="alert">
            Une erreur inattendue est apparue
          </div>';
        }
       
    }

}


?>