<?php
session_start();
$countries = require './config/countries.php';
?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
        <script defer src="/js/main.js"></script>
        <title>Formulaire de déclaration de perte d'animal</title>
    </head>
    <body>
    <h1>Déclaration de la perte de mon animal</h1>
    <form action="/process.php" method="post">
        <fieldset>
            <legend>Vos coordonnées</legend>
            <div>
                <label for="email">Email</label>
                <input type="email" id="email"
                    <?php if (isset($_SESSION['old']['email'])): ?>
                        value="<?= $_SESSION['old']['email'] ?>"
                    <?php endif; ?>
                       name="email" required>
            </div>
            <?php if (isset($_SESSION['error']['email'])): ?>
                <div>
                    <?= $_SESSION['error']['email']; ?>
                </div>
            <?php endif; ?>
            <div>
                <label for="vemail">Vérification de l'email</label>
                <input type="email"
                       id="vemail"
                    <?php if (isset($_SESSION['old']['vemail'])): ?>
                        value="<?= $_SESSION['old']['vemail'] ?>"
                    <?php endif; ?>
                       name="vemail" required>
            </div>
            <?php if (isset($_SESSION['errors']['vemail'])): ?>
                <div>
                    <?= $_SESSION['errors']['vemail']; ?>
                </div>
            <?php endif; ?>
            <div>
                <label for="telephone">Téléphone <small> par exemple&nbsp; :+32 (0)4 666 66 66</small></label>
                <input type="tel"
                       id="telephone"
                    <?php if (isset($_SESSION['old']['telephone'])): ?>
                        value="<?= $_SESSION['old']['telephone'] ?>"
                    <?php endif; ?>
                       name="telephone" placeholder="0499 10 10 10">
            </div>
            <?php if (isset($_SESSION['errors']['telephone'])): ?>
                <div>
                    <p><?= $_SESSION['errors']['telephone']; ?></p>
                </div>
            <?php endif; ?>
            <div>
                <label for="country">Pays</label>
                <select name="country" id="country">
                    <?php foreach ($countries as $code => $country): ?>
                        <option value="<?= $code ?>"
                            <?php if (isset($_SESSION['old']['country']) && $_SESSION['old']['country'] === $code): ?>
                                selected
                            <?php endif; ?>
                        ><?= $country ?></option>
                        <!--<option value="Ru">Royaume-Uni</option>
                        <option value="Fr">France</option>
                        <option value="Pb">Pays-Bas</option>
                        <option value="Al">Allemagne</option>-->
                    <?php endforeach; ?>
                </select>
            </div>
            <?php if (isset($_SESSION['errors']['country'])): ?>
                <div>
                    <p><?= $_SESSION['errors']['country']; ?></p>
                </div>
            <?php endif; ?>
        </fieldset>
        <fieldset>
            <legend>
                Description de l'animal perdu
            </legend>
            <div>
                <label for="animal">Type d'animal</label>
                <select name="animal" id="animal">
                    <option value="Ch">Chien</option>
                    <option value="Cha">Chat</option>
                    <option value="Pe">Perroquet</option>
                    <option value="La">Lapin</option>
                </select>
            </div>
            <div>
                <label for="name">Nom de l'animal</label>
                <input type="text" id="name" name="name" value="" placeholder="Rex" required>
            </div>
            <div>
                <label for="puce">Puce (obligatoire si chien)</label>
                <input type="text" id="puce" name="puce" placeholder="1234567890" value="">
            </div>
            <div class="sexe">
                <label for="sexe">Sexe</label>
                <input type="radio" id="sexe" name="sexe" value="Mâle">
                <label for="sexe">Mâle</label>
                <input type="radio" id="sexe" name="sexe" value="Femelle">
                <label for="sexe">Femelle</label>
            </div>
            <div>
                <label for="age">Âge (estimation)</label>
                <input type="number" id="age" name="age" placeholder="5" value="">
            </div>
            <div>
                <label for="race">Race</label>
                <input type="text" id="race" name="race" value="" placeholder="caniche">
            </div>
            <div>
                <label for="tatoo">Tatouage</label>
                <select name="tatoo" id="tatoo">
                    <option value="Be">Oreille gauche</option>
                    <option value="Ru">Oreille droite</option>
                </select>
                <label for="code">Code tatouage</label>
                <input type="text" id="code" name="code" value="" placeholder="B999AA">
            </div>
            <div class="description">
                <label for="description">Description / Signes particuliers</label>
                <textarea name="description" id="description" cols="30" rows="10"></textarea>
            </div>
            <div>
                <label for="image">Photo de l'animal</label>
                <input type="file" name="image" id="image">
            </div>
        </fieldset>
        <fieldset>
            <legend>Date et localité de la perte</legend>
            <div>
                <label for="date">Date</label>
                <input type="date" id="date" name="date">
            </div>
            <div>
                <label for="heure">Heure</label>
                <input type="time" id="heure" name="heure">
            </div>
            <div>
                <label for="postal">Code postal</label>
                <input type="text" id="postal" name="postal" placeholder="4000">
            </div>
            <div>
                <label for="country">Pays</label>
                <select name="country" id="country">
                    <option value="Be">Belgique</option>
                    <option value="Ru">Royaume-Uni</option>
                    <option value="Fr">France</option>
                    <option value="Pb">Pays-Bas</option>
                    <option value="Al">Allemagne</option>
                </select>
            </div>
        </fieldset>
        <button type="submit">
            Déclarer la disparition
        </button>
    </form>

    </body>
    </html>

<?php $_SESSION['errors'] = null;
$_SESSION['old'] = null;

