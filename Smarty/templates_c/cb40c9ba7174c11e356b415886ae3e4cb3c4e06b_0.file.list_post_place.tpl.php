<?php
/* Smarty version 3.1.33, created on 2021-10-06 12:14:15
  from 'C:\xampp\htdocs\logBook\Smarty\templates\list_post_place.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_615d76f7a9df02_34901008',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cb40c9ba7174c11e356b415886ae3e4cb3c4e06b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\logBook\\Smarty\\templates\\list_post_place.tpl',
      1 => 1633515219,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_615d76f7a9df02_34901008 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<?php $_smarty_tpl->_assignInScope('userlogged', (($tmp = @$_smarty_tpl->tpl_vars['userlogged']->value)===null||$tmp==='' ? 'nouser' : $tmp));?>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Homepage - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="/logBook/Smarty/immagini/immagine_logo.JPG" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
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
        <a class="navbar-brand" href="/logBook/"><img src="/logBook/Smarty/immagini/logo_logbook.PNG"  width="243" height="62"></a>
        <form method="get" action="/logBook/Research/find">
            <div class="row">
                <div class="input-group">
                    <input class="form-control" id="research" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                    <select class="btn btn-primary" name="search">
                        <option value="1">Search for user</option>
                        <option value="2">Search for place</option>
                    </select>
                    <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                </div>
            </div>
        </form>
        <?php if ($_smarty_tpl->tpl_vars['userlogged']->value != 'nouser') {?>
            <a class="btn btn-primary" href="/logBook/User/profile"><?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</a>
        <?php } else { ?>
            <a class="btn btn-primary" href="/logBook/User/login">Sign Up</a>
        <?php }?>
    </div>
</nav>
<!-- Header-->
<header class="bg-primary py-5">
    <div class="row">
        <div class = "col-md-5">
            <img src="data:<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
;base64,<?php echo $_smarty_tpl->tpl_vars['placeImage']->value;?>
" width="600" height="500" class=" mt-5 ml-5" alt="relative image">

        </div>
        <div class="col-md-7 justify-content-end">
            <div class="d-flex w-100 justify-content-between">
                <p><b><?php echo $_smarty_tpl->tpl_vars['TitlePlace']->value;?>
 </b></p>

            </div>
            <div class="d-flex w-100 justify-content-between">
                <p><b><?php echo $_smarty_tpl->tpl_vars['DescriptionPlace']->value;?>
 </b></p>
            </div>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">

    <div class="row">
        <!-- Blog entries-->
        <?php if ($_smarty_tpl->tpl_vars['arrayPostPlace']->value) {?>
        <?php if (isset($_smarty_tpl->tpl_vars['arrayPostPlace']->value)) {?>
        <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);
$_smarty_tpl->tpl_vars['i']->value = 0;
if ($_smarty_tpl->tpl_vars['i']->value <= count($_smarty_tpl->tpl_vars['arrayPostPlace']->value)) {
for ($_foo=true;$_smarty_tpl->tpl_vars['i']->value <= count($_smarty_tpl->tpl_vars['arrayPostPlace']->value); $_smarty_tpl->tpl_vars['i']->value=$_smarty_tpl->tpl_vars['i']->value+2) {
?>
            <div class="row">
                <!-- Blog post-->
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrayPostPlace']->value, 'post');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['post']->value) {
?>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img class="card-img-top" src="data:<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
;base64,<?php echo $_smarty_tpl->tpl_vars['post']->value->getImage();?>
" alt="..." />
                            <div class="card-body">
                                <div class="small text-muted"><?php echo $_smarty_tpl->tpl_vars['post']->value->getDate();?>
</div>
                                <h2 class="card-title h4"><?php echo $_smarty_tpl->tpl_vars['post']->value->getTitle();?>
</h2>
                                <p class="card-text"><?php echo $_smarty_tpl->tpl_vars['post']->value->getAuthor;?>
</p>
                                <a class="btn btn-primary" href="/logBook/Research/postDetail/<?php echo $_smarty_tpl->tpl_vars['post']->value->getID();?>
">Go to the Post →</a>
                            </div>
                        </div>
                    </div>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
        <?php }
}
?>
        <?php }?>
        <?php }?>
    </div>



</section>
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
</footer>
<!-- Bootstrap core JS-->
<?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
<!-- Core theme JS-->
<?php echo '<script'; ?>
 src="js/scripts.js"><?php echo '</script'; ?>
>
</body>
</html><?php }
}
