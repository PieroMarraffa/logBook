<?php
/* Smarty version 3.1.33, created on 2021-11-04 13:33:23
  from 'C:\xampp\htdocs\logBook\Smarty\templates\admin_reported_post.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_6183d313d49873_85177654',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'eb560377f96d769f2fdc2b806f514d821a0665d5' => 
    array (
      0 => 'C:\\xampp\\htdocs\\logBook\\Smarty\\templates\\admin_reported_post.tpl',
      1 => 1636029201,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6183d313d49873_85177654 (Smarty_Internal_Template $_smarty_tpl) {
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
<!-- Section-->
<section class="py-5">

    <div class="row">
        <!-- Blog entries-->
        <div class="row">
            <?php if ($_smarty_tpl->tpl_vars['arrayReportedPost']->value) {?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrayReportedPost']->value, 'a');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['a']->value) {
?>
                    <!-- Blog post-->
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." />
                            <div class="card-body">
                                <div class="small text-muted"><?php echo $_smarty_tpl->tpl_vars['a']->value->getDate();?>
</div>
                                <h2 class="card-title h4"><?php echo $_smarty_tpl->tpl_vars['a']->value->getTitle();?>
</h2>
                                <p class="card-text"><?php echo $_smarty_tpl->tpl_vars['a']->value->getAuthor();?>
</p>
                                <a class="btn btn-primary" href="/logBook/Research/postDetail/<?php echo $_smarty_tpl->tpl_vars['a']->value->getID();?>
">Go to the Post →</a>
                            </div>
                        </div>
                    </div>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
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
