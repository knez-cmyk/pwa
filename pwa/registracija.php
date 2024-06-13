<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registracija</title>
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
        <h1>Registracija</h1>
        <form action="registracija_skripta.php" method="POST">
            <label for="korisnicko_ime">Korisničko ime:</label>
            <input type="text" id="korisnicko_ime" name="korisnicko_ime" required>
            
            <label for="lozinka">Lozinka:</label>
            <input type="password" id="lozinka" name="lozinka" required>
            
            <label for="ime">Ime:</label>
            <input type="text" id="ime" name="ime">
            
            <label for="prezime">Prezime:</label>
            <input type="text" id="prezime" name="prezime">
            
            <button type="submit">Registriraj se</button>
        </form>
    </main>
    <footer>
        <a href="./index.php"><img src="logo.png" alt="x"></a>
    </footer>
</body>
</html>
