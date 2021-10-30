<?php
/* Smarty version 3.1.33, created on 2021-10-30 15:21:21
  from 'C:\xampp\htdocs\logBook\Smarty\templates\post_detail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_617d46d1cced62_43294134',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '09c0433a8d5345448bd7edf95401b5d4c00c737e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\logBook\\Smarty\\templates\\post_detail.tpl',
      1 => 1635600068,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_617d46d1cced62_43294134 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<?php $_smarty_tpl->_assignInScope('userlogged', (($tmp = @$_smarty_tpl->tpl_vars['userlogged']->value)===null||$tmp==='' ? 'nouser' : $tmp));?>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Post</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="/logBook/Smarty/immagini/immagine_logo.JPG" />
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
            height: 400px;
            width: 100%;
        }
    </style>
    <?php echo '<script'; ?>
 src="/logBook/Smarty/js/bootstrap.js"><?php echo '</script'; ?>
>
</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-light bg-light static-top">
    <div class="container">
        <a class="navbar-brand" href="/logBook/"><img src="/logBook/Smarty/immagini/logo_logbook.PNG"  width="243" height="62" alt="logo"></a>
        <?php if ($_smarty_tpl->tpl_vars['userlogged']->value != 'nouser') {?>
            <a class="btn btn-primary" href="/logBook/User/profile"><?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</a>
        <?php } else { ?>
            <a class="btn btn-primary" href="/logBook/User/login">Sign Up</a>
        <?php }?>
    </div>
</nav>
<!-- Page content-->
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Post content-->
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <div class="row">
                        <div class="col-md-7">
                        <h1 class="fw-bolder mb-1"><?php echo $_smarty_tpl->tpl_vars['Title']->value;?>
</h1>
                        <!-- Post meta content-->
                        <h4 class="fw-bolder mb-1"><?php echo $_smarty_tpl->tpl_vars['author']->value;?>
</h4>
                        <div class="text-muted fst-italic mb-2">Posted on: <?php echo $_smarty_tpl->tpl_vars['date']->value;?>
</div>
                        </div>
                        <div class="col-md-4" align="end">
                            <div class="btn btn-primary align-content-center" >
                                <a class="navbar-brand" href=""><img src="/logBook/Smarty/immagini/cuore.png" width="30" height="25" class="d-inline-block" alt=""></a>
                            </div>
                            <div class="btn btn-primary align-content-center" >
                                <a class="navbar-brand" href=""><img src="/logBook/Smarty/immagini/cuore_spezzato.png" width="30" height="25" class="d-inline-block" alt=""></a>
                            </div>

                        </div>
                    </div>
                </header>
                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php if (isset($_smarty_tpl->tpl_vars['typeImg']->value[0])) {?>
                            <div class="carousel-item active">
                                <img class="w-100" src='data:<?php echo $_smarty_tpl->tpl_vars['typeImg']->value[0];?>
;charset=utf-8;base64,<?php echo $_smarty_tpl->tpl_vars['pic64Img']->value[0];?>
' alt="...">
                            </div>
                        <?php }?>
                        <?php if (isset($_smarty_tpl->tpl_vars['typeImg']->value[1])) {?>
                        <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);
$_smarty_tpl->tpl_vars['i']->value = 1;
if ($_smarty_tpl->tpl_vars['i']->value <= count($_smarty_tpl->tpl_vars['typeImg']->value)-1) {
for ($_foo=true;$_smarty_tpl->tpl_vars['i']->value <= count($_smarty_tpl->tpl_vars['typeImg']->value)-1; $_smarty_tpl->tpl_vars['i']->value++) {
?>
                            <div class="carousel-item">

                                    <img class="w-100" src='data:<?php echo $_smarty_tpl->tpl_vars['typeImg']->value[$_smarty_tpl->tpl_vars['i']->value];?>
;charset=utf-8;base64,<?php echo $_smarty_tpl->tpl_vars['pic64Img']->value[$_smarty_tpl->tpl_vars['i']->value];?>
' alt="...">

                            </div>
                        <?php }
}
?>
                        <?php }?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <section class="mb-5">
                    <?php if ($_smarty_tpl->tpl_vars['arrayExperience']->value) {?>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrayExperience']->value, 'experience');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['experience']->value) {
?>
                    <div class="card my-3">
                        <div class="card-header">
                            <h4><?php echo $_smarty_tpl->tpl_vars['experience']->value->getTitle();?>
</h4>
                            <div  class="text-muted fst-italic mb-2">From: <?php echo $_smarty_tpl->tpl_vars['experience']->value->getStartDay();?>
   To: <?php echo $_smarty_tpl->tpl_vars['experience']->value->getEndDay();?>
</div>
                        </div>
                        <div class="card-body">
                            <?php echo $_smarty_tpl->tpl_vars['experience']->value->getDescription();?>

                        </div>
                    </div>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <?php }?>
                </section>
            </article>
            <!-- Comments section-->
            <section class="mb-5">
                <div class="card bg-light">
                    <div class="card-body">
                        <!-- Comment form-->
                        <form method="post" id="form_comment" action="/logBook/Post/writeComment" class="mb-4">
                            <textarea class="form-control" id="comment" rows="3" placeholder="Leave a comment!"></textarea>
                            <div align="end">
                                <button class="btn btn-primary my-2" type="submit" form="form_comment" value="Submit"> Post comment </button>
                            </div>
                        </form>
                        <!-- Comment -->
                        <?php if ($_smarty_tpl->tpl_vars['arrayComment']->value) {?>
                            <?php if (isset($_smarty_tpl->tpl_vars['arrayComment']->value)) {?>
                                <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);
$_smarty_tpl->tpl_vars['i']->value = 0;
if ($_smarty_tpl->tpl_vars['i']->value <= count($_smarty_tpl->tpl_vars['arrayComment']->value)-1) {
for ($_foo=true;$_smarty_tpl->tpl_vars['i']->value <= count($_smarty_tpl->tpl_vars['arrayComment']->value)-1; $_smarty_tpl->tpl_vars['i']->value++) {
?>
                                <div class="d-flex mb-4">
                                    <!-- INSERISCI L'IMMAGINE DELL'UTENTE-->
                                    <?php if (isset($_smarty_tpl->tpl_vars['arrayComment']->value[$_smarty_tpl->tpl_vars['i']->value])) {?>
                                            <div class="flex-shrink-0"><img class="rounded-circle" src='data:<?php echo $_smarty_tpl->tpl_vars['type']->value[$_smarty_tpl->tpl_vars['i']->value];?>
;charset=utf-8;base64,<?php echo $_smarty_tpl->tpl_vars['pic64']->value[$_smarty_tpl->tpl_vars['i']->value];?>
' width="65" height="65" alt="..."></div>
                                            <div class="ms-3">
                                                <div class="h5"><?php echo $_smarty_tpl->tpl_vars['arrayComment']->value[$_smarty_tpl->tpl_vars['i']->value]->getAuthor()->getUserName();?>
</div>
                                                <div class="text-muted mb-2"><?php echo $_smarty_tpl->tpl_vars['arrayComment']->value[$_smarty_tpl->tpl_vars['i']->value]->getContent();?>
</div>
                                            </div>
                                        <?php }?>
                                </div>
                                <?php }
}
?>
                            <?php }?>
                        <?php }?>
                    </div>
                </div>
            </section>
        </div>
        <!-- Side widgets-->
        <div class="col-lg-4">
            <!-- Search widget-->
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Map</h5>
                </div>
                <div class="card-body">
                    <div id="map"></div>

                    <?php echo '<script'; ?>
 async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgGqDyRzOb655kefklsqI12vpj2idk8Es&callback=initialize"> <?php echo '</script'; ?>
>

                    <?php echo '<script'; ?>
>
                        function initialize() {
                            var map = new google.maps.Map(document.getElementById('map'), {
                                zoom: 2,
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

                            }
                        }
                    <?php echo '</script'; ?>
>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Bootstrap core JS-->
<?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
</body>
</html><?php }
}
