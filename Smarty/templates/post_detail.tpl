<!DOCTYPE html>
{assign var='userlogged' value=$userlogged|default:'nouser'}
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>{$post->getTitle()}</title>
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
    <style type="text/css">
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
    <script src="/logBook/Smarty/js/bootstrap.js"></script>
</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-light bg-light static-top">
    <div class="container">
        <a class="navbar-brand" href="/logBook/"><img src="/logBook/Smarty/immagini/logo_logbook.PNG"  width="243" height="62" alt="logo"></a>
        {if $userlogged!='nouser'}
            <a class="btn btn-primary" href="/logBook/User/profile">{$username}</a>
        {else}
            <a class="btn btn-primary" href="/logBook/User/login">Sign Up</a>
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
                    <div class="row">
                        <div class="col-md-7">
                        <h1 class="fw-bolder mb-1">{$post->getTitle()}</h1>
                        <!-- Post meta content-->
                            <h4 class="fw-bolder mb-1"><a href="/logBook/Research/profileDetail/{$id}">{$author}</a></h4>
                        <div class="text-muted fst-italic mb-2">Posted on: {$post->getCreationDate()}</div>
                        </div>
                        <div class="col-md-12" align="end">
                            <b>{$post->getNLike()}</b>
                            <div class="btn btn-primary align-content-center" >
                                <a class="navbar-brand" href="/logBook/Research/postDetail/like/{$post->getPostID()}/1"><img src="/logBook/Smarty/immagini/cuore.png" width="30" height="25" class="d-inline-block" alt=""></a>
                            </div>
                            <b>{$post->getNDisLike()}</b>
                            <div class="btn btn-primary align-content-center" >
                                <a class="navbar-brand" href="/logBook/Research/postDetail/like/{$post->getPostID()}/-1"><img src="/logBook/Smarty/immagini/cuore_spezzato.png" width="30" height="25" class="d-inline-block" alt=""></a>
                            </div>
                                {if $userlogged!='nouser'}
                                    {if $author!=$username}
                                        <a class="navbar-brand justify-content-end" href="/logBook/Research/reportPost/{$post->getPostID()}">
                                            <div class="btn btn-danger justify-content-end" >
                                                    <img src="/logBook/Smarty/immagini/alert.png" width="35" height="35" class="d-inline-block" alt="">

                                            </div>
                                        </a>
                                    {/if}
                                {/if}
                        </div>
                    </div>
                </header>
                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        {if isset($typeImg[0])}
                            <div class="carousel-item active">
                                <img class="w-100" src='data:{$typeImg[0]};charset=utf-8;base64,{$pic64Img[0]}' alt="...">
                            </div>
                        {/if}
                        {if isset($typeImg[1])}
                        {for $i=1;$i<=count($typeImg)-1;$i++}
                            <div class="carousel-item">

                                    <img class="w-100" src='

                                    data:{$typeImg[$i]};charset=utf-8;base64,{$pic64Img[$i]}' alt="...">

                            </div>
                        {/for}
                        {/if}
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <section class="mb-5">
                    {if $arrayExperience}
                        {foreach $arrayExperience as $experience}
                        <div class="card my-3">
                            <div class="card-header">
                                <h4>{$experience->getTitle()}</h4>
                                <div  class="text-muted fst-italic mb-2">From: {$experience->getStartDay()}   To: {$experience->getEndDay()}</div>
                            </div>
                            <div class="card-body">
                                {$experience->getDescription()}
                            </div>
                        </div>
                        {/foreach}
                    {/if}
                </section>
            </article>
            <!-- Comments section-->
            <section class="mb-5">
                <div class="card bg-light">
                    <div class="card-body">
                        <!-- Comment form-->
                        <form method="POST" id="form_comment" action="/logBook/Post/writeComment/{$post->getPostID()}" class="mb-4">
                            <input class="form-control" name="comment" id="comment" rows="3" placeholder="Leave a comment!">
                            <div align="end">
                                <input class="btn btn-primary my-2" type="submit" id="submit" form="form_comment" value="Post comment"> 

                            </div>
                        </form>
                        <!-- Comment -->
                        {if $arrayComment}
                            {if isset($arrayComment)}
                                {for $i=0;$i<=count($arrayComment)-1;$i++}
                                <div class=" mb-4">
                                    <!-- INSERISCI L'IMMAGINE DELL'UTENTE-->
                                    {if isset($arrayComment[$i])}
                                        {if $arrayComment[$i]->getDeleted()!=true}
                                                    <div class="d-flex">
                                                    <div class="flex-shrink-0">
                                                        <img class="rounded-circle" src='data:{$type[$i]};charset=utf-8;base64,{$pic64[$i]}' width="65" height="65" alt="...">
                                                    </div>
                                                    <div class="md-7 ms-3">
                                                        <div class="h5">{$arrayComment[$i]->getAuthor()->getUserName()}</div>
                                                        <div class="text-muted mb-2">{$arrayComment[$i]->getContent()}</div>
                                                    </div>
                                                    </div>
                                            {if $userlogged!='nouser'}
                                                {if $arrayComment[$i]->getAuthor()->getUserName()!=$username}
                                                    <div  align="end">
                                                        <a href="/logBook/Research/reportComment/{$arrayComment[$i]->getCommentID()}/{$post->getPostID()}" class="btn btn-danger" >Report</a>
                                                    </div>
                                                {/if}
                                            {/if}
                                        {/if}
                                    {/if}
                                </div>
                                {/for}
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
                <div class="card-header">
                    <h5>Map</h5>
                </div>
                <div class="card-body">

                    <div id="map"></div>

                    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgGqDyRzOb655kefklsqI12vpj2idk8Es&callback=initialize"> </script>

                    <script>
                        function initialize() {
                            var map = new google.maps.Map(document.getElementById('map'), {
                                zoom: 2,
                                center: new google.maps.LatLng(30,0),
                                mapTypeId: google.maps.MapTypeId.ROADMAP
                            });
                            var locations = [];
                            {if isset($array_place)}
                            {foreach $array_place as $a}
                            marker = new google.maps.Marker({
                                position: new google.maps.LatLng({$a->getLatitude()},{$a->getLongitude()}),
                                map: map,
                                icon: 'http://maps.google.com/mapfiles/ms/micons/' + 'red-pushpin.png'
                            });
                            {/foreach}
                            {/if}
                            var infowindow = new google.maps.InfoWindow();

                            var marker, i;

                            var iconBase = 'http://maps.google.com/mapfiles/ms/micons/';
                            var icons = [iconBase + 'red-dot.png',
                                iconBase + 'purple-pushpin.png',
                                iconBase + 'purple-pushpin.png'];


                            for (i = 0; i < locations.length; i++) {
                                marker = new google.maps.Marker({
                                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                                    map: map,
                                    icon: icons[i]
                                });

                            }
                        }
                    </script>
                </div>
                {$pm = FPersistentManager::getInstance()}
                {$user = unserialize(USession::getElement('user'))}
                {if $post->getUserID() == $user->getUserID()}
                <a type="button" class="mx-3 my-3 btn btn-primary "  href="/logBook/Post/modify_post/{$post->getPostID()}">Modify Post</a>
                {/if}
            </div>

        </div>
    </div>
</div>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>