<?php
/* Smarty version 3.1.33, created on 2021-10-05 17:32:00
  from 'C:\xampp\htdocs\logBook\Smarty\templates\create_post.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_615c6ff0730cd2_27834496',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b491306e9fa275edfc38254c39545d7c138f4e80' => 
    array (
      0 => 'C:\\xampp\\htdocs\\logBook\\Smarty\\templates\\create_post.tpl',
      1 => 1633447918,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_615c6ff0730cd2_27834496 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Blog Post - Start Bootstrap Template</title>
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
    <form method="post" id="form_create_post" action="/logBook/Post/create_post">
    <div class="row">
        <div class="col-md-9">
            <div class="card">

                        <div class="col-md-11 py-4">

                            <input type="text" id="title" class='form-control bg-opacity-10' placeholder='Insert title here' size="100%" rows='1' >

                            <img class="my-5" src="https://dummyimage.com/1050x700/dee2e6/6c757d.jpg" width="1050" height="700" alt="image">
                        </div>
                        <a name="experiences"></a>
                        <div class="col-md-8">

                            <div class="container py-3" id="container">
                            </div>
                            <div class="col-md-4">
                                <input name="send" type="submit" form="form_create_post" class="btn btn-primary" >
                            </div>

                        </div>

            </div>
        </div>
        <div class="col-md-3" >
            <div class="row">
                <a type="button" class="btn btn-primary "  onclick="creaExperience()" href="#experiences" >+ Add Experience</a>
            </div>
            <div class="row">
                <button type="button" class="btn btn-primary  my-1 " onclick="creaImage()" >+ Add Image</button>
            </div>

                <div id="container2" class="col">
            </div>

        </div>
    </div>
    </form>
</section>
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
</footer>
<!-- Bootstrap core JS-->
<?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>

</body>
</html><?php }
}
