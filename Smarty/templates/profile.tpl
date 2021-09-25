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
<!-- Page header with logo and tagline-->
<header class="py-5 bg-light border-bottom mb-4">

    <div id="map"></div>
    <script async
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAWjZKrvCUmkvwtggiIfQkbtQJYFzeELRc&callback=initMap">
    </script>
    <!--script di google maps per visualizzare tutti i posti dove è stato l'utente-->
</header>
<!-- Page content-->
<div class="container my-5">
    <div class="row">
        <div class="col-md-2">
            <img class="rounded-circle" src="data:{$type};base64,{$pic64}" width="150" height="150" alt="...">
        </div>
        <div class="col-md-6">

            <h2><b>{$user->getUsername()}</b></h2>
            <h5>{$user->getDescription()}</h5>
        </div>
        <div class="col-md-1">
            <div class="btn btn-primary align-content-center" ><a class="navbar-brand" href="/logBook/User/changeCredential"><img src="/logBook/Smarty/immagini/pencil.png" width="30" height="25" class="d-inline-block" alt=""></a></div>
        </div>
        <div class="col-md-1">
            <a class="btn btn-primary" href="  ">+ Post</a>
        </div>
        <div class="col-md-1">
            <a class="btn btn-primary" href="/logBook/User/logout">Logout</a>
        </div>
    </div>
</div>


<div class="container my-5">
    <div class="row">
        <!-- Blog entries-->
        {if $user->getPostList()}
        {if isset($user->getPostList())}
            {foreach $user->getPostList() as $p}

                <div class="row">
                    <!-- Blog post-->
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img class="card-img-top" src="" alt="..." />
                            <div class="card-body">
                                <div class="small text-muted">{$p->getDate()}</div>
                                <h2 class="card-title h4">{$p->getPostTitle()}</h2>
                                <p class="card-text">{$p->getDescription()}</p>
                                <a class="btn btn-primary" href="/logBook/Research/postDetail/{$p->getID()}">Go to the Post →</a>
                            </div>
                        </div>
                    </div>
                </div>
            {/foreach}
        {/if}
        {/if}
    </div>
</div>
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>