<?php
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ALL); //Fehlermeldungen aktivieren
ini_set('display_errors', 'On'); //Zusatzeinstellung: Error wird ausgegeben
?>
<!DOCTYPE html>
<html lang="de">

<body>
    <?php
    $Sess_anrede = $_SESSION['anrede'];
    $Sess_vorname = $_SESSION['vorname'];
    $Sess_nachname = $_SESSION['nachname'];
    $Sess_email = $_SESSION['email'];
    $Sess_benutzername = $_SESSION['username'];
    ?>
    <div class="imgcontainer">
        <img src="images/login_avatar.png" alt="Avatar" class="avatar" style="max-width: 300px">
    </div>
    <h2>Hier können Sie Ihre Profildaten ansehen und bearbeiten.</h2>
    <hr style="border-color: white;">
    <form method="post" action="index.php?menu=profilEdit">
        <div class="row">
            <div class="profilColumn">
                <p class="profilFontLeft">Anrede:</p>
            </div>
            <div class="profilColumn">
                <select class="profilFontRight halfLength" style="color:grey;" id="anrede" name="change_anrede">
                    <?php
                    if ($Sess_anrede == "Keine Anrede") { ?>
                        <option value="Keine Anrede">Keine Anrede</option>
                        <option value="Herr">Herr</option>
                        <option value="Frau">Frau</option>
                    <?php } else if ($Sess_anrede == "Herr") { ?>
                            <option value="Herr">Herr</option>
                            <option value="Keine Anrede">Keine Anrede</option>
                            <option value="Frau">Frau</option>
                    <?php } else if ($Sess_anrede == "Frau") { ?>
                                <option value="Frau">Frau</option>
                                <option value="Herr">Herr</option>
                                <option value="Keine Anrede">Keine Anrede</option>
                    <?php }
                    ?>
                </select>
            </div>
            <div class="profilColumn">
                <p class="profilFontLeft">Vorname:</p>
            </div>
            <div class="profilColumn">
                <input class="profilFontRight halfLength" style="color: black" type="text"
                    placeholder="<?php echo "$Sess_vorname" ?>" name="user_vorname">
            </div>
            <div class="profilColumn">
                <p class="profilFontLeft">Nachname:</p>
            </div>
            <div class="profilColumn">
                <input class="profilFontRight halfLength" style="color: black" type="text"
                    placeholder="<?php echo "$Sess_nachname" ?>" name="user_nachname">
            </div>
            <div class="profilColumn">
                <p class="profilFontLeft">Email:</p>
            </div>
            <div class="profilColumn">
                <input class="profilFontRight halfLength" style="color: black" type="text"
                    placeholder="<?php echo "$Sess_email" ?>" name="user_email">
            </div>
            <div class="profilColumn">
                <p class="profilFontLeft">Benutzername:</p>
            </div>
            <div class="profilColumn">
                <input class="profilFontRight halfLength" style="color: black" type="text"
                    placeholder="<?php echo "$Sess_benutzername" ?>" name="user_benutzername">
            </div>
            <div class="profilColumn">
                <p class="profilFontLeft">Neues Passwort:</p>
            </div>
            <div class="profilColumn">
                <input class="profilFontRight halfLength" style="color: black" type="text" placeholder="Neues Passwort"
                    name="user_newPasswort">
            </div>
            <div class="profilColumn">
                <p class="profilFontLeft">Aktuelles Passwort:</p>
            </div>
            <div class="profilColumn">
                <input class="profilFontRight halfLength" style="color: black" type="text"
                    placeholder="Aktuelles Passwort" name="user_oldPasswort">
            </div>

        </div>
        <button class="margin50" type="submit" name="submitChanges" value="abgeschickt">
            Änderungen speichern
        </button>
    </form>
    <button class="margin50" onclick="document.getElementById('id02').style.display='block'">Delete Account</button>

    <div id="id02" class="modal">
        <form class="modal-content" action="index.php?menu=profilEdit" method="post">
            <div class="container">
                <h1>Delete Account</h1>
                <p class="plain-text">Are you sure you want to delete your account?</p>
                <!-- <p class="plain-text">Your account will be gone forever and cannot be recovered</p> -->
                <div class="clearfix">
                    <button type="button" class="cancelbtn"
                        onclick="document.getElementById('id02').style.display='none'">Cancel</button>
                    <button type="submit" class="deletebtn" name="deleteConfirm" value=<?php echo $_SESSION['id'] ?>>Delete</button>
                </div>
            </div>
        </form>
    </div>
    <hr style="border-color: white;">
</body>
<!-- __________________________________________________________________DELETE ACCOUNT__________________________________________________________________ -->
<?php
if (!empty($_POST["deleteConfirm"])) {
    $currentID = $_POST['deleteConfirm'];
    echo $currentID;
    $con = mysqli_connect("localhost", "root", ""); //Verbindung mit der Datenbank
    mysqli_select_db($con, "hotel_friedrichshafen");
    //Delete reservations made by this account
    mysqli_query($con, "DELETE FROM `tbl_reservierungen` WHERE reserv_id = $currentID");
    //Delete the account
    mysqli_query($con, "DELETE FROM `tbl_kontaktdaten` WHERE user_id = $currentID");
    include __DIR__ . '/logout.php';
}
?>

<!-- __________________________________________________________________EDIT PROFILE__________________________________________________________________ -->
<?php
if (!empty($_POST["submitChanges"])) {
    $change_anrede = $_POST["change_anrede"];
    $change_vorname = $_POST["user_vorname"];
    $change_nachname = $_POST["user_nachname"];
    $change_email = $_POST["user_email"];
    $change_benutzername = $_POST["user_benutzername"];
    $change_newPasswort = $_POST["user_newPasswort"];
    $change_oldPasswort = $_POST["user_oldPasswort"];

    $con = mysqli_connect("localhost", "root", ""); //Verbindung mit der Datenbank
    mysqli_select_db($con, "hotel_friedrichshafen");
    $result = mysqli_query($con, "SELECT * FROM `tbl_kontaktdaten` WHERE user_benutzername = '$Sess_benutzername'");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC); //Fetch_array durchsucht nur Zeilen
    //Der User gibt keine Änderung an
    if ($change_anrede == $Sess_anrede and empty($change_vorname) and empty($change_nachname) and empty($change_email) and empty($change_benutzername) and empty($change_newPasswort)) {
        echo "<script>location.href='index.php?menu=profil'</script>";
    } else {
        if ($change_anrede != $Sess_anrede) {
            mysqli_query($con, "UPDATE `tbl_kontaktdaten` SET `user_anrede` = '$change_anrede' WHERE user_benutzername = '$Sess_benutzername'");
            $_SESSION['anrede'] = $change_anrede;
        }
        if ($change_vorname != $Sess_vorname and $change_vorname != "") {
            mysqli_query($con, "UPDATE `tbl_kontaktdaten` SET `user_vorname` = '$change_vorname' WHERE user_benutzername = '$Sess_benutzername'");
            $_SESSION['vorname'] = $change_vorname;
        }
        if ($change_nachname != $Sess_nachname and $change_nachname != "") {
            mysqli_query($con, "UPDATE `tbl_kontaktdaten` SET `user_nachname` = '$change_nachname' WHERE user_benutzername = '$Sess_benutzername'");
            $_SESSION['nachname'] = $change_nachname;
        }
        if ($change_email != $Sess_email and $change_email != "") {
            mysqli_query($con, "UPDATE `tbl_kontaktdaten` SET `user_email` = '$change_email' WHERE user_benutzername = '$Sess_benutzername'");
            $_SESSION['email'] = $change_email;
        }
        if ($change_benutzername != $Sess_benutzername and $change_benutzername != "") {
            //Checken ob Benutzername nicht schon vergeben ist
            $result = mysqli_query($con, "SELECT * FROM `tbl_kontaktdaten` WHERE user_benutzername = '$change_benutzername'");
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC); //Fetch_array durchsucht nur Zeilen
            $count_benutzername = mysqli_num_rows($result); //Zählt Reihen in denen Username und Passwort vorkommen ( 0 oder 1)
            if ($count_benutzername == 1) { //Benutzername ist vergeben?>
                <h1>Der gewünschte Benutzername ist leider bereits vergeben!</h1>
            <?php } else {
                mysqli_query($con, "UPDATE `tbl_kontaktdaten` SET `user_benutzername` = '$change_benutzername' WHERE user_benutzername = '$Sess_benutzername'");
                $_SESSION['username'] = $change_benutzername;
                $Sess_benutzername = $_SESSION['username']; //Sess_benutzername muss aktualisiert werden damit Passwortänderungen funktionieren
            }
        }
        if ($change_newPasswort != $Sess_passwort and $change_newPasswort != "") {
            if (password_verify($change_oldPasswort, $Sess_passwort)) {
                $change_newPasswort_hashed = password_hash($change_newPasswort, PASSWORD_DEFAULT);
                mysqli_query($con, "UPDATE `tbl_kontaktdaten` SET `user_passwort` = '$change_newPasswort_hashed' WHERE user_benutzername = '$Sess_benutzername'");
                $_SESSION['passwort'] = $change_newPasswort_hashed;

            } else { ?>
                <h1>Das aktuelle Passwort wurde falsch eingegeben. Bitte versuchen Sie es nochmal.</h1>
            <?php }
        }
        echo "<script>location.href='index.php?menu=profil'</script>";
    }
}
?>

</html>