<?php

$conn = new mysqli('localhost','root','','m1_sdac');
session_start();

if(!$conn){
    echo 'DB not connected.';
}
?>