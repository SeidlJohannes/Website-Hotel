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
<div class="page-center">
<h1>Um Reservierungen machen zu können, 
<a onclick="document.getElementById('login').style.display='block';" href="#" id="myBtn"><u>melden Sie sich bitte zuerst an</u></a>
oder erstellen Sie ein Konto!
</h1>
<?php include 'login.php'?>
</div>
</body>
</html>