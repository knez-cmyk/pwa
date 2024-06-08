<?php
$conn = mysqli_connect('localhost', 'root', '', 'welt');
// Provjera konekcije
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Dohvaćanje svih članaka iz baze
$sql = "SELECT id, naslov, sazetak, tekst, kategorija, prikaz, slika, created_at FROM news ORDER BY created_at DESC";
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
    <title>Administracija - Svi Članci</title>
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
      <h1>ADMINISTRACIJA</h1>
      <div class="container">
        <?php if (empty($clanci)): ?>
            <p>No articles available.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Naslov</th>
                        <th>Sažetak</th>
                        
                        <th>Kategorija</th>
                        
                        <th>Slika</th>
                        <th>Datum</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clanci as $clanak): ?>
                        <tr>
                            <td><?php echo $clanak['id']; ?></td>
                            <td><?php echo htmlspecialchars($clanak['naslov']); ?></td>
                            <td><?php echo htmlspecialchars($clanak['sazetak']); ?></td>
                           
                            <td><?php echo htmlspecialchars($clanak['kategorija']); ?></td>
                            
                            <td><?php if ($clanak['slika']): ?>
                                <img src="<?php echo $clanak['slika']; ?>" alt="Slika" style="max-width: 100px;">
                                <?php endif; ?>
                            </td>
                            
                            <td><?php echo date('d.m.Y', strtotime($clanak['created_at'])); ?></td>
                            <td><a href="uredi_clanak.php?id=<?php echo $clanak['id']; ?>">Uredi</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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
