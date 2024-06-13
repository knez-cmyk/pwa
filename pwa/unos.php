<?php

session_start();



if(isset($_GET["korisnik"])){
  $prijava = true;

}
else{
  if(isset($_SESSION["administratorska_prava"])){
    $prijava=true;

  }
  else{
    $prijava = false;
  }
  
} ?>

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



          <?php if($prijava){?>
          <?php if($_SESSION['administratorska_prava']){
          ?>   
          <a href="./unos.php">
            <li>UNOS</li>
          </a>
          <a href="./administracija.php">
            <li>ADMINISTRACIJA</li>
          </a> <?php }} ?>


          
          <span id="sirina"></span>
          <span id="bjela"><?php 
          if($prijava){
            echo "Dobrodošli&nbsp ",$_SESSION['korisnicko_ime'];
          }
          else{
            echo "";
          }
          ?></span>

          <?php if(!isset($_SESSION['korisnik_id'])){
          ?> 
          <a class="pm" href="./login.php">
            <li>LOGIN</li>
          </a>
          
          <a class="pm" href="./registracija.php">
            <li>REGISTER</li>
          </a> <?php } else { ?>
            <a class="pm" href="./logout.php">
            <li>LOGOUT</li>
          </a>
          <?php } ?>
        </ul>
      </nav>
    </header>
    <main>
      <form id="newsForm" action="skripta.php" method="POST" enctype="multipart/form-data">
        <label for="naslov">Naslov Vijesti:</label>
        <input type="text" id="naslov" name="naslov" required>
        <span class="error-message" id="naslovError"></span>
        <br>
        <label for="sazetak">Kratki Sažetak:</label>
        <textarea id="sazetak" name="sazetak" rows="4" required></textarea>
        <span class="error-message" id="sazetakError"></span>
        <br>
        <label for="tekst">Tekst Vijesti:</label>
        <textarea id="tekst" name="tekst" rows="8" required></textarea>
        <span class="error-message" id="tekstError"></span>
        <br>
        <label for="kategorija">Kategorija:</label>
        <select id="kategorija" name="kategorija" required>
          <option value="politika">BERUF & KARRIERE</option>
          <option value="hrana">FOOD</option>
        </select>
        <span class="error-message" id="kategorijaError"></span>
        <br>
        <label for="slika">Odaberi sliku:</label>
        <input type="file" id="slika" name="slika" accept="image/*" required>
        <span class="error-message" id="slikaError"></span>
        <br>
        <label id="kazpri" for="prikaz">Prikazati obavijest:</label>
        <input type="checkbox" id="prikaz" name="prikaz">
        <br>
        <button type="submit">Pošalji</button>
      </form>
    </main>
    <footer>
      <a href="./index.php">
        <img src="logo.png" alt="x">
      </a>
    </footer>
    <script src="script.js"></script>
  </body>
</html>
