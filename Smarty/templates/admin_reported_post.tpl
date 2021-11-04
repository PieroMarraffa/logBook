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
        <div class="col-md-auto">
            <img src="/logBook/Smarty/immagini/logo_logbook.PNG"  width="243" height="62" alt="..."></div>
        <a href="/logBook/Admin/reportedComments"><div class="col-md-auto">
                <b class="h5">Reported comments</b></div></a>
        <a href="/logBook/Admin/reportedPosts" ><div class="col-md-auto">
                <b class="h5">Reported posts</b></div></a>
        <a href="/logBook/Admin/adminHome"><div class="col-md-auto">
                <b class="h5">Reported user</b></div></a>
        <div class="col-md-auto">
            <a class="btn btn-primary align-content-end" href="/logBook/Admin/adminLogout">Logout</a></div>
    </div>
</nav>
<div class="navbar btn-primary" align="center"><p class="mx-2"><h4>Reported Posts</h4></p></div>

<!-- Section-->
<section class="py-5">

    <div class="row">
        <!-- Blog entries-->
        <div class="row">
            {if $arrayReportedPost}
                {if is_array($arrayReportedPost)}
                    {for $i=0;$i<=count($arrayReportedPost)-1;$i++}
                    {if isset($arrayReportedPost[$i])}
                    <!-- Blog post-->
                    <div class="col-md-3">
                        <div class="card mb-4">
                            <img class="card-img-top" src='data:{$typeImg[$i]};charset=utf-8;base64,{$pic64Img[$i]}' height="300" width="400" alt="...">
                            <div class="card-body">
                                <div class="small text-muted">{$arrayReportedPost[$i]->getCreationDate()}</div>
                                <h2 class="card-title h4">{$arrayReportedPost[$i]->getTitle()}</h2>
                                <a class="btn btn-primary" href="/logBook/Admin/deletePost/{$arrayReportedPost[$i]->getPostID()}">Delete</a>
                                <a class="btn btn-primary" href="/logBook/Admin/ignorePost/{$arrayReportedPost[$i]->getPostID()}">Ignore</a>
                            </div>
                        </div>
                    </div>
                    {/if}
                {/for}
                {/if}
            {/if}
        </div>
    </div>

</section>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>