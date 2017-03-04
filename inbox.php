<?php
session_start();

$path = 'phpseclib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
include_once('Crypt/RSA.php');

function rsa_decrypt($string, $private_key)
{
    //Create an instance of the RSA cypher and load the key into it
    $cipher = new Crypt_RSA();
    $cipher->loadKey($private_key);
    //Set the encryption mode
    $cipher->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
    //Return the decrypted version
    return $cipher->decrypt($string);
}


function printMessages(){
	$i;
	$array = array();
	$str = file_get_contents('messages.txt');
	$array = json_decode($str);
    for($i=0;$i<sizeof($array);$i++){
		if($array[$i]->to === $_SESSION["login"]){
            //THIS MESAGE GOES TO INBOX
			$tempS = base64_decode($array[$i]->body);
			$doText = rsa_decrypt($tempS, $_SESSION['privCode']);
			echo $array[$i]->from . ": " . $doText . "<br/ >";
        }	
	}
}

?>

<head>
	<title>"Inbox"</title>
    <meta charset = "utf-8"/>
</head>

<body>
 <h1>Inbox</h1>
 <p>
	<?php printMessages(); ?>
	</p>
	<div>
		<input onCLick="location.href = 'viewPosts.php';" type="submit" id="goBack" name="goBack" value="Back to Homepage"/>
	</div>
</body>
