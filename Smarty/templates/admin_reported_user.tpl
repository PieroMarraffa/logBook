<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Homepage - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="/logBook/Smarty/css/styles.css" rel="stylesheet" />
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
        <img src="/logBook/Smarty/immagini/logo_logbook.PNG"  width="243" height="62">
        <a href="/logBook/Admin/reported_comment" >Reported comments</a>
        <a href="/logBook/Admin/reported_posts" >Reported posts</a>
        <a href="/logBook/Admin/reported_user" >Reported user</a>

        <a class="btn btn-primary align-content-end" href="/logBook/Admin/logout">Logout</a>
    </div>
</nav>
<!-- Section-->
<section class="  py-5">

    {if $userReported}
        {foreach $userReported as $u}
            <div class="col-md-3">
                <div id="user"class="card">
                    <!-- INSERISCI L'IMMAGINE DELL'UTENTE-->
                    <div class="card-header">
                        <div class="flex-shrink-0"><img class="rounded-circle" width="100" height="100" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                        <div class="ms-3">
                            <div class="fw-bold">{$user->getName()}<br><button onclick="remove()" id="bann" class="btn btn-primary">
                                    Bann</button><button onclick="remove()" id="ignore" class="btn btn-primary"> Ignore</button></div>
                            <a class="btn btn-primary" href="/logBook/Research/postDetail/{$a->getID()}">Go to the Profile → </a>
                        </div>
                    </div>
                </div>
            </div>
        {/foreach}
    {/if}

</section>
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