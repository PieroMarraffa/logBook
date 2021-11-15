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

    <form method="post" id="form_create_post"  action="/logBook/Post/savePost/{$postID}" enctype="multipart/form-data">
        <a name="headPage"></a>
    <div class="row">
        <div class="col-md-9">
            <div class="card">

                        <div class="col-md-11 py-4">

                            {if $creaPost == true}
                            <input type="text" name="title" required id="title" class='mx-3 form-control bg-opacity-10' placeholder='Insert title here' size="100%" rows='1' >

                            <p class="text-justify text-dark align-content-start px-5 py-4 h5">
                                    <b>
                                        This is the post's creation form, here you can create your posts.</br></br>

                                    A post is composed by a title, some experience (not less than one) and the images.</br></br>

                                    You can insert a title in the form on top of the page.</br></br>

                                    You can create an experience clicking on the button "Add Experience" and</br>
                                    you can add the images clicking on the button "Add Image".</br></br>

                                    You can also modify the post clicking on the button "Modify Post" in the</br>
                                        post page.</br></br>

                                    If your post won't have a title or at list one complete experience won't be saved</br></br>
                                    </b>
                                </p>
                        </div>
                        <div class="col-md-8">

                            <div class="container py-3" id="container">
                            </div>

                        </div>
            </div>
        </div>
        {else}
        <input type="text" name="title" required id="title" required class='mx-3 form-control bg-opacity-10' placeholder='Insert title here' size="100%" rows='1' value="{$travelTitle}">

        <div class="py-3">
            {if isset($image)}
                {for $i=0;$i<=count($image)-1;$i++}
                    <div class="row align-content-md-center py-3">
                        <div class="col-md-8 align-content-center">
                            <img class="card-img-top w-100" src='data:{$typeImg[$i]};charset=utf-8;base64,{$pic64Img[$i]}'  alt="...">
                        </div>
                        <div class="col-md-3 align-content-center" align="center">
                            <a class="btn btn-danger" href="/logBook/Post/deleteExistingImage/{$image[$i]->getImageID()}/{$postID}"> Delete </a>
                        </div>
                    </div>
                {/for}
            {/if}
        </div>
    </div>
        {if $array_experience}
            {if is_array($array_experience)}
                {foreach $array_experience as $exp}
                    <div class="card">
                        <div class="card-header">
                            <textarea class="form-control" name="titleExperience[]" rows="1" required maxlength="49" placeholder="Insert experience title here">{$exp->getTitle()}</textarea>
                            <div class="row py-2">
                                <div class="col-md-3">
                                    <input type="date" name="startDate[]" class="px-2" required value="{$exp->getStartDay()}">
                                </div>
                                <div class="col-md-3">
                                    <input type="date" name="endDate[]" class="px-2"  required value="{$exp->getEndDay()}">
                                </div>
                                <div class="col-md-3">
                                    <select class="btn btn-primary" name="place[]">
                                        {if isset($arrayMete)}
                                            <optgroup label="Tourist Destination">
                                                {if count($arrayMete) == 1}
                                                    {if $exp->getPlace()->getPlaceID() == $arrayMete->getPlaceID()}
                                                        <option selected value="{$arrayMete->getPlaceID()}">{$arrayMete->getName()}</option>
                                                    {else}
                                                        <option value="{$arrayMete->getPlaceID()}">{$arrayMete->getName()}</option>
                                                    {/if}
                                                {else}
                                                    {foreach $arrayMete as $mete}
                                                        {if $exp->getPlace()->getPlaceID() == $mete->getPlaceID()}
                                                            <option selected value="{$mete->getPlaceID()}">{$mete->getName()}</option>
                                                        {else}
                                                            <option value="{$mete->getPlaceID()}">{$mete->getName()}</option>
                                                        {/if}
                                                    {/foreach}
                                                {/if}
                                            </optgroup>
                                        {/if}

                                        {if isset($arrayCity)}
                                            <optgroup label="Cities">
                                                {if count($arrayCity) == 1}
                                                    {if $exp->getPlace()->getPlaceID() == $arrayCity->getPlaceID()}
                                                        <option selected value="{$arrayCity->getPlaceID()}">{$arrayCity->getName()}</option>
                                                    {else}
                                                        <option value="{$arrayCity->getPlaceID()}">{$arrayCity->getName()}</option>
                                                    {/if}
                                                {else}
                                                    {foreach $arrayCity as $city}
                                                        {if $exp->getPlace()->getPlaceID() == $city->getPlaceID()}
                                                            <option selected value="{$city->getPlaceID()}">{$city->getName()}</option>
                                                        {else}
                                                            <option value="{$city->getPlaceID()}">{$city->getName()}</option>
                                                        {/if}
                                                    {/foreach}
                                                {/if}
                                            </optgroup>
                                        {/if}

                                        {if isset($arrayRegion)}
                                            <optgroup label="Regions">
                                            {if count($arrayRegion) == 1}
                                                {if $exp->getPlace()->getPlaceID() == $arrayRegion->getPlaceID()}
                                                    <option selected value="{$arrayRegion->getPlaceID()}">{$arrayRegion->getName()}</option>
                                                {else}
                                                    <option value="{$arrayRegion->getPlaceID()}">{$arrayRegion->getName()}</option>
                                                {/if}
                                            {else}
                                                {foreach $arrayRegion as $region}
                                                    {if $exp->getPlace()->getPlaceID() == $region->getPlaceID()}
                                                        <option selected value="{$region->getPlaceID()}">{$region->getName()}</option>
                                                    {else}
                                                        <option value="{$region->getPlaceID()}">{$region->getName()}</option>
                                                    {/if}
                                                {/foreach}
                                            {/if}
                                            </optgroup>
                                        {/if}

                                        {if isset($arrayState)}
                                            <optgroup label="Stetes">
                                            {if count($arrayState) == 1}
                                                {if $exp->getPlace()->getPlaceID() == $arrayState->getPlaceID()}
                                                    <option selected value="{$arrayState->getPlaceID()}">{$arrayState->getName()}</option>
                                                {else}
                                                    <option value="{$arrayState->getPlaceID()}">{$arrayState->getName()}</option>
                                                {/if}
                                            {else}
                                                {foreach $arrayState as $state}
                                                    {if $exp->getPlace()->getPlaceID() == $state->getPlaceID()}
                                                        <option selected value="{$state->getPlaceID()}">{$state->getName()}</option>
                                                    {else}
                                                        <option value="{$state->getPlaceID()}">{$state->getName()}</option>
                                                    {/if}
                                                {/foreach}
                                            {/if}
                                            </optgroup>
                                        {/if}
                                    </select>
                                </div>
                                <div class="col-md-3">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <textarea required class="form-control" name="description[]" maxlength="499" rows="6" placeholder="Insert description here">{$exp->getDescription()}</textarea>
                        </div>
                        <div align="end">
                            <a type="button" class="my-3 mx-3 btn btn-danger" href="/logBook/Post/deleteExistingExperience/{$exp->getExperienceID()}/{$postID}">- Delete Experience</a>
                        </div>
                    </div>
                {/foreach}
            {/if}
        {/if}
        <div class="col-md-8">

            <div class="container py-3" id="container">
            </div>
            <div class="col-md-8">

            </div>

        </div>

        </div>
        </div>
        {/if}
        <div class="col-md-3 fisso" >
            <div align="center">
                <a type="button" href="#headPage"><img src="/logBook/Smarty/immagini/buttonUp.png" width="100" height="100" class="d-inline-block" alt=""></a>
                <a type="button" href="#bottomPage"><img src="/logBook/Smarty/immagini/buttonDOWN.png" width="100" height="100" class="d-inline-block" alt=""></a>
            </div>
            <div class="card">
            <div class="row">
                <script id="creaExperience">

                    function defaultDate(numCode){
                        var d1 = new Date(document.getElementById('date1'+ numCode).value);
                        var d2 = new Date(document.getElementById('date2'+ numCode).value);

                        if (d2.getDate()<d1.getDate()) {
                            alert("You cannot enter an end date that is earlier than the start date");
                            document.getElementById('date2'+ numCode).value= null;
                        }
                    }

                    function creaExperience() {
                        nuovo_elemento = document.createElement("div");
                        var numCode = parseInt(document.getElementById("container").childNodes.length + 1);
                        nuovo_elemento.setAttribute("id", "quadro" + parseInt(document.getElementById("container").childNodes.length + 1));
                        nuovo_elemento.setAttribute("class", "quadrato");
                        nuovo_elemento.innerHTML =
                            "<div class='card'>" +
                            "<div class='card-header'>" +
                            "<input type='text' class='form-control' required name='titleExperience[]' rows='1' maxlength='49' placeholder='Insert experience title here'></textarea>" +
                            "<div class='row py-2'>" +
                            "<div class='col-md-3'>" +
                            "<input type='date' required name='startDate[]' id='date1"+numCode +"' onchange='defaultDate("+numCode+")' class='px-2'>" +
                            "</div><div class='col-md-3'>" +
                            "<input type='date' required name='endDate[]' id='date2"+numCode +"' onchange='defaultDate("+numCode+")' class='px-2'>" +
                            "</div><div class='col-md-3'>" +
                            "<select class='btn btn-primary' name='place[]'>" +

                            "{if isset($arrayMete)}" +
                            "<optgroup label='Tourist Destinations'>" +
                            "{if count($arrayMete) == 1}" +
                            "<option value='{$arrayMete->getPlaceID()}'>{$arrayMete->getName()}</option>" +
                            "{else}" +
                            "{foreach $arrayMete as $m}" +
                            "<option value='{$m->getPlaceID()}'>{$m->getName()}</option>" +
                            "{/foreach}"+
                            "{/if}" +
                            "</optgroup>" +
                            "{/if}" +

                            "{if isset($arrayCity)}" +
                            "<optgroup label='Cities'>" +
                            "{if count($arrayCity) == 1}" +
                            "<option value='{$arrayCity->getPlaceID()}'>{$arrayCity->getName()}</option>" +
                            "{else}" +
                            "{foreach $arrayCity as $city}" +
                            "<option value='{$city->getPlaceID()}'>{$city->getName()}</option>" +
                            "{/foreach}"+
                            "{/if}" +
                            "</optgroup>" +
                            "{/if}" +

                            "{if isset($arrayRegion)}" +
                            "<optgroup label='Regions'>" +
                            "{if count($arrayRegion) == 1}" +
                            "<option value='{$arrayRegion->getPlaceID()}'>{$arrayRegion->getName()}</option>" +
                            "{else}" +
                            "{foreach $arrayRegion as $region}" +
                            "<option value='{$region->getPlaceID()}'>{$region->getName()}</option>" +
                            "{/foreach}"+
                            "{/if}" +
                            "</optgroup>" +
                            "{/if}" +

                            "{if isset($arrayState)}" +
                            "<optgroup label='States'>" +
                            "{if count($arrayState) == 1}" +
                            "<option value='{$arrayState->getPlaceID()}'>{$arrayState->getName()}</option>" +
                            "{else}" +
                            "{foreach $arrayState as $state}" +
                            "<option value='{$state->getPlaceID()}'>{$state->getName()}</option>" +
                            "{/foreach}"+
                            "{/if}" +
                            "</optgroup>" +
                            "{/if}" +

                            "</select>" +
                            "</div>" +
                            "<div class='col-md-3'></div></div></div>" +
                            "<div class='card-body'>" +
                            "<textarea class='form-control' required name='description[]' maxlength='499' rows='6' placeholder='Insert description here'></textarea>" +
                            "</div><div align='end'>" +
                            "<a type='button' class='my-3 mx-3 btn btn-danger '  onclick='remove(" + numCode + ")' href='#experiences'>- Delete Experience</a>" +
                            "</div></div>";

                        document.getElementById("container").appendChild(nuovo_elemento);
                        obj = eval("document.getElementById(\"quadro" + parseInt(document.getElementById("container").childNodes.length) + "\")");
                        obj.style.height = "450px";
                        obj.style.width = "1000px";
                    }

                </script>
                <a type="button" class="btn btn-primary " onclick="creaExperience()" href="#bottomPage">+ Add Experience</a>
            </div>
            <div class="row">
                <button type="button" class="btn btn-primary  my-1 " onclick="creaImage()" >+ Add Image</button>
            </div>
                <div id="container2" class="col">
            </div>
            </div>
        </div>
    </div>
        <button name="send" type="submit" form="form_create_post" class="mx-3 my-3 btn btn-primary" >Salva</button>
        {if !isset($postID)}
            <a name="send" href="/logBook/User/profile" class="mx-3 my-3 btn btn-warning" >Annulla</a>
        {else}
            <a name="send" href="/logBook/Post/annullaModifiche/{$postID}/" class="btn btn-warning">Annulla</a>
        {/if}
        <a name="bottomPage"></a>
    </form>
</section>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>