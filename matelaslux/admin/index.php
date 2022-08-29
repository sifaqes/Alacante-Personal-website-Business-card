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

<?php
// star  session 
// session_start();
if(isset($_SESSION['user'])){

    if($_SESSION['user']->ROLE === "ADMIN"){
        
        echo '
        <div>Bienvenue '.$_SESSION['user']->NAME.', Vous ete '.$_SESSION['user']->ROLE.'
        <form>
            <a class="btn btn-ligth form-control mb-1" href="profile.php">Modifier le profile</a>
            <a class=" btn btn-warning form-control mb-1" href="clients.php"> Ajouter un Client</a>
            <a class=" btn  btn-danger form-control mb-1" href="#"> Ajouter une Commanede</a>

         </form> </div>
        ';

    } else {
        header("location:http://alacante.es/login.php",true); 
        die("");
    }


    }else{
        header("location:http://alacante.es/login.php",true); 
        die(""); 
    }
    
    if(isset($_GET['logout'])){
        session_unset();
        session_destroy();
        header("location:http://alacante.es/login.php",true); 
        }

    ?> 
    </main>
    </body>
    </html>




