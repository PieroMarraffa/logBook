<?php
/* Smarty version 3.1.33, created on 2021-10-31 16:54:52
  from '/Applications/XAMPP/xamppfiles/htdocs/logBook/Smarty/templates/update_post.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_617ebc4c3fe176_49895042',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ad6d5622544838327ee4fc6af31d7a0f13feeb6e' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/logBook/Smarty/templates/update_post.tpl',
      1 => 1635695691,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_617ebc4c3fe176_49895042 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Creation Post</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="/logBook/Smarty/immagini/immagine_logo.JPG" />
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
    <?php echo '<script'; ?>
 src="/logBook/Smarty/js/crea_post.js"><?php echo '</script'; ?>
>
</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-light bg-light static-top">
    <div class="container">
        <a class="navbar-brand" href="/logBook/"><img src="/logBook/Smarty/immagini/logo_logbook.PNG"  width="243" height="62"></a>
    </div>
</nav>
<section>
    <form method="post" id="form_create_post" action="/logBook/Post/savePost">
        <div class="row">
            <div class="col-md-9">
                <div class="card">

                    <div class="col-md-11 py-4">

                        <input type="text" name="title" id="title" class='mx-3 form-control bg-opacity-10' placeholder='Insert title here' size="100%" rows='1' value="<?php echo $_smarty_tpl->tpl_vars['travelTitle']->value;?>
">

                        <img class="mx-3 my-5" src="https://dummyimage.com/1050x700/dee2e6/6c757d.jpg" width="1050" height="700" alt="image">
                    </div>
                    <a name="experiences"></a>
                    <?php if ($_smarty_tpl->tpl_vars['array_experience']->value) {?>
                    <?php if (is_array($_smarty_tpl->tpl_vars['array_experience']->value)) {?>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['array_experience']->value, 'exp');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['exp']->value) {
?>
                        <div class="card">
                            <div class="card-header">
                                <textarea class="form-control" name="titleExperience<?php echo $_smarty_tpl->tpl_vars['exp']->value->getExperienceID();?>
" rows="1" maxlength="49" placeholder="Insert experience title here"><?php echo $_smarty_tpl->tpl_vars['exp']->value->getTitle();?>
</textarea>
                                <div class="row py-2">
                                    <div class="col-md-3">
                                        <input type="date" name="startDate<?php echo $_smarty_tpl->tpl_vars['exp']->value->getExperienceID();?>
" class="px-2" value="<?php echo $_smarty_tpl->tpl_vars['exp']->value->getStartDay();?>
">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="date" name="endDate<?php echo $_smarty_tpl->tpl_vars['exp']->value->getExperienceID();?>
" class="px-2" value="<?php echo $_smarty_tpl->tpl_vars['exp']->value->getEndDay();?>
">
                                    </div>
                                    <div class="col-md-3">
                                        <select class="btn btn-primary" name="place<?php echo $_smarty_tpl->tpl_vars['exp']->value->getExperienceID();?>
">
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['exp']->value->getPlace()->getPlaceID();?>
"><?php echo $_smarty_tpl->tpl_vars['exp']->value->getPlace()->getName();?>
</option>
                                            <?php if (isset($_smarty_tpl->tpl_vars['arrayPlace']->value)) {?>
                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrayPlace']->value, 'p');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['p']->value) {
?>
                                                    <?php if ($_smarty_tpl->tpl_vars['p']->value->getName() != $_smarty_tpl->tpl_vars['exp']->value->getPlace()->getName()) {?>
                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['p']->value->getPlaceID();?>
"><?php echo $_smarty_tpl->tpl_vars['p']->value->getName();?>
</option>
                                                    <?php }?>
                                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <textarea class="form-control" name="descriprion<?php echo $_smarty_tpl->tpl_vars['exp']->value->getExperienceID();?>
" maxlength="499" rows="6" placeholder="Insert description here"><?php echo $_smarty_tpl->tpl_vars['exp']->value->getDescription();?>
</textarea>
                            </div>
                            <div align="end">
                                <a type="button" class="my-3 mx-3 btn btn-danger" onclick="remove(<?php echo $_smarty_tpl->tpl_vars['exp']->value->getExperienceID();?>
)">- Delete Experience</a>
                            </div>
                        </div>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <?php }?>
                    <?php }?>
                    <div class="col-md-8">

                        <div class="container py-3" id="container">
                        </div>
                        <div class="col-md-4">
                            <input name="send" type="submit" form="form_create_post" class="mx-3 my-3 btn btn-primary">
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-md-3 fisso" >
                <div class="card">
                    <div class="row">
                        <a type="button" class="btn btn-primary "  onclick="creaExperience()" href="#experiences" >+ Add Experience</a>
                    </div>
                    <div class="row">
                        <button type="button" class="btn btn-primary  my-1 " onclick="creaImage()" >+ Add Image</button>
                        <input width='100%' class='btn btn-primary my-1' type='file' name='file' id='image' accept='image/png, image/jpeg'>
                    </div>
                    <div id="container2" class="col">
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>

<!-- Bootstrap core JS-->
<?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>

</body>
</html><?php }
}
