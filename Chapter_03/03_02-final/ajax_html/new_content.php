<?php
// echo $var;
// return;
$var = 'new content';
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH'])&& $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest";
}

if(is_ajax_request()){
    echo "<span style=\"color: blue;\">This is the <strong $var</strong> which has been loaded by Ajax.</span>";
    echo "<pre>";
    print_r($_SERVER);
    echo "</pre>";
}else {
    echo 'Nope';
    echo "<pre>";
    print_r($_SERVER);
    echo "</pre>";
}



