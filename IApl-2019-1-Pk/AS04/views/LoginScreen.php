<html>
    <head>
        <title>Parketin</title>
        <style>
            @import "http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700";

            * {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                padding: 0px;
                margin: 0px;
                border: 0px;
                font-family: 'Open Sans';
            }
            
            html, body {
                background: #d2d6de;
            }
            
            .loginModal {
                width: 320px;
                margin: 100px auto;
                background: #ffffff;
                padding: 20px;
            }

            .title {
                text-align: center;
                width: 100%;
                margin: 15px 0;
                color: #666666;
                font-size: 24px;
            }

            input {
                border: 2px solid #d2d6de;
                margin: 10px 0px;
                padding: 5px 10px;
                width: 100%;
            }

            input.withError {
                border-color: rgba(255, 0, 0, 0.3);
            }

            input::placeholder {
                color: #d2d6de;
            }

            button {
                width: 100%;
                background: #a2a6ae;
                cursor: pointer;
                padding: 7px 10px;
                margin: 10px 0px;
            }

            .errorMsg {
                background: rgba(255, 0, 0, 0.3);
                padding: 0px 10px;
                line-height: 30px;
                font-size: 15px;
            }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script>
            $(window).ready(function() {

                $("#login").on("click", function () {
                    var email = $("#email").val(),
                        pass = $("#password").val();

                    $("#email").removeClass("withError");
                    $("#password").removeClass("withError");
                    $(".errorMsg").html("");

                    $.post("/<?=LANG;?>/login/authenticate", {"email": email, "password": pass}, function(data){
                         if (data.code != 200) {
                         }
                    }, 'jSON').fail(function(data) {
                        $("#email").addClass("withError");
                        $("#password").addClass("withError");
                        $(".errorMsg").html(data.responseJSON.error);
                    });
                });
            });
        </script>
    </head>
    <body>
        <div class="loginModal">
            <div class="title">Parketin</div>
            <div class="errorMsg"></div>
            <input id="email" type="text" placeholder="<?=LANG_TEXT[1];?>" />
            <input id="password" type="password" placeholder="<?=LANG_TEXT[2];?>" />
            <button id="login"><?=LANG_TEXT[3];?></button>
        </div>
    </body>
</html>