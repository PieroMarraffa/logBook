<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Creation Post</title>
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
    <script src="/logBook/Smarty/js/crea_post.js"></script>
</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-light bg-light static-top">
    <div class="container">
        <a class="navbar-brand" href="/logBook/"><img src="/logBook/Smarty/immagini/logo_logbook.PNG"  width="243" height="62"></a>
    </div>
</nav>
<section>
    <form method="post" id="form_create_post" action="/logBook/Post/savePost" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-9">
            <div class="card">

                        <div class="col-md-11 py-4">

                            <input type="text" name="title" id="title" class='mx-3 form-control bg-opacity-10' placeholder='Insert title here' size="100%" rows='1' >

                            <img class="mx-3 my-5" src="https://dummyimage.com/1050x700/dee2e6/6c757d.jpg" width="1050" height="700" alt="image">
                        </div>
                        <a name="experiences"></a>
                        <div class="col-md-8">

                            <div class="container py-3" id="container">
                            </div>
                            <div class="col-md-4">
                                <!--input name="send" type="submit" form="form_create_post" class="btn btn-primary" -->
                            </div>

                        </div>

            </div>
        </div>
        <div class="col-md-3 fisso" >
            <div class="card">
            <div class="row">
                <script id="creaExperience">
                    function creaExperience() {
                        nuovo_elemento = document.createElement("div");
                        var numCode = parseInt(document.getElementById("container").childNodes.length + 1);
                        nuovo_elemento.setAttribute("id", "quadro" + parseInt(document.getElementById("container").childNodes.length + 1));
                        nuovo_elemento.setAttribute("class", "quadrato");
                        nuovo_elemento.innerHTML =
                            "<div class='card'>" +
                            "<div class='card-header'>" +
                            "<textarea class='form-control' name='titleExperience[]' rows='1' maxlength='49' placeholder='Insert experience title here'></textarea>" +
                            "<div class='row py-2'>" +
                            "<div class='col-md-3'>" +
                            "<input type='date' name='startDate[]]' class='px-2'>" +
                            "</div><div class='col-md-3'>" +
                            "<input type='date' name='endDate[]]' class='px-2'>" +
                            "</div><div class='col-md-3'>" +
                            //"<button class='btn btn-primary' onclick='selectPlace()'> + Add Place </button>" +
                            "<select class='btn btn-primary' name='place[]]'>" +

                            "{if isset($arrayMete) && count($arrayMete) == 1}" +
                            "<optgroup label='Tourist Destinations'>" +
                            "<option value='{$arrayMete->getPlaceID()}'>{$arrayMete->getName()}</option>" +
                            "</optgroup>" +
                            "{/if}" +

                            "{if isset($arrayMete) && count($arrayMete) > 1}" +
                            "<optgroup label='Tourist Destinations'>" +
                            "{foreach $arrayMete as $m}" +
                            "<option value='{$m->getPlaceID()}'>{$m->getName()}</option>" +
                            "{/foreach}"+
                            "</optgroup>" +
                            "{/if}" +

                            "{if isset($arrayCity) && count($arrayCity) == 1}" +
                            "<optgroup label='Cities'>" +
                            "<option value='{$arrayCity->getPlaceID()}'>{$arrayCity->getName()}</option>" +
                            "</optgroup>" +
                            "{/if}" +

                            "{if isset($arrayCity) && count($arrayCity) > 1}" +
                            "<optgroup label='Cities'>" +
                            "{foreach $arrayCity as $c}" +
                            "<option value='{$c->getPlaceID()}'>{$c->getName()}</option>" +
                            "{/foreach}"+
                            "</optgroup>" +
                            "{/if}" +

                            "{if isset($arrayRegion) && count($arrayRegion) == 1}" +
                            "<optgroup label='Regions'>" +
                            "<option value='{$arrayRegion->getPlaceID()}'>{$arrayRegion->getName()}</option>" +
                            "</optgroup>" +
                            "{/if}" +

                            "{if isset($arrayRegion) && count($arrayRegion) > 1}" +
                            "<optgroup label='Regions'>" +
                            "{foreach $arrayRegion as $c}" +
                            "<option value='{$c->getPlaceID()}'>{$c->getName()}</option>" +
                            "{/foreach}"+
                            "</optgroup>" +
                            "{/if}" +

                            "{if isset($arrayState) && count($arrayState) == 1}" +
                            "<optgroup label='States'>" +
                            "<option value='{$arrayState->getPlaceID()}'>{$arrayState->getName()}</option>" +
                            "</optgroup>" +
                            "{/if}" +

                            "{if isset($arrayState)&& count($arrayState) > 1}" +
                            "<optgroup label='States'>" +
                            "{foreach $arrayState as $s}" +
                            "<option value='{$s->getPlaceID()}'>{$s->getName()}</option>" +
                            "{/foreach}"+
                            "</optgroup>" +
                            "{/if}" +

                            "</select>" +
                            "</div>" +
                            "<div class='col-md-3'></div></div></div>" +
                            "<div class='card-body'>" +
                            "<textarea class='form-control' name='description[]' maxlength='499' rows='6' placeholder='Insert description here'></textarea>" +
                            "</div><div align='end'>" +
                            "<a type='button' class='my-3 mx-3 btn btn-danger '  onclick='remove(" + numCode + ")' href='#experiences'>- Delete Experience</a>" +
                            "</div></div>";
                        document.getElementById("container").appendChild(nuovo_elemento);
                        obj = eval("document.getElementById(\"quadro" + parseInt(document.getElementById("container").childNodes.length) + "\")");
                        obj.style.height = "450px";
                        obj.style.width = "1000px";
                    }
                </script>
                <a type="button" class="btn btn-primary " onclick="creaExperience()" href="#experiences" >+ Add Experience</a>
            </div>
            <div class="row">
                <button type="button" class="btn btn-primary  my-1 " onclick="creaImage()" >+ Add Image</button>
                <input width='100%' class='btn btn-primary my-1' type='file' name='file' id='image' accept='image/png, image/jpeg'>
            </div>
                <div id="container2" class="col">
            </div>
            </div>
        </div>
    </div>
        <button name="send" type="submit" form="form_create_post" class="btn btn-primary" >Salva</button>
    </form>
</section>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>