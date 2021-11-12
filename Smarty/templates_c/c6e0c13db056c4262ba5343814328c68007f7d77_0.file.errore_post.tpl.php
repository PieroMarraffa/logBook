<?php
/* Smarty version 3.1.33, created on 2021-11-11 15:15:17
  from '/Applications/XAMPP/xamppfiles/htdocs/logBook/Smarty/templates/errore_post.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_618d2575f01347_46623136',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c6e0c13db056c4262ba5343814328c68007f7d77' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/logBook/Smarty/templates/errore_post.tpl',
      1 => 1636640115,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_618d2575f01347_46623136 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<?php $_smarty_tpl->_assignInScope('error', (($tmp = @$_smarty_tpl->tpl_vars['error']->value)===null||$tmp==='' ? 'ok' : $tmp));
$_smarty_tpl->_assignInScope('bann', (($tmp = @$_smarty_tpl->tpl_vars['bann']->value)===null||$tmp==='' ? 'false' : $tmp));?>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login</title>
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
 src="/logBook/Smarty/js/login.js"><?php echo '</script'; ?>
>
<!------ Include the above in your HEAD tag ---------->

<div class="wrapper fadeInDown">
    <div id="formContent">

        <!-- Icon -->
        <div class="fadeIn first" >
            <a href="/logBook/"> <img src="/logBook/Smarty/immagini/logo_logbook_vertical.PNG" id="icon"/></a>
        </div>

        <form method="post" id="form_login" onsubmit="return convalidaPassword(this)" action="/logBook/User/checkLogin">
            <div class="my-3 mx-3">
                <div class="my-3 mx-3">
                    <a>Pippo</a>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html><?php }
}
