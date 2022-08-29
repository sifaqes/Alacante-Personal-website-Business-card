<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<?php 
session_start();
$username = $_SESSION['user']->NAME;
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="."><img src="../logo.png" alt="logo"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="profile.php">
            
         
          <?php echo $username ?></a>
        <li class="nav-item">
        <form method="POST">
          <button class="btn btn-outline-danger" type="submit" name="logout" >déconnexion</button>
        </form>
        </li>
      </ul>
    </div>
  </div>
</nav>


<?php 
if(isset($_POST['logout'])){
  session_unset();
  session_destroy();
  header("location:http://alacante.es/index.php",true); 
  }
?>



