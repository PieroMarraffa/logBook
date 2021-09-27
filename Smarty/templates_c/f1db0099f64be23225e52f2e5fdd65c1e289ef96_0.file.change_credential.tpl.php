<?php
/* Smarty version 3.1.33, created on 2021-09-27 17:41:14
  from 'C:\xampp\htdocs\logBook\Smarty\templates\change_credential.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_6151e61acec073_30195187',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f1db0099f64be23225e52f2e5fdd65c1e289ef96' => 
    array (
      0 => 'C:\\xampp\\htdocs\\logBook\\Smarty\\templates\\change_credential.tpl',
      1 => 1632757236,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6151e61acec073_30195187 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Blog Home - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="/logBook/Smarty/immagini/immagine_logo.JPG" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="/logBook/Smarty/css/styles.css" rel="stylesheet" />
    <link href="/logBook/Smarty/css/profile.css" rel="stylesheet" />
    <?php echo '<script'; ?>
 type="text/javascript" src="/logBook/Smarty/js/profile_map.js"><?php echo '</script'; ?>
>
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
        <a class="navbar-brand" href="/logBook/User/home"><img src="/logBook/Smarty/immagini/logo_logbook.PNG"  width="300" height="90"></a>
    </div>
</nav>
<header>
    <div align="center" class="col-md">
        <img class="rounded-circle" src="data:<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
;base64,<?php echo $_smarty_tpl->tpl_vars['pic64']->value;?>
" width="150" height="150" alt="...">
        <h2><b><?php echo $_smarty_tpl->tpl_vars['user']->value->getUsername();?>
</b></h2>
        <h2><?php echo $_smarty_tpl->tpl_vars['user']->value->getMail();?>
</h2>
    </div>
</header>
<section>
    <div align="center" class="col-md my-5">
        <div class="col-md-5 my-4">
            <div class="card">
                <div class="card-header"><b>Change email</b></div>
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-6">
                        <p> Here u can change your email address</p>
                    </div>
                    <div class="col-md-6">
                        <img  src="/logBook/Smarty/immagini/email.jpg" width="150" height="150">
                    </div>
                    </div>
                    <a class="btn btn-primary my-3" href="/logBook/User/changeEmail">Change email -> </a></div>
            </div>
        </div>
        <div class="col-md-5 my-4">
            <div class="card">
                <div class="card-header"><b>Change Password</b></div>
                <div class="card-body">
                    <div class="row my-2">
                        <div class="col-md-6">
                            <p> Here u can change your email address</p>
                        </div>
                        <div class="col-md-6">
                            <img  src="/logBook/Smarty/immagini/password.jpg" width="150" height="150">
                        </div>
                    </div>
                    <a class="btn btn-primary my-3" href="/logBook/User/changePassword">Change Password -> </a></div>
            </div>
        </div>
        <div class="col-md-5 my-4">
            <div class="card">
                <div class="card-header"><b>Change Username</b></div>
                <div class="body">
                    <div class="row my-2">
                        <div class="col-md-6">
                            <p> Here u can change your email address</p>
                        </div>
                        <div class="col-md-6">
                            <img  src="/logBook/Smarty/immagini/user.png" width="150" height="150">
                        </div>
                    </div>
                    <a class="btn btn-primary my-3" href="/logBook/User/changeUsername">Change Username -> </a></div>
            </div>
        </div>
        <div class="col-md-5 my-4">
            <div class="card">
                <div class="card-header"><b>Change profile image</b></div>
                <div class="body">
                    <div class="row my-2">
                        <div class="col-md-6">
                            <p> Here u can change your email address</p>
                        </div>
                        <div class="col-md-6">
                            <img  src="/logBook/Smarty/immagini/profileImage.jpg" width="150" height="150">
                        </div>
                    </div>
                    <a class="btn btn-primary my-3" href="/logBook/User/changeImage">Change Image -> </a></div>
            </div>
        </div>
        <div class="col-md-5 my-4">
            <div class="card">
                <div class="card-header"><b>Change Description</b></div>
                <div class="body">
                    <div class="row my-2">
                        <div class="col-md-6">
                            <p> Here u can change your email address</p>
                        </div>
                        <div class="col-md-6">
                            <img  src="/logBook/Smarty/immagini/user.png" width="150" height="150">
                        </div>
                    </div><a class="btn btn-primary my-3" href="/logBook/User/changeDescription">Change Description -> </a></div>
            </div>
        </div>
    </div>
</section>

</body>
</html><?php }
}
