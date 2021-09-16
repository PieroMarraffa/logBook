<!DOCTYPE html>
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
    <link href="../css/login.css" rel="stylesheet" />
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
<script src="../js/registration.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first" >
            <a href="home.html"><img src="../immagini/logo_logbook_vertical.PNG" id="icon"  /></a>
        </div>

        <!-- Login Form -->
        <form method="post" action="/logBook/User/registration" id="form_registration" onsubmit="return convalidaForm(this) ">
            <input type="text" id="name" class="fadeIn second" name="Name" placeholder="Name" required>
            <input type="text" id="email" class="fadeIn second" pattern="[^@]+@[^@]+\.[a-zA-Z]" name="email" placeholder="Email" required>
            <input type="text" id="username" class="fadeIn second" name="Username" placeholder="Username" required>

            <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password" required>
            <input type="password" id="confirm_password" class="fadeIn third" name="password2" placeholder="Confirm Password" required>
            <input type="file" id="profileImage" class="btn btn-primary" name="profileImage" placeholder="Insert here your profile image">

            <input type="submit" class="fadeIn fourth" form="form_registration" value="Register">
        </form>
        {if $errorSize!='ok'}
            <div style="color: red;">
                <p align="center">Attenzione! Formato immagine troppo grande!  </p>
            </div>
        {/if}
        {if $errorType!='ok'}
            <div style="color: red;">
                <p align="center">Attenzione! Formato immagine non supportato (provare con .png o .jpg)!  </p>
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