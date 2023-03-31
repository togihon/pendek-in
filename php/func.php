<?php
function createRandom($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}

function connectDB($host, $uname, $pass, $db)
{
    $mysqli = mysqli_connect($host, $uname, $pass, $db);
    return $mysqli;
}

function checkDB($koneksi, $code)
{
    $query = mysqli_query($koneksi, "SELECT * FROM `tb_link` WHERE shorten_code = '$code' ");
    if ($query->num_rows > 0) {
        return false;
    } else if ($query->num_rows == 0) {
        return true;
    }
}

function insertDB($koneksi, $link, $code)
{
    return mysqli_query($koneksi, "INSERT INTO `tb_link`(`actual_link`, `shorten_code`) VALUES ('$link','$code')");
}

function isEmpty($var)
{
    if ($var == "") {
        return true;
    } else if ($var != "") {
        return false;
    }
}
