<?php
  if(!isset($_SESSION)) 
  { 
      session_start(); 
  } 
  error_reporting(E_ALL); //Fehlermeldungen aktivieren
  ini_set('display_errors','On'); //Zusatzeinstellung: Error wird ausgegeben
?>
<!DOCTYPE html>
<html lang="de">
<body>
    <?php 
        $anrede = $_SESSION['anrede'];
        $vorname = $_SESSION['vorname'];
        $nachname = $_SESSION['nachname'];
        $email = $_SESSION['email'];
        $benutzername = $_SESSION['username'];
    ?>
<div class="imgcontainer">
    <img src="images/login_avatar.png" alt="Avatar" class="avatar" style="max-width: 250px">
</div>
<h2>Hier können Sie Ihre Profildaten ansehen und bearbeiten.</h2>
<hr style="border-color: white;">
<div class="row">
    <div class="profilColumn">
        <p class="profilFontLeft">Anrede:</p>
    </div>
    <div class="profilColumn">
        <p class="profilFontRight"><?php echo "$anrede"?></p>
    </div>
    <div class="profilColumn">
        <p class="profilFontLeft">Vorname:</p>
    </div>
    <div class="profilColumn">
        <p class="profilFontRight"><?php echo "$vorname"?></p>
    </div>
    <div class="profilColumn">
        <p class="profilFontLeft">Nachname:</p>
    </div>
    <div class="profilColumn">
        <p class="profilFontRight"><?php echo "$nachname"?></p>
    </div>
    <div class="profilColumn">
        <p class="profilFontLeft">Email:</p>
    </div>
    <div class="profilColumn">
        <p class="profilFontRight"><?php echo "$email"?></p>
    </div>
    <div class="profilColumn">
        <p class="profilFontLeft">Benutzername:</p>
    </div>
    <div class="profilColumn">
        <p class="profilFontRight"><?php echo "$benutzername"?></p>
    </div>
    <div class="profilColumn">
        <p class="profilFontLeft">Passwort:</p>
    </div>
    <div class="profilColumn">
        <p class="profilFontRight">********</p>
    </div>
</div>
<hr style="border-color: white;">
<a href="index.php?menu=profilEdit">
    <button class="dropbtn margin50" style="left: 50%">Profil bearbeiten</button>
</a> 
</body>
</html>