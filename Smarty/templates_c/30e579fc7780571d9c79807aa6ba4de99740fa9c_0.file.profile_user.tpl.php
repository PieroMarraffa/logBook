<?php
/* Smarty version 3.1.33, created on 2021-11-01 17:54:41
  from 'C:\xampp\htdocs\logBook\Smarty\templates\profile_user.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_61801bd1b230a1_10829225',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '30e579fc7780571d9c79807aa6ba4de99740fa9c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\logBook\\Smarty\\templates\\profile_user.tpl',
      1 => 1635785648,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61801bd1b230a1_10829225 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php echo $_smarty_tpl->tpl_vars['user']->value->getUsername();?>
</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="/logBook/Smarty/immagini/immagine_logo.JPG" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="/logBook/Smarty/css/styles.css" rel="stylesheet" />
    <link href="/logBook/Smarty/css/profile.css" rel="stylesheet" />
    <?php echo '<script'; ?>
 type="text/javascript" src="../js/profile_map.js"><?php echo '</script'; ?>
>
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
        <a class="navbar-brand" href="/logBook/User/home"><img src="/logBook/Smarty/immagini/logo_logbook.PNG"  width="300" height="90"></a>
    </div>
</nav>
<!-- Page header with logo and tagline-->
<header class="py-5 bg-light border-bottom mb-4">

    <div id="map"></div>

    <?php echo '<script'; ?>
 async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgGqDyRzOb655kefklsqI12vpj2idk8Es&callback=initialize"> <?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
>

        function initialize() {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 2.5,
                center: new google.maps.LatLng(30,0),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            var locations = [];
            <?php if (isset($_smarty_tpl->tpl_vars['array_place']->value)) {?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['array_place']->value, 'a');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['a']->value) {
?>
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(<?php echo $_smarty_tpl->tpl_vars['a']->value->getLatitude();?>
,<?php echo $_smarty_tpl->tpl_vars['a']->value->getLongitude();?>
),
                map: map,
                icon: 'http://maps.google.com/mapfiles/ms/micons/' + 'red-pushpin.png'
            });
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php }?>
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
    <?php echo '</script'; ?>
>
    <!--script di google maps per visualizzare tutti i posti dove è stato l'utente-->
</header>
<!-- Page content-->
<div class="container my-5">
    <div class="row">
        <div class="col-md-2">
            <img class="rounded-circle" src='data:<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
;charset=utf-8;base64,<?php echo $_smarty_tpl->tpl_vars['pic64']->value;?>
' width="150" height="150" alt="...">
        </div>
        <div class="col-md-6">

            <h2><b><?php echo $_smarty_tpl->tpl_vars['user']->value->getUsername();?>
</b></h2>
            <h5><?php echo $_smarty_tpl->tpl_vars['user']->value->getDescription();?>
</h5>
        </div>
        <div class="col-md-4" align="end" >
            <div class="btn btn-danger justify-content-end" >
                <a class="navbar-brand justify-content-end" href="/logBook/Research/report/<?php echo $_smarty_tpl->tpl_vars['user']->value->getUserID();?>
">
                    <img src="/logBook/Smarty/immagini/alert.png" width="35" height="35" class="d-inline-block" alt="">
                </a>
            </div>
        </div>
    </div>
</div>


<div class="container px-4 px-lg-5 mt-5">
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-start">
        <?php if ($_smarty_tpl->tpl_vars['postList']->value) {?>
            <?php if (isset($_smarty_tpl->tpl_vars['postList']->value)) {?>
                <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);
$_smarty_tpl->tpl_vars['i']->value = 0;
if ($_smarty_tpl->tpl_vars['i']->value <= count($_smarty_tpl->tpl_vars['postList']->value)-1) {
for ($_foo=true;$_smarty_tpl->tpl_vars['i']->value <= count($_smarty_tpl->tpl_vars['postList']->value)-1; $_smarty_tpl->tpl_vars['i']->value++) {
?>
                    <?php if (isset($_smarty_tpl->tpl_vars['postList']->value[$_smarty_tpl->tpl_vars['i']->value])) {?>
                        <div class="col md-4" >
                            <div class="card mb-4">
                                <!-- Profile image-->
                                <img class="card-img-top" src='data:<?php echo $_smarty_tpl->tpl_vars['typeImg']->value[$_smarty_tpl->tpl_vars['i']->value];?>
;charset=utf-8;base64,<?php echo $_smarty_tpl->tpl_vars['pic64Img']->value[$_smarty_tpl->tpl_vars['i']->value];?>
' height="300" width="400" alt="...">
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder"><?php echo $_smarty_tpl->tpl_vars['postList']->value[$_smarty_tpl->tpl_vars['i']->value]->getTitle();?>
</h5>
                                        <!-- Product price-->
                                        <h6 class="text-muted "><?php echo $_smarty_tpl->tpl_vars['postList']->value[$_smarty_tpl->tpl_vars['i']->value]->getCreationDate();?>
</h6>
                                        <a class="btn btn-primary py-2" href="/logBook/Research/postDetail/<?php echo $_smarty_tpl->tpl_vars['postList']->value[$_smarty_tpl->tpl_vars['i']->value]->getPostID();?>
">Go to the Post →</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }?>
                <?php }
}
?>
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
