<?php
global $animals;
$messages = require __DIR__ . '/../lang/fr/validation.php';
/*$animals = require '/../config/animals.php';*/

if (!function_exists('check_required')) {
    function check_required(string $field_name): bool
    {
        global $messages;
        if (!array_key_exists($field_name, $_REQUEST)) {
            $_SESSION['errors'][$field_name] = sprintf($messages['required'], $field_name);
            return false;
        }
        if (trim($_REQUEST[$field_name]) === '') {
            $_SESSION['errors'][$field_name] = sprintf($messages['required'], $field_name);
            return false;
        }
        return true;
    }
}

if (!function_exists('check_email')) {
    function check_email(string $field_name): bool
    {
        if (!check_required($field_name)) {
            global $messages;
            if (!filter_var($_REQUEST[$field_name], FILTER_VALIDATE_EMAIL)) {
                $_SESSION['errors'][$field_name] = sprintf($messages['email'], $field_name);
                return false;
            }
        }
        return true;
    }
}


if (!function_exists('check_phone')) {
    function check_phone(string $field_name): bool
    {
        if (isset($_REQUEST[$field_name]) || trim($_REQUEST[$field_name]) === '') {
            return false;
        }

        global $messages;
        if (strlen($_REQUEST['telephone']) < 9) {
            $_SESSION['errors'][$field_name] = sprintf($messages['phone'], $field_name);
            return false;
        }


        if (!is_numeric(str_replace(['+', '(', ')', ' '], '', $field_name))) {
            $_SESSION['errors'][$field_name] = sprintf($messages['phone'], $field_name);
            return false;
        }
        return true;
    }
}

if (!function_exists('check_same')) {
    function check_same(string $verification_field_name, string $original_field_name): bool
    {
        if (array_key_exists($verification_field_name, $_REQUEST) &&
            array_key_exists($original_field_name, $_REQUEST)) {
            global $messages;
            if (trim($_REQUEST[$verification_field_name]) !== trim($_REQUEST[$original_field_name])) {
                $_SESSION['errors'][$verification_field_name] =
                    sprintf($messages['same'], $verification_field_name, $original_field_name);
                return false;
            }
            return true;
        }

        return false;
    }
}

if (!function_exists('check_in_collection')) {
    function check_in_collection(string $field_name, string $collection_name, array $collection): bool
    {
        if (array_key_exists($field_name, $_REQUEST) &&
            trim($_REQUEST[$field_name]) !== '' &&
            !array_key_exists($_REQUEST[$field_name], $collection)) {
            global $messages;
            $_SESSION['errors'][$field_name] =
                sprintf($messages['in_collection'], $field_name, $collection_name);
            return false;
        }

        return true;
    }
}

if (!function_exists('check_name')) {
    function check_name(string $field_name): bool
    {
        if (!check_required($field_name)) {
            global $messages;
            if (!ctype_alpha($_REQUEST[$field_name])) {
                $_SESSION['errors'][$field_name] = sprintf($messages['name'], $field_name);
                return false;
            }
        }
        return true;
    }
}

if (!function_exists('check_puce')) {

    foreach ($animals as $letter => $animal) {
        if ($letter === 'CH') {
            function check_puce(string $field_name): bool
            {
                if (!check_required($field_name)) {

                    global $messages;
                    if (strlen($_REQUEST['puce']) < 10) {
                        $_SESSION['errors'][$field_name] = sprintf($messages['puce'], $field_name);
                        return false;
                    }

                    if (!is_numeric(str_replace([':', '.', '-', ' '], '', $field_name))) {
                        $_SESSION['errors'][$field_name] = sprintf($messages['puce'], $field_name);
                        return false;
                    }
                    return true;
                }
                return false;
            }
        } else {
            if (!function_exists('check_puce')) {
                function check_puce(string $field_name): bool
                {
                    if (isset($_REQUEST[$field_name]) || trim($_REQUEST[$field_name]) === '') {
                        return false;
                    }

                    global $messages;
                    if (strlen($_REQUEST['puce']) < 9) {
                        $_SESSION['errors'][$field_name] = sprintf($messages['puce'], $field_name);
                        return false;
                    }


                    if (!is_numeric(str_replace([':', '.', '-', ' '], '', $field_name))) {
                        $_SESSION['errors'][$field_name] = sprintf($messages['puce'], $field_name);
                        return false;
                    }
                    return true;
                }
            }
        }
    }
}