<!DOCTYPE html>
{assign var='error' value=$error|default:'ok'}
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Blog Post - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="/logBook/Smarty/immagini/immagine_logo.JPG" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="/logBook/Smarty/css/login.css" rel="stylesheet" />
    <script>
        function ready(){
            if (!navigator.cookieEnabled) {
                alert('Attenzione! Attivare i cookie per proseguire correttamente la navigazione');
            }
        }
        document.addEventListener("DOMContentLoaded", ready);
    </script>
</head>
<body>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="/logBook/Smarty/js/login.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="wrapper fadeInDown">
    <div id="formContent">

        <!-- Icon -->
        <div class="fadeIn first" >
            <a href="/logBook/"> <img src="/logBook/Smarty/immagini/logo_logbook_vertical.PNG" id="icon"/></a>
        </div>

        <!-- Login Form -->
        <form method="post" id="form_login" onsubmit="return convalidaPassword(this)" action="/logBook/User/checkLogin">
            <label for="email"><input type="text" id="email" class="fadeIn second" name="email" placeholder="email" required></label>
            <label for="password"><input type="password" id="password" class="fadeIn third" name="password" placeholder="password" required></label>

            {if $error!='ok'}
                <div style="color: red;">
                    <p align="center">Error! Username or password is wrong! </p>
                </div>
            {/if}
            <input type="submit" id="form_login" class="fadeIn fourth" value="Log In">

        </form>
        <!-- Remind Passowrd -->
        <div id="formFooter">
            <a class="underlineHover" href="/logBook/User/registration">You are not registered? Register here.</a>
        </div>

    </div>
</div>
</body>
</html>