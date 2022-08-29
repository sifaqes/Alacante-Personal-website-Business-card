<!-- NAVEBARRE -->
    <?php require_once'nav.php';?>


<?php
    // session_start();
    if(isset($_SESSION['user'])){
    if($_SESSION['user']->ROLE === "ADMIN"){

        echo '<form method="POST">
        <a href="index.php"> Volver a la página principal</a>
        <input type="text" name="text" required/>
        <button type="submit" name="add">adición</button>
        </form>';

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



    if(isset($_POST['add'])){

////////////////////////////////////////INSERT ITEMS///////////////////////////////////// 
    $addItem = $database->prepare("INSERT INTO todolist(userid,text,status ) VALUES(:userId,:text,'no')");
// INSERT TEXT
    $textadd = $_POST['text'];
    $addItem->bindParam("text",$textadd);
// INSERT USERID
    $userId = $_SESSION['user']->ID;
    $addItem->bindParam("userId",$userId);

    if($addItem->execute()){
    echo 'Agregado exitosamente <br>';
    header("refresh:0;");
    }


    }

/////////////////////////////////////// DISPLAY TEXT ////////////////////////////////////
$toDoItems = $database->prepare("SELECT * FROM todolist WHERE userid = :id");
$userId = $_SESSION['user']->ID;

$toDoItems->bindParam("id",$userId);
$toDoItems->execute();
echo '<table class="table">';
echo '<tr>';
echo '<th>Operacion</th>';
echo '<th>Estado</th>';
echo '<th>Eliminar</th>';

echo '</tr>';
foreach($toDoItems AS $items){
    echo ' <form> <tr> ';
echo '<th>'.$items['text'].'</th>';
if($items['status'] ==="no"){
    echo '<th>
    <input type="hidden" name="statusValue" value="'.$items['status'].'"/>
    <button type="submit"name="status" value="'.$items['id'].'">Indisponible</button> </th>';
}else if($items['status'] ==="yes"){
    echo '<th> 
    <input type="hidden" name="statusValue" value="'.$items['status'].'"/>
    <button type="submit" name="status" value="'.$items['id'].'">Disponible</button></th>';
}

echo '<th> <button type="submit" class="btn btn-outline-danger" 
name="remove" value="'.$items['id'].'">Eliminar</button></th>';

echo '</tr> </form>';

}
echo '</table>';

if(isset($_GET['status'])){

if($_GET['statusValue'] ==="no"){
$updateStatus = $database->prepare("UPDATE todolist SET status = 'yes' WHERE id = :id");
$updateStatus->bindParam("id",$_GET['status']);
$updateStatus->execute();
// PROTOCOL OF MAIL MAILER
        //   **         
        require_once '../mail.php';
        $mail->addAddress($_SESSION['user']->EMAIL);
        $mail->Subject = "ELBOSSINMOBILIARIA - INMUEBLE DISPONIBLE";
        $mail->Body = 'Hola '.$_SESSION['user']->NAME.'has puesto un inmueble en servicio, Informaciones del inmueble '.$items['text'].'';
        $mail->setFrom("NoRaply@elbossinmobiliaria.es", "ELBOSSINMOBILIARIA");
        $mail->send();

header("location:addinmueble.php",true);
}else if($_GET['statusValue'] ==="yes"){
    $updateStatus = $database->prepare("UPDATE todolist SET status = 'no' WHERE id = :id");
    $updateStatus->bindParam("id",$_GET['status']);
    $updateStatus->execute();
// PROTOCOL OF MAIL MAILER
        //   **         
        require_once '../mail.php';
        $mail->addAddress($_SESSION['user']->EMAIL);
        $mail->Subject = "ELBOSSINMOBILIARIA - INMUEBLE NON DISPONIBE";
        $mail->Body = 'Hola '.$_SESSION['user']->NAME.'has puesto un inmueble fuera del del servicio, Informaciones del inmueble '.$items['text'].' ';
        $mail->setFrom("NoRaply@elbossinmobiliaria.es", "ELBOSSINMOBILIARIA");
        $mail->send();
    header("location:addinmueble.php",true);
}

}

if(isset($_GET['remove'])){
$removeItem = $database->prepare("DELETE FROM todolist WHERE id = :id");
$removeItem->bindParam('id',$_GET['remove']);
$removeItem->execute();
header("location:addinmueble.php",true);
}

    }else{
// **
// header("location:http://localhost/elbossinmobiliaria/signin.php",true);  
header("location:https://crm.elbossinmobiliaria.es/signin.php",true); 
        die("");
    }
    }else{
// **
// header("location:http://localhost/elbossinmobiliaria/signin.php",true);  
header("location:https://crm.elbossinmobiliaria.es/signin.php",true); 
        die(""); 
    }

    if(isset($_GET['logout'])){
        session_unset();
        session_destroy();
// **
// header("location:http://localhost/elbossinmobiliaria/signin.php",true);  
header("location:https://crm.elbossinmobiliaria.es/signin.php",true); 
        }
?> 
</main>

