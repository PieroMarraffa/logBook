<!DOCTYPE html>
{assign var='userlogged' value=$userlogged|default:'nouser'}
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Research</title>
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
    <style type="text/css">
        #map {
            height: 600px;
            width: 100%;

        }
    </style>
</head>
<body onload="uSearchBar('')">
<!-- Navigation-->
<nav class="navbar navbar-light bg-light static-top">
    <div class="container">
        <div class="col-md-3">
            <a class="navbar-brand" href="/logBook/"><img src="/logBook/Smarty/immagini/logo_logbook.PNG"  width="243" height="62"></a>
        </div>
        <div class="col-md-6 py-3">
            <form method="post" id="form_research" action="/logBook/Research/find">
                <div class="row">
                    <div class="input-group" id="container">
                    </div>
                </div>
                <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVf05xLqt9omyf9N1ePbWCVuXeKFhOeos&libraries=places&callback=initialize"> </script>
                <script>
                    let autocomplete;

                    function uSearchBar(valore){
                        nuovo_elemento = document.getElementById("container");
                        nuovo_elemento.innerHTML =
                            "<input class='form-control' name='research' id='research' type='text' value='" + valore + "' placeholder='Enter username' aria-label='Enter search term...' aria-describedby='button-search' />" +
                            "<label>" +
                            "<select class='btn btn-primary' name='search' id='ddlSearchBy' onchange='getValue()'>" +
                            "<option value='1' id='1' selected>Search for user</option>" +
                            "<option value='2' id='2' >Search for place</option>" +
                            "</select>" +
                            "</label>" +
                            "<button class='btn btn-primary' type='submit' form='form_research' value='Submit'>Go!</button>"
                    }

                    function pSearchBar(valore){
                        nuovo_elemento = document.getElementById("container");
                        nuovo_elemento.innerHTML =
                            "<input class='form-control' name='research' id='research' type='text' value='" + valore + "' placeholder='Enter place' aria-label='Enter search term...' aria-describedby='button-search' onclick='initAutocomplete()'/>" +
                            "<label>" +
                            "<select class='btn btn-primary' name='search' id='ddlSearchBy' onchange='getValue()'>" +
                            "<option value='1' id='1' >Search for user</option>" +
                            "<option value='2' id='2' selected>Search for place</option>" +
                            "</select>" +
                            "</label>" +
                            "<button class='btn btn-primary' type='submit' form='form_research' value='Submit'>Go!</button>"
                    }

                    function getValue(){
                        var e = document.getElementById("ddlSearchBy");
                        var strUser = e.value;
                        console.log(strUser);
                        if (strUser == 2){
                            valore = document.getElementById("research").value;
                            console.log(valore);
                            pSearchBar(valore);
                        } else {
                            valore = document.getElementById("research").value;
                            console.log(valore);
                            uSearchBar(valore);
                        }
                    }

                    function initAutocomplete(){
                        autocomplete=new google.maps.places.Autocomplete(
                            document.getElementById('research'),
                            {   componentRestriction: { 'country':['IT']},
                                fields: ['place_id','geometry','name']
                            });
                        autocomplete.addEventListener('place_changed', onPlaceChanged());
                    }

                    function onPlaceChanged(){
                        var place=autocomplete.getPlace();

                        if(!place.geometry){
                            document.getElementById('research').placeholder='Enter a place';
                        }
                        else{
                            document.getElementById('details').value=place.name;
                        }
                    }
                </script>
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
        <div class = "col-md-6">
            <div id="map"></div>
            <script>

                function initialize() {
                    var map = new google.maps.Map(document.getElementById('map'), {
                        {if $Place->getName()!= $Place->getCountryName()}
                        zoom: 13,
                        {else}
                        zoom:6,
                        {/if}
                        center: new google.maps.LatLng({$Place->getLatitude()},{$Place->getLongitude()}),
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    });
                    {if isset($Place)}
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng({$Place->getLatitude()},{$Place->getLongitude()}),
                        map: map,
                        icon: 'https://maps.google.com/mapfiles/ms/micons/' + 'red-pushpin.png'
                    });
                    {/if}
                    var infowindow = new google.maps.InfoWindow();

                    var marker, i;

                    var iconBase = 'https://maps.google.com/mapfiles/ms/micons/';
                    var icons = [iconBase + 'red-dot.png',
                        iconBase + 'purple-pushpin.png',
                        iconBase + 'purple-pushpin.png'];


                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                        map: map,
                        icon: icons[i]
                    });

                }
            </script>
        </div>
        <div class="col-md-5 justify-content-end px-5 my-5 py-5">
            <div class="d-flex w-100 justify-content-between">
                <p class="text-white align-content-start dimension_title testo1"><b>{$research} </b></p>
            </div>
            <div class="d-flex w-100 justify-content-between">
                <p class="text-white align-content-start testo2">{$Place->getCountryName()}</p>
            </div>
            {if !isset($arrayPostPlace)}
            <div class="d-flex w-100 justify-content-between">
                <p class="text-white align-content-start testo2">No results for this place</p>
            </div>
            {/if}
        </div>
    </div>
</header>
<!-- Section-->
<div class="container px-4 px-lg-5 mt-5">
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-start">
        <!-- Blog entries-->
        {if $arrayPostPlace}
        {if isset($arrayPostPlace)}
                <!-- Blog post-->
        {for $i=0;$i<=count($arrayPostPlace)-1;$i++}
        {if isset($arrayPostPlace[$i])}
        <div class="col md-4" >
            <div class="card mb-4">
                <!-- Profile image-->
                <a href="/logBook/Research/postDetail/{$arrayPostPlace[$i]->getPostID()}">
                    <img class="card-img-top" src='data:{$typeImg[$i]};charset=utf-8;base64,{$pic64Img[$i]}' height="300" width="400" alt="..."></a>
                <div class="card-body">
                                <div class="small text-muted">{$arrayPostPlace[$i]->getCreationDate()}</div>
                                <h2 class="card-title h4">{$arrayPostPlace[$i]->getTitle()}</h2>
                                <a class="btn btn-primary" href="/logBook/Research/postDetail/{$arrayPostPlace[$i]->getPostID()}">Go to the Post →</a>
                            </div>
                        </div>
                    </div>
            {/if}
                {/for}
            </div>
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