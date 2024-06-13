<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Prijava</title>
</head>
<body>
    <header>
        <img id="logo" src="logo.png" alt="x">
        <nav>
            <ul>
                <a href="./index.php"><li>HOME</li></a>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Prijava</h1>
        <form action="login_skripta.php" method="POST">
            <label for="korisnicko_ime">Korisničko ime:</label>
            <input type="text" id="korisnicko_ime" name="korisnicko_ime" required>
            
            <label for="lozinka">Lozinka:</label>
            <input type="password" id="lozinka" name="lozinka" required>
            
            <button type="submit">Prijavi se</button>
        </form>
        <p id="font">Nemate račun? <a href="registracija.php">Registrirajte se</a></p>
    </main>
    <footer>
        <a href="./index.php"><img src="logo.png" alt="x"></a>
    </footer>
</body>
</html>
