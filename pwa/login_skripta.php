<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'welt');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $korisnicko_ime = $_POST['korisnicko_ime'];
    $lozinka = $_POST['lozinka'];

    $stmt = $conn->prepare("SELECT id, lozinka, ime, administratorska_prava FROM korisnik WHERE korisnicko_ime = ?");
    $stmt->bind_param('s', $korisnicko_ime);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password, $ime, $administratorska_prava);
        $stmt->fetch();

        if (password_verify($lozinka, $hashed_password)) {
            $_SESSION['korisnik_id'] = $id;
            $_SESSION['korisnicko_ime'] = $korisnicko_ime;
            $_SESSION['ime'] = $ime;
            $_SESSION['administratorska_prava'] = $administratorska_prava;

            if ($administratorska_prava) {
                header("Location: administracija.php");
            } else {
                header("Location: index.php?korisnik=1");
               
            }
        } else {
            echo "Neispravna lozinka. <a href='registracija.php'>Registrirajte se</a>";
        }
    } else {
        echo "Korisničko ime ne postoji. <a href='registracija.php'>Registrirajte se</a>";
    }

    $stmt->close();
    $conn->close();
}
?>
