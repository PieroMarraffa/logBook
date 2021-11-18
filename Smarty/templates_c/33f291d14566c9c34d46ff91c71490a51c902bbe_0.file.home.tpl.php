<?php
/* Smarty version 3.1.33, created on 2021-11-18 14:46:49
  from 'C:\xampp\htdocs\logBook\Smarty\templates\home.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_619659490cd230_30464482',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '33f291d14566c9c34d46ff91c71490a51c902bbe' => 
    array (
      0 => 'C:\\xampp\\htdocs\\logBook\\Smarty\\templates\\home.tpl',
      1 => 1637243203,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_619659490cd230_30464482 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<?php $_smarty_tpl->_assignInScope('userlogged', (($tmp = @$_smarty_tpl->tpl_vars['userlogged']->value)===null||$tmp==='' ? 'nouser' : $tmp));?>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Home</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="/logBook/Smarty/immagini/immagine_logo.JPG" /><link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="/logBook/Smarty/css/styles.css" rel="stylesheet"  type="text/css"/>

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

    <link rel="stylesheet" href="logBook/Smarty/css/styles.css">
    <style type="text/css">
        .bgimg {
            background-image: url('/logBook/Smarty/immagini/ala_aereo.jpeg');
        }
    </style>
</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-light bg-light static-top">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="/logBook/Smarty/immagini/logo_logbook.PNG"  width="243" height="62" alt="logo"></a>
        <?php if ($_smarty_tpl->tpl_vars['userlogged']->value != 'nouser') {?>
            <a class="btn btn-primary" href="/logBook/User/profile"><?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</a>
        <?php } else { ?>
            <a class="btn btn-primary" href="/logBook/User/login">Sign Up</a>
        <?php }?>
    </div>
</nav>
<!-- Masthead-->
<header class="masthead bgimg ">
    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="text-center text-white" >
                    <!-- Page heading-->
                    <h1 class="mb-5 text-light" ><b>Go wherever you want...</b></h1>
                    <form method="post" id="form_research" action="/logBook/Research/find">
                        <div class="row">
                            <div class="input-group">
                                <input class="form-control" name="research" id="research" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                                <label>
                                    <select class="btn btn-primary" name="search">
                                        <option value="1" id="1" >Search for user</option>
                                        <option value="2" id="2" >Search for place</option>
                                    </select>
                                </label>
                                <button class="btn btn-primary" type="submit" form="form_research" value="Submit">Go!</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container px-4 px-lg-5 mt-5">
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-start">
        <?php if ($_smarty_tpl->tpl_vars['array_post_home']->value) {?>
        <?php if (is_array($_smarty_tpl->tpl_vars['array_post_home']->value)) {?>
        <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);
$_smarty_tpl->tpl_vars['i']->value = 0;
if ($_smarty_tpl->tpl_vars['i']->value <= count($_smarty_tpl->tpl_vars['array_post_home']->value)-1) {
for ($_foo=true;$_smarty_tpl->tpl_vars['i']->value <= count($_smarty_tpl->tpl_vars['array_post_home']->value)-1; $_smarty_tpl->tpl_vars['i']->value++) {
?>
        <div class="col mb-5" >
            <div class="card h-100">
                <!-- Profile image-->
                <a href="/logBook/Research/postDetail/<?php echo $_smarty_tpl->tpl_vars['array_post_home']->value[$_smarty_tpl->tpl_vars['i']->value]->getPostID();?>
">
                    <img class="w-100" src='data:<?php echo $_smarty_tpl->tpl_vars['typeImg']->value[$_smarty_tpl->tpl_vars['i']->value];?>
;charset=utf-8;base64,<?php echo $_smarty_tpl->tpl_vars['pic64Img']->value[$_smarty_tpl->tpl_vars['i']->value];?>
' height="300" alt="..."></a>
                <!-- Product details-->
                <div class="card-body p-4">
                    <div class="text-center">
                        <!-- Product name-->
                        <h5 class="fw-bolder"><?php echo $_smarty_tpl->tpl_vars['array_post_home']->value[$_smarty_tpl->tpl_vars['i']->value]->getTitle();?>
</h5>
                        <!-- Product price-->
                        <h6 class="text-muted "><?php echo $_smarty_tpl->tpl_vars['array_post_home']->value[$_smarty_tpl->tpl_vars['i']->value]->getCreationDate();?>
</h6>
                        <a class="btn btn-primary py-2" href="/logBook/Research/postDetail/<?php echo $_smarty_tpl->tpl_vars['array_post_home']->value[$_smarty_tpl->tpl_vars['i']->value]->getPostID();?>
">Go to the Post →</a>
                    </div>
                </div>
            </div>
        </div>
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
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<!-- * *                               SB Forms JS                               * *-->
<!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<?php echo '<script'; ?>
 src="https://cdn.startbootstrap.com/sb-forms-latest.js"><?php echo '</script'; ?>
>
</body>
</html><?php }
}
