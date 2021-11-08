<?php
/* Smarty version 3.1.33, created on 2021-11-08 17:06:51
  from 'C:\xampp\htdocs\logBook\Smarty\templates\registration.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_61894b1bb86d75_26502998',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'af4f3b7a4f3fe5dc859305394d6598eba9b9a5f1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\logBook\\Smarty\\templates\\registration.tpl',
      1 => 1636289819,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61894b1bb86d75_26502998 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<?php $_smarty_tpl->_assignInScope('errorSize', (($tmp = @$_smarty_tpl->tpl_vars['errorSize']->value)===null||$tmp==='' ? 'ok' : $tmp));
$_smarty_tpl->_assignInScope('errorType', (($tmp = @$_smarty_tpl->tpl_vars['errorType']->value)===null||$tmp==='' ? 'ok' : $tmp));
$_smarty_tpl->_assignInScope('errorEmail', (($tmp = @$_smarty_tpl->tpl_vars['errorEmail']->value)===null||$tmp==='' ? 'ok' : $tmp));?>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Registration</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="/logBook/Smarty/immagini/immagine_logo.JPG" />
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
 src="/logBook/Smarty/js/registration.js"><?php echo '</script'; ?>
>
<!------ Include the above in your HEAD tag ---------->

<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first" >
            <a href="/logBook/"><img src="/logBook/Smarty/immagini/logo_logbook_vertical.PNG" id="icon"  /></a>
        </div>

        <!-- Login Form -->
        <form method="post" action="/logBook/User/registration" id="form_registration" onsubmit="return convalidaForm(this)" enctype="multipart/form-data" >
            <label for="name"><input type="text" id="name" class="fadeIn second" name="name" placeholder="Name" required></label>
            <label for="email"><input type="text" id="email" class="fadeIn second" name="email" placeholder="Email" required></label>
            <label for="username"><input type="text" id="username" class="fadeIn second" name="username" placeholder="Username" required></label>

            <label for="password"><input type="password" id="password" class="fadeIn third" name="password" placeholder="Password" required></label>
            <label for="confirm_password"><input type="password" id="confirm_password" class="fadeIn third" name="password2" placeholder="Confirm Password" required></label>
            <div class="btn btn-primary"><input width='100%' class='btn btn-primary my-1 fadeIn third' type='file' name='file' id='image'></div>

        <?php if ($_smarty_tpl->tpl_vars['errorSize']->value != 'ok') {?>
            <div style="color: red;">
                <p class="fadeIn third" align="center">Attention! Inserted image is too big. </p>
            </div>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['errorType']->value != 'ok') {?>
            <div style="color: red;">
                <p  class="fadeIn third" align="center">Attention! This image's type is not allowed. </p>
            </div>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['errorEmail']->value != 'ok') {?>
            <div style="color: red;">
                <p  class="fadeIn third" align="center">Attention! This email is alredy used!  </p>
            </div>
        <?php }?>
            <input type="submit" class="fadeIn fourth" form="form_registration" value="Register">
        </form>

    </div>
</div>
</body>
</html><?php }
}
