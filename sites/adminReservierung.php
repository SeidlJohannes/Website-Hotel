<?php
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ALL); //Fehlermeldungen aktivieren
//ini_set('display_errors','On'); //Zusatzeinstellung: Error wird ausgegeben

?>
<!DOCTYPE html>
<html lang="de">

<body id="reservierungsdaten" class="plain-text">

<!-- _____________________________________________RESERVIERUNGEN ANZEIGEN_____________________________________________ -->
<div style="overflow-x:auto;">
    <?php //var_dump($_POST) ?> <!--Table responsive machen!-->
    <table class="table table-dark mt-5  table-striped table-bordered table-hover table-condensed" name="table">
    <h1>Reservierungen</h1>
        <tr>
            <th>Reservierungsnummer</th>
            <th>Zimmernummer</th>
            <th>Parkplatz</th>
            <th>Frühstück</th>
            <th>Hasutiere</th>
            <th>Fernseher</th>
            <th>Anreisedatum</th>
            <th>Abreisedatum</th>
            <th>Reservierungsdatum</th>
            <th>UserID</th>
        </tr>
        <?php require_once 'includes/dbaccess.php';
        $sql = "SELECT reserv_nummer, reserv_zimmer_nummer, reserv_parkplatz, reserv_breakfast, reserv_haustiere, reserv_fernseher, reserv_datumAn, reserv_datumAb, reserv_Zeitpunkt, reserv_id FROM tbl_reservierungen
                ORDER BY reserv_nummer ASC";
        $result = $con->query($sql);

        if (!$result) {
            die("Ошибка выполнения SQL-запроса: " . $con->error);
        }

        //Populating table with data from the database
        $selected_anrede = $selected_privileges = $selected_status = "";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td>
                        <?php echo $row['reserv_nummer'] ?>
                    </td>
                    <td>
                        <?php echo $row['reserv_zimmer_nummer'] ?>
                    </td>
                    <td>
                        <?php echo $row['reserv_parkplatz'] ?>
                    </td>
                    <td>
                        <?php echo $row['reserv_breakfast'] ?>
                    </td>
                    <td>
                        <?php echo $row['reserv_haustiere'] ?>
                    </td>
                    <td>
                        <?php echo $row['reserv_fernseher'] ?>
                    </td>
                    <td>
                        <?php echo $row['reserv_datumAn'] ?>
                    </td>
                    <td>
                        <?php echo $row['reserv_datumAb'] ?>
                    </td>
                    <td>
                        <?php echo $row['reserv_Zeitpunkt'] ?>
                    </td>
                    <td>
                        <?php echo $row['reserv_id'] ?>
                    </td>
            </tr>
            <?php 
            }
        } else {
            echo "Keine Kontaktdatengespeichert";
        }
        ?>
        </div>
</body>

</html>