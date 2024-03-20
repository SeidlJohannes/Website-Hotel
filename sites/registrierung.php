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
    <div id="registrierung" class="modal"> <!--class modal => window is not displayed by default-->
          <form class="modal-content"  method="post" action="index.php?menu=home"> 
            <div class="imgcontainer">
            <span onclick="document.getElementById('registrierung').style.display='none';
          document.getElementById('login').style.display='none';" class="close">&times;</span>
              <img src="images/login_avatar.png" alt="Avatar" class="avatar">
            </div>
        
            <div class="modal-body">
            <label for="anrede"><b>Anrede:</b></label>
              <select id="anrede" name="user_anrede">
              <option value="Keine Anrede">Keine Anrede</option>
              <option value="Herr">Herr</option>
              <option value="Frau">Frau</option>
              </select>
              <label for="firstname"><b>Vorname:</b></label>
              <input type="text" placeholder="Vorname" name="user_vorname" required class="fullLength">
              <label for="lastname"><b>Nachname:</b></label>
              <input type="text" placeholder="Nachname" name="user_nachname" required class="fullLength">
              <label for="email"><b>Email:</b></label>
              <input type="email" placeholder="Email" name="user_email" id="email" required class="fullLength">
            <div>
              <label for="benutzername"><b>Benutzername:</b></label>
              <input type="text" placeholder="Benutzername" name="user_benutzername" id="benutzername" required class="fullLength">
            </div>
            <div>
              <label for="psw"><b>Passwort</b></label>
              <input type="password" placeholder="Passwort" name="user_passwort" required class="fullLength">
            </div>
            <div>
              <label for="psw"><b>Passwort bestätigen</b></label>
              <input type="password" placeholder="Passwort" name="user_passwort_confirm" required class="fullLength">
            </div>
              <button type="submit" name="submitRegistration" value="abgeschickt">
                Registrieren
              </button>
          </form>
        </div>
      </body>
</html>