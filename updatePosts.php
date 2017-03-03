<?php
$path = 'phpseclib';
	set_include_path(get_include_path() . PATH_SEPARATOR . $path);
	include_once('Crypt/RSA.php');
class Post { 
    public $user;
    public $title;
    public $msg;
    public $time;
    public $pid; 
} 
function check(){
    $i;
    $array = array();
    $str = file_get_contents('posts.txt');
    $array = json_decode($str);
        for($i=0;$i<sizeof($array);$i++){
        if($array[$i]->user === $_SESSION["login"] && $array[$i]->pid === $_POST['postID']){
            return true;
        }
    }
    return false;
}

if($_POST["postID"] == -1){
    $array = array();
    $pst = new Post();

    $pst->user = $_SESSION["login"];
    $pst->title = $_POST["postTitle"];
    $pst->msg = $_POST["postDesc"];
    $pst->title = time();
    $filename = 'posts.txt';
    //$myfile = fopen($filename,"w") or die ("Unable to open file!");
    if (!file_exists($filename) || ($bar = file_get_contents($filename))=== '') {
        $pst->pid=0;
        array_push($array,$pst);
        }
    else{
    //    ($bar = file_get_contents($filename));
        $array = json_decode($bar);
        $pst->id = sizeof($array);
        array_push($array,$pst);
    }
    $str = json_encode($array);
    //echo $str;
    file_put_contents($filename, $str);
    header('Location: viewPosts.php');
    exit;
}
//else if(check()){
//    
//}

?>
