<?php

session_start();

$conn = mysqli_connect('localhost', 'root', '', 'welt');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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

$kategorija = isset($_GET['kategorija']) ? $_GET['kategorija'] : '';

if (!in_array($kategorija, ['politika', 'hrana'])) {
    die("Invalid category.");
}

$sql = "SELECT id, naslov, sazetak, tekst, kategorija, prikaz, slika, created_at FROM news WHERE kategorija = '$kategorija' AND prikaz = 'Da' ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result === false) {
    die("Error executing query: " . $conn->error);
}

$clanci = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $clanci[] = $row;
    }
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
          </a> <?php if($prijava){?> <?php if($_SESSION['administratorska_prava']){
          ?> <a href="./unos.php">
            <li>UNOS</li>
          </a>
          <a href="./administracija.php">
            <li>ADMINISTRACIJA</li>
          </a> <?php }} ?> <span id="sirina"></span>
          <span id="bjela"> <?php 
          if($prijava){
            echo "Dobrodošli&nbsp ",$_SESSION['korisnicko_ime'];
          }
          else{
            echo "";
          }
          ?> </span> <?php if(!isset($_SESSION['korisnik_id'])){
          ?> <a class="pm" href="./login.php">
            <li>LOGIN</li>
          </a>
          <a class="pm" href="./registracija.php">
            <li>REGISTER</li>
          </a> <?php } else { ?> <a class="pm" href="./logout.php">
            <li>LOGOUT</li>
          </a> <?php } ?>
        </ul>
      </nav>
    </header>
    <main>
      <h1> <?php 
        
        if($kategorija === "politika"){
          echo "BERUF & KARRIERE";
        }
        else{
          echo "FOOD";
        }

        ?> </h1>
      <div class="container"> <?php if (empty($clanci)): ?> <p id="font">Nema članaka u ovoj kategoriji</p> <?php else: ?> <?php foreach ($clanci as $clanak): ?> <div class="column">
          <a class="test" href="podstranica.php?id=
					<?php echo $clanak['id']; ?>"> <?php if ($clanak['slika']): ?> <img class="clanakslika" src="
					<?php echo $clanak['slika']; ?>" alt=""> <?php endif; ?> <h2> <?php echo htmlspecialchars($clanak['naslov']); ?> </h2>
          <p> <?php echo htmlspecialchars($clanak['sazetak']); ?> </p>
          <h6 class="bottom"> <?php echo date('d.m.Y', strtotime($clanak['created_at'])); ?> </h6>
          </a>
        </div> <?php endforeach; ?> <?php endif; ?> </div>
    </main>
    <footer>
      <a href="./index.php">
        <img src="logo.png" alt="x">
      </a>
    </footer>
  </body>
</html>