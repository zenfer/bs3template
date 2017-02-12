<?php
require_once 'includes/config.php';
require_once 'includes/db_lib.php';
require_once 'includes/user_lib.php';
require_once 'includes/form_lib.php';
require_once 'includes/email_lib.php';



function create_guid() {
    mt_srand((double) microtime() * 10000);
    $charid = strtoupper(md5(uniqid(rand(), true)));
    $hyphen = chr(45); // "-"
    $uuid = substr($charid, 0, 8) . $hyphen
            . substr($charid, 8, 4) . $hyphen
            . substr($charid, 12, 4) . $hyphen
            . substr($charid, 16, 4) . $hyphen
            . substr($charid, 20, 12);
    return $uuid;
}

function public_encrypt($plaintext) {
    global $sellerninja_public_key;
    openssl_get_publickey($sellerninja_public_key);
    openssl_public_encrypt($plaintext, $crypttext, $sellerninja_public_key);
    return(base64_encode($crypttext));
}

function private_decrypt($encryptedext) {
    global $sellerninja_private_key;
    $private_key = openssl_get_privatekey($sellerninja_private_key);
    openssl_private_decrypt(base64_decode($encryptedext), $decrypted, $sellerninja_private_key);
    return $decrypted;
}
