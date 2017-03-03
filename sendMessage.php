<?php
$path = 'phpseclib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
include_once('Crypt/RSA.php');

header('Content-type: application/json');

class Post { 
    public $from;
    public $to;
    public $body;
} 

$array = array();
$filename = 'messages.txt';

function rsa_encrypt($string, $public_key)
{
    //Create an instance of the RSA cypher and load the key into it
    $cipher = new Crypt_RSA();
    $cipher->loadKey($public_key);
    //Set the encryption mode
    $cipher->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
    //Return the encrypted version
    return $cipher->encrypt($string);
}






?>