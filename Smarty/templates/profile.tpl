<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>{$user->getUsername()}</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="/logBook/Smarty/immagini/immagine_logo.JPG" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="/logBook/Smarty/css/styles.css" rel="stylesheet" />
    <link href="/logBook/Smarty/css/profile.css" rel="stylesheet" />
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
            height: 600px;
            width: 100%;
        }
    </style>
</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-light bg-light static-top">
    <div class="container">
        <a class="navbar-brand" href="/logBook/User/home"><img src="/logBook/Smarty/immagini/logo_logbook.PNG"  width="300" height="90"></a>
    </div>
</nav>
<!-- Page header with logo and tagline-->
<header class="bg-light border-bottom mb-4">
    <div id="map"></div>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgGqDyRzOb655kefklsqI12vpj2idk8Es&callback=initialize"> </script>

    <script>
        function initialize() {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 2.5,
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
    <!--script di google maps per visualizzare tutti i posti dove è stato l'utente-->
</header>
<!-- Page content-->
<div class="container my-5">
    <div class="row">
        <div class="col-md-2">
            <img class="rounded-circle" src='data:{$type};charset=utf-8;base64,{$pic64}' width="150" height="150" alt="...">
        </div>
        <div class="col-md-6">
            <h2><b>{$user->getUsername()}</b></h2>
            <h5>{$user->getDescription()}</h5>
        </div>
        <div class="col-md-1">
            <div class="btn btn-primary align-content-center" ><a class="navbar-brand" href="/logBook/User/changeCredential"><img src="/logBook/Smarty/immagini/pencil.png" width="30" height="25" class="d-inline-block" alt=""></a></div>
        </div>
        <div class="col-md-1">
            <a class="btn btn-primary" href="/logBook/Post/create_post">+ Post</a>
        </div>
        <div class="col-md-1">
            <a class="btn btn-primary" href="/logBook/User/logout">Logout</a>
        </div>
    </div>
</div>


<div class="container px-4 px-lg-5 mt-5">
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-start">
        {if $postList}
        {if isset($postList)}
            {for $i=0;$i<=count($postList)-1;$i++}
                {if isset($postList[$i])}
                <div class="col md-4" >
                    <div class="card mb-4">
                        <!-- Profile image-->
                        <img class="card-img-top" src='data:{$typeImg[$i]};charset=utf-8;base64,{$pic64Img[$i]}' height="300" width="400" alt="...">
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">{$postList[$i]->getTitle()}</h5>
                                <!-- Product price-->
                                <h6 class="text-muted ">{$postList[$i]->getCreationDate()}</h6>
                                <a class="btn btn-primary py-2" href="/logBook/Research/postDetail/{$postList[$i]->getPostID()}">Go to the Post →</a>
                            </div>
                        </div>
                    </div>
                </div>
                {/if}
            {/for}
        {/if}
        {/if}
    </div>
</div>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>