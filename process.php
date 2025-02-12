<?php
/*echo '';*/
/*var_dump($_POST);*/
/*echo $_REQUEST['name'];*/

/** @var array $countries */
session_start();
$countries = require './config/countries.php';
require './core/validation.php';

check_required('email');
check_required('vemail');
check_email('email');
check_phone('telephone');
check_in_collection('country', 'countries', $countries);
var_dump($_SESSION); die();
check_same('vemail', 'email');
/*check_min('telephone', 9); */

$email = '';
$vemail = '';
$telephone = '';

if (array_key_exists('email', $_REQUEST)) {
    $email = trim($_REQUEST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['errors']['email'] = 'L‘email proposé n‘est pas valide';
    }
} else {
    $_SESSION['errors']['email'] = 'L‘email devrait être fourni';

}

if (array_key_exists('vemail', $_REQUEST)) {
    $vemail = trim($_REQUEST['vemail']);
    if ($email !== $vemail) {
        $_SESSION['errors']['vemail'] = 'La vérification de l‘email a échouée';
    }
} else {
    $_SESSION['errors']['vemail'] = 'Vous devez répéter votre email';

}

if (array_key_exists('telephone', $_REQUEST) && (strlen($_REQUEST['telephone']) < 9 && !is_numeric(str_replace(['+', '(', ')', ' '], '', $telephone)))) {
    $_SESSION['errors']['telephone'] = 'Le format du téléphone est incorrect';
}

if (array_key_exists('country', $_REQUEST)) {
    if (!array_key_exists($_REQUEST['country'], $countries)) {
        $_SESSION['errors']['country'] = 'Le pays n‘est pas valide';
    }
}

if (!is_null($_SESSION['errors'])) {
    $_SESSION['old'] = $_REQUEST;
    header('Location: /index.php');
    exit;
}

?>


<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <title>Merci</title>
</head>
<body>
<h1>Merci</h1>
<p>J'ai bien reçu les infos</p>
<dl>
    <div>
        <dt>
            Email
        </dt>
        <dd>
            <?= $email; ?>
        </dd>
    </div>
    <div>
        <dt>
            Télephone
        </dt>
        <dd>
            <?= $telephone; ?>
        </dd>
    </div>
    <div>
        <dt>
            Pays
        </dt>
        <dd>
            <?= $country; ?>
        </dd>
    </div>
</dl>
</body>
</html>
