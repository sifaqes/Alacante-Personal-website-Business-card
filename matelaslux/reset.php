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
<?php require_once 'php/nav.php' ?>  

<main class="contanier  m-auto " style="max-width:720px; margin-top:50px !important; text-align: center; ">

<?php 

if(!isset($_GET['code'])){
echo '<form method="POST">
<div class="p-3 shadow mb-3">Recuperer le Mot de Passe</div>
<input class="form-control" type="email" name="email"  required/>
<button class="btn btn-warning mt-3 w-100" type="submit" name="resetPassword" >
Envoyer un lien de réinitialisation de mot de passe à un e-mail
</button> 
</form > ';
}else if(isset($_GET['code']) && isset($_GET['email'])){
echo '<form method="POST">
<div class="p-3 shadow mb-3">
Mettre un nouveau mot de passe
</div>
<input class="form-control" type="text" name="password" required/>
<button type"submit" class="btn btn-warning mt-3 w-100" name="newPassword">Réinitialisation du mot de passe</button>
</form>';
}
?>


<?php 
if(isset($_POST['resetPassword']) ){
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
    
    $checkEmail = $database->prepare("SELECT EMAIL,SECURITY_CODE FROM users WHERE EMAIL = :email");
    $checkEmail->bindParam("email",$_POST['email']);
    $checkEmail->execute();

    if( $checkEmail->rowCount() > 0){
        require_once 'mail.php';
        $user = $checkEmail->fetchObject();
        $mail->addAddress($_POST['email']);
        $mail->Subject = "Réinitialisation du mot de passe";
    $mail->Body = '
    Lien de réinitialisation du mot de passe
        <br>
        ' . '<a href="http://alacante.es/reset.php?email='.$_POST['email']. 
        '&code='.$user->SECURITY_CODE. '">http://alacante.es/reset.php?email='.$_POST['email']. 
        '&code='.$user->SECURITY_CODE.'</a>';
        ;
        
        $mail->setFrom("NoRaply@elbossinmobiliaria.es", "MATEALSLUX");
        $mail->send();
        echo '
        <div class="alert alert-success mt-3"> 
        Un lien de réinitialisation de mot de passe a été envoyé à votre compte
     </div> 
     ';
    }else{
        echo '
        <div class="alert alert-warning mt-3">
        Cet e-mail n'."'".'est pas enregistré chez nous
        </div> 
        ';
    }
}
?>


<?php 

if(isset($_POST['newPassword'])){
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
    
   $updatePassword = $database->prepare("UPDATE users SET PASSWORD 
   = :password WHERE EMAIL = :email");
// CRIPTING PASSWORD
   $passwordUser = sha1($_POST['password']); 
   $updatePassword->bindParam("password",$passwordUser);
   $updatePassword->bindParam("email",$_GET['email']);
   
   if($updatePassword->execute()){
    echo '
    <div class="alert alert-success mt-3">
    Mot de passe réinitialisé avec succès
    </div> 
    ';
   }else{
    echo '
    <div class="alert alert-danger mt-3">
    Échec de la réinitialisation du mot de passe
    </div>
    ';
   }
}

?>

</main>

    </body>
</html>