<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   

    // Kreiranje konekcije
    $conn = mysqli_connect('localhost', 'root', '', 'welt');

    // Provjera konekcije
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Preuzimanje podataka iz forme
    $naslov = htmlspecialchars($_POST['naslov']);
    $sazetak = htmlspecialchars($_POST['sazetak']);
    $tekst = htmlspecialchars($_POST['tekst']);
    $kategorija = htmlspecialchars($_POST['kategorija']);
    $prikaz = isset($_POST['prikaz']) ? 'Da' : 'Ne';
    $slika = null;

    // Prijenos slike ako je postavljena
    if (isset($_FILES['slika']) && $_FILES['slika']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['slika']['name']);
        if (move_uploaded_file($_FILES['slika']['tmp_name'], $uploadFile)) {
            $slika = $uploadFile;
        } else {
            echo "<p><strong>Slika:</strong> Došlo je do pogreške prilikom prijenosa slike.</p>";
        }
    } else {
        echo "<p><strong>Slika:</strong> Slika nije postavljena.</p>";
        echo "<p>Error code: {$_FILES['slika']['error']}</p>"; // Debugging line
    }

    // Priprema i izvršavanje SQL upita za unos podataka
    $stmt = $conn->prepare("INSERT INTO news (naslov, sazetak, tekst, kategorija, prikaz, slika) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $naslov, $sazetak, $tekst, $kategorija, $prikaz, $slika);

    if ($stmt->execute()) {
        echo "<p>Vijest je uspješno spremljena u bazu podataka.</p>";
    } else {
        echo "<p>Došlo je do pogreške prilikom spremanja vijesti: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();

    
} else {
    echo "<p>Podaci nisu poslani putem forme.</p>";
}

header("Location: http://localhost/pwa/index.php", true, 302);

?>

