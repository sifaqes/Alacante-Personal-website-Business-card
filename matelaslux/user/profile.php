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
<!-- NaveBarre  -->
<?php require_once'nav.php';?>

<main>


<?php 
// session_start();
if(isset($_SESSION['user'])){
if($_SESSION['user']->ROLE === "USER"){

$pasworddisplay = sha1($_SESSION['user']->PASSWORD);

echo '
<form method="POST">
    <a class="w-100 btn btn-light mb-3" href="index.php">Page Principale</a>
    <div class="p-3 shadow ">Nom :</div>
    <input class="form-control mb-1" type="text" name="name" value="'.$_SESSION['user']->NAME.'" required />

    <div class="p-3 shadow ">Lage :</div>
    <input  class="form-control mb-1" type="date" name="age" value="'.$_SESSION['user']->AGE.'" required />

    <div class="p-3 shadow ">Email :</div>
    <input  class="form-control mb-1" type="email" name="email" value="'.$_SESSION['user']->EMAIL.'" required />

    <div class="p-3 shadow ">Mot de passe :</div>
    <input class="form-control mb-1" type="text" name="password" value="'.$pasworddisplay.'" required />

    <button class="w-100 btn btn-warning mt-1" type="submit" name="update" value="'.$_SESSION['user']->ID.'">Mise a Jour</button>
    <a class="w-100 btn btn-light mt-1" href="index.php"> Page Principale</a>
</form>
';

if(isset($_POST['update'])){
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
    
    $updateUserData = $database->prepare("UPDATE users SET NAME = :name ,AGE=:age ,EMAIL=:email,PASSWORD = :password  WHERE ID = :id ");
        $updateUserData->bindParam('name',$_POST['name']);
        $updateUserData->bindParam('age',$_POST['age']);
        $updateUserData->bindParam('email',$_POST['email']);
// CRYPTO PASSWORD INJUCCION
        $passwordupdateuser = sha1($_POST['password']);
        $updateUserData->bindParam('password',$passwordupdateuser);
        $updateUserData->bindParam('id',$_POST['update']);

    if($updateUserData->execute()){
        echo '<div class="alert alert-success mt-3">Les données ont été mises à jour avec succès</div>';
        $user =  $database->prepare("SELECT * FROM users WHERE ID = :id ");
        $user->bindParam('id',$_POST['update']);
        $user->execute();
        $_SESSION['user'] = $user->fetchObject();
        header("refresh:2;");
    }  else{
        echo '<div class="alert alert-alert mt-3">La mise à jour des données a échoué</div>';


    }
}
}else{
    session_unset();
    session_destroy();
    header("location:http://alacante.es/login.php",true);  
}
}else{
    session_unset();
    session_destroy();
    header("location:http://alacante.es/login.php",true);  
}

?>

</main>





</body>
</html>