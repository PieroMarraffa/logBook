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
    <form method="post" id="form_create_post" action="/logBook/Post/savePost">
        <div class="row">
            <div class="col-md-9">
                <div class="card">

                    <div class="col-md-11 py-4">

                        <input type="text" name="title" id="title" class='mx-3 form-control bg-opacity-10' placeholder='Insert title here' size="100%" rows='1' value="{$travelTitle}">

                        <img class="mx-3 my-5" src="https://dummyimage.com/1050x700/dee2e6/6c757d.jpg" width="1050" height="700" alt="image">
                    </div>
                    <a name="experiences"></a>
                    {if $array_experience}
                    {if is_array($array_experience)}
                    {foreach $array_experience as $exp}
                        <div class="card">
                            <div class="card-header">
                                <textarea class="form-control" name="titleExperience{$exp->getExperienceID()}" rows="1" maxlength="49" placeholder="Insert experience title here">{$exp->getTitle()}</textarea>
                                <div class="row py-2">
                                    <div class="col-md-3">
                                        <input type="date" name="startDate{$exp->getExperienceID()}" class="px-2" value="{$exp->getStartDay()}">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="date" name="endDate{$exp->getExperienceID()}" class="px-2" value="{$exp->getEndDay()}">
                                    </div>
                                    <div class="col-md-3">
                                        <select class="btn btn-primary" name="place{$exp->getExperienceID()}">
                                            <option value="{$exp->getPlace()->getPlaceID()}">{$exp->getPlace()->getName()}</option>
                                            {if isset($arrayPlace)}
                                                {foreach $arrayPlace as $p}
                                                    {if $p->getName() != $exp->getPlace()->getName()}
                                                        <option value="{$p->getPlaceID()}">{$p->getName()}</option>
                                                    {/if}
                                                {/foreach}
                                            {/if}
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <textarea class="form-control" name="descriprion{$exp->getExperienceID()}" maxlength="499" rows="6" placeholder="Insert description here">{$exp->getDescription()}</textarea>
                            </div>
                            <div align="end">
                                <a type="button" class="my-3 mx-3 btn btn-danger" onclick="remove({$exp->getExperienceID()})">- Delete Experience</a>
                            </div>
                        </div>
                    {/foreach}
                    {/if}
                    {/if}
                    <div class="col-md-8">

                        <div class="container py-3" id="container">
                        </div>
                        <div class="col-md-4">
                            <input name="send" type="submit" form="form_create_post" class="mx-3 my-3 btn btn-primary">
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-md-3 fisso" >
                <div class="card">
                    <div class="row">
                        <a type="button" class="btn btn-primary "  onclick="creaExperience()" href="#experiences" >+ Add Experience</a>
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
    </form>
</section>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>