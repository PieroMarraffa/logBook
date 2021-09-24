<!DOCTYPE html>
{assign var='errorSize' value=$errorSize|default:'ok'}
{assign var='errorType' value=$errorType|default:'ok'}
{assign var='errorEmail' value=$errorEmail|default:'ok'}
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Blog Post - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
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
<script src="/logBook/Smarty/js/registration.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first" >
            <a href="/logBook/"><img src="/logBook/Smarty/immagini/logo_logbook_vertical.PNG" id="icon"  /></a>
        </div>

        <!-- Login Form -->
        <form method="post" action="/logBook/User/registration" id="form_registration" onsubmit="return convalidaForm(this)" enctype="multipart/form-data" >
            <label for="name"><input type="text" id="name" class="fadeIn second" name="name" placeholder="Name" required></label>
            <label for="email"><input type="text" id="email" class="fadeIn second" name="email" placeholder="Email" required></label>
            <label for="username"><input type="text" id="username" class="fadeIn second" name="username" placeholder="Username" required></label>

            <label for="password"><input type="password" id="password" class="fadeIn third" name="password" placeholder="Password" required></label>
            <label for="confirm_password"><input type="password" id="confirm_password" class="fadeIn third" name="password2" placeholder="Confirm Password" required></label>
            <input type="file" name="file" size="40" >
            <input type="submit" class="fadeIn fourth" form="form_registration" value="Register">
        </form>
        {if $errorSize!='ok'}
            <div style="color: red;">
                <p align="center">Attenzione! Formato immagine troppo grande!  </p>
            </div>
        {/if}
        {if $errorType!='ok'}
            <div style="color: red;">
                <p align="center">Attenzione! Formato immagine non supportato (provare con .jpg)!  </p>
            </div>
        {/if}
        {if $errorEmail!='ok'}
            <div style="color: red;">
                <p align="center">Attenzione! Email già esistente!  </p>
            </div>
        {/if}


    </div>
</div>
</body>
</html>