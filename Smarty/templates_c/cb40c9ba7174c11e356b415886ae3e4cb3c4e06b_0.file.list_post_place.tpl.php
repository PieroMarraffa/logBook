<?php
/* Smarty version 3.1.33, created on 2021-11-23 12:08:57
  from 'C:\xampp\htdocs\logBook\Smarty\templates\list_post_place.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_619ccbc9b69278_35046093',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cb40c9ba7174c11e356b415886ae3e4cb3c4e06b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\logBook\\Smarty\\templates\\list_post_place.tpl',
      1 => 1637588078,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_619ccbc9b69278_35046093 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<?php $_smarty_tpl->_assignInScope('userlogged', (($tmp = @$_smarty_tpl->tpl_vars['userlogged']->value)===null||$tmp==='' ? 'nouser' : $tmp));?>
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
    <?php echo '<script'; ?>
>
        function ready(){
            if (!navigator.cookieEnabled) {
                alert('Attenzione! Attivare i cookie per proseguire correttamente la navigazione');
            }
        }
        document.addEventListener("DOMContentLoaded", ready);
    <?php echo '</script'; ?>
>
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
        <div class="col-md-3">
            <a class="navbar-brand" href="/logBook/"><img src="/logBook/Smarty/immagini/logo_logbook.PNG"  width="243" height="62"></a>
        </div>
        <div class="col-md-6 py-3">
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
                <?php echo '<script'; ?>
 async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVf05xLqt9omyf9N1ePbWCVuXeKFhOeos&libraries=places&callback=initialize"> <?php echo '</script'; ?>
>
                <?php echo '<script'; ?>
>
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
                <?php echo '</script'; ?>
>
            </form>
        </div>
        <div class="col-auto">
            <?php if ($_smarty_tpl->tpl_vars['userlogged']->value != 'nouser') {?>
                <a class="btn btn-primary" href="/logBook/User/profile"><?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</a>
            <?php } else { ?>
                <a class="btn btn-primary" href="/logBook/User/login">Sign Up</a>
            <?php }?>
        </div>
    </div>
</nav>
<!-- Header-->
<header class="bg-primary py-5">
    <div class="row">
        <div class = "col-md-6">
            <div id="map"></div>
            <?php echo '<script'; ?>
>

                function initialize() {
                    var map = new google.maps.Map(document.getElementById('map'), {
                        <?php if ($_smarty_tpl->tpl_vars['Place']->value->getName() != $_smarty_tpl->tpl_vars['Place']->value->getCountryName()) {?>
                        zoom: 13,
                        <?php } else { ?>
                        zoom:6,
                        <?php }?>
                        center: new google.maps.LatLng(<?php echo $_smarty_tpl->tpl_vars['Place']->value->getLatitude();?>
,<?php echo $_smarty_tpl->tpl_vars['Place']->value->getLongitude();?>
),
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    });
                    <?php if (isset($_smarty_tpl->tpl_vars['Place']->value)) {?>
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(<?php echo $_smarty_tpl->tpl_vars['Place']->value->getLatitude();?>
,<?php echo $_smarty_tpl->tpl_vars['Place']->value->getLongitude();?>
),
                        map: map,
                        icon: 'https://maps.google.com/mapfiles/ms/micons/' + 'red-pushpin.png'
                    });
                    <?php }?>
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
            <?php echo '</script'; ?>
>
        </div>
        <div class="col-md-5 justify-content-end px-5 my-5 py-5">
            <div class="d-flex w-100 justify-content-between">
                <p class="text-white align-content-start dimension_title testo1"><b><?php echo $_smarty_tpl->tpl_vars['research']->value;?>
 </b></p>
            </div>
            <div class="d-flex w-100 justify-content-between">
                <p class="text-white align-content-start testo2"><?php echo $_smarty_tpl->tpl_vars['Place']->value->getCountryName();?>
</p>
            </div>
            <?php if (!isset($_smarty_tpl->tpl_vars['arrayPostPlace']->value)) {?>
            <div class="d-flex w-100 justify-content-between">
                <p class="text-white align-content-start testo2">No results for this place</p>
            </div>
            <?php }?>
        </div>
    </div>
</header>
<!-- Section-->
<div class="container px-4 px-lg-5 mt-5">
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-start">
        <!-- Blog entries-->
        <?php if ($_smarty_tpl->tpl_vars['arrayPostPlace']->value) {?>
        <?php if (isset($_smarty_tpl->tpl_vars['arrayPostPlace']->value)) {?>
                <!-- Blog post-->
        <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);
$_smarty_tpl->tpl_vars['i']->value = 0;
if ($_smarty_tpl->tpl_vars['i']->value <= count($_smarty_tpl->tpl_vars['arrayPostPlace']->value)-1) {
for ($_foo=true;$_smarty_tpl->tpl_vars['i']->value <= count($_smarty_tpl->tpl_vars['arrayPostPlace']->value)-1; $_smarty_tpl->tpl_vars['i']->value++) {
?>
        <?php if (isset($_smarty_tpl->tpl_vars['arrayPostPlace']->value[$_smarty_tpl->tpl_vars['i']->value])) {?>
        <div class="col md-4" >
            <div class="card mb-4">
                <!-- Profile image-->
                <a href="/logBook/Research/postDetail/<?php echo $_smarty_tpl->tpl_vars['arrayPostPlace']->value[$_smarty_tpl->tpl_vars['i']->value]->getPostID();?>
">
                    <img class="card-img-top" src='data:<?php echo $_smarty_tpl->tpl_vars['typeImg']->value[$_smarty_tpl->tpl_vars['i']->value];?>
;charset=utf-8;base64,<?php echo $_smarty_tpl->tpl_vars['pic64Img']->value[$_smarty_tpl->tpl_vars['i']->value];?>
' height="300" width="400" alt="..."></a>
                <div class="card-body">
                                <div class="small text-muted"><?php echo $_smarty_tpl->tpl_vars['arrayPostPlace']->value[$_smarty_tpl->tpl_vars['i']->value]->getCreationDate();?>
</div>
                                <h2 class="card-title h4"><?php echo $_smarty_tpl->tpl_vars['arrayPostPlace']->value[$_smarty_tpl->tpl_vars['i']->value]->getTitle();?>
</h2>
                                <a class="btn btn-primary" href="/logBook/Research/postDetail/<?php echo $_smarty_tpl->tpl_vars['arrayPostPlace']->value[$_smarty_tpl->tpl_vars['i']->value]->getPostID();?>
">Go to the Post →</a>
                            </div>
                        </div>
                    </div>
            <?php }?>
                <?php }
}
?>
            </div>
        <?php }?>
        <?php }?>
    </div>
</div>
<!-- Bootstrap core JS-->
<?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
<!-- Core theme JS-->
<?php echo '<script'; ?>
 src="js/scripts.js"><?php echo '</script'; ?>
>
</body>
</html><?php }
}
