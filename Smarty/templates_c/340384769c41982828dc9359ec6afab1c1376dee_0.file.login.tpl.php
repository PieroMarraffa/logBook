<?php
/* Smarty version 3.1.33, created on 2021-09-23 11:30:33
  from 'C:\xampp\htdocs\logBook\Smarty\templates\login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_614c4939ab05c4_41562640',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '340384769c41982828dc9359ec6afab1c1376dee' => 
    array (
      0 => 'C:\\xampp\\htdocs\\logBook\\Smarty\\templates\\login.tpl',
      1 => 1632389430,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_614c4939ab05c4_41562640 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<?php $_smarty_tpl->_assignInScope('error', (($tmp = @$_smarty_tpl->tpl_vars['error']->value)===null||$tmp==='' ? 'ok' : $tmp));?>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Blog Post - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="/logBook/Smarty/css/login.css" rel="stylesheet" />
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
<?php echo '<script'; ?>
 src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/logBook/Smarty/js/login.js"><?php echo '</script'; ?>
>
<!------ Include the above in your HEAD tag ---------->

<div class="wrapper fadeInDown">
    <div id="formContent">

        <!-- Icon -->
        <div class="fadeIn first" >
            <a href="/logBook/"> <img src="/logBook/Smarty/immagini/logo_logbook_vertical.PNG" id="icon"/></a>
        </div>

        <!-- Login Form -->
        <form method="post" id="form_login" onsubmit="return convalidaPassword(this)" action="/logBook/User/checkLogin">
            <label for="email"><input type="text" id="email" class="fadeIn second" name="email" placeholder="email" required></label>
            <label for="password"><input type="password" id="password" class="fadeIn third" name="password" placeholder="password" required></label>

            <?php if ($_smarty_tpl->tpl_vars['error']->value != 'ok') {?>
                <div style="color: red;">
                    <p align="center">Error! Username or password is wrong! </p>
                </div>
            <?php }?>
            <input type="submit" id="form_login" class="fadeIn fourth" value="Log In">

        </form>
        <!-- Remind Passowrd -->
        <div id="formFooter">
            <a class="underlineHover" href="/logBook/User/registration">You are not registered? Register here.</a>
        </div>

    </div>
</div>
</body>
</html><?php }
}
