<html>
    <head>
        <title>Parketin - Login</title>
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
        </style>
    </head>
    <body>
        <div class="loginModal">
            <div class="title">Parketin</div>
            <input id="email" type="text" placeholder="Email" />
            <input id="password" type="password" placeholder="Senha" />
            <button>Login</button>
        </div>
    </body>
</html>