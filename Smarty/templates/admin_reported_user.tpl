<!DOCTYPE html>
{assign var='immagine' value=$immagine|default:'ok'}
{assign var='immagine_1' value=$immagine_1|default:'ok'}
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="/logBook/Smarty/immagini/immagine_logo.JPG" />
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
        <div class="col-md-auto">
        <img src="/logBook/Smarty/immagini/logo_logbook.PNG"  width="243" height="62" alt="..."></div>
        <a href="/logBook/Admin/reportedComments"><div class="col-md-auto">
        <b class="h5">Reported comments</b></div></a>
        <a href="/logBook/Admin/reported_posts" ><div class="col-md-auto">
        <b class="h5">Reported posts</b></div></a>
        <a href="/logBook/Admin/adminHome"><div class="col-md-auto">
                <b class="h5">Reported user</b></div></a>
        <div class="col-md-auto">
            <a class="btn btn-primary align-content-end" href="/logBook/Admin/adminLogout">Logout</a></div>
    </div>
</nav>
<!-- Section-->
<section>
<div class="navbar btn-primary" align="center"><p class="mx-2"><h4>Reported User</h4></p></div>
<div class="row" align="center">
    {if $userReported}
        {if is_array($userReported)}
            {for $i=0 to count($userReported)-1}
            <div class="col-md-4 my-4">
                <div id="user" class="card">
                    <!-- INSERISCI L'IMMAGINE DELL'UTENTE-->
                    <div class="card-header">
                        {if $immagine_1 == 'ok'}
                            <img class="rounded-circle ml-3" width="100" height="100" src="data:{$typeR[$i]};base64,{$pic64R[$i]}"  alt="profile picture" />
                        {else}
                            <img class=" ml-3" width="100" height="100" src="/logBook/Smarty/immagini/user.png"  alt="profile picture" />
                        {/if}
                        <div class="ms-3">
                            <div class="fw-bold"><h4>{$userReported[$i]->getUsername()}</h4><br><a href="/logBook/Admin/banUser/{$userReported[$i]->getUserID()}" id="bann" class="btn btn-primary mx-3">
                                     Bann</a><a href="/logBook/Admin/ignoreUser/{$userReported[$i]->getUserID()}" id="ignore" class="btn btn-primary mx-3"> Ignore</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {/for}
        {/if}
    {/if}
    </div>
    <div class="navbar btn-primary" align="center"><p class="mx-2"><h4>Banned User</h4></p></div>

    <div class="row" align="center">
    {if $userBanned}
        {if is_array($userBanned)}
            {for $i=0 to count($userBanned)-1}
            <div class="col-md-4 my-4">
                <div id="user" class="card">
                    <!-- INSERISCI L'IMMAGINE DELL'UTENTE-->
                    <div class="card-header">
                        {if $immagine_1 == 'ok'}
                            <img class="rounded-circle ml-3" width="100" height="100" src="data:{$typeB[$i]};base64,{$pic64B[$i]}"  alt="profile picture" />
                        {else}
                            <img class=" ml-3" width="100" height="100" src="/logBook/Smarty/immagini/user.png"  alt="profile picture" />
                        {/if}
                            <div class="ms-3">
                                <div class="fw-bold"><h4>{$userBanned[$i]->getUsername()}</h4><br><a href="/logBook/Admin/restoreUser/{$userBanned[$i]->getUserID()}" id="restore" class="btn btn-primary mx-3">
                                Restore User</a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            {/for}
        {/if}
    {/if}
</div>
</section>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>