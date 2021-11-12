<?php
/* Smarty version 3.1.33, created on 2021-11-11 12:37:30
  from '/Applications/XAMPP/xamppfiles/htdocs/logBook/Smarty/templates/list_post_user.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_618d007a01b849_77385688',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dcd7d678785e2d1b5addd123b5f02d1b06e415cd' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/logBook/Smarty/templates/list_post_user.tpl',
      1 => 1636421609,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_618d007a01b849_77385688 (Smarty_Internal_Template $_smarty_tpl) {
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
    <link rel="icon" type="image/x-icon" href="/logBook/Smarty/immagini/immagine_logo.JPG" /><link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
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
<!-- Section-->
<section class="py-5">

    <div class="row">
        <!-- Blog entries-->
        <?php if ($_smarty_tpl->tpl_vars['arrayUser']->value) {?>
        <?php if (isset($_smarty_tpl->tpl_vars['arrayUser']->value)) {?>
        <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);
$_smarty_tpl->tpl_vars['i']->value = 0;
if ($_smarty_tpl->tpl_vars['i']->value <= count($_smarty_tpl->tpl_vars['arrayUser']->value)-1) {
for ($_foo=true;$_smarty_tpl->tpl_vars['i']->value <= count($_smarty_tpl->tpl_vars['arrayUser']->value)-1; $_smarty_tpl->tpl_vars['i']->value++) {
?>
        <div class="row py-3">
            <div class="card">
                <div class="card-header">
                    <img class="rounded-circle" src='data:<?php echo $_smarty_tpl->tpl_vars['type']->value[$_smarty_tpl->tpl_vars['i']->value];?>
;charset=utf-8;base64,<?php echo $_smarty_tpl->tpl_vars['pic64']->value[$_smarty_tpl->tpl_vars['i']->value];?>
' width="65" height="65" alt="...">
                    <B><a href="/logBook/Research/profileDetail/<?php echo $_smarty_tpl->tpl_vars['arrayUser']->value[$_smarty_tpl->tpl_vars['i']->value]->getUserID();?>
"><?php echo $_smarty_tpl->tpl_vars['arrayUser']->value[$_smarty_tpl->tpl_vars['i']->value]->getUsername();?>
</a></B>
                </div>
                <div class="container px-4 px-lg-5 mt-3">

                        <?php if ($_smarty_tpl->tpl_vars['post']->value[$_smarty_tpl->tpl_vars['i']->value]) {?>
                    <div class="row gx-4 py-1 gx-lg-5 row-cols-3 row-cols-md-3 row-cols-xl-3 justify-content-start">
                            <?php if ($_smarty_tpl->tpl_vars['post']->value[$_smarty_tpl->tpl_vars['i']->value] != null) {?>
                                <?php
$_smarty_tpl->tpl_vars['j'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);
$_smarty_tpl->tpl_vars['j']->value = 0;
if ($_smarty_tpl->tpl_vars['j']->value < count($_smarty_tpl->tpl_vars['post']->value[$_smarty_tpl->tpl_vars['i']->value]) && $_smarty_tpl->tpl_vars['j']->value <= 2) {
for ($_foo=true;$_smarty_tpl->tpl_vars['j']->value < count($_smarty_tpl->tpl_vars['post']->value[$_smarty_tpl->tpl_vars['i']->value]) && $_smarty_tpl->tpl_vars['j']->value <= 2; $_smarty_tpl->tpl_vars['j']->value++) {
?>
                                    <div class="col-md-5 my-2">
                                        <div class="card py-3 mb-4">
                                            <div class="text-center">
                                                <!-- Product name-->
                                                <h3 class="fw-bolder"><?php echo $_smarty_tpl->tpl_vars['post']->value[$_smarty_tpl->tpl_vars['i']->value][$_smarty_tpl->tpl_vars['j']->value]->getTitle();?>
</h3>
                                                <!-- Product price-->
                                                <h5 class="text-muted "><?php echo $_smarty_tpl->tpl_vars['post']->value[$_smarty_tpl->tpl_vars['i']->value][$_smarty_tpl->tpl_vars['j']->value]->getCreationDate();?>
</h5>
                                                <a class="btn btn-primary py-2" href="/logBook/Research/postDetail/<?php echo $_smarty_tpl->tpl_vars['post']->value[$_smarty_tpl->tpl_vars['i']->value][$_smarty_tpl->tpl_vars['j']->value]->getPostID();?>
">Go to the Post →</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
}
?>
                            <?php }?>
                    </div>
                        <?php } else { ?>
                            <p align="center">This user has no post</p>
                        <?php }?>
                </div>
            </div>
        </div>
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
