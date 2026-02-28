<?php

/**
 * Gets a POST var
 * @param mixed $variable Variable name
 * @return mixed
 */
function getPOST($variable): mixed {
    return isset($_POST[$variable]) ? $_POST[$variable] : null;
}

/****
 * Gets a GET var
 * @param mixed $variable Variable name
 * @return mixed
 */
function getGET($variable): mixed {
    return isset($_GET[$variable]) ? $_GET[$variable] : null;
}

/**
 * Gets a variable from POST or GET (POST takes precedence)
 * @param mixed $variable Variable name
 * @return mixed
 */
function getvar($variable): mixed {
    $var = getPOST($variable);
    if ($var === null) {
        $var = getGET($variable);
    }
    return $var;
}
