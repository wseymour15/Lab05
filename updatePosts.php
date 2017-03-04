<?php
session_start();
$path = 'phpseclib';
	set_include_path(get_include_path() . PATH_SEPARATOR . $path);
	include_once('Crypt/RSA.php');
header('Content-type: application/json');
class Post { 
    public $user;
    public $title;
    public $msg;
    public $tim;
    public $pid; 
} 
function check(){
    $i;
    $array = array();
    $str = file_get_contents('posts.txt');
    $array = json_decode($str);
        for($i=0;$i<sizeof($array);$i++){
        //if($array[$i]->user === $_SESSION["login"] && $array[$i]->pid === $_POST['postID']){
            return true;
        //}
    }
    return false;
}
$array = array();
$filename = 'posts.txt';
$pst = new Post();
if($_POST["postID"] == -1 ){

    //$pst->user = $_SESSION["login"];
    $pst->user = $_SESSION["login"];
    $pst->title = $_POST["postTitle"];
    $pst->msg = $_POST["postDesc"];
    $pst->tim = time();
    //$myfile = fopen($filename,"w") or die ("Unable to open file!");
    if (!file_exists($filename) || ($bar = file_get_contents($filename))=== '') {
        $pst->pid=0;
        array_push($array,$pst);
        }
    else{
    //    ($bar = file_get_contents($filename));
        $array = json_decode($bar);
        $pst->pid = sizeof($array)-1;
        array_push($array,$pst);
    }
    $str = json_encode($array);
    file_put_contents($filename, $str);
//    header('Location: viewPosts.php');
    echo json_encode($array);
}
else if($_POST["postID"] == -2){
    $bar = file_get_contents($filename);
    echo $bar;
}
else{
    $bar = file_get_contents($filename);
    $array = json_decode($bar);
    $pst->user = "Walter";
    $pst->title = $array[$_POST["postID"]]->title;
    $pst->msg = $_POST["postDesc"];
    $pst->tim = time();
    if(check()){
        $pst->user = $_SESSION["login"];
        $pst->title = $_POST["postTitle"];
        $pst->msg = $_POST["postDesc"];
        $pst->tim = time();
        $pst->pid = $_POST["postID"];
        $array[$_POST["postID"]] = $pst;
        echo json_encode($array);
    }
    else{
        echo $bar;
        array_splice($array,$_POST["postID"],1);
        $pst->pid = sizeof($array)-1;
        array_push($array,$pst);
        $str = json_encode($array);
        file_put_contents($filename, $str);
    }
    echo $str;
}
?>
