<?php
/* Smarty version 3.1.33, created on 2021-11-27 14:04:21
  from '/Applications/XAMPP/xamppfiles/htdocs/logBook/Smarty/templates/admin_reported_comment.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_61a22cd5771b84_96601321',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '92338a2a1b234312f07a70f7ada7a82694b42d0b' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/logBook/Smarty/templates/admin_reported_comment.tpl',
      1 => 1636048605,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61a22cd5771b84_96601321 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
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
<div class="navbar btn-primary" align="center"><p class="mx-2"><h4>Reported Comments</h4></p></div>
<!-- Section-->
<section class="py-5">
    <?php if ($_smarty_tpl->tpl_vars['commentArrayReported']->value) {?>
        <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? count($_smarty_tpl->tpl_vars['commentArrayReported']->value)-1+1 - (0) : 0-(count($_smarty_tpl->tpl_vars['commentArrayReported']->value)-1)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration === 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;?>
            <div class="card my-3 px-4 mx-4">
                <div class="card-body">
                    <div id="comment" class="d-flex mb-4">
                        <!-- INSERISCI L'IMMAGINE DELL'UTENTE-->
                        <div class="flex-shrink-0">
                                <img class="rounded-circle ml-3" width="100" height="100" src="data:<?php echo $_smarty_tpl->tpl_vars['typeImg']->value[$_smarty_tpl->tpl_vars['i']->value];?>
;base64,<?php echo $_smarty_tpl->tpl_vars['pic64Img']->value[$_smarty_tpl->tpl_vars['i']->value];?>
"  alt="profile picture" />
                        </div>
                        <div class="ms-3">
                            <div class="fw-bold h4">
                                <?php echo $_smarty_tpl->tpl_vars['author']->value[$_smarty_tpl->tpl_vars['i']->value]->getUserName();?>

                            </div>
                            <h5 class="text-muted fst-italic mb-2"><?php echo $_smarty_tpl->tpl_vars['commentArrayReported']->value[$_smarty_tpl->tpl_vars['i']->value]->getContent();?>
</h5>
                        </div>
                    </div>
                    <div align="end">
                        <a href="/logBook/Admin/deleteComment/<?php echo $_smarty_tpl->tpl_vars['commentArrayReported']->value[$_smarty_tpl->tpl_vars['i']->value]->getCommentID();?>
"><button id="delete" class="btn btn-primary" >Delete</button></a>
                        <a href="/logBook/Admin/ignoreComment/<?php echo $_smarty_tpl->tpl_vars['commentArrayReported']->value[$_smarty_tpl->tpl_vars['i']->value]->getCommentID();?>
"><button id="ignore" class="btn btn-primary"> Ignore</button></a>
                    </div>
                </div>
            </div>
        <?php }
}
?>
    <?php }?>


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
