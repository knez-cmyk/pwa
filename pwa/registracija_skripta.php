<?php
$conn = new mysqli('localhost', 'root', '', 'welt');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $korisnicko_ime = $_POST['korisnicko_ime'];
    $lozinka = password_hash($_POST['lozinka'], PASSWORD_BCRYPT);
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    

    $stmt = $conn->prepare("INSERT INTO korisnik (korisnicko_ime, lozinka, ime, prezime) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('ssss', $korisnicko_ime, $lozinka, $ime, $prezime);

    if ($stmt->execute()) {
        header("Location: login.php");
    } else {
        echo "Greška prilikom registracije: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
