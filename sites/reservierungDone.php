  <!-- _____________________________ZIMMER RESERVIERUNG_____________________________ -->
  <?php
  //Code wird nur beachtet wenn Wert "submit" nicht leer ist
  if (!empty($_POST["submitReservierung"])) {
    $anreise = $_POST["anreise"];
    $abreise = $_POST["abreise"];
    $zimmer = $_POST["room"];
    $user_id = $_SESSION['id'];
    if (isset($_POST["breakfast"])) {
      $breakfast = $_POST["breakfast"];
    } else {
      $breakfast = "Nein";
    }
    if (isset($_POST["parkplatz"])) {
      $parkplatz = $_POST["parkplatz"];
    } else {
      $parkplatz = "Nein";
    }
    if (isset($_POST["haustiere"])) {
      $haustiere = $_POST["haustiere"];
    } else {
      $haustiere = "Nein";
    }
    if (isset($_POST["fernseher"])) {
      $fernseher = $_POST["fernseher"];
    } else {
      $fernseher = "Nein";
    }
    $currentDateTime = date('Y-m-d H:i:s');

    ?>
    <h1>Danke für Ihre Reservierung! Wir freuen uns auf Sie!</h1>
    <hr style="border-color: white;">
<div class="row">
    <div class="profilColumn">
        <p class="profilFontLeft">Zimmer Nummer:</p>
    </div>
    <div class="profilColumn">
        <p class="reservFontRight"><?php echo "$zimmer"?></p>
    </div>

    <div class="profilColumn">
        <p class="profilFontLeft">Parkplatz:</p>
    </div>
    <div class="profilColumn">
        <p class="reservFontRight"><?php echo "$parkplatz"?></p>
    </div>

    <div class="profilColumn">
        <p class="profilFontLeft">Frühstück:</p>
    </div>
    <div class="profilColumn">
        <p class="reservFontRight"><?php echo "$breakfast"?></p>
    </div>

    <div class="profilColumn">
        <p class="profilFontLeft">Haustiere:</p>
    </div>
    <div class="profilColumn">
        <p class="reservFontRight"><?php echo "$haustiere"?></p>
    </div>

    <div class="profilColumn">
        <p class="profilFontLeft">Fernseher:</p>
    </div>
    <div class="profilColumn">
        <p class="reservFontRight"><?php echo "$fernseher"?></p>
    </div>

    <div class="profilColumn">
        <p class="profilFontLeft">Anreise:</p>
    </div>
    <div class="profilColumn">
        <p class="reservFontRight"><?php echo "$anreise"?></p>
    </div>

    <div class="profilColumn">
        <p class="profilFontLeft">Abreise:</p>
    </div>
    <div class="profilColumn">
        <p class="reservFontRight"><?php echo "$abreise"?></p>
    </div>

    <div class="profilColumn">
        <p class="profilFontLeft">Zeitpunkt der Buchung:</p>
    </div>
    <div class="profilColumn">
        <p class="reservFontRight"><?php echo "$currentDateTime"?></p>
    </div>
    </div>
</div>
<hr style="border-color: white;">
    <?php
    include __DIR__ . '/../includes/dbaccess.php';
    $query = mysqli_query($con, "INSERT INTO tbl_reservierungen (`reserv_nummer`, `reserv_zimmer_nummer`, `reserv_parkplatz`, `reserv_breakfast`, `reserv_haustiere`, `reserv_fernseher`, `reserv_datumAn`, `reserv_datumAb`, `reserv_zeitpunkt`, `reserv_id`) 
        VALUES (NULL, '$zimmer', '$parkplatz', '$breakfast', '$haustiere', '$fernseher', '$anreise', '$abreise', '$currentDateTime', '$user_id')");
    //echo "$con->error";
    ?>
    <div class="center">
      <a href="index.php?menu=reservierung">
        <button type="button">Weitere Reservierungen machen</button></a>
    </div>
    <?php
  } ?>