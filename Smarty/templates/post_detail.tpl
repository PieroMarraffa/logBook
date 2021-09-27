<!DOCTYPE html>
{assign var='userlogged' value=$userlogged|default:'nouser'}
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Blog Post - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="/logBook/Smarty/immagini/immagine_logo.JPG" />
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
        <a class="navbar-brand" href="home.html"><img src="/logBook/Smarty/immagini/logo_logbook.PNG"  width="243" height="62"></a>
        {if $userlogged!='nouser'}
            <a class="btn btn-primary" href="login.html">Sign Up</a>
        {else}
            <a class="btn btn-primary" href="profile.html">{$username}</a>
        {/if}
    </div>
</nav>
<!-- Page content-->
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Post content-->
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <h1 class="fw-bolder mb-1">{$Title}</h1>
                    <!-- Post meta content-->
                    <div class="text-muted fst-italic mb-2">Posted on: {$date}</div>
                </header>
                <!-- Preview image figure-->
                <figure class="mb-4"><img class="img-fluid rounded" src="https://dummyimage.com/900x400/ced4da/6c757d.jpg" alt="..." /></figure>
                <!-- Post content-->
                <section class="mb-5">
                    {if $arrayExperience}
                    {foreach $arrayExperience as $experience}
                    <div class="card">
                        <div class="card-header">
                            {$experience->getTitle()}
                            {$experience->getStartDate()}{$experience->getEndDate()}
                        </div>
                        <div class="card-body">
                            {$experience->getDescription()}
                        </div>
                    </div>
                    {/foreach}
                    {/$if}
                </section>
            </article>
            <!-- Comments section-->
            <section class="mb-5">
                <div class="card bg-light">
                    <div class="card-body">
                        <!-- Comment form-->
                        <form method="post" action="/logBook/Post/writeComment" class="mb-4">
                            <textarea class="form-control"  id="comment" rows="3" placeholder="Leave a comment!"></textarea>
                        </form>
                        <!-- Comment -->
                        {$if $arrayComment}
                        {$if isset($arrayComment)}
                        {foreach $arrayComment as $c}
                        <div class="d-flex mb-4">
                            <!-- INSERISCI L'IMMAGINE DELL'UTENTE-->
                            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                            <div class="ms-3">
                                <div class="fw-bold">{$comment_author}</div>
                                {$comment_content}
                            </div>
                        </div>
                        {/foreach}
                        {/if}
                        {/if}
                    </div>
                </div>
            </section>
        </div>
        <!-- Side widgets-->
        <div class="col-lg-4">
            <!-- Search widget-->
            <div class="card mb-4">
                <div class="card-header">Map</div>
                <div class="card-body">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                        <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                    </div>
                </div>
            </div>

        </div>
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