<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filter MATELASLUX</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet" />

</head>
<body style="margin: auto; max-width: 70%; text-align: left;">
  <!-- NaveBarre  -->
  <?php 
      require_once'php/nav.php';
  ?>

<div style="margin: auto; max-width: 100%; text-align:centre">
<form method="GET">
  <table>
      <tr >
          <td >
            Prix:
            <input class="form-control" type="number" name="startNumber">
            A:
            <input  class="form-control" type="number" name="endNumber" value="100000">

            <button  target="_blank" class="btn btn-warning mt-3" type="submit" name="filter">Filtrer par Prix</button>
          </td>
      </tr>
  </table>

</form>
</div>

<div class="mt-3" >
             <!-- STAR PHP CODE FILTER -->
    <?php
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

if(isset($_GET['filter'])){
  $products = $database->prepare("SELECT * FROM products WHERE Price 
  BETWEEN :startNumber AND :endNumber");
  $products->bindParam("startNumber",$_GET['startNumber']);
  $products->bindParam("endNumber",$_GET['endNumber']);

  $products->execute();
  foreach(  $products AS $myProducts){
    echo '<div class="card bg-light mb-3">
    <div class="card-header">' . $myProducts['Name'] .'</div>
    <div class="card-body">
      <h5 class="card-title">' . $myProducts['Price'] .' السعر </h5>
 
    </div>
  </div>';
}
}else{
  $products = $database->prepare("SELECT * FROM products");
  $products->execute();
  foreach(  $products AS $myProducts){
    echo '<div class="card bg-light mb-3">
    <div class="card-header">' . $myProducts['Name'] .'</div>
    <div class="card-body">
      <h5 class="card-title">' . $myProducts['Price'] .' السعر </h5>
 
    </div>
  </div>';

  }
}
?>
             <!-- END PHP CODE FILTEER   -->
             </div>

</body>
</html>




 