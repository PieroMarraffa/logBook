<?php
/* Smarty version 3.1.33, created on 2021-11-15 14:22:14
  from 'C:\xampp\htdocs\logBook\Smarty\templates\admin_reported_user.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_61925f06947265_36602888',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '45d00cef41b4872df28c2d01f2d54c0b210b18f2' => 
    array (
      0 => 'C:\\xampp\\htdocs\\logBook\\Smarty\\templates\\admin_reported_user.tpl',
      1 => 1636982532,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61925f06947265_36602888 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<?php $_smarty_tpl->_assignInScope('immagine', (($tmp = @$_smarty_tpl->tpl_vars['immagine']->value)===null||$tmp==='' ? 'ok' : $tmp));
$_smarty_tpl->_assignInScope('immagine_1', (($tmp = @$_smarty_tpl->tpl_vars['immagine_1']->value)===null||$tmp==='' ? 'ok' : $tmp));?>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin</title>
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
        <div class="col-md-auto">
        <img src="/logBook/Smarty/immagini/logo_logbook.PNG"  width="243" height="62" alt="..."></div>
        <a href="/logBook/Admin/reportedComments"><div class="col-md-auto">
        <b class="h5">Reported comments</b></div></a>
        <a href="/logBook/Admin/reportedPosts" ><div class="col-md-auto">
        <b class="h5">Reported posts</b></div></a>
        <a href="/logBook/Admin/adminHome"><div class="col-md-auto">
                <b class="h5">Reported user</b></div></a>
        <div class="col-md-auto">
            <a class="btn btn-primary align-content-end" href="/logBook/Admin/adminLogout">Logout</a></div>
    </div>
</nav>
<!-- Section-->
<section>
<div class="navbar btn-primary" align="center"><p class="mx-2"><h4>Reported User</h4></p></div>
<div class="row" align="center">
    <?php if ($_smarty_tpl->tpl_vars['userReported']->value) {?>
        <?php if (is_array($_smarty_tpl->tpl_vars['userReported']->value)) {?>
            <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? count($_smarty_tpl->tpl_vars['userReported']->value)-1+1 - (0) : 0-(count($_smarty_tpl->tpl_vars['userReported']->value)-1)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration === 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;?>
                <?php if ($_smarty_tpl->tpl_vars['userReported']->value[$_smarty_tpl->tpl_vars['i']->value]) {?>
            <div class="col-md-4 my-4">
                <div id="user" class="card">
                    <!-- INSERISCI L'IMMAGINE DELL'UTENTE-->
                    <div class="card-header">
                        <?php if ($_smarty_tpl->tpl_vars['immagine_1']->value == 'ok') {?>
                            <img class="rounded-circle ml-3" width="100" height="100" src="data:<?php echo $_smarty_tpl->tpl_vars['typeR']->value[$_smarty_tpl->tpl_vars['i']->value];?>
;base64,<?php echo $_smarty_tpl->tpl_vars['pic64R']->value[$_smarty_tpl->tpl_vars['i']->value];?>
"  alt="profile picture" />
                        <?php } else { ?>
                            <img class=" ml-3" width="100" height="100" src="/logBook/Smarty/immagini/user.png"  alt="profile picture" />
                        <?php }?>
                        <div class="ms-3">
                            <div class="fw-bold"><h4><?php echo $_smarty_tpl->tpl_vars['userReported']->value[$_smarty_tpl->tpl_vars['i']->value]->getUsername();?>
</h4><br><a href="/logBook/Admin/banUser/<?php echo $_smarty_tpl->tpl_vars['userReported']->value[$_smarty_tpl->tpl_vars['i']->value]->getUserID();?>
" id="bann" class="btn btn-primary mx-3">
                                     Bann</a><a href="/logBook/Admin/ignoreUser/<?php echo $_smarty_tpl->tpl_vars['userReported']->value[$_smarty_tpl->tpl_vars['i']->value]->getUserID();?>
" id="ignore" class="btn btn-primary mx-3"> Ignore</a>
                            </div>
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
    <div class="navbar btn-primary" align="center"><p class="mx-2"><h4>Banned User</h4></p></div>

    <div class="row" align="center">
    <?php if ($_smarty_tpl->tpl_vars['userBanned']->value) {?>
        <?php if (is_array($_smarty_tpl->tpl_vars['userBanned']->value)) {?>
            <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? count($_smarty_tpl->tpl_vars['userBanned']->value)-1+1 - (0) : 0-(count($_smarty_tpl->tpl_vars['userBanned']->value)-1)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration === 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;?>
                <?php if ($_smarty_tpl->tpl_vars['userBanned']->value[$_smarty_tpl->tpl_vars['i']->value] != null) {?>
            <div class="col-md-4 my-4">
                <div id="user" class="card">
                    <!-- INSERISCI L'IMMAGINE DELL'UTENTE-->
                    <div class="card-header">
                        <?php if ($_smarty_tpl->tpl_vars['immagine_1']->value == 'ok') {?>
                            <img class="rounded-circle ml-3" width="100" height="100" src="data:<?php echo $_smarty_tpl->tpl_vars['typeB']->value[$_smarty_tpl->tpl_vars['i']->value];?>
;base64,<?php echo $_smarty_tpl->tpl_vars['pic64B']->value[$_smarty_tpl->tpl_vars['i']->value];?>
"  alt="profile picture" />
                        <?php } else { ?>
                            <img class=" ml-3" width="100" height="100" src="/logBook/Smarty/immagini/user.png"  alt="profile picture" />
                        <?php }?>
                            <div class="ms-3">
                                <div class="fw-bold"><h4><?php echo $_smarty_tpl->tpl_vars['userBanned']->value[$_smarty_tpl->tpl_vars['i']->value]->getUsername();?>
</h4><br><a href="/logBook/Admin/restoreUser/<?php echo $_smarty_tpl->tpl_vars['userBanned']->value[$_smarty_tpl->tpl_vars['i']->value]->getUserID();?>
" id="restore" class="btn btn-primary mx-3">
                                Restore User</a>
                                    </div>
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
