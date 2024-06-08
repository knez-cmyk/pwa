<?php
// Provjeri je li primljeni podaci iz forme
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Provjeri je li primljen ID članka
    if (isset($_POST['clanak_id'])) {
        // Spajanje na bazu podataka
        $conn = mysqli_connect('localhost', 'root', '', 'welt');
        
        // Provjera konekcije
        if (!$conn) {
            die("Neuspješno spajanje na bazu podataka: " . mysqli_connect_error());
        }
        
        // Provjeri je li checkbox za brisanje članka označen
if (isset($_POST['brisanje']) && $_POST['brisanje'] === 'Da') {
    // Pripremi SQL upit za brisanje članka
    $clanak_id = $_POST['clanak_id'];
    $sql_delete = "DELETE FROM news WHERE id=$clanak_id";
    
    // Izvrši SQL upit za brisanje članka
    if (mysqli_query($conn, $sql_delete)) {
        echo "Članak je uspješno obrisan.";
    } else {
        echo "Greška prilikom brisanja članka: " . mysqli_error($conn);
    }
        } else {
            // Pripremi podatke za ažuriranje članka
            $naslov = $_POST['naslov'];
            $sazetak = $_POST['sazetak'];
            $tekst = $_POST['tekst'];
            $kategorija = $_POST['kategorija'];
            $prikaz = isset($_POST['prikaz']) ? 'Da' : 'Ne';
            $clanak_id = $_POST['clanak_id'];
            
            // Provjeri je li primljena nova slika
            if ($_FILES['slika']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';
                $uploadFile = $uploadDir . basename($_FILES['slika']['name']);
                
                // Premjesti sliku u odredišni direktorij
                if (move_uploaded_file($_FILES['slika']['tmp_name'], $uploadFile)) {
                    // Ažuriraj putanju slike u bazi podataka
                    $slika_path = $uploadFile;
                    $sql_update = "UPDATE news SET naslov='$naslov', sazetak='$sazetak', tekst='$tekst', kategorija='$kategorija', prikaz='$prikaz', slika='$slika_path' WHERE id=$clanak_id";
                } else {
                    echo "Došlo je do pogreške prilikom prijenosa slike.";
                    exit;
                }
            } else {
                // Ako nije primljena nova slika, ažuriraj ostale podatke članka u bazi
                $sql_update = "UPDATE news SET naslov='$naslov', sazetak='$sazetak', tekst='$tekst', kategorija='$kategorija', prikaz='$prikaz' WHERE id=$clanak_id";
            }
            
            // Izvrši SQL upit za ažuriranje članka
            if (mysqli_query($conn, $sql_update)) {
                echo "Članak je uspješno ažuriran.";
            } else {
                echo "Greška prilikom ažuriranja članka: " . mysqli_error($conn);
            }
        }
        
        // Zatvori konekciju
        mysqli_close($conn);
    } else {
        echo "Nije primljen ID članka.";
    }
    // Nakon ispisivanja poruke, redirektiraj na index.php
    header("Location: http://localhost/pwa/index.php", true, 302);
} else {
    echo "Podaci nisu poslani putem forme.";
}
?>
