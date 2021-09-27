<!DOCTYPE html>
<html>
<head>
    <title>Add Map</title>

    <style type="text/css">
        /* Set the size of the div element that contains the map */
        #map {
            height: 400px;
            /* The height is 400 pixels */
            width: 100%;
            /* The width is the width of the web page */
        }
    </style>
</head>
<body>
<h3>My Google Maps Demo</h3>
<!--The div element for the map -->
<div id="map"></div>

<!-- Async script executes immediately and must be after any DOM elements used in callback. -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgGqDyRzOb655kefklsqI12vpj2idk8Es&callback=initialize"> </script>

<script>

    function initMap()

    function initialize() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 1,
            center: new google.maps.LatLng(0,0),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        var locations = [];

        {if $array_place}
        {foreach $array_place as $a}
        locations.push(['<span style="font-weight: bold"></span>, {$a->getName()}',undefined{$a->getLatitude()}, {$a->getLongitude()}]);
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
</body>
</html>