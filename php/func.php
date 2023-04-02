<?php

if (count(get_included_files()) == 1) exit("Direct access not permitted.");

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
    $row = $query->fetch_assoc();
    if ($query->num_rows > 0) { //ada data di db
        return array(true, $row);
    } else if ($query->num_rows == 0) {
        return array(false, "");
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

function validateURL($url)
{
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        return true;
    } else {
        return false;
    }
}

function redirectUser($koneksi)
{
    if (isset($_GET['id'])) {
        $code = $_GET['id'];
        if (!isEmpty($code)) {
            $check = checkDB($koneksi, $code);
            if ($check[0]) {
                $link = $check[1]['actual_link'];
                header("Location: $link");
            } else if (!$check[0]) {
                return false;
            }
        }
    } else {
        return true;
    }
}
