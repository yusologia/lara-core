<?php

if (!function_exists("errOccurred")) {
    function errOccurred($internalMsg = "")
    {
        error(500, "An error occurred!", $internalMsg);
    }
}

if (!function_exists("errCredentialIncorrect")) {
    function errCredentialIncorrect($internalMsg = "")
    {
        error(400, "The credentials provided are incorrect!!", $internalMsg);
    }
}

if (!function_exists("errUnableToGenerateToken")) {
    function errUnableToGenerateToken($internalMsg = "")
    {
        error(500, "Unable to generate token", $internalMsg);
    }
}

if (!function_exists("errUserNotFound")) {
    function errUserNotFound($internalMsg = "")
    {
        error(401, "User not found. Please login first!!", $internalMsg);
    }
}

if (!function_exists("errUnauthenticated")) {
    function errUnauthenticated($internalMsg = "")
    {
        error(401, "Your token is invalid. please re-login!!", $internalMsg);
    }
}

if (!function_exists("errUnableToUploadFile")) {
    function errUnableToUploadFile($internalMsg = "")
    {
        error(500, "Unable to upload file", $internalMsg);
    }
}

if (!function_exists("errNumberGeneratorInvalid")) {
    function errNumberGeneratorInvalid($internalMsg = "")
    {
        error(500, "Number generator invalid", $internalMsg);
    }
}

if (!function_exists("errPermissionRestricted")) {
    function errPermissionRestricted($internalMsg = "")
    {
        error(403, "Error. User\'s permission restricted", $internalMsg);
    }
}
