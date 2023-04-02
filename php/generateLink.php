<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    exit("Direct access not permitted.");
}

include("../php/func.php");
include("../php/config.php");

$baseURL = $_SERVER['SERVER_NAME'];
$data = json_decode(file_get_contents('php://input')); //get data from fetch
$link = $data->link; //accepted link
$custom = $data->custom;

$lastRequestTime = isset($_SESSION['last_request_time']) ? $_SESSION['last_request_time'] : 0;
$currentTime = microtime(true);

if ($currentTime - $lastRequestTime < 5) {
    http_response_code(429);
    header('Retry-After: ' . (5 - ($currentTime - $lastRequestTime)));
    echo 'Error: terlalu banyak request';
    exit;
} else {
    $_SESSION['last_request_time'] = $currentTime;

    if (validateURL($link)) {
        // if custom empty so createRandom
        if (isEmpty($custom)) {
            $custom =  createRandom(5);;

            //check if custom already exist in table
            if (checkDB($koneksi, $custom)[0]) { //if true
                $custom =  createRandom(5);
            }
        }

        if (!isEmpty($custom)) {
            //check if user custom already exist in table
            if (checkDB($koneksi, $custom)[0]) { //if true
                echo "Error: custom link tidak bisa digunakan";
            }
        }

        // insert to database
        $exec = insertDB($koneksi, $link, $custom);
        if ($exec) {
            echo $baseURL . '/' . $custom;
        }
    }
}
