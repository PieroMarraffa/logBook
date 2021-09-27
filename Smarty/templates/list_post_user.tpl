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
    <link rel="icon" type="image/x-icon" href="/logBook/Smarty/immagini/immagine_logo.JPG" /><link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
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
        <a class="navbar-brand" href="/logBook/"><img src="/logBook/Smarty/immagini/logo_logbook.PNG"  width="243" height="62"></a>
        <form method="get" action="/logBook/Research/find">
            <div class="row">
                <div class="input-group">
                    <input class="form-control" id="research" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                    <select class="btn btn-primary" name="search">
                        <option value="1">Search for user</option>
                        <option value="2">Search for place</option>
                    </select>
                    <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                </div>
            </div>
        </form>
        {if $userlogged!='nouser'}
            <a class="btn btn-primary" href="/logBook/User/login">Sign Up</a>
        {else}
            <a class="btn btn-primary" href="/logBook/User/profile">{$username}</a>
        {/if}
    </div>
</nav>
<!-- Section-->
<section class="py-5">

    <div class="row">
        <!-- Blog entries-->
        {if $arrayUser}
        {if isset($arrayUser)}
        {for $j = 0; $j<= count($arrayUser);$j++ }
        <div class="row">
            <div class="card mb-10">
                <div class="card-header">
                    <b><a href="/logBook/Research/postDetail/{$arrayUser[$j]->getUserID()}">{$arrayUser[$j]->getUsername()}</a></b>
                </div>
                <div class="card-body">
                    <div class="row">
                        {$userPostList =$arrayUser->getPostList()}
                        {for $i = 0; $i<= 3;$i++ }
                            <!-- Blog post-->
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <!-- INSERIRE IMMAGINI CHE SCORRONO-->
                                    <img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." />
                                    <div class="card-body">
                                        <div class="small text-muted">{$userPostList[$i]->getDate()}</div>
                                        <h2 class="card-title h4">{$userPostList[$i]->getTitle()}</h2>
                                        <p class="card-text">{$userPostList[$i]->getAuthor()}</p>
                                        <a class="btn btn-primary" href="/logBook/Research/postDetail/{$userPostList[$i]->getPostID()}">Go to the Post →</a>
                                    </div>
                                </div>
                            </div>
                        {/for}
                    </div>
                </div>
            </div>
        </div>
        {/for}
        {/if}
        {/if}

    </div>

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