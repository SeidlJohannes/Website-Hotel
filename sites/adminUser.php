<?php
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ALL); //Fehlermeldungen aktivieren
//ini_set('display_errors','On'); //Zusatzeinstellung: Error wird ausgegeben

?>
<!DOCTYPE html>
<html lang="de">

<body id="usersdaten" class="plain-text">
<div style="overflow-x:auto;">
    <?php //var_dump($_POST) ?> 
    <!--Table responsive machen!-->
    <table class="table table-dark mt-5  table-striped table-bordered table-hover table-condensed" name="table">
    <h1>Benutzerdaten</h1>
    <?php 
    if(isset($_SESSION['benutzernameVergeben'])){
        if($_SESSION['benutzernameVergeben'] == 1){ ?>
            <h1>Der gewünschte Benutzername ist leider bereits vergeben!</h1> <?php
        }
    }
    
    ?>
        <tr>
            <th>ID</th>
            <th>Benutzername</th>
            <th>Anrede</th>
            <th>Nachname</th>
            <th>Vorname</th>
            <th>E-mail</th>
            <!--<th>Privileges</th> Privileges müssen nicht geändert werden-->
            <th>Status</th>
            <th>Aktion</th>
        </tr>
        <?php require_once 'includes/dbaccess.php';
        $sql = "SELECT user_id, user_benutzername, user_anrede, user_vorname, user_nachname, user_email, user_status FROM tbl_kontaktdaten
                ORDER BY user_benutzername ASC";
        $result = $con->query($sql);

        if (!$result) {
            die("Ошибка выполнения SQL-запроса: " . $con->error);
        }

        //Populating table with data from the database
        $selected_anrede = $selected_privileges = $selected_status = "";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { ?>
                <?php if (isset($_SESSION['users_errors'][$row['user_id']])) {
                    $errors = $_SESSION['users_errors'][$row['user_id']];
                    var_dump($errors);
                    unset($_SESSION['users_errors'][$row['user_id']]);
                    foreach ($errors as $error) {
                        if ($error != "") {
                            echo "<div class='alert alert-danger'>" . "Der Fehler mit der Benutzer-ID {$row['user_id']}: " . htmlspecialchars($error) . "</div>";
                        }
                    }
                }
                ; ?>
                <tr>
                    <td>
                        <?php echo $row['user_id'] ?>
                    </td>

                    <td>
                        <?php echo $row['user_benutzername'] ?>
                    </td>
                    <td>
                        <?php echo $row['user_anrede'] ?>
                    </td>
                    <td>
                        <?php echo $row['user_nachname'] ?>
                    </td>
                    <td>
                        <?php echo $row['user_vorname'] ?>
                    </td>
                    <td>
                        <?php echo $row['user_email'] ?>
                    </td>
                    <td>
                        <?php echo $row['user_status'] ?>
                    </td>
                    <td>
                        <button type="button" class="button-edit" data-bs-toggle="modal"
                            data-bs-target="#update_users_data_<?php echo $row['user_id']; ?>" title="Bearbeiten"></button>

                        <div class="modal fade" id="update_users_data_<?php echo $row['user_id']; ?>" tabindex="-1"
                            aria-labelledby="update_users_data" aria-hidden="true">
                            <!-- function for error -->
                            <?php  //$errors = getValidationErrors($row['user_id']);
                            
                            ?>
                            <div class="modal-dialog modal-lg modal-dialog modal-dialog-scrollable"> <!-- add responsive -->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Bearbeiten Daten von
                                            <?php echo $row['user_benutzername']?>
                                        </h5> <!-- add name of user -->
                                    </div>
                                    <div class="modal-body">
                                        <form action="index.php?menu=adminUser" method="POST">
                                            <div class="mb-3">
                                                <label for="benutzername" class="form-label">Benutzername</label>
                                                <input type="text" class="form-control" name="change_benutzername" id="change_benutzername"
                                                    placeholder=<?php echo $row['user_benutzername'] ?>>
                                            </div>
                                            <div class="mb-3">
                                                <label for="vorname" class="form-label">Vorname</label>
                                                <input type="text" class="form-control" name="change_vorname" id="change_vorname"
                                                    placeholder=<?php echo $row['user_vorname'] ?>>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nachname" class="form-label">Nachname</label>
                                                <input type="text" class="form-control" name="change_nachname" id="change_nachname"
                                                    placeholder=<?php echo $row['user_nachname'] ?>>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">E-mail</label>
                                                <input type="email" class="form-control" name="change_email" id="change_email"
                                                    placeholder=<?php echo $row['user_email'] ?>>
                                            </div>
                                            <div class="mb-3">
                                                <label for="password1" class="form-label">Neues Passwort wiederstellen</label>
                                                <input type="password" class="form-control" name="change_passwort" id="change_password">
                                            </div>
                                            <div class="mb-3">
                                                <label for="password2" class="form-label">Neues Passwort bestätigen</label>
                                                <input type="password" class="form-control" name="change_passwortCheck" id="change_passwordCheck">
                                            </div>
                                            <div class="mb-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" name="change_status"
                                                        id="change_status <?php echo $row['user_id']; ?>" <?php echo $row["user_status"] === "Aktiv" ? "checked" : "" ?>>
                                                    <label class="form-check-label" for="status">Aktiv</label>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" value=<?php echo $row['user_id'] ?> name="submitBearbeiten"
                                            class="btn btn-primary">Speichern</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
            </div>
                <?php 
            }
        } else {
            echo "Keine Kontaktdatengespeichert";
        }
        ?>
            <!-- _____________________________________________HANDLE USER CHANGES_____________________________________________ -->
            <?php 
if (!empty($_POST["submitBearbeiten"])){

    function check_input($data) {
        $data = trim($data); //löscht space vorne und am ende
        $data = stripslashes($data); //löscht spezialsymbole nach \
        $data = htmlspecialchars($data);// setzt html symbule auf entiteten für sichereit
        return $data;
    }

    $idOfUserToChange = $_POST["submitBearbeiten"];
    //Set variable for id so we can save it for later use
    $change_benutzername = check_input($_POST["change_benutzername"]);
    $change_vorname = check_input($_POST["change_vorname"]);
    $change_nachname = check_input($_POST["change_nachname"]);
    $change_email = check_input($_POST["change_email"]);
    $change_passwort = check_input($_POST["change_passwort"]);
    $change_passwortCheck = check_input($_POST["change_passwortCheck"]);

    $con = mysqli_connect("localhost", "root", ""); //Verbindung mit der Datenbank
    mysqli_select_db($con, "hotel_friedrichshafen");
    $result = mysqli_query($con, "SELECT * FROM `tbl_kontaktdaten` WHERE user_id = '$idOfUserToChange'");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC); //Fetch_array durchsucht nur Zeilen

    //Der User gibt keine Änderung an
    if(isset($_POST["change_status"])){
        mysqli_query($con, "UPDATE `tbl_kontaktdaten` SET `user_status` = 'Aktiv' WHERE user_id = '$idOfUserToChange'");
    }
    else{
        mysqli_query($con, "UPDATE `tbl_kontaktdaten` SET `user_status` = 'Inaktiv' WHERE user_id = '$idOfUserToChange'");
    }
    if(empty($change_vorname) AND empty($change_nachname) AND empty($change_email) AND empty($change_benutzername) AND empty($change_passwort)){
        echo "<script>location.href='index.php?menu=adminUser'</script>";
    } else {
        if (!empty($change_vorname)) {
            mysqli_query($con, "UPDATE `tbl_kontaktdaten` SET `user_vorname` = '$change_vorname' WHERE user_id = '$idOfUserToChange'");
        }
        
        if (!empty($change_nachname)) {
            mysqli_query($con, "UPDATE `tbl_kontaktdaten` SET `user_nachname` = '$change_nachname' WHERE user_id = '$idOfUserToChange'");
        }
        
        if (!empty($change_email)) {
            mysqli_query($con, "UPDATE `tbl_kontaktdaten` SET `user_email` = '$change_email' WHERE user_id = '$idOfUserToChange'");
        }
        
        if (!empty($change_benutzername)) {
            //Checken ob Benutzername nicht schon vergeben ist
            $result = mysqli_query($con, "SELECT * FROM `tbl_kontaktdaten` WHERE user_benutzername = '$change_benutzername'");
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC); //Fetch_array durchsucht nur Zeilen
            $count_benutzername = mysqli_num_rows($result); //Zählt Reihen in denen Username und Passwort vorkommen ( 0 oder 1)
            if($count_benutzername == 1){ //Benutzername ist vergeben
                $_SESSION['benutzernameVergeben'] = 1;
            }
            else{
                $_SESSION['benutzernameVergeben'] = 0;
                mysqli_query($con, "UPDATE `tbl_kontaktdaten` SET `user_benutzername` = '$change_benutzername' WHERE user_id = '$idOfUserToChange'");
            }
        }
        
        if ($change_passwort == $change_passwortCheck and $change_passwort != "") {
            $change_passwort_hashed = password_hash($change_passwort, PASSWORD_DEFAULT);
            mysqli_query($con, "UPDATE `tbl_kontaktdaten` SET `user_passwort` = '$change_passwort_hashed' WHERE user_id = '$idOfUserToChange'");
        }
        echo "<script>location.href='index.php?menu=adminUser'</script>";
    }
} ?>
</body>

</html>