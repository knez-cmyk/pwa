<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['clanak_id'])) {
        $conn = new mysqli('localhost', 'root', '', 'welt');
        
        if ($conn->connect_error) {
            die("Neuspješno spajanje na bazu podataka: " . $conn->connect_error);
        }
        
        $clanak_id = $_POST['clanak_id'];

        if (isset($_POST['brisanje']) && $_POST['brisanje'] === 'Da') {
            $stmt = $conn->prepare("DELETE FROM news WHERE id = ?");
            $stmt->bind_param('i', $clanak_id);
            
            if ($stmt->execute()) {
                echo "Članak je uspješno obrisan.";
            } else {
                echo "Greška prilikom brisanja članka: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $naslov = $_POST['naslov'];
            $sazetak = $_POST['sazetak'];
            $tekst = $_POST['tekst'];
            $kategorija = $_POST['kategorija'];
            $prikaz = isset($_POST['prikaz']) ? 'Da' : 'Ne';
            
            if ($_FILES['slika']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';
                $uploadFile = $uploadDir . basename($_FILES['slika']['name']);
                
                if (move_uploaded_file($_FILES['slika']['tmp_name'], $uploadFile)) {
                    $slika_path = $uploadFile;
                    $stmt = $conn->prepare("UPDATE news SET naslov = ?, sazetak = ?, tekst = ?, kategorija = ?, prikaz = ?, slika = ? WHERE id = ?");
                    $stmt->bind_param('ssssssi', $naslov, $sazetak, $tekst, $kategorija, $prikaz, $slika_path, $clanak_id);
                } else {
                    echo "Došlo je do pogreške prilikom prijenosa slike.";
                    exit;
                }
            } else {
                $stmt = $conn->prepare("UPDATE news SET naslov = ?, sazetak = ?, tekst = ?, kategorija = ?, prikaz = ? WHERE id = ?");
                $stmt->bind_param('sssssi', $naslov, $sazetak, $tekst, $kategorija, $prikaz, $clanak_id);
            }
            
            if ($stmt->execute()) {
                echo "Članak je uspješno ažuriran.";
            } else {
                echo "Greška prilikom ažuriranja članka: " . $stmt->error;
            }
            $stmt->close();
        }
        
        $conn->close();
    } else {
        echo "Nije primljen ID članka.";
    }

    header("Location: http://localhost/pwa/index.php", true, 302);
    exit();
} else {
    echo "Podaci nisu poslani putem forme.";
}
?>
