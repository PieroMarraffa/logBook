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
    <title>Registration</title>
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
            <label for="file-upload" ><input class="fadeIn third" type="file" name="file" size="40"/></label>

        {if $errorSize!='ok'}
            <div style="color: red;">
                <p class="fadeIn third" align="center">Attention! Inserted image is too big. </p>
            </div>
        {/if}
        {if $errorType!='ok'}
            <div style="color: red;">
                <p  class="fadeIn third" align="center">Attention! This image's type is not allowed. </p>
            </div>
        {/if}
        {if $errorEmail!='ok'}
            <div style="color: red;">
                <p  class="fadeIn third" align="center">Attention! This email is alredy used!  </p>
            </div>
        {/if}
            <input type="submit" class="fadeIn fourth" form="form_registration" value="Register">
        </form>

    </div>
</div>
</body>
</html>