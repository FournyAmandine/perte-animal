<?php

/** @var array $countries */
session_start();
$countries = require './config/countries.php';
require './core/validation.php';

$email = '';
$vemail = '';
$telephone = '';

check_required('email');
check_required('vemail');
check_email('email');
check_phone('telephone');
check_same('vemail', 'email');
check_in_collection('country', 'countries', $countries);

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
</dl>
</body>
</html>
