<?php
session_start();

if(isset($_GET["korisnik"])){
  $prijava = true;

}
else{
  if(isset($_SESSION["administratorska_prava"])){
    $prijava=true;

  }
  else{
    $prijava = false;
  }
  
}
// Kreiranje konekcije
$conn = mysqli_connect('localhost', 'root', '', 'welt');

// Provjera konekcije
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Dohvaćanje ID-a članka iz URL parametra
$article_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Dohvaćanje članka iz baze prema ID-ju
$sql = "SELECT naslov, sazetak, tekst, kategorija, slika, created_at FROM news WHERE id = $article_id AND prikaz = 'Da'";
$result = $conn->query($sql);

$clanak = null;
if ($result->num_rows > 0) {
    $clanak = $result->fetch_assoc();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>WELT</title>
  </head>
  <body>
  <header>
      <img id="logo" src="logo.png" alt="x">
      <nav>
        <ul>
          <a href="./index.php">
            <li>HOME</li>
          </a>
          <a href="kategorija.php?kategorija=politika">
            <li>BERUF & KARRIERE</li>
          </a>
          <a href="kategorija.php?kategorija=hrana">
            <li>FOOD</li>
          </a>



          <?php if($prijava){?>
          <?php if($_SESSION['administratorska_prava']){
          ?>   
          <a href="./unos.php">
            <li>UNOS</li>
          </a>
          <a href="./administracija.php">
            <li>ADMINISTRACIJA</li>
          </a> <?php }} ?>


          
          <span id="sirina"></span>
          <span id="bjela"><?php 
          if($prijava){
            echo "Dobrodošli&nbsp ",$_SESSION['korisnicko_ime'];
          }
          else{
            echo "";
          }
          ?></span>

          <?php if(!isset($_SESSION['korisnik_id'])){
          ?> 
          <a class="pm" href="./login.php">
            <li>LOGIN</li>
          </a>
          
          <a class="pm" href="./registracija.php">
            <li>REGISTER</li>
          </a> <?php } else { ?>
            <a class="pm" href="./logout.php">
            <li>LOGOUT</li>
          </a>
          <?php } ?>
        </ul>
      </nav>
    </header>
    <main>
        <?php if ($clanak): ?>
            <h1 id="hjedan"><?php echo htmlspecialchars($clanak['naslov']); ?></h1>
            <hr>
            <div class="containerpod">
                <div class="columnpod">
                    <h6>Stand: <?php echo date('d.m.Y', strtotime($clanak['created_at'])); ?></h6>
                    <?php if ($clanak['slika']): ?>
                        <img class="clanakslika" src="<?php echo $clanak['slika']; ?>" alt="">
                    <?php endif; ?>
                    <p><?php echo htmlspecialchars($clanak['tekst']); ?></p>
                </div>
            </div>
        <?php else: ?>
            <p>Članak nije pronađen</p>
        <?php endif; ?>
    </main>
    <footer>
      <a href="./index.php">
        <img src="logo.png" alt="x">
      </a>
    </footer>
  </body>
</html>