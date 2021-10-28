<!DOCTYPE html>
{assign var='userlogged' value=$userlogged|default:'nouser'}
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Post</title>
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
                    <h1 class="fw-bolder mb-1">{$Title}</h1>
                    <!-- Post meta content-->
                    <h4 class="fw-bolder mb-1">{$author}</h4>
                    <div class="text-muted fst-italic mb-2">Posted on: {$date}</div>
                </header>
                <!-- Preview image figure-->
                <figure class="mb-4"><img class="img-fluid rounded" src="https://dummyimage.com/900x400/ced4da/6c757d.jpg" alt="..." /></figure>
                <!-- Post content-->
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
                        <form method="post" id="form_comment" action="/logBook/Post/writeComment" class="mb-4">
                            <textarea class="form-control" id="comment" rows="3" placeholder="Leave a comment!"></textarea>
                            <div align="end">
                                <button class="btn btn-primary my-2" type="submit" form="form_comment" value="Submit"> Post comment </button>
                            </div>
                        </form>
                        <!-- Comment -->
                        {if $arrayComment}
                            {if isset($arrayComment)}
                                {for $i=0;$i<=count($arrayComment)-1;$i++}
                                <div class="d-flex mb-4">
                                    <!-- INSERISCI L'IMMAGINE DELL'UTENTE-->
                                    {if isset($arrayComment[$i])}
                                            <div class="flex-shrink-0"><img class="rounded-circle" src='data:{$type[$i]};charset=utf-8;base64,{$pic64[$i]}' width="65" height="65" alt="..."></div>
                                            <div class="ms-3">
                                            <div class="h5">{$arrayComment[$i]->getAuthor()->getUserName()}</div>
                                            <div class="text-muted mb-2">{$arrayComment[$i]->getContent()}</div>
                                        {/if}
                                    </div>
                                </div>
                                {/for}
                            {/if}
                        {/if}
                    </div>
                </div>
            </section>
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

                                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                                    return function() {
                                        infowindow.setContent(locations[i][0]);
                                        infowindow.open(map, marker);
                                    }
                                })(marker, i));
                            }
                        }
                    </script>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>