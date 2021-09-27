<?php
/* Smarty version 3.1.33, created on 2021-09-27 17:44:01
  from 'C:\xampp\htdocs\logBook\Smarty\templates\profile.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_6151e6c1483317_83597547',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9657d6d92daaf7a98b91025218cac7601121fddc' => 
    array (
      0 => 'C:\\xampp\\htdocs\\logBook\\Smarty\\templates\\profile.tpl',
      1 => 1632757425,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6151e6c1483317_83597547 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Blog Home - Start Bootstrap Template</title>
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
 async
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAWjZKrvCUmkvwtggiIfQkbtQJYFzeELRc&callback=initMap">
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
            <a class="btn btn-primary" href="  ">+ Post</a>
        </div>
        <div class="col-md-1">
            <a class="btn btn-primary" href="/logBook/User/logout">Logout</a>
        </div>
    </div>
</div>


<div class="container my-5">
    <div class="row">
        <!-- Blog entries-->
        <?php if ($_smarty_tpl->tpl_vars['user']->value->getPostList()) {?>
        <?php if ((($_smarty_tpl->tpl_vars['user']->value->getPostList() !== null ))) {?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['user']->value->getPostList(), 'p');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['p']->value) {
?>

                <div class="row">
                    <!-- Blog post-->
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img class="card-img-top" src="" alt="..." />
                            <div class="card-body">
                                <div class="small text-muted"><?php echo $_smarty_tpl->tpl_vars['p']->value->getDate();?>
</div>
                                <h2 class="card-title h4"><?php echo $_smarty_tpl->tpl_vars['p']->value->getPostTitle();?>
</h2>
                                <p class="card-text"><?php echo $_smarty_tpl->tpl_vars['p']->value->getDescription();?>
</p>
                                <a class="btn btn-primary" href="/logBook/Research/postDetail/<?php echo $_smarty_tpl->tpl_vars['p']->value->getID();?>
">Go to the Post →</a>
                            </div>
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
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
</footer>
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
