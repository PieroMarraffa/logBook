<?php
/* Smarty version 3.1.33, created on 2021-10-28 19:38:51
  from 'C:\xampp\htdocs\logBook\Smarty\templates\change_single_credential.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_617ae02b144614_82579418',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8f23153b65c65d0dae8d6bc158e7b6b3cee90544' => 
    array (
      0 => 'C:\\xampp\\htdocs\\logBook\\Smarty\\templates\\change_single_credential.tpl',
      1 => 1635442645,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_617ae02b144614_82579418 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<?php $_smarty_tpl->_assignInScope('error', (($tmp = @$_smarty_tpl->tpl_vars['error']->value)===null||$tmp==='' ? 'ok' : $tmp));
$_smarty_tpl->_assignInScope('errorSize', (($tmp = @$_smarty_tpl->tpl_vars['errorSize']->value)===null||$tmp==='' ? 'ok' : $tmp));
$_smarty_tpl->_assignInScope('errorType', (($tmp = @$_smarty_tpl->tpl_vars['errorType']->value)===null||$tmp==='' ? 'ok' : $tmp));
$_smarty_tpl->_assignInScope('errorUsername', (($tmp = @$_smarty_tpl->tpl_vars['errorUsername']->value)===null||$tmp==='' ? 'ok' : $tmp));?>
<html lang="en">
<head>
    <!--meta charset="utf-8" /-->
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Change Credential</title>
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
 src="/logBook/Smarty/js/change_credential.js"><?php echo '</script'; ?>
>

<!------ Include the above in your HEAD tag ---------->

<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first" >
            <img src="/logBook/Smarty/immagini/logo_logbook_vertical.PNG" id="icon"/>
        </div>

        <!-- Login Form -->
        <form method="post" action="/logBook/User/changeCredential" enctype="multipart/form-data" onsubmit="return convalidaForm(this)">
            <?php if ($_smarty_tpl->tpl_vars['change']->value == 'email') {?>
                <label for="email"><input type="text" id="email" class="fadeIn second" name="email" placeholder="new email" required></label>
            <?php } elseif ($_smarty_tpl->tpl_vars['change']->value == 'password') {?>
                <input type="text" id="old_password" class="fadeIn second" name="old_password" placeholder="old password" required>
                <input type="text" id="new_password" class="fadeIn second" name="new_password" placeholder="new password" required>
                <input type="text" id="confirm_password" class="fadeIn second" name="confirm_password" placeholder="confirm new password" required>
            <?php } elseif ($_smarty_tpl->tpl_vars['change']->value == 'username') {?>
                <label><input type="text" id="username" class="fadeIn second" name="username" placeholder="new username" required></label>
                <?php if ($_smarty_tpl->tpl_vars['errorUsername']->value != 'ok') {?>
                    <div style="color: red;">
                        <p  class="fadeIn third" align="center">Attention! This username is alredy used!  </p>
                    </div>
                <?php }?>
            <?php } elseif ($_smarty_tpl->tpl_vars['change']->value == 'image') {?>
                <input type="file" name="file" >
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
            <?php } elseif ($_smarty_tpl->tpl_vars['change']->value == 'description') {?>
                <div class="col-md-5">
                    <label for="description">
                        <textarea id="description" maxlength='100' cols="50" rows='3' class="fadeIn second" name="description" placeholder="insert here your profile's description" required></textarea>
                    </label>
                </div>
            <?php }?>
            <input type="submit" class="fadeIn fourth" value="Submit">

        </form>

    </div>
</div>
</body>
</html><?php }
}
