<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Blog Home - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="/logBook/Smarty/css/styles.css" rel="stylesheet" />
    <link href="/logBook/Smarty/css/profile.css" rel="stylesheet" />
    <script type="text/javascript" src="../js/profile_map.js"></script>
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
<!-- Navigation-->
<nav class="navbar navbar-light bg-light static-top">
    <div class="container">
        <a class="navbar-brand" href="/logBook/User/home"><img src="/logBook/Smarty/immagini/logo_logbook.PNG"  width="300" height="90"></a>
    </div>
</nav>
<header>
    <div align="center" class="col-md">
        <img class="rounded-circle" src="data:{$type};base64,{$pic64}" width="150" height="150" alt="...">
        <h2><b>{$user->getUsername()}</b></h2>
        <h2>{$user->getMail()}</h2>
    </div>
</header>
<section>
    <div align="center" class="col-md my-5">
        <div class="col-md-5 my-4">
            <div class="card">
                <div class="card-header">Change email</div>
                <div class="body"><a class="btn btn-primary" href="/logBook/User/changeEmail">Change email -> </a></div>
            </div>
        </div>
        <div class="col-md-5 my-4">
            <div class="card">
                <div class="card-header">Change Password</div>
                <div class="body"><a class="btn btn-primary" href="/logBook/User/changePassword">Change Password -> </a></div>
            </div>
        </div>
        <div class="col-md-5 my-4">
            <div class="card">
                <div class="card-header">Change Username</div>
                <div class="body"><a class="btn btn-primary" href="/logBook/User/changeUsername">Change Username -> </a></div>
            </div>
        </div>
        <div class="col-md-5 my-4">
            <div class="card">
                <div class="card-header">Change profile image</div>
                <div class="body"><a class="btn btn-primary" href="/logBook/User/changeImage">Change Image -> </a></div>
            </div>
        </div>
        <div class="col-md-5 my-4">
            <div class="card">
                <div class="card-header">Change Description</div>
                <div class="body"><a class="btn btn-primary" href="/logBook/User/changeDescription">Change Description -> </a></div>
            </div>
        </div>
    </div>
</section>

</body>
</html>