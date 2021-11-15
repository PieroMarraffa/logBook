<?php
/* Smarty version 3.1.33, created on 2021-11-15 16:33:17
  from '/Applications/XAMPP/xamppfiles/htdocs/logBook/Smarty/templates/create_post.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_61927dbdca98f6_78853119',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8ab864f746eef411a7551085316efc8600a49aa4' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/logBook/Smarty/templates/create_post.tpl',
      1 => 1636990291,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61927dbdca98f6_78853119 (Smarty_Internal_Template $_smarty_tpl) {
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

<?php if ($_smarty_tpl->tpl_vars['creaPost']->value == true) {?>

<body onload="creaExperience()">
<!-- Navigation-->
<nav class="navbar navbar-light bg-light static-top">
    <div class="container">
        <a class="navbar-brand" href="/logBook/"><img src="/logBook/Smarty/immagini/logo_logbook.PNG"  width="243" height="62"></a>
    </div>
</nav>
<section>

    <form method="post" id="form_create_post"  action="/logBook/Post/savePost/<?php echo $_smarty_tpl->tpl_vars['postID']->value;?>
" enctype="multipart/form-data">
        <a name="headPage"></a>
    <div class="row">
        <div class="col-md-9">
            <div class="card">

                        <div class="col-md-11 py-4">

                            <input type="text" name="title" required id="title" class='mx-3 form-control bg-opacity-10' placeholder='Insert title here' size="100%" rows='1'>

                            <p class="text-justify text-dark align-content-start px-5 py-4 h5">
                                    <b>
                                        This is the post's creation form, here you can create your posts.</br></br>

                                    A post is composed by a title, some experience (not less than one) and the images.</br></br>

                                    You can insert a title in the form on top of the page.</br></br>

                                    You can create an experience clicking on the button "Add Experience" and</br>
                                    you can add the images clicking on the button "Add Image".</br></br>

                                    You can also modify the post clicking on the button "Modify Post" in the</br>
                                        post page.</br></br>

                                    If your post won't have a title or at list one complete experience won't be saved</br></br>
                                    </b>
                                </p>
                        </div>
                        <div class="col-md-8">

                            <div class="container py-3"  id="container">
                            </div>

                        </div>
            </div>
        </div>

<?php } else { ?>

<body>
<!-- Navigation-->
<nav class="navbar navbar-light bg-light static-top">
    <div class="container">
        <a class="navbar-brand" href="/logBook/"><img src="/logBook/Smarty/immagini/logo_logbook.PNG"  width="243" height="62"></a>
    </div>
</nav>
<section>

    <form method="post" id="form_create_post"  action="/logBook/Post/savePost/<?php echo $_smarty_tpl->tpl_vars['postID']->value;?>
" enctype="multipart/form-data">
        <a name="headPage"></a>
        <div class="row">
            <div class="col-md-9">
                <div class="card">

                    <div class="col-md-11 py-4">
                        <input type="text" name="title" id="title" required class='mx-3 form-control bg-opacity-10' placeholder='Insert title here' size="100%" rows='1' value="<?php echo $_smarty_tpl->tpl_vars['travelTitle']->value;?>
">

                        <div class="py-3">
                            <?php if (isset($_smarty_tpl->tpl_vars['image']->value)) {?>
                                <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);
$_smarty_tpl->tpl_vars['i']->value = 0;
if ($_smarty_tpl->tpl_vars['i']->value <= count($_smarty_tpl->tpl_vars['image']->value)-1) {
for ($_foo=true;$_smarty_tpl->tpl_vars['i']->value <= count($_smarty_tpl->tpl_vars['image']->value)-1; $_smarty_tpl->tpl_vars['i']->value++) {
?>
                                    <div class="row align-content-md-center py-3">
                                        <div class="col-md-8 align-content-center">
                                            <img class="card-img-top w-100" src='data:<?php echo $_smarty_tpl->tpl_vars['typeImg']->value[$_smarty_tpl->tpl_vars['i']->value];?>
;charset=utf-8;base64,<?php echo $_smarty_tpl->tpl_vars['pic64Img']->value[$_smarty_tpl->tpl_vars['i']->value];?>
'  alt="...">
                                        </div>
                                        <div class="col-md-3 align-content-center" align="center">
                                            <a class="btn btn-danger" href="/logBook/Post/deleteExistingImage/<?php echo $_smarty_tpl->tpl_vars['image']->value[$_smarty_tpl->tpl_vars['i']->value]->getImageID();?>
/<?php echo $_smarty_tpl->tpl_vars['postID']->value;?>
"> Delete </a>
                                        </div>
                                    </div>
                                <?php }
}
?>
                            <?php }?>
                        </div>
                    </div>
                        <?php if ($_smarty_tpl->tpl_vars['array_experience']->value) {?>
                            <?php if (is_array($_smarty_tpl->tpl_vars['array_experience']->value)) {?>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['array_experience']->value, 'exp');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['exp']->value) {
?>
                                    <div class="card">
                                        <div class="card-header">
                                            <textarea class="form-control" name="titleExperience[]" rows="1" required maxlength="49" placeholder="Insert experience title here"><?php echo $_smarty_tpl->tpl_vars['exp']->value->getTitle();?>
</textarea>
                                            <div class="row py-2">
                                                <div class="col-md-3">
                                                    <input type="date" name="startDate[]" class="px-2" required value="<?php echo $_smarty_tpl->tpl_vars['exp']->value->getStartDay();?>
">
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="date" name="endDate[]" class="px-2"  required value="<?php echo $_smarty_tpl->tpl_vars['exp']->value->getEndDay();?>
">
                                                </div>
                                                <div class="col-md-3">
                                                    <select class="btn btn-primary" name="place[]">
                                                        <?php if (isset($_smarty_tpl->tpl_vars['arrayMete']->value)) {?>
                                                            <optgroup label="Tourist Destination">
                                                                <?php if (count($_smarty_tpl->tpl_vars['arrayMete']->value) == 1) {?>
                                                                    <?php if ($_smarty_tpl->tpl_vars['exp']->value->getPlace()->getPlaceID() == $_smarty_tpl->tpl_vars['arrayMete']->value->getPlaceID()) {?>
                                                                        <option selected value="<?php echo $_smarty_tpl->tpl_vars['arrayMete']->value->getPlaceID();?>
"><?php echo $_smarty_tpl->tpl_vars['arrayMete']->value->getName();?>
</option>
                                                                    <?php } else { ?>
                                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['arrayMete']->value->getPlaceID();?>
"><?php echo $_smarty_tpl->tpl_vars['arrayMete']->value->getName();?>
</option>
                                                                    <?php }?>
                                                                <?php } else { ?>
                                                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrayMete']->value, 'mete');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['mete']->value) {
?>
                                                                        <?php if ($_smarty_tpl->tpl_vars['exp']->value->getPlace()->getPlaceID() == $_smarty_tpl->tpl_vars['mete']->value->getPlaceID()) {?>
                                                                            <option selected value="<?php echo $_smarty_tpl->tpl_vars['mete']->value->getPlaceID();?>
"><?php echo $_smarty_tpl->tpl_vars['mete']->value->getName();?>
</option>
                                                                        <?php } else { ?>
                                                                            <option value="<?php echo $_smarty_tpl->tpl_vars['mete']->value->getPlaceID();?>
"><?php echo $_smarty_tpl->tpl_vars['mete']->value->getName();?>
</option>
                                                                        <?php }?>
                                                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                                <?php }?>
                                                            </optgroup>
                                                        <?php }?>

                                                        <?php if (isset($_smarty_tpl->tpl_vars['arrayCity']->value)) {?>
                                                            <optgroup label="Cities">
                                                                <?php if (count($_smarty_tpl->tpl_vars['arrayCity']->value) == 1) {?>
                                                                    <?php if ($_smarty_tpl->tpl_vars['exp']->value->getPlace()->getPlaceID() == $_smarty_tpl->tpl_vars['arrayCity']->value->getPlaceID()) {?>
                                                                        <option selected value="<?php echo $_smarty_tpl->tpl_vars['arrayCity']->value->getPlaceID();?>
"><?php echo $_smarty_tpl->tpl_vars['arrayCity']->value->getName();?>
</option>
                                                                    <?php } else { ?>
                                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['arrayCity']->value->getPlaceID();?>
"><?php echo $_smarty_tpl->tpl_vars['arrayCity']->value->getName();?>
</option>
                                                                    <?php }?>
                                                                <?php } else { ?>
                                                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrayCity']->value, 'city');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['city']->value) {
?>
                                                                        <?php if ($_smarty_tpl->tpl_vars['exp']->value->getPlace()->getPlaceID() == $_smarty_tpl->tpl_vars['city']->value->getPlaceID()) {?>
                                                                            <option selected value="<?php echo $_smarty_tpl->tpl_vars['city']->value->getPlaceID();?>
"><?php echo $_smarty_tpl->tpl_vars['city']->value->getName();?>
</option>
                                                                        <?php } else { ?>
                                                                            <option value="<?php echo $_smarty_tpl->tpl_vars['city']->value->getPlaceID();?>
"><?php echo $_smarty_tpl->tpl_vars['city']->value->getName();?>
</option>
                                                                        <?php }?>
                                                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                                <?php }?>
                                                            </optgroup>
                                                        <?php }?>

                                                        <?php if (isset($_smarty_tpl->tpl_vars['arrayRegion']->value)) {?>
                                                            <optgroup label="Regions">
                                                            <?php if (count($_smarty_tpl->tpl_vars['arrayRegion']->value) == 1) {?>
                                                                <?php if ($_smarty_tpl->tpl_vars['exp']->value->getPlace()->getPlaceID() == $_smarty_tpl->tpl_vars['arrayRegion']->value->getPlaceID()) {?>
                                                                    <option selected value="<?php echo $_smarty_tpl->tpl_vars['arrayRegion']->value->getPlaceID();?>
"><?php echo $_smarty_tpl->tpl_vars['arrayRegion']->value->getName();?>
</option>
                                                                <?php } else { ?>
                                                                    <option value="<?php echo $_smarty_tpl->tpl_vars['arrayRegion']->value->getPlaceID();?>
"><?php echo $_smarty_tpl->tpl_vars['arrayRegion']->value->getName();?>
</option>
                                                                <?php }?>
                                                            <?php } else { ?>
                                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrayRegion']->value, 'region');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['region']->value) {
?>
                                                                    <?php if ($_smarty_tpl->tpl_vars['exp']->value->getPlace()->getPlaceID() == $_smarty_tpl->tpl_vars['region']->value->getPlaceID()) {?>
                                                                        <option selected value="<?php echo $_smarty_tpl->tpl_vars['region']->value->getPlaceID();?>
"><?php echo $_smarty_tpl->tpl_vars['region']->value->getName();?>
</option>
                                                                    <?php } else { ?>
                                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['region']->value->getPlaceID();?>
"><?php echo $_smarty_tpl->tpl_vars['region']->value->getName();?>
</option>
                                                                    <?php }?>
                                                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                            <?php }?>
                                                            </optgroup>
                                                        <?php }?>

                                                        <?php if (isset($_smarty_tpl->tpl_vars['arrayState']->value)) {?>
                                                            <optgroup label="Stetes">
                                                            <?php if (count($_smarty_tpl->tpl_vars['arrayState']->value) == 1) {?>
                                                                <?php if ($_smarty_tpl->tpl_vars['exp']->value->getPlace()->getPlaceID() == $_smarty_tpl->tpl_vars['arrayState']->value->getPlaceID()) {?>
                                                                    <option selected value="<?php echo $_smarty_tpl->tpl_vars['arrayState']->value->getPlaceID();?>
"><?php echo $_smarty_tpl->tpl_vars['arrayState']->value->getName();?>
</option>
                                                                <?php } else { ?>
                                                                    <option value="<?php echo $_smarty_tpl->tpl_vars['arrayState']->value->getPlaceID();?>
"><?php echo $_smarty_tpl->tpl_vars['arrayState']->value->getName();?>
</option>
                                                                <?php }?>
                                                            <?php } else { ?>
                                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrayState']->value, 'state');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['state']->value) {
?>
                                                                    <?php if ($_smarty_tpl->tpl_vars['exp']->value->getPlace()->getPlaceID() == $_smarty_tpl->tpl_vars['state']->value->getPlaceID()) {?>
                                                                        <option selected value="<?php echo $_smarty_tpl->tpl_vars['state']->value->getPlaceID();?>
"><?php echo $_smarty_tpl->tpl_vars['state']->value->getName();?>
</option>
                                                                    <?php } else { ?>
                                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['state']->value->getPlaceID();?>
"><?php echo $_smarty_tpl->tpl_vars['state']->value->getName();?>
</option>
                                                                    <?php }?>
                                                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                            <?php }?>
                                                            </optgroup>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <textarea required class="form-control" name="description[]" maxlength="499" rows="6" placeholder="Insert description here"><?php echo $_smarty_tpl->tpl_vars['exp']->value->getDescription();?>
</textarea>
                                        </div>
                                        <div align="end">
                                            <a type="button" class="my-3 mx-3 btn btn-danger" href="/logBook/Post/deleteExistingExperience/<?php echo $_smarty_tpl->tpl_vars['exp']->value->getExperienceID();?>
/<?php echo $_smarty_tpl->tpl_vars['postID']->value;?>
">- Delete Experience</a>
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
                            <div class="col-md-8">
                            </div>
                        </div>
                        </div>
                        </div>
<?php }?>
        <div class="col-md-3 fisso" >
            <div align="center">
                <a type="button" href="#headPage"><img src="/logBook/Smarty/immagini/buttonUp.png" width="100" height="100" class="d-inline-block" alt=""></a>
                <a type="button" href="#bottomPage"><img src="/logBook/Smarty/immagini/buttonDOWN.png" width="100" height="100" class="d-inline-block" alt=""></a>
            </div>
            <div class="card">
            <div class="row">
                <?php echo '<script'; ?>
 id="creaExperience">

                    function defaultDate(numCode){
                        var d1 = new Date(document.getElementById('date1'+ numCode).value);
                        var d2 = new Date(document.getElementById('date2'+ numCode).value);

                        if (d2.getDate()<d1.getDate()) {
                            alert("You cannot enter an end date that is earlier than the start date");
                            document.getElementById('date2'+ numCode).value= null;
                        }
                    }

                    function creaExperience() {
                        nuovo_elemento = document.createElement("div");
                        var numCode = parseInt(document.getElementById("container").childNodes.length + 1);
                        nuovo_elemento.setAttribute("id", "quadro" + parseInt(document.getElementById("container").childNodes.length + 1));
                        nuovo_elemento.setAttribute("class", "quadrato");
                        nuovo_elemento.innerHTML =
                            "<div class='card'>" +
                            "<div class='card-header'>" +
                            "<input type='text' class='form-control' required name='titleExperience[]' rows='1' maxlength='49' placeholder='Insert experience title here'></textarea>" +
                            "<div class='row py-2'>" +
                            "<div class='col-md-3'>" +
                            "<input type='date' required name='startDate[]' id='date1"+numCode +"' onchange='defaultDate("+numCode+")' class='px-2'>" +
                            "</div><div class='col-md-3'>" +
                            "<input type='date' required name='endDate[]' id='date2"+numCode +"' onchange='defaultDate("+numCode+")' class='px-2'>" +
                            "</div><div class='col-md-3'>" +
                            "<select class='btn btn-primary' name='place[]'>" +

                            "<?php if (isset($_smarty_tpl->tpl_vars['arrayMete']->value)) {?>" +
                            "<optgroup label='Tourist Destinations'>" +
                            "<?php if (count($_smarty_tpl->tpl_vars['arrayMete']->value) == 1) {?>" +
                            "<option value='<?php echo $_smarty_tpl->tpl_vars['arrayMete']->value->getPlaceID();?>
'><?php echo $_smarty_tpl->tpl_vars['arrayMete']->value->getName();?>
</option>" +
                            "<?php } else { ?>" +
                            "<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrayMete']->value, 'm');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['m']->value) {
?>" +
                            "<option value='<?php echo $_smarty_tpl->tpl_vars['m']->value->getPlaceID();?>
'><?php echo $_smarty_tpl->tpl_vars['m']->value->getName();?>
</option>" +
                            "<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>"+
                            "<?php }?>" +
                            "</optgroup>" +
                            "<?php }?>" +

                            "<?php if (isset($_smarty_tpl->tpl_vars['arrayCity']->value)) {?>" +
                            "<optgroup label='Cities'>" +
                            "<?php if (count($_smarty_tpl->tpl_vars['arrayCity']->value) == 1) {?>" +
                            "<option value='<?php echo $_smarty_tpl->tpl_vars['arrayCity']->value->getPlaceID();?>
'><?php echo $_smarty_tpl->tpl_vars['arrayCity']->value->getName();?>
</option>" +
                            "<?php } else { ?>" +
                            "<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrayCity']->value, 'city');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['city']->value) {
?>" +
                            "<option value='<?php echo $_smarty_tpl->tpl_vars['city']->value->getPlaceID();?>
'><?php echo $_smarty_tpl->tpl_vars['city']->value->getName();?>
</option>" +
                            "<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>"+
                            "<?php }?>" +
                            "</optgroup>" +
                            "<?php }?>" +

                            "<?php if (isset($_smarty_tpl->tpl_vars['arrayRegion']->value)) {?>" +
                            "<optgroup label='Regions'>" +
                            "<?php if (count($_smarty_tpl->tpl_vars['arrayRegion']->value) == 1) {?>" +
                            "<option value='<?php echo $_smarty_tpl->tpl_vars['arrayRegion']->value->getPlaceID();?>
'><?php echo $_smarty_tpl->tpl_vars['arrayRegion']->value->getName();?>
</option>" +
                            "<?php } else { ?>" +
                            "<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrayRegion']->value, 'region');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['region']->value) {
?>" +
                            "<option value='<?php echo $_smarty_tpl->tpl_vars['region']->value->getPlaceID();?>
'><?php echo $_smarty_tpl->tpl_vars['region']->value->getName();?>
</option>" +
                            "<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>"+
                            "<?php }?>" +
                            "</optgroup>" +
                            "<?php }?>" +

                            "<?php if (isset($_smarty_tpl->tpl_vars['arrayState']->value)) {?>" +
                            "<optgroup label='States'>" +
                            "<?php if (count($_smarty_tpl->tpl_vars['arrayState']->value) == 1) {?>" +
                            "<option value='<?php echo $_smarty_tpl->tpl_vars['arrayState']->value->getPlaceID();?>
'><?php echo $_smarty_tpl->tpl_vars['arrayState']->value->getName();?>
</option>" +
                            "<?php } else { ?>" +
                            "<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrayState']->value, 'state');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['state']->value) {
?>" +
                            "<option value='<?php echo $_smarty_tpl->tpl_vars['state']->value->getPlaceID();?>
'><?php echo $_smarty_tpl->tpl_vars['state']->value->getName();?>
</option>" +
                            "<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>"+
                            "<?php }?>" +
                            "</optgroup>" +
                            "<?php }?>" +

                            "</select>" +
                            "</div>" +
                            "<div class='col-md-3'></div></div></div>" +
                            "<div class='card-body'>" +
                            "<textarea class='form-control' required name='description[]' maxlength='499' rows='6' placeholder='Insert description here'></textarea>" +
                            "</div><div align='end'>" +
                            "<a type='button' class='my-3 mx-3 btn btn-danger '  onclick='remove(" + numCode + ")' href='#experiences'> - Delete Experience</a>" +
                            "</div></div>";

                        document.getElementById("container").appendChild(nuovo_elemento);
                        obj = eval("document.getElementById(\"quadro" + parseInt(document.getElementById("container").childNodes.length) + "\")");
                        obj.style.height = "450px";
                        obj.style.width = "1000px";
                    }

                <?php echo '</script'; ?>
>
                <a type="button" class="btn btn-primary " onclick="creaExperience()" href="#bottomPage">+ Add Experience</a>
            </div>
            <div class="row">
                <button type="button" class="btn btn-primary  my-1 " onclick="creaImage()" >+ Add Image</button>
            </div>
                <div id="container2" class="col">
            </div>
            </div>
        </div>
    </div>
        <button name="send" type="submit" form="form_create_post" class="mx-3 my-3 btn btn-primary" >Salva</button>
        <?php if (!isset($_smarty_tpl->tpl_vars['postID']->value)) {?>
            <a name="send" href="/logBook/User/profile" class="mx-3 my-3 btn btn-warning" >Annulla</a>
        <?php } else { ?>
            <a name="send" href="/logBook/Post/annullaModifiche/<?php echo $_smarty_tpl->tpl_vars['postID']->value;?>
/" class="btn btn-warning">Annulla</a>
        <?php }?>
        <a name="bottomPage"></a>
    </form>
</section>

<!-- Bootstrap core JS-->
<?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>

</body>
</html><?php }
}
