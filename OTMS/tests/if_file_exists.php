<?php
$key = "89556747-24cb-43ed-920b-47caed15465f";
if(!empty($_REQUEST['key']))
    $key = $_REQUEST['key'];
$url = "http://secondlife.com/app/image/".$key."/1";


$str = file_get_contents($url);
if(empty($str))
    echo "Empty";
else
    echo "Picture Here";
?>
