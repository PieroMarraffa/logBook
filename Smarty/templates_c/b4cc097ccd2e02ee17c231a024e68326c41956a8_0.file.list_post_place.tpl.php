<?php
/* Smarty version 3.1.33, created on 2021-10-28 19:04:35
  from '/Applications/XAMPP/xamppfiles/htdocs/logBook/Smarty/templates/list_post_place.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_617ad823280b46_35626713',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b4cc097ccd2e02ee17c231a024e68326c41956a8' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/logBook/Smarty/templates/list_post_place.tpl',
      1 => 1635431464,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_617ad823280b46_35626713 (Smarty_Internal_Template $_smarty_tpl) {
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
                    <div class="input-group">
                        <input class="form-control" name="research" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                        <label>
                            <select class="btn btn-primary" name="search">
                                <option value="1">Search for user</option>
                                <option value="2">Search for place</option>
                            </select>
                        </label>
                        <button class="btn btn-primary" id="button-search" type="submit">Go!</button>
                    </div>
                </div>
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
 async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgGqDyRzOb655kefklsqI12vpj2idk8Es&callback=initialize"> <?php echo '</script'; ?>
>

            <?php echo '<script'; ?>
>

                function initialize() {
                    var map = new google.maps.Map(document.getElementById('map'), {
                        <?php if ($_smarty_tpl->tpl_vars['Place']->value->getCategory() == "città") {?>
                        zoom: 13,
                        <?php } elseif ($_smarty_tpl->tpl_vars['Place']->value->getCategory() == "meta turistica") {?>
                        zoom: 15,
                        <?php } elseif ($_smarty_tpl->tpl_vars['Place']->value->getCategory() == "nazione") {?>
                        zoom: 6,
                        <?php } else { ?>
                        zoom:10,
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
                <p class="text-white align-content-start dimension_title testo1"><b><?php echo $_smarty_tpl->tpl_vars['Place']->value->getName();?>
 </b></p>
            </div>
            <div class="d-flex w-100 justify-content-between">
                <p class="text-white align-content-start testo2"><?php echo $_smarty_tpl->tpl_vars['Place']->value->getCategory();?>
</p>
            </div>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">

    <div class="row">
        <!-- Blog entries-->
        <?php if ($_smarty_tpl->tpl_vars['arrayPostPlace']->value) {?>
        <?php if (isset($_smarty_tpl->tpl_vars['arrayPostPlace']->value)) {?>
            <div class="row">
                <!-- Blog post-->
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrayPostPlace']->value, 'post');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['post']->value) {
?>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img class="card-img-top" src="https://dummyimage.com/400x300/dee2e6/6c757d.jpg" alt="..." />
                            <div class="card-body">
                                <div class="small text-muted"><?php echo $_smarty_tpl->tpl_vars['post']->value->getCreationDate();?>
</div>
                                <h2 class="card-title h4"><?php echo $_smarty_tpl->tpl_vars['post']->value->getTitle();?>
</h2>
                                <a class="btn btn-primary" href="">Go to the Post →</a>
                            </div>
                        </div>
                    </div>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
        <?php }?>
        <?php }?>
    </div>

</section>
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
