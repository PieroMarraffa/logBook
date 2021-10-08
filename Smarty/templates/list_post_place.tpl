<!DOCTYPE html>
{assign var='userlogged' value=$userlogged|default:'nouser'}
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Homepage - Start Bootstrap Template</title>
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
        <div class="col-md-3">
            <a class="navbar-brand" href="/logBook/"><img src="/logBook/Smarty/immagini/logo_logbook.PNG"  width="243" height="62"></a>
        </div>
        <div class="col-md-6 py-3">
            <form method="post" id="form_research" action="/logBook/Research/find">
                <div class="row">
                    <div class="input-group">
                        <input class="form-control" name="research" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                        <label>
                            <select class="btn btn-primary" name="search">
                                <option value="1">Search for user</option>
                                <option value="2">Search for place</option>
                            </select>
                        </label>
                        <button class="btn btn-primary" id="button-search" type="submit">Go!</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-auto">
            {if $userlogged!='nouser'}
                <a class="btn btn-primary" href="/logBook/User/profile">{$username}</a>
            {else}
                <a class="btn btn-primary" href="/logBook/User/login">Sign Up</a>
            {/if}
        </div>
    </div>
</nav>
<!-- Header-->
<header class="bg-primary py-5">
    <div class="row">
        <div class = "col-md-5">
            <img src="https://dummyimage.com/600x500/dee2e6/6c757d.jpg" width="600" height="500" class=" mt-5 ml-5" alt="relative image">

        </div>
        <div class="col-md-7 justify-content-end my-5 py-5">
            <div class="d-flex w-100 justify-content-between">
                <p class="text-white align-content-start dimension_title testo1"><b>{$TitlePlace} </b></p>
            </div>
            <div class="d-flex w-100 justify-content-between">
                <p class="text-white align-content-start testo2">{$Category}</p>
            </div>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">

    <div class="row">
        <!-- Blog entries-->
        {if $arrayPostPlace}
        {if isset($arrayPostPlace)}
            <div class="row">
                <!-- Blog post-->
                {foreach $arrayPostPlace as $post}
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img class="card-img-top" src="https://dummyimage.com/400x300/dee2e6/6c757d.jpg" alt="..." />
                            <div class="card-body">
                                <div class="small text-muted">{$post->getCreationDate()}</div>
                                <h2 class="card-title h4">{$post->getTitle()}</h2>
                                <a class="btn btn-primary" href="">Go to the Post →</a>
                            </div>
                        </div>
                    </div>
                {/foreach}
            </div>
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