<?php
if (count(get_included_files()) == 1) exit("Direct access not permitted.");
$koneksi = connectDB('localhost', 'root', '', 'shorten_link');
