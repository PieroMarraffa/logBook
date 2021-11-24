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
        <div class="col-md-3">
            <a class="navbar-brand" href="/logBook/"><img src="/logBook/Smarty/immagini/logo_logbook.PNG"  width="243" height="62"></a>
        </div>
        <div class="col-md-6 py-3">
            <form method="post" id="form_research" action="/logBook/Research/find">
                <div class="row">
                    <div class="input-group" id="container">
                        <input class="form-control" name="research" id="research" type="search" placeholder="Enter username" aria-label="Enter search term..." aria-describedby="button-search" onclick="userAutocomplete()"/>
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
                            "<input class='form-control' name='research' id='research' type='search' value='" + valore + "' placeholder='Enter username' aria-label='Enter search term...' aria-describedby='button-search' />" +
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
                            "<input class='form-control' name='research' id='research' type='search' value='" + valore + "' placeholder='Enter place' aria-label='Enter search term...' aria-describedby='button-search' onclick='initAutocomplete()'/>" +
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
<!-- Section-->
<section class="py-5">

    <div class="row">
        <!-- Blog entries-->
        {if $arrayUser}
        {if isset($arrayUser)}
        {for $i=0;$i<=count($arrayUser)-1;$i++}
        <div class="row py-3">
            <div class="card">
                <div class="card-header">
                    <img class="rounded-circle" src='data:{$type[$i]};charset=utf-8;base64,{$pic64[$i]}' width="65" height="65" alt="...">
                    <B><a href="/logBook/Research/profileDetail/{$arrayUser[$i]->getUserID()}">{$arrayUser[$i]->getUsername()}</a></B>
                </div>
                <div class="container px-4 px-lg-5 mt-3">

                        {if $post[$i]}
                    <div class="row gx-4 py-1 gx-lg-5 row-cols-3 row-cols-md-3 row-cols-xl-3 justify-content-start">
                            {if $post[$i]!=null}
                                {for $j=0; $j<count($post[$i]) && $j<=2; $j++}
                                    <div class="col-md-5 my-2">
                                        <div class="card py-3 mb-4">
                                            <div class="text-center">
                                                <!-- Product name-->
                                                <h3 class="fw-bolder">{$post[$i][$j]->getTitle()}</h3>
                                                <!-- Product price-->
                                                <h5 class="text-muted ">{$post[$i][$j]->getCreationDate()}</h5>
                                                <a class="btn btn-primary py-2" href="/logBook/Research/postDetail/{$post[$i][$j]->getPostID()}">Go to the Post →</a>
                                            </div>
                                        </div>
                                    </div>
                                {/for}
                            {/if}
                    </div>
                        {else}
                            <p align="center">This user has no post</p>
                        {/if}
                </div>
            </div>
        </div>
        {/for}
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