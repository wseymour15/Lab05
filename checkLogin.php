<?php
session_start();
?>
<?php
function check(){
    $i;
    $array = array();
    $str = file_get_contents('users.txt');
    $array = json_decode($str);
        for($i=0;$i<sizeof($array);$i++){
        if($array[$i]->user === $_POST['username'] && $array[$i]->pass === $_POST['password']){
            return true;
        }
    }
    return false;
}
header('Content-type: application/json');
$_SESSION['login'] = $_POST['username'];
//$path = 'phpseclib';
//	set_include_path(get_include_path() . PATH_SEPARATOR . $path);
//	include_once('Crypt/RSA.php');
    if(check()){
        echo json_encode("true");
    }
    else{
        echo json_encode("false");
    }
?>
