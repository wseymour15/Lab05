<?php
$path = 'phpseclib';
	set_include_path(get_include_path() . PATH_SEPARATOR . $path);
	include_once('Crypt/RSA.php');
class Account { 
    public $user;
    public $pass;
    public $pubKey;
    public $privKey;
} 

$acc = new Account();
$rsa = new Crypt_RSA();
$rsa->setPrivateKeyFormat(CRYPT_RSA_PRIVATE_FORMAT_PKCS1);
$rsa->setPublicKeyFormat(CRYPT_RSA_PUBLIC_FORMAT_PKCS1);
extract($rsa->createKey(4)); /// makes $publickey and $privatekey available
$acc->privKey = $privatekey;
$acc->pubKey = $publickey;
$acc->user = $_GET["user"];
$acc->pass = $_GET["pass"];
$filename = "users.txt";
$myfile = fopen($filename,"w") or die ("Unable to open file!");
if (($bar = file_get_contents($filename))!== false) {
    $str = json_encode($acc);
    print_r($bar);
}
else{
    $str = json_decode($bar);
    
}
file_put_contents($str)
fwrite($myfile, $acc);
fclose($myfile);


?>
