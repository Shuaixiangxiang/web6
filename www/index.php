<?php

$function = @$_GET['func'];

function filter($beef1y){
    $filter_arr = array('php','happy','national','day','!','guys');
    $filter = '/'.implode('|',$filter_arr).'/i';
    return preg_replace($filter,'',$beef1y);
}


if($_SESSION){
    unset($_SESSION);
}

$_SESSION["user"] = 'guest';
$_SESSION['function'] = $function;

extract($_POST);

if(!$function){
    echo '<a href="index.php?f=highlight_file">source_code</a>';
}

if(!$_GET['beef1y_path']){
    $_SESSION['beef1y'] = base64_encode('guest_beef1y.png');
}else{
    $_SESSION['beef1y'] = sha1(base64_encode($_GET['beef1y_path']));
}

$serialize_info = filter(serialize($_SESSION));

if($function == 'highlight_file'){
    highlight_file('index.php');
}else if($function == 'phpinfo'){
    eval('phpinfo();'); //maybe you can find something in here!
}else if($function == 'show_time'){
    $userinfo = unserialize($serialize_info);
    echo file_get_contents(base64_decode($userinfo['beef1y']));
}