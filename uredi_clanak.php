<?php
// Provjeri je li primljen ID članka
if (isset($_GET['id'])) {
    $clanak_id = $_GET['id'];
    
    // Spajanje na bazu podataka
    $conn = mysqli_connect('localhost', 'root', '', 'welt');
    
    // Provjera konekcije
    if (!$conn) {
        die("Neuspješno spajanje na bazu podataka: " . mysqli_connect_error());
    }
    
    // Dohvati članak iz baze podataka
    $sql = "SELECT * FROM news WHERE id=$clanak_id";
    $result = mysqli_query($conn, $sql);
    
    // Provjera rezultata upita
    if (mysqli_num_rows($result) > 0) {
        $clanak = mysqli_fetch_assoc($result);
    } else {
        echo "Nema članka s ID: $clanak_id";
        exit;
    }
    
    // Zatvori konekciju
    mysqli_close($conn);
} else {
    echo "ID članka nije primljen.";
    exit;
}
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
    <title>Uredi članak</title>
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
        <h1>Uredi članak</h1>
        <!-- Forma za uređivanje članka -->
        <form action="azuriraj_clanak.php" method="POST" enctype="multipart/form-data">
            <!-- Polje za naslov članka -->
            <label for="naslov">Naslov Vijesti:</label>
            <input type="text" id="naslov" name="naslov" value="<?php echo $clanak['naslov']; ?>" required>
            
            <!-- Polje za kratki sažetak -->
            <label for="sazetak">Kratki Sažetak:</label>
            <textarea id="sazetak" name="sazetak" rows="4" required><?php echo $clanak['sazetak']; ?></textarea>
            
            <!-- Polje za tekst vijesti -->
            <label for="tekst">Tekst Vijesti:</label>
            <textarea id="tekst" name="tekst" rows="8" required><?php echo $clanak['tekst']; ?></textarea>
            
            <!-- Polje za kategoriju članka -->
            <label for="kategorija">Kategorija:</label>
            <select id="kategorija" name="kategorija" required>
                <option value="politika" <?php if ($clanak['kategorija'] === 'politika') echo 'selected'; ?>>BERUF & KARRIERE</option>
                <option value="hrana" <?php if ($clanak['kategorija'] === 'hrana') echo 'selected'; ?>>FOOD</option>
            </select>
            
            <!-- Polje za odabir slike -->
            <label for="slika">Odaberi sliku:</label>
            <input type="file" id="slika" name="slika" accept="image/*">
            <br>
            <img src="<?php echo $clanak['slika']; ?>" alt="Slika" style="max-width: 300px;">
            
            <!-- Checkbox za prikazivanje obavijesti -->
             <br>
            <label id="kazpri" for="prikaz">Prikazati obavijest:</label>
            <input type="checkbox" id="prikaz" name="prikaz" <?php if ($clanak['prikaz'] === 'Da') echo 'checked'; ?>>
            
            <!-- Skriveno polje za ID članka -->
            <input type="hidden" name="clanak_id" value="<?php echo $clanak_id; ?>">
            <br>
<label for="brisanje" id="kazpri">Označi za brisanje članka:</label> <!-- Dodajte oznaku za checkbox -->
<input type="checkbox" id="brisanje" name="brisanje" value="Da"> <!-- Dodajte ovo checkbox polje unutar forme -->

            <!-- Gumb za slanje forme -->
            <!-- Tipka za ažuriranje -->
             <!-- Tipka za ažuriranje -->
              <br>
    <button type="submit" name="akcija" value="azuriraj">Ažuriraj</button>


  </form>
    </main>
    <footer>
        <a href="./index.php">
            <img src="logo.png" alt="x">
        </a>
    </footer>
</body>
</html>
