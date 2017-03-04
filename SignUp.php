<?php
session_start();
$path = 'phpseclib';
	set_include_path(get_include_path() . PATH_SEPARATOR . $path);
	include_once('Crypt/RSA.php');
class Account { 
    public $user;
    public $pass;
    public $pubKey;
    public $privKey;
} 
$array = array();
$acc = new Account();
$rsa = new Crypt_RSA();
$rsa->setPrivateKeyFormat(CRYPT_RSA_PRIVATE_FORMAT_PKCS1);
$rsa->setPublicKeyFormat(CRYPT_RSA_PUBLIC_FORMAT_PKCS1);
extract($rsa->createKey(1024)); /// makes $publickey and $privatekey available
$acc->privKey = $privatekey;
$acc->pubKey = $publickey;
$acc->user = $_POST["user"];
$acc->pass = $_POST["pass"];
$filename = 'users.txt';
//$myfile = fopen($filename,"w") or die ("Unable to open file!");
if (!file_exists($filename) || ($bar = file_get_contents($filename))=== '') {
    array_push($array,$acc);
}
else{
//    ($bar = file_get_contents($filename));
    $array = json_decode($bar);
    array_push($array,$acc);
}
$str = json_encode($array);
//echo $str;
file_put_contents($filename, $str);
header('Location: login.html');
exit;
?>
