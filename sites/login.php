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

<div id="login" class="modal plain-text"> <!--class modal => window is not displayed by default-->
          <form class="modal-content"  method="post" action="index.php?menu=home"> 
            <div class="imgcontainer">
              <span onclick="document.getElementById('login').style.display='none'" class="close">&times;</span>
              <img src="images/login_avatar.png" alt="Avatar" class="avatar">
            </div>
        
            <div class="modal-body">
              <label for="uname"><b>Username</b></label>
              <input type="text" placeholder="Benutzername" name="username" required class="fullLength">
        
              <label for="psw"><b>Password</b></label>
              <input type="password" placeholder="Passwort" name="password" required class="fullLength">
                <div>
              <button type="submit" name="submitLogin" value="abgeschickt">
                Anmelden
              </button>
              <label class="right">Benutzername merken
                <input type="checkbox" checked="checked" name="remember"> 
              </label>
              </div>
            </form>
            <div class="grayContainer">
            <a onclick="document.getElementById('registrierung').style.display='block';" href="#" id="myBtn">Konto erstellen</a>
            <?php include 'registrierung.php'?>
            </div>
            </div>
            </div>
</body>

</html>