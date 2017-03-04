<?php
session_start();
$path = 'phpseclib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
include_once('Crypt/RSA.php');

header('Content-type: application/json');

class Message { 
    public $from;
    public $to;
    public $body;
} 

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

function check(){
    $i;
    $array = array();
    $str = file_get_contents('users.txt');
    $array = json_decode($str);
        for($i=0;$i<sizeof($array);$i++){
        	if($array[$i]->user === $_POST["recipient"]){
				return true;
			}
		}
    return false;
}

function findRecipKey(){
    $i;
    $array = array();
    $str = file_get_contents('users.txt');
    $array = json_decode($str);
        for($i=0;$i<sizeof($array);$i++){
        	if($array[$i]->user === $_POST["recipient"]){
				return $array[$i]->pubKey;
			}
		}
    return "WRONG";
}



$tempText = $_POST["messageVal"];

$recipKey = findRecipKey();

$newText = rsa_encrypt($tempText, $recipKey);

$a = base64_encode($newText);

$array = array();
$mess = new Message();
$mess->from = $_SESSION["login"];
$mess->to = $_POST["recipient"];
$mess->body = $a;

$filename = 'messages.txt';


if (!file_exists($filename) || ($bar = file_get_contents($filename))=== '') {
    array_push($array,$mess);
}
else{
    $array = json_decode($bar);
    array_push($array,$mess);
}

$str = json_encode($array);

if(check()){
	file_put_contents($filename, $str);
}
//header('Location: viewPosts.php');
exit;


?>