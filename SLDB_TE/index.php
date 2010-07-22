<?php
include "lib/vars.php";
$page = file_get_contents("lib/page.html");

$replace =array('{@beforeHTML' => '','{@header}' => $header,'{@nav}' => file_get_contents("lib/nav.php"),'{@content}' => "not really sure what to put here",'{@footer}' => $footerMSG,'{@afterHTML}' => "");

foreach($replace as $k => $v)
{
    $page = str_replace($k, $v, $page);
}


echo $page;

?>
