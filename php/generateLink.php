<?php
include("../php/func.php");


$data = json_decode(file_get_contents('php://input')); //get data from fetch
$link = $data->link; //accepted link
$custom = $data->custom;

$db = connectDB('localhost', 'root', '', 'shorten_link');

// if custom empty so createRandom
if (isEmpty($custom)) {
    $custom =  createRandom(5);;

    //check if custom already exist in table
    if (!checkDB($db, $custom)) {
        $custom =  createRandom(5);
    }
}

if (!isEmpty($custom)) {
    if (!checkDB($db, $custom)) {
        echo "Link tidak bisa dipakai";
    }
}

// insert to database
$exec = insertDB($db, $link, $custom);
if ($exec) {
    echo "pendek.in/" . $custom;
}
