<?php
/* Smarty version 3.1.33, created on 2021-10-08 19:11:57
  from 'C:\xampp\htdocs\logBook\Smarty\templates\error.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_61607bdd0ac1b8_95279836',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1c04d5d82673b993673683737799009ced11df93' => 
    array (
      0 => 'C:\\xampp\\htdocs\\logBook\\Smarty\\templates\\error.tpl',
      1 => 1633713113,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61607bdd0ac1b8_95279836 (Smarty_Internal_Template $_smarty_tpl) {
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
    <link rel="icon" type="image/x-icon" href="/logBook/Smarty/immagini/immagine_logo.JPG" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
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
        <div class="col-auto">
            <a class="navbar-brand" href="/logBook/"><img src="/logBook/Smarty/immagini/logo_logbook.PNG"  width="243" height="62"></a>
        </div>
        <div class="col-auto py-3">
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
<!-- Masthead-->
<section>
    <div class="col py-5 px-5 mx-5">
        <div class="card border-4 border-secondary">
            <div class="card-body">
                <?php if ($_smarty_tpl->tpl_vars['research']->value) {?>
                <p align="center" class="dimension_title testo2">Error, your research of <B><?php echo $_smarty_tpl->tpl_vars['research']->value;?>
</B> doesn't produce any results</p>
                <?php }?>
            </div>
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
