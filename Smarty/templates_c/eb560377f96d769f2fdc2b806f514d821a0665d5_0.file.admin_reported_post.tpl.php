<?php
/* Smarty version 3.1.33, created on 2021-12-06 19:26:47
  from 'C:\xampp\htdocs\logBook\Smarty\templates\admin_reported_post.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_61ae55e7e92d15_93161172',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'eb560377f96d769f2fdc2b806f514d821a0665d5' => 
    array (
      0 => 'C:\\xampp\\htdocs\\logBook\\Smarty\\templates\\admin_reported_post.tpl',
      1 => 1636038671,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61ae55e7e92d15_93161172 (Smarty_Internal_Template $_smarty_tpl) {
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
<div class="navbar btn-primary" align="center"><p class="mx-2"><h4>Reported Posts</h4></p></div>

<!-- Section-->
<section class="py-5">

    <div class="row">
        <!-- Blog entries-->
        <div class="row">
            <?php if ($_smarty_tpl->tpl_vars['arrayReportedPost']->value) {?>
                <?php if (is_array($_smarty_tpl->tpl_vars['arrayReportedPost']->value)) {?>
                    <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);
$_smarty_tpl->tpl_vars['i']->value = 0;
if ($_smarty_tpl->tpl_vars['i']->value <= count($_smarty_tpl->tpl_vars['arrayReportedPost']->value)-1) {
for ($_foo=true;$_smarty_tpl->tpl_vars['i']->value <= count($_smarty_tpl->tpl_vars['arrayReportedPost']->value)-1; $_smarty_tpl->tpl_vars['i']->value++) {
?>
                    <?php if (isset($_smarty_tpl->tpl_vars['arrayReportedPost']->value[$_smarty_tpl->tpl_vars['i']->value])) {?>
                    <!-- Blog post-->
                    <div class="col-md-3">
                        <div class="card mb-4">
                            <img class="card-img-top" src='data:<?php echo $_smarty_tpl->tpl_vars['typeImg']->value[$_smarty_tpl->tpl_vars['i']->value];?>
;charset=utf-8;base64,<?php echo $_smarty_tpl->tpl_vars['pic64Img']->value[$_smarty_tpl->tpl_vars['i']->value];?>
' height="300" width="400" alt="...">
                            <div class="card-body">
                                <div class="small text-muted"><?php echo $_smarty_tpl->tpl_vars['arrayReportedPost']->value[$_smarty_tpl->tpl_vars['i']->value]->getCreationDate();?>
</div>
                                <h2 class="card-title h4"><?php echo $_smarty_tpl->tpl_vars['arrayReportedPost']->value[$_smarty_tpl->tpl_vars['i']->value]->getTitle();?>
</h2>
                                <a class="btn btn-primary" href="/logBook/Admin/deletePost/<?php echo $_smarty_tpl->tpl_vars['arrayReportedPost']->value[$_smarty_tpl->tpl_vars['i']->value]->getPostID();?>
">Delete</a>
                                <a class="btn btn-primary" href="/logBook/Admin/ignorePost/<?php echo $_smarty_tpl->tpl_vars['arrayReportedPost']->value[$_smarty_tpl->tpl_vars['i']->value]->getPostID();?>
">Ignore</a>
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
