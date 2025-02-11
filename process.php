<?php
/*echo '';*/
/*var_dump($_POST);*/
/*echo $_REQUEST['name'];*/

session_start();


$email = '';
$vemail = '';
$telephone = '';
$country = '';
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

if (array_key_exists('telephone', $_REQUEST)) {
    $telephone = trim($_REQUEST['telephone']);
    if (!ctype_digit($telephone)) {
        $_SESSION['errors']['telephone'] = 'La vérification du téléphone est incorrect';
    }
} else {
    $_SESSION['errors']['telephone'] = 'Vous devez entrer un numéro de téléphone';

}

if (array_key_exists('country', $_REQUEST)) {
    $country = trim($_REQUEST['country']);
    if (!in_array($country, ['Be' => 'Belgique', 'Ru' => 'Royaume-Uni', 'Fr' => 'France', 'Pb' => 'Pays-Bas', 'Al' => 'Allemagne'])) {
        $_SESSION['errors']['country'] = 'Le pays n‘est pas valide';
    }
} else{
    $_SESSION['errors']['country'] = 'Il n‘y a pas de pays';
}

if (isset($_SESSION['errors']) && count($_SESSION['errors'])) {
    $_SESSION['old'] = $_REQUEST;
    header('Location: /index.php');
}

?>


<html lang="en">
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
