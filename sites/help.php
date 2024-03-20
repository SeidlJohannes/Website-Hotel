<?php
  if(!isset($_SESSION)) 
  { 
      session_start(); 
  } 
  error_reporting(E_ALL); //Fehlermeldungen aktivieren
  ini_set('display_errors','On'); //Zusatzeinstellung: Error wird ausgegeben

  $title = 'Hilfe';
?>
<!DOCTYPE html>
<html lang="de">
<body>
<img src="images/Friedrichshafen.png" class="img-fluid centered-img" alt="Hotel Friedrichshafen">
<div>
  <h1>Benutzerhandbuch & Fragen</h1>
  <h2>Wir sind immer für Sie da!</h2>
  <span></span>
</div>
            <div>
                <h1>Benutzerhandbuch:</h1>
<pre class="centered-text">
Auf Dieser Website können Sie entweder
anonym die News-Beiträge ansehen oder
sich einloggen und Zimmer reservieren!
</pre>
            <div class="centered-text">
                <h1>FAQ:</h1>
                <form action="" method="get" class="form-example">
                    <div class="form-example">
                    <label for="frage">Geben Sie Ihre Frage hier ein:</label><br>
                    <textarea id="frage" name="textarea" rows="5" cols="60"></textarea>
                    <div>
                    <input type="submit" value="Abschicken">
                    <input type="reset">
                  </div>
                  </form>
            </div>
</body>
</html>