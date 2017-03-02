<?php
function check(){
    $i;
    $array = array();
    $str = file_get_contents('users.txt');
    $array = json_decode($str);
        for($i=0;$i<sizeof($array);$i++){
        if($array[$i]->user == $_POST['user'] && $array[$i]->pass == $_POST['pass']){
            return true;
        }
    }
    retun false;
}
//header('Content-type: application/json');

$path = 'phpseclib';
	set_include_path(get_include_path() . PATH_SEPARATOR . $path);
	include_once('Crypt/RSA.php');
    if(check()){
        echo json_encode("true");
    }
    echo json_encode("false");
?>
