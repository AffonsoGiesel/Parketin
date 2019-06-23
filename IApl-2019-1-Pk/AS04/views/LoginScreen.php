<html>
    <head>
        <title>Parketin</title>
        <link rel="stylesheet" href="/views/css/main.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="/views/js/main.js" data-lang="<?=LANG;?>"></script>
    </head>
    <body>
        <div class="loginModal">
            <div class="title-site">Parketin</div>
            <div class="errorMsg"></div>
            <input id="email" type="text" placeholder="<?=LANG_TEXT['LOGIN_EMAIL'];?>" />
            <input id="password" type="password" placeholder="<?=LANG_TEXT['LOGIN_PASSWORD'];?>" />
            <button id="login"><?=LANG_TEXT['LOGIN_ENTER'];?></button>
        </div>
    </body>
</html>