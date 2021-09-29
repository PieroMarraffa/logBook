<?php
/* Smarty version 3.1.33, created on 2021-09-29 00:44:19
  from 'C:\xampp\htdocs\logBook\Smarty\templates\admin_reported_user.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_61539ac3a839c4_48212019',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '45d00cef41b4872df28c2d01f2d54c0b210b18f2' => 
    array (
      0 => 'C:\\xampp\\htdocs\\logBook\\Smarty\\templates\\admin_reported_user.tpl',
      1 => 1632869056,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61539ac3a839c4_48212019 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Homepage - Start Bootstrap Template</title>
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
</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-light bg-light static-top">
    <div class="container">
        <div class="col-md-4">
        <img src="/logBook/Smarty/immagini/logo_logbook.PNG"  width="243" height="62"></div>
        <div class="col-md-2">
        <a href="/logBook/Admin/reported_comment">Reported comments</a></div>
        <div class="col-md-2">
        <a href="/logBook/Admin/reported_posts" >Reported posts</a></div>
        <div class="col-md-2">
        <a href="/logBook/Admin/reported_user" >Reported user</a></div>
        <div class="col-md-2">
            <a class="btn btn-primary align-content-end" href="/logBook/Admin/adminLogout">Logout</a></div>
    </div>
</nav>
<!-- Section-->
<section class=" py-5">
<div align="center">
    <?php if ($_smarty_tpl->tpl_vars['userReported']->value) {?>
    <?php if (is_array($_smarty_tpl->tpl_vars['userReported']->value)) {?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['userReported']->value, 'u');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['u']->value) {
?>
            <div class="col-md-4 my-4">
                <div id="user" class="card">
                    <!-- INSERISCI L'IMMAGINE DELL'UTENTE-->
                    <div class="card-header">
                        <div class="flex-shrink-0"><img class="rounded-circle" width="100" height="100" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                        <div class="ms-3">
                            <div class="fw-bold"><?php echo $_smarty_tpl->tpl_vars['u']->value->getUsername();?>
<br><button onclick="remove()" id="bann" class="btn btn-primary mx-3">
                                     Bann</button><button onclick="remove()" id="ignore" class="btn btn-primary mx-3"> Ignore</button>
                            <a class="btn btn-primary" href="/logBook/Research/postDetail/<?php echo $_smarty_tpl->tpl_vars['u']->value->getUserID();?>
"> Go to the Profile → </a></div>
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
    <?php if ($_smarty_tpl->tpl_vars['userBanned']->value) {?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['userBanned']->value, 'u');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['u']->value) {
?>
            <div class="col-md-4">
                <div id="user" class="card">
                    <!-- INSERISCI L'IMMAGINE DELL'UTENTE-->
                    <div class="card-header">
                        <div class="flex-shrink-0"><img class="rounded-circle" width="100" height="100" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                        <div class="ms-3">
                            <div class="fw-bold"><?php echo $_smarty_tpl->tpl_vars['u']->value->getName();?>
<br><button onclick="remove()" id="bann" class="btn btn-primary">
                                    Bann</button><button onclick="remove()" id="ignore" class="btn btn-primary"> Ignore</button></div>
                            <a class="btn btn-primary" href="/logBook/Research/postDetail/<?php echo $_smarty_tpl->tpl_vars['u']->value->getID();?>
">Go to the Profile → </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
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
