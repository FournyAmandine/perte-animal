<?php

/** @var array $countries */
session_start();

require './vendor/autoload.php';

use Tecgdcs\Animal\Validator;

$countries = require './config/countries.php';
require './core/validation.php';
require './core/Validator.php';

$email = '';
$vemail = '';
$telephone = '';

Validator::check([
    'email' => 'required|email',
    'vemail' => 'required|same:email',
    'phone' => 'telephone',
    'country' => 'in_collection:countries',
]);

/*Validator::required('email');
Validator::required('vemail');
Validator::email('email');
Validator::same('vemail', 'email');
Validator::phone('telephone');
Validator::in_collection('country', 'countries', $countries);*/


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
