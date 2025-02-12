<?php
$messages = require __DIR__ . '/../lang/fr/validation.php';

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


if (!function_exists('check_in_collection')) {
    function check_in_collection(string $item_field_name, $collection_name, array $collection): bool
    {
        global $messages;
        if (!array_key_exists($_REQUEST['country'], $collection)) {
            $_SESSION['errors'][$item_field_name] = sprintf($messages['in_collection'], $item_field_name, $collection_name);
            return false;
        }
        return true;
    }
}

if (!function_exists('check_same')) {
    function check_same(string $verification_field_name, $original_field_name): bool
    {

    }
}
