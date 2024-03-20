<?php
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ALL); //Fehlermeldungen aktivieren
ini_set('display_errors', 'On'); //Zusatzeinstellung: Error wird ausgegeben

include 'includes/navbar_active.php'; //Zugriff auf Funktion
$menu = @$_GET['menu'];
if(!isset($_GET['menu'])){
    $menu = "home";
}
switch ($menu) {
    case 'home':
        $navigation = getNavigation('Home');
        $title = 'Home';
        break;
    case 'impressum':
        $navigation = getNavigation('Impressum');
        $title = 'Impressum';
        break;
    case 'playground':
        $navigation = getNavigation('Playground');
        $title = 'Playground';
        break;
    case 'loginFirst':
        $navigation = getNavigation('Reservierung');
        $title = 'Reservierung';
        break;
    case 'reservierung':
        $navigation = getNavigation('Reservierung');
        $title = 'Reservierung';
        break;
    case 'adminUser':
        $navigation = getNavigation('SeeUser');
        $title = 'SeeUser';
        break;
    case 'adminReservierung':
        $navigation = getNavigation('SeeReserv');
        $title = 'SeeReserv';
        break;
    case 'adminNews':
        $navigation = getNavigation('adminNews');
        $title = 'adminNews';
        break;
    case 'help':
        $navigation = getNavigation('Help');
        $title = 'Hilfe';
        break;
    case 'logout':
        $navigation = getNavigation('Logout');
        break;
    case 'profil':
        $navigation = getNavigation('Profil');
        $title = 'Profil';
        break;
    case 'profilEdit':
        $navigation = getNavigation('Profil');
        $title = 'Bearbeiten';
        break;
}

//$title = 'home';
?>
<!DOCTYPE html>
<html lang="de">
<?php include 'includes/header.php' ?>

<body> <!-- style="height: 2000px;" -->
    <?php include 'includes/navbar.php' ?>
    <?php

    // All PHP-Pages are included using "include"
    switch ($menu) {
        case 'home':
            include 'sites/home.php';
            break;
        case 'impressum':
            include 'sites/impressum.php';
            break;
        case 'playground':
            include 'sites/playground.php';
            break;
        case 'reservierung':
            include 'sites/reservierung.php';
            break;
        case 'adminUser':
            include 'sites/adminUser.php';
            break;
        case 'adminReservierung':
            include 'sites/adminReservierung.php';
            break;
        case 'adminNews':
            include 'sites/adminNews.php';
            break;
        case 'help':
            include 'sites/help.php';
            break;
        case 'loginFirst':
            include 'sites/loginFirst.php';
            break;
        case 'login':
            include 'sites/login.php';
            break;
        case 'logout':
            include 'sites/logout.php';
            break;
        case 'profil':
            include 'sites/profil.php';
            break;
        case 'profilEdit':
            include 'sites/profilEdit.php';
            break;
    }

    
    ?>




</body>

</html>