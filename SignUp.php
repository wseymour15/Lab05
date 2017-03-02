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
if (filesize('users.txt') == 0){
    $myfile = fopen($filename,"w") or die ("Unable to open file!");
    $acc = json_encode($acc);
    fwrite($myfile, $acc);
}
else{
    $bar = fread($handle, filesize($filename));
    $bar = json_decode($bar);
    print_r($bar);
}
fclose($myfile);


?>
