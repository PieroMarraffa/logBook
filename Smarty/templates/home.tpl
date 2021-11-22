<!DOCTYPE html>
{assign var='userlogged' value=$userlogged|default:'nouser'}
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Home</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="/logBook/Smarty/immagini/immagine_logo.JPG" /><link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="/logBook/Smarty/css/styles.css" rel="stylesheet"  type="text/css"/>

    <script>
        function ready(){
            if (!navigator.cookieEnabled) {
                alert('Attenzione! Attivare i cookie per proseguire correttamente la navigazione');
            }
        }
        document.addEventListener("DOMContentLoaded", ready);
    </script>

    <link rel="stylesheet" href="logBook/Smarty/css/styles.css">
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
        <a class="navbar-brand" href="#"><img src="/logBook/Smarty/immagini/logo_logbook.PNG"  width="243" height="62" alt="logo"></a>
        {if $userlogged!='nouser'}
            <a class="btn btn-primary" href="/logBook/User/profile">{$username}</a>
        {else}
            <a class="btn btn-primary" href="/logBook/User/login">Sign Up</a>
        {/if}
    </div>
</nav>
<!-- Masthead-->
<header class="masthead bgimg " >
    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="text-center text-white" >
                    <!-- Page heading-->
                    <h1 class="mb-5 text-light" ><b>Go wherever you want...</b></h1>
                    <form method="post" id="form_research" action="/logBook/Research/find">
                        <div class="row">
                            <div class="input-group" id="container">
                                <input class="form-control" name="research" id="research" type="text" placeholder="Enter username" aria-label="Enter search term..." aria-describedby="button-search"/>
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
            </div>
        </div>
    </div>
</header>
<div class="container px-4 px-lg-5 mt-5">
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-start">
        {if $array_post_home}
        {if is_array($array_post_home)}
        {for $i=0;$i<=count($array_post_home)-1;$i++}
        <div class="col mb-5" >
            <div class="card h-100">
                <!-- Profile image-->
                <a href="/logBook/Research/postDetail/{$array_post_home[$i]->getPostID()}">
                    <img class="w-100" src='data:{$typeImg[$i]};charset=utf-8;base64,{$pic64Img[$i]}' height="300" alt="..."></a>
                <!-- Product details-->
                <div class="card-body p-4">
                    <div class="text-center">
                        <!-- Product name-->
                        <h5 class="fw-bolder">{$array_post_home[$i]->getTitle()}</h5>
                        <!-- Product price-->
                        <h6 class="text-muted ">{$array_post_home[$i]->getCreationDate()}</h6>
                        <a class="btn btn-primary py-2" href="/logBook/Research/postDetail/{$array_post_home[$i]->getPostID()}">Go to the Post →</a>
                    </div>
                </div>
            </div>
        </div>
        {/for}
        {/if}
        {/if}
    </div>
</div>
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