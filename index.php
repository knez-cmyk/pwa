<?php
$conn = mysqli_connect('localhost', 'root', '', 'welt');
/// Provjera konekcije
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Dohvaćanje članaka iz baze
$sql = "SELECT id, naslov, sazetak, tekst, kategorija, prikaz, slika, created_at FROM news WHERE prikaz = 'Da' ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result === false) {
  die("Error executing query: " . $conn->error);
}

$politika_clanci = [];
$hrana_clanci = [];

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
      if ($row['kategorija'] === 'politika') {
          $politika_clanci[] = $row;
      } elseif ($row['kategorija'] === 'hrana') {
          $hrana_clanci[] = $row;
      }
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
          </a>
          <a href="./unos.html">
            <li>UNOS</li>
          </a>
          <a href="./administracija.php">
            <li>ADMINISTRACIJA</li>
          </a>
        </ul>
      </nav>
    </header>
    <main>
    <h1 id="hjedan">BERUF & KARRIERE</h1>
    <div class="container">
        <?php if (empty($politika_clanci)): ?>
            <p>Nema članaka u ovoj kategoriji</p>
        <?php else: ?>
            <?php foreach ($politika_clanci as $clanak): ?>
                <div class="column">
                    <a class="test" href="podstranica.php?id=<?php echo $clanak['id']; ?>">
                        <?php if ($clanak['slika']): ?>
                            <img class="clanakslika" src="<?php echo $clanak['slika']; ?>" alt="">
                        <?php endif; ?>
                        <h2><?php echo htmlspecialchars($clanak['naslov']); ?></h2>
                        <p><?php echo htmlspecialchars($clanak['sazetak']); ?></p>
                        <h6 class="bottom"><?php echo date('d.m.Y', strtotime($clanak['created_at'])); ?></h6>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <h1>FOOD</h1>
    <div class="container">
        <?php if (empty($hrana_clanci)): ?>
            <p>Nema članaka u ovoj kategoriji</p>
        <?php else: ?>
            <?php foreach ($hrana_clanci as $clanak): ?>
                <div class="column2">
                    <a class="test" href="podstranica.php?id=<?php echo $clanak['id']; ?>">
                        <?php if ($clanak['slika']): ?>
                            <img class="clanakslika" src="<?php echo $clanak['slika']; ?>" alt="">
                        <?php endif; ?>
                        <h2><?php echo htmlspecialchars($clanak['naslov']); ?></h2>
                        <p><?php echo htmlspecialchars($clanak['sazetak']); ?></p>
                        <h6 class="bottom"><?php echo date('d.m.Y', strtotime($clanak['created_at'])); ?></h6>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</main>
    <footer>
      <a href="./index.php">
        <img src="logo.png" alt="x">
      </a>
    </footer>
  </body>
</html>
