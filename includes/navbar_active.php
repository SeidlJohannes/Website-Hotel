<?php
//Parameter $activeElement muss mit Typ angegeben werden
//'home' ist hier der default Wert, auf der Home Seite kann ich den Parameter also weglassen
function getNavigation(string $activeElement /* = 'Home'*/): array
{
    /* 
    !!!WICHTIG!!!
    Bei neuem Element muss auch in index.php das Element dazugegeben werden
    */
    $navigation = [];

    $navigationElement = [
        'label' => 'Home',
        'target' => 'index.php?menu=home',
        'active' => false
    ];
    $navigation['Home'] = $navigationElement;

    $navigationElement = [
        'label' => 'Impressum',
        'target' => 'index.php?menu=impressum',
        'active' => false
    ];
    $navigation['Impressum'] = $navigationElement;

    $navigationElement = [
        'label' => 'Reservierung',
        'target' => 'index.php?menu=reservierung',
        'active' => false
    ];
    $navigation['Reservierung'] = $navigationElement;
    /*
            $navigationElement = [
                'label' => 'Playground',
                'target' => 'index.php?menu=playground',
                'active' => false
            ];

            $navigation['Playground'] = $navigationElement;
    */

    if (isset($_SESSION['username'])) {
        if ($_SESSION['username'] == "admin") {
            $navigationElement = [
                'label' => 'SeeUser',
                'target' => 'index.php?menu=adminUser',
                'active' => false
            ];
            $navigation['SeeUser'] = $navigationElement;

            $navigationElement = [
                'label' => 'SeeReserv',
                'target' => 'index.php?menu=adminReservierung',
                'active' => false
            ];
            $navigation['SeeReserv'] = $navigationElement;

            $navigationElement = [
                'label' => 'adminNews',
                'target' => 'index.php?menu=adminNews',
                'active' => false
            ];
            $navigation['adminNews'] = $navigationElement;
        }
    }

    $navigationElement = [
        'label' => NULL,
        'target' => 'index.php?menu=help',
        'active' => false
    ];
    $navigation['Help'] = $navigationElement;

    $navigationElement = [
        'label' => NULL,
        'target' => 'index.php?menu=logout',
        'active' => false
    ];
    $navigation['Logout'] = $navigationElement;

    $navigationElement = [
        'label' => NULL,
        'target' => 'index.php?menu=profil',
        'active' => false
    ];
    $navigation['Profil'] = $navigationElement;

    $navigationElement = [
        'label' => NULL,
        'target' => 'index.php?menu=profilEdit',
        'active' => false
    ];
    $navigation['Profil'] = $navigationElement;

    //Wenn das richtige Element gefunden wird wird es active gesetzt
    $navigation[$activeElement]['active'] = true;
    return $navigation;
}
?>