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
// IF HAVE PERMETION ADMIN DO
if(isset($_SESSION['user'])){
// IF THE PERMITION IS USER
    if($_SESSION['user']->ROLE === "ADMIN"){
// ECHO INPUTS TOOLS
    echo'
    <form method="POST">
            <a class="w-100 btn btn-light mb-3" href="index.php"> Retour à la page principale</a>
    
                Nom & Prenom * 
                <input class="form-control " type="text" name="namec" required/>
                Adresse * 
                <input class="form-control " type="text" name="adressec" required/>
                Code Postal<small> (Optional) </small>
                <input class="form-control " type="number"  name="codepostalc" />
                Wilaya<small>(Optional) </small>
                <input class="form-control " type="text" name="wilayac" />
                Email<small> (Optional) </small>
                <input class="form-control " type="email" name="emailc"/>
                Telephone *<small> 055059XXXX </small>
                <input class="form-control" type="text" name="telc" required/>
                Age<small> (Optional) </small>
                <input class="form-control " type="number" value="18" name="agec" />
                Mot de Passe <small>(Optional: 123456)</small>
                <input class="form-control" value="123456"type="password" name="passwordc" />
    
            <button class="w-100 btn btn-warning mb-3 mt-3" type="submit" name="add">Ajouter</button>
        </form>';
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

    if(isset($_POST['add'])){
            $addItem = $database->prepare("INSERT INTO clients(USERID,NAMEC,ADRESSEC,CODEPOSTALC,WILAYAC,EMAILC,TELC,AGEC,PASSWORDC,STATUSC) 
            VALUES(:USERID,:NAMEC,:ADRESSEC,:CODEPOSTALC,:WILAYAC,:EMAILC,:TELC,:AGEC,:PASSWORDC,'no')");
// IMPORT ID FROM USERS ADMINISTRADO 
            $userid = $_SESSION['user']->ID;
            $addItem->bindParam("USERID",$userid);
// MAKE VARIABLE $XXXXC
            $namec = $_POST['namec'];
            $adressec = $_POST['adressec'];
            $codepostalc = $_POST['codepostalc'];
            $wilayac = $_POST['wilayac'];
            $emailc = $_POST['emailc'];
            $telc = $_POST['telc'];
            $agec = $_POST['agec'];
            // CRYPTING PASSWORD
            $passwordc =sha1($_POST['passwordc']);

// BINDPARAM SETTING
            $addItem->bindParam("NAMEC",$namec);
            $addItem->bindParam("ADRESSEC",$adressec);
            $addItem->bindParam("CODEPOSTALC", $codepostalc);
            $addItem->bindParam("WILAYAC",$wilayac);
            $addItem->bindParam("EMAILC",$emailc);
            $addItem->bindParam("TELC",$telc);
            $addItem->bindParam("AGEC",$agec);
            $addItem->bindParam("PASSWORDC",$passwordc);
// EXECUTE DATABESE
            if($addItem->execute()){
            echo '<div class="alert alert-success mt-3 mb-3">Ajouté avec succès</div>';
            require_once'sender.php';
}
}
//////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////// DISPLAY////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
// SELECT DATABASE
$nameadmin = $_SESSION['user']->NAME;
$toDoItems = $database->prepare("SELECT * FROM clients WHERE USERID = :id");
$userid = $_SESSION['user']->ID;
$toDoItems->bindParam("id",$userid);
$toDoItems->execute();


echo '<table class="table">';
echo '<tr>';
echo '<th>المهمة</th>';
echo '<th>الحالة</th>';
echo '<th>حذف</th>';

echo '</tr>';
foreach($toDoItems AS $items){
    echo ' <form> <tr> ';
echo '<th>'.$items['NAMEC'].'</th>';
if($items['STATUSC'] ==="no"){
    echo '<th>
    <input type="hidden" name="statusValue" value="'.$items['STATUSC'].'"/>
    <button type="submit" class="btn btn-warning" 
    name="status" value="'.$items['ID'].'">غير منجز</button> </th>';
}else if($items['STATUSC'] ==="yes"){
    echo '<th> 
    <input type="hidden" name="statusValue" value="'.$items['STATUSC'].'"/>
    <button type="submit" class="btn btn-success" 
    name="status" value="'.$items['ID'].'">منجز</button></th>';
}

echo '<th> <button type="submit" class="btn btn-outline-danger" 
name="remove" value="'.$items['ID'].'">حذف</button></th>';

echo '</tr> </form>';

}
echo '</table>';

if(isset($_GET['status'])){

if($_GET['statusValue'] ==="no"){
$updateStatus = $database->prepare("UPDATE clients SET STATUSC = 'yes' WHERE ID = :id");
$updateStatus->bindParam("id",$_GET['status']);
$updateStatus->execute();
if ($updateStatus->execute()) {
    echo'<div class="alert alert-success" role="alert">
     votre commande N:'.$items['ID'].' a été expédiée!
    </div>';
    // header("location:user/clients.php",true);
}
}else if($_GET['statusValue'] ==="yes"){
    $updateStatus = $database->prepare("UPDATE clients SET STATUSC = 'no' WHERE ID = :id");
    $updateStatus->bindParam("id",$_GET['status']);
    $updateStatus->execute();
        if ($updateStatus->execute()) {
            echo'<div class="alert alert-success" role="alert">
            votre commande N:'.$items['ID'].' a été Anuller!
            </div>';
            // header("location:user/clients.php",true);
        }
}

}

if(isset($_GET['remove'])){
$removeItem = $database->prepare("DELETE FROM clients WHERE id = :id");
$removeItem->bindParam('id',$_GET['remove']);
$removeItem->execute();
    if ($removeItem->execute()) { 
        $adminname = $_SESSION['user']->NAME;
        echo'<div class="alert alert-success" role="alert">
        Mr.'.$adminname.', Vous avez supprimé la  commande numéro:'.$items['ID'].' a ete suprimer avec secces!
        </div>';
        // header("location:user/clients.php",true);
    }

}






























//     echo '
//     <div >
//     <table class="table">
//     <thead >
//     <tr>
//       <th scope="col">ID</th>
//       <th scope="col">ADMIN</th>
//       <th scope="col">Nom & Prenom</th>
//       <th scope="col">Adresse</th>
//       <th scope="col">Code Postal</th>
//       <th scope="col">Wilaya</th>
//       <th scope="col">Email</th>
//       <th scope="col">TEL</th>
//       <th scope="col">Age</th>
//     </tr>
//   </thead>
//   <tbody>
// <tr>
//   <th scope="row">'.$items['ID'].'</th>
//   <td>'.$nameadmin.'</td>

//   <td>'.$items['NAMEC'].'</td>
//   <td>'.$items['ADRESSEC'].'</td>
//   <td>'.$items['CODEPOSTALC'].'</td>
//   <td>'.$items['WILAYAC'].'</td>
//   <td>'.$items['EMAILC'].'</td>
//   <td>'.$items['TELC'].'</td>
//   <td>'.$items['AGEC'].'</td>
// </tr>
// </tbody>

//     </table>
//     </div>';

  
}else{
    header("location:http://alacante.es/login.php",true); 
    die("");
}


}else{
    header("location:http://alacante.es/login.php",true); 
    die("");
}
    ?>


<?php 
if(isset($_GET['logout'])){
    session_unset();
    session_destroy();
    header("location:http://alacante.es/login.php",true); 
    }

    ?>








</body>
</html>