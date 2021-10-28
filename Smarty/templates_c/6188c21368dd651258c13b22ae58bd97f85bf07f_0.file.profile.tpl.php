<?php
/* Smarty version 3.1.33, created on 2021-10-28 16:32:15
  from '/Applications/XAMPP/xamppfiles/htdocs/logBook/Smarty/templates/profile.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_617ab46f43f893_70304897',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6188c21368dd651258c13b22ae58bd97f85bf07f' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/logBook/Smarty/templates/profile.tpl',
      1 => 1635431464,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_617ab46f43f893_70304897 (Smarty_Internal_Template $_smarty_tpl) {
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
<header class="bg-light border-bottom mb-4">
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
        <div class="col-md-1">
            <div class="btn btn-primary align-content-center" ><a class="navbar-brand" href="/logBook/User/changeCredential"><img src="/logBook/Smarty/immagini/pencil.png" width="30" height="25" class="d-inline-block" alt=""></a></div>
        </div>
        <div class="col-md-1">
            <a class="btn btn-primary" href="/logBook/Post/create_post">+ Post</a>
        </div>
        <div class="col-md-1">
            <a class="btn btn-primary" href="/logBook/User/logout">Logout</a>
        </div>
    </div>
</div>


<div class="container my-5">
    <div class="row">
        <!-- Blog entries-->
        <?php if ($_smarty_tpl->tpl_vars['postList']->value) {?>
        <?php if (isset($_smarty_tpl->tpl_vars['postList']->value)) {?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['postList']->value, 'p');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['p']->value) {
?>
                    <!-- Blog post-->
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img class="card-img-top" src="" alt="..." />
                            <div class="card-body">
                                <div class="small text-muted"><?php echo $_smarty_tpl->tpl_vars['p']->value->getCreationDate();?>
</div>
                                <h2 class="card-title h4"><?php echo $_smarty_tpl->tpl_vars['p']->value->getTitle();?>
</h2>
                                <a class="btn btn-primary" href="">Go to the Post →</a>
                            </div>
                        </div>
                    </div>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
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
