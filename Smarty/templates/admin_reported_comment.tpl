<!DOCTYPE html>
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
        <img src="/logBook/Smarty/immagini/logo_logbook.PNG"  width="243" height="62">
        <a href="/logBook/Admin/reported_comment" >Reported comments</a>
        <a href="/logBook/Admin/reported_posts" >Reported posts</a>
        <a href="/logBook/Admin/reported_user" >Reported user</a>

        <a class="btn btn-primary align-content-end" href="/logBook/Admin/logout">Logout</a>
    </div>
</nav>
<!-- Section-->
<section class="py-5">
    {if $commentArrayReported}
        {for $i=0 to count($commentArrayReported)-1}
            <div class="card my-3 px-4 mx-4">
                <div class="card-body">
                    <div id="comment" class="d-flex mb-4">
                        <!-- INSERISCI L'IMMAGINE DELL'UTENTE-->
                        <div class="flex-shrink-0">
                            <img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" width="100" height="100" alt="..." />
                        </div>
                        <div class="ms-3">
                            <div class="fw-bold h4">
                                {$author[$i]->getUserName()}
                            </div>
                            <h5 class="text-muted fst-italic mb-2">{$commentArrayReported[$i]->getContent()}</h5>
                        </div>
                    </div>
                    <div align="end">
                        <a href="/logBook/Admin/deleteComment/{$commentArrayReported[$i]->getCommentID()}"><button id="delete" class="btn btn-primary" >Delete</button></a>
                        <button id="ignore" class="btn btn-primary"> Ignore</button>
                    </div>
                </div>
            </div>
        {/for}
    {/if}


</section>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>