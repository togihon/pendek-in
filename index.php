<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendek.in: Shorten your link</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" type="image/x-icon" href="img/logo.png" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div id="header">
        <div class="title-top">Pendek.in</div>
        <div class="nav-bar">
            <a href="#" onclick='return aboutUs()'>About us</a>
            <a href="">Contact</a>
            <a href="">Term of use</a>
        </div>
    </div>
    <div id="bubble">
        <p>URL panjang memang bikin ribet! <br>
            <b>Pendek.in</b> aja biar lebih mudah :)
        </p>
    </div>

    <div class="box">
        <input type="text" name="link" placeholder="https://example.com" autofocus><button onclick="createLink()" id="create-link"><i class="fas fa-link"></i></button>
    </div>

    <div class="custom">
        <a class="createCustom" href="#" onclick="return createCustomLink()">Custom link pendek kamu.</a>
        <div class="box-custom">
            pendek.in/ <input type="text" name="userCustomLink">
        </div>
    </div>
    <div class="loading-container">
        <div class="loading hidden"></div>
    </div>
    <div class="result hidden">
        <div class="copylink">
            <input  class="link-result" name="link-res" value="pendek.in/35hfsI" readonly><a class="btn" href="#" onclick="return copyLink()" alt="Copy to clipboard"><i class="far fa-copy"></i></a>
        </div>
        <p class="badge">Horaay!</p>
    </div>
    <div id="footer">
        <div class="foo">Copyright &copy; 2023 Pendek.in. All Rights Reserved. </div>
    </div>
</body>
<script type="text/javascript" src="js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://kit.fontawesome.com/9b9aa16409.js" crossorigin="anonymous"></script>

</html>