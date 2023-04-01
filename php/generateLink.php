<?php
include("../php/func.php");
include("../php/config.php");


$data = json_decode(file_get_contents('php://input')); //get data from fetch
$link = $data->link; //accepted link
$custom = $data->custom;

// if custom empty so createRandom
if (isEmpty($custom)) {
    $custom =  createRandom(5);;

    //check if custom already exist in table
    if (checkDB($koneksi, $custom)) {
        $custom =  createRandom(5);
    }
}

if (!isEmpty($custom)) {
    //check if user custom already exist in table
    if (checkDB($koneksi, $custom)) {
        echo "error";
    }
}

// insert to database
$exec = insertDB($koneksi, $link, $custom);
if ($exec) {
    echo "pendek.in/" . $custom;
}
