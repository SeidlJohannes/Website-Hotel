<?php
if (!isset($_SESSION)) {
  session_start();
}
error_reporting(E_ALL); //Fehlermeldungen aktivieren
ini_set('display_errors', 'On'); //Zusatzeinstellung: Error wird ausgegeben
?>
<?php if (!isset($_SESSION['username'])) {
  echo "<script>location.href='index.php?menu=loginFirst'</script>";
} ?>
<!DOCTYPE html>
<html lang="de">

<body>
  <img src="images/Friedrichshafen.png" class="img-fluid centered-img" alt="Hotel Friedrichshafen">
  <!--img-fluid makes picture responsive-->
  <?php
  include __DIR__ . '/reservierungDone.php';

  //Code wird nur beachtet wenn Wert "submit" nicht leer ist
  if (empty($_POST["submitReservierung"])) { ?>
    <h2>Wählen sie An- und Abreisedatum Ihres Aufenthalts:</h2>
    <form method="post" action="index.php?menu=reservierung">
      <div class="profilColumn">
        <p class="profilFontLeft">Anreisedatum:</p>
        <input class="profilFontRight halfLength" style="margin-left: 50%; color: black;" type="date" name="anreise"
          value="2023-01-01" min="2024-01-01" max="2124-12-31">
      </div>

      <div class="profilColumn">
        <p class="profilFontRight">Abreisedatum:</p>
        <input class="profilFontRight halfLength" style="color: black" type="date" name="abreise" value="2023-02-01"
          min="2024-02-01" max="2124-12-31">
      </div>

      <h2>Wählen Sie Art des Zimmers:</h2>
      <div class="container">
        <div class="row">
          <div class="col-md">
            <label>
              <input type="radio" name="room" value="1" checked>
              <img src="images/hotelroom1.jpg" class="shadow-1-strong rounded-corners mt-4 profilFontRight"
                alt="Hotelroom for 2">
            </label>
          </div>
          <div class="col-md">
            <label>
              <input type="radio" name="room" value="2">
              <img src="images/hotelroom2.jpg" class="shadow-1-strong rounded-corners mt-4 profilFontRight"
                alt="Hotelroom for 2">
            </label>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-md">
            <label>
              <input type="radio" name="room" value="3">
              <img src="images/hotelroom3.jpg" class="shadow-1-strong rounded-corners mt-4 profilFontRight"
                alt="Hotelroom for 2">
            </label>
          </div>
          <div class="col-md">
            <label>
              <input type="radio" name="room" value="4">
              <img src="images/hotelroom4.jpg" class="shadow-1-strong rounded-corners mt-4 profilFontRight"
                alt="Hotelroom for 2">
            </label>
          </div>
        </div>
      </div>

      <h2>Wählen Sie zusätzliche Dienste:</h2>
      <div class="profilColumn profilFontLeft">
        <input type="checkbox" name="breakfast" value="Ja" style="color: black">
        <label for="breakfast">Frühstück</label>
      </div>
      <div class="profilColumn profilFontRight">
        <input type="checkbox" name="parkplatz" value="Ja" style="color: black">
        <label for="Parkplatz">Parkplatz</label>
      </div>
      <div class="profilColumn profilFontLeft">
        <input type="checkbox" name="haustiere" value="Ja" style="color: black">
        <label for="Haustiere">Haustiere</label>
      </div>
      <div class="profilColumn profilFontRight">
        <input type="checkbox" name="fernseher" value="Ja" style="color: black">
        <label for="Fernseher">Fernseher</label>
      </div>
      <button type="submit" name="submitReservierung" value="abgeschickt" class="margin50">
        Reservieren
      </button>
    </form>
    <?php
  }
  ?>
</body>

</html>