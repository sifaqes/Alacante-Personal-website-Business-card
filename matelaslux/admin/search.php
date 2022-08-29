
<?php require_once'nav.php';?>
<?php 
// session_start();
if(isset($_SESSION['user'])){
if($_SESSION['user']->ROLE === "ADMIN"){
echo '<form>
<input type="text" name="search" placeholder="Búsqueda ...." />
<button  type="submit" name="searchBtn" >Búsqueda</button>
</form>
';

if(isset($_GET['searchBtn'])){
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



    $searchResult = $database->prepare("SELECT * FROM todolist WHERE text LIKE :text OR userid LIKE :userid");
    $searchValue = "%".$_GET['search']."%";
    $searchResult->bindParam("text",$searchValue);
    $searchResult->bindParam("userid",$searchValue);
    $searchResult->execute();
    echo '<table class="table mt-3">';
    echo  "<tr>";
    echo "<th>Nombre</th>";
    echo "<th>Email</th>";
    echo  "<tr>";
    foreach($searchResult AS $result){
        echo  "<tr>";
        echo "<td> ".$result['text'] ."</td>";
        echo "<td> ".$result['userid'] ."</td>";
        echo  "<tr>";
    }
    echo '</table>';
   
}

}else{
    session_unset();
    session_destroy();
// **
// header("location:http://localhost/elbossinmobiliaria/signin.php",true);  
header("location:https://crm.elbossinmobiliaria.es/signin.php",true);   
}
}else{
    session_unset();
    session_destroy();
// **
// header("location:http://localhost/elbossinmobiliaria/signin.php",true);  
header("location:https://crm.elbossinmobiliaria.es/signin.php",true);  
}

?>

</main>
</body>
</html>