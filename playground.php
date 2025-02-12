<?php

$tel = '+32 (0)4/666 66 66';

var_dump(is_numeric(str_replace(['+', '(', ')', ' '], '', $tel)));

$salutations = 'Bonjour %s';

$message = sprintf($salutations, 'Dominique');

echo $message;