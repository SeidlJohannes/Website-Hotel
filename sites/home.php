<?php
if (!isset($_SESSION)) {
  session_start();
}
error_reporting(E_ALL); //Fehlermeldungen aktivieren
//ini_set('display_errors','On'); //Zusatzeinstellung: Error wird ausgegeben

$navigation = getNavigation('Home');
?>
<!DOCTYPE html>
<html lang="de">

<body> <!-- style="height: 2000px;" -->
  <img src="images/Friedrichshafen.png" class="img-fluid centered-img" alt="Hotel Friedrichshafen">
  <!--img-fluid makes picture responsive-->
  <?php
  if (isset($_SESSION['username'])) {
    $benutzername = $_SESSION['username'] ?>
    <h1>Herzlich Willkommen,
      <?php echo "$benutzername" ?>!
    </h1>
  <?php } ?>
  <!-- _____________________________LOGIN_____________________________ -->
  <?php
  if (!empty($_POST["submitLogin"])) {

    $benutzername = $_POST["username"];
    $passwort = $_POST["password"];

    include __DIR__ . '/../includes/dbaccess.php';
    //Durchsucht Benutzernamen
    $result = mysqli_query($con, "SELECT * FROM `tbl_kontaktdaten` WHERE user_benutzername = '$benutzername'");

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC); //Fetch_array durchsucht nur Zeilen
    $benutzername_existent = mysqli_num_rows($result); //Zählt Reihen in denen Username und Passwort vorkommen ( 0 oder 1)
    if ($benutzername_existent == 1) {
      //Check if password is correct
      if ($row["user_status"] == "Inaktiv") {
        ?>
        <h1>Ihr Account ist inaktiv, bitte wenden Sie sich an einen Administrator!</h1>
        <?php
      } else if (password_verify($passwort, $row["user_passwort"])) {
        //Get user details to store them in Session variables for later use
        $_SESSION['id'] = $row["user_id"];
        $_SESSION['anrede'] = $row["user_anrede"];
        $_SESSION['vorname'] = $row["user_vorname"];
        $_SESSION['nachname'] = $row["user_nachname"];
        $_SESSION['email'] = $row["user_email"];
        $_SESSION['username'] = $benutzername;
        //Dont store password in session
        //$_SESSION['passwort'] = $row["user_passwort"];
        echo "<script>location.href='index.php?menu=home'</script>"; //refreshes page to change Anmelden to Abmelden
      } else { ?>
          <h1>Das Passwort stimmt nicht mit dem Benutzer überein</h1>
      <?php }
    } else { ?>
      <h1>Der angegebene Benutzername existiert nicht</h1>
    <?php }
  } ?>

  <!-- _____________________________REGISTRIERUNG_____________________________ -->
  <?php
  //Code wird nur beachtet wenn Wert "submit" nicht leer ist
  if (!empty($_POST["submitRegistration"])) {

    $user_anrede = $_POST["user_anrede"];
    $user_vorname = $_POST["user_vorname"];
    $user_nachname = $_POST["user_nachname"];
    $user_email = $_POST["user_email"];
    $user_benutzername = $_POST["user_benutzername"];
    $user_passwort = $_POST["user_passwort"];
    $user_passwort_confirm = $_POST["user_passwort_confirm"];

    $hashed_passwort = password_hash($user_passwort, PASSWORD_DEFAULT);

    include __DIR__ . '/../includes/dbaccess.php';

    $result = mysqli_query($con, "SELECT * FROM `tbl_kontaktdaten` WHERE user_benutzername = '$user_benutzername'");

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC); //Fetch_array durchsucht nur Zeilen
    $count_benutzername = mysqli_num_rows($result); //Zählt Reihen in denen Username und Passwort vorkommen ( 0 oder 1)
    if ($count_benutzername == 1) { ?>
      <h1>Der Benutzername ist leider bereits vergeben!</h1>
    <?php } else {
      if ($user_passwort_confirm == $user_passwort) {
        mysqli_query($con, "INSERT INTO `tbl_kontaktdaten` (`user_id`, `user_anrede`, `user_vorname`, `user_nachname`, `user_email`, `user_benutzername`, `user_passwort`) 
              VALUES (NULL, '$user_anrede', '$user_vorname', '$user_nachname', '$user_email', '$user_benutzername', '$hashed_passwort')");
        ?>
        <h1>Danke für Ihre Registrierung! Sie können sich nun anmelden.</h1>
      <?php } else { ?>
        <h1>Passwörter stimmen nicht überein!</h1>
      <?php }
    }
  } ?>
  <!--_____________________________NEWS DISPLAY_____________________________ -->
  <div style="overflow-x:auto;" class ="centered-text">
      <?php require_once 'includes/dbaccess.php';
      $sql = "SELECT news_id, news_image, news_text, news_date FROM tbl_news
                ORDER BY news_id DESC";
      $result = $con->query($sql);

      if (!$result) {
        die("Ошибка выполнения SQL-запроса: " . $con->error);
      }

      //Populating table with data from the database
      $selected_anrede = $selected_privileges = $selected_status = "";
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) { ?>
          <?php if (isset($_SESSION['users_errors'][$row['news_id']])) {
            $errors = $_SESSION['users_errors'][$row['news_id']];
            var_dump($errors);
            unset($_SESSION['users_errors'][$row['news_id']]);
            foreach ($errors as $error) {
              if ($error != "") {
                echo "<div class='alert alert-danger'>" . "Der Fehler mit der Benutzer-ID {$row['user_id']}: " . htmlspecialchars($error) . "</div>";
              }
            }
          } ?>
          <div>
          <hr style="border-color: white;">
          Newsbeitrag vom <?php echo $row['news_date']?>
          <img src="uploads/<?php echo $row['news_image']?>" class="img-fluid centered-img" alt="News Beitrag">
          <?php echo $row['news_text']; ?>

          </div> <?php
        }
      }
      else{
        echo "Aktuell gibt es keine News";
      }
      ?>
      </div>




        <!--
  _____________________________CAROUSEL_____________________________ 
  <div id="myCarousel" class="carousel slide centered-text" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="../uploads/news_frozen_shopkeeper.png" alt="First slide">
      </div>
      <div class="carousel-item">
        <img src="../uploads/caesar.jpg" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img src="../uploads/brain_meme.jpg" alt="Third slide">
      </div>
    </div>

    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  </div>
  -->
</body>

</html>