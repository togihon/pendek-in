<?php
include("php/func.php");
include("php/config.php");

$title = "Pendek.in: Shorten your link";
if (!redirectUser($koneksi)) { 
    $title = "Pendek.in: Page Not Found";
}

include("pages/header.html");

if (!redirectUser($koneksi)) { 
    include("pages/error.html");
} else {
    include("pages/body.html");
}

include("pages/footer.html");
