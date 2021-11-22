<!DOCTYPE html>
{assign var='userlogged' value=$userlogged|default:'nouser'}
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Error</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="/logBook/Smarty/immagini/immagine_logo.JPG" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
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
        .bgimg {
            background-image: url('/logBook/Smarty/immagini/ala_aereo.jpeg');
        }
    </style>
</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-light bg-light static-top">
    <div class="container">
        <div class="col-auto">
            <a class="navbar-brand" href="/logBook/"><img src="/logBook/Smarty/immagini/logo_logbook.PNG"  width="243" height="62"></a>
        </div>
        <div class="col-auto py-3">
            <form method="post" id="form_research" action="/logBook/Research/find">
                <div class="row">
                    <div class="input-group" id="container">
                        <input class="form-control" name="research" id="research" type="text" placeholder="Enter username" aria-label="Enter search term..." aria-describedby="button-search" onclick="userAutocomplete()"/>
                        <label>
                            <select class="btn btn-primary" name="search" id="ddlSearchBy" onchange="getValue()">
                                <option value="1" id="1" selected>Search for user</option>
                                <option value="2" id="2" >Search for place</option>
                            </select>
                        </label>
                        <button class="btn btn-primary" type="submit" form="form_research" value="Submit">Go!</button>
                    </div>
                </div>
                <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVf05xLqt9omyf9N1ePbWCVuXeKFhOeos&libraries=places"> </script>
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
<!-- Masthead-->
<header class="masthead bgimg">
    <div class="col py-5 px-5 mx-5">
        <div class="card border-dark">
            <div class="card-body">
                {if $research}
                <p align="center" class="dimension_title testo2">Error, your research of <B>{$research}</B> doesn't produce any results</p>
                {/if}
            </div>
        </div>
    </div>
</header>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<!-- * *                               SB Forms JS                               * *-->
<!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>
</html>