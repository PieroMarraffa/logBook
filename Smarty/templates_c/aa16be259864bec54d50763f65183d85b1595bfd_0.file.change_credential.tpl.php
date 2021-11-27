<?php
/* Smarty version 3.1.33, created on 2021-11-27 13:32:41
  from '/Applications/XAMPP/xamppfiles/htdocs/logBook/Smarty/templates/change_credential.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_61a2256952f008_98540907',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aa16be259864bec54d50763f65183d85b1595bfd' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/logBook/Smarty/templates/change_credential.tpl',
      1 => 1635431464,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61a2256952f008_98540907 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Change Credential</title>
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
                <div class="card-header"><h5>Change email</h5></div>
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-6">
                        <p><b> Here you can change your email address</b></p>
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
                <div class="card-header"><h5>Change Password</h5></div>
                <div class="card-body">
                    <div class="row my-2">
                        <div class="col-md-6">
                            <p><b> Here you can change your Password</b></p>
                        </div>
                        <div class="col-md-6">
                            <img  src="/logBook/Smarty/immagini/password.png" width="150" height="150">
                        </div>
                    </div>
                    <a class="btn btn-primary my-3" href="/logBook/User/changePassword">Change Password -> </a></div>
            </div>
        </div>
        <div class="col-md-5 my-4">
            <div class="card">
                <div class="card-header"><h5>Change Username</h5></div>
                <div class="body">
                    <div class="row my-2">
                        <div class="col-md-6">
                            <p> <b> Here you can change your username</b></p>
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
                <div class="card-header"><h5>Change profile image</h5></div>
                <div class="body">
                    <div class="row my-2">
                        <div class="col-md-6">
                            <p> <b> Here you can change your profile image</b></p>
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
                <div class="card-header"><h5>Change Description</h5></div>
                <div class="body">
                    <div class="row my-2">
                        <div class="col-md-6">
                            <p> <b>Here you can change your profile description</b></p>
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
