<!DOCTYPE html>
{assign var='error' value=$error|default:'ok'}
<html lang="en">
<head>
    <!--meta charset="utf-8" /-->
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
<script src="/logBook/Smarty/js/change_credential.js"></script>

<!------ Include the above in your HEAD tag ---------->

<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first" >
            <img src="/logBook/Smarty/immagini/logo_logbook_vertical.PNG" id="icon"/>
        </div>

        <!-- Login Form -->
        <form method="post" action="/logBook/User/changeCredential" enctype="multipart/form-data" onsubmit="return convalidaForm(this)">
            {if $change=='email'}
                <label for="email"><input type="text" id="email" class="fadeIn second" name="email" placeholder="new email" required></label>
            {elseif $change=='password'}
                <input type="text" id="old_password" class="fadeIn second" name="old_password" placeholder="old password" required>
                <input type="text" id="new_password" class="fadeIn second" name="new_password" placeholder="new password" required>
                <input type="text" id="confirm_password" class="fadeIn second" name="confirm_password" placeholder="confirm new password" required>
            {elseif $change=='username'}
                <input type="text" id="username" class="fadeIn second" name="username" placeholder="new username" required>
            {elseif $change=='image'}
                <input type="file" name="file" >
            {elseif $change=='description'}
                <div class="col-md-5">
                    <label for="description">
                        <textarea id="description" maxlength='100' cols="50" rows='3' class="fadeIn second" name="description" placeholder="insert here your profile's description" required></textarea>
                    </label>
                </div>
            {/if}
            <input type="submit" class="fadeIn fourth" value="Submit">

        </form>

    </div>
</div>
</body>
</html>