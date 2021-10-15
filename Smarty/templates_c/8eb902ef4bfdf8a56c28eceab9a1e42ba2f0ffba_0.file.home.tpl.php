<?php
/* Smarty version 3.1.33, created on 2021-10-15 02:50:26
  from '/Applications/XAMPP/xamppfiles/htdocs/logBook/Smarty/templates/home.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_6168d052eb0281_98949666',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8eb902ef4bfdf8a56c28eceab9a1e42ba2f0ffba' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/logBook/Smarty/templates/home.tpl',
      1 => 1634210245,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6168d052eb0281_98949666 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<?php $_smarty_tpl->_assignInScope('userlogged', (($tmp = @$_smarty_tpl->tpl_vars['userlogged']->value)===null||$tmp==='' ? 'nouser' : $tmp));?>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Landing Page - Start Bootstrap Theme</title>
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
<header class="masthead bgimg">
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
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        <?php if ($_smarty_tpl->tpl_vars['array_post_home']->value) {?>
        <?php if (is_array($_smarty_tpl->tpl_vars['array_post_home']->value)) {?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['array_post_home']->value, 'post');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['post']->value) {
?>
        <div class="col mb-5">
            <div class="card h-100">
                <!-- Profile image-->
                <img class="card-img-top" src="data:<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
;base64,<?php echo $_smarty_tpl->tpl_vars['post']->value->getImage();?>
" alt="..." />
                <!-- Product details-->
                <div class="card-body p-4">
                    <div class="text-center">
                        <!-- Product name-->
                        <h5 class="fw-bolder"><?php echo $_smarty_tpl->tpl_vars['post']->value->getTitle();?>
</h5>
                        <!-- Product price-->
                        <h6 class="text-muted "><?php echo $_smarty_tpl->tpl_vars['post']->value->getAuthor();?>
</h6>
                    </div>
                </div>
                <!-- Product actions-->
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center"><a class="btn btn-primary" href="/logBook/Research/postDetail/<?php echo $_smarty_tpl->tpl_vars['post']->value->getID();?>
">Go to the post -></a></div>
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
<footer class="footer bg-light">

</footer>
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
