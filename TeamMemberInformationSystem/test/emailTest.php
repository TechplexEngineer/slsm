<?php

if(filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)) {
    echo "it's valid so do something";
}
else {
    echo "it's not valid so do something else";
}
?>
