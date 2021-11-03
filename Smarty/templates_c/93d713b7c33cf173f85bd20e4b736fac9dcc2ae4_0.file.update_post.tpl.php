<?php
/* Smarty version 3.1.33, created on 2021-11-03 20:04:57
  from 'C:\xampp\htdocs\logBook\Smarty\templates\update_post.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_6182dd598ae744_16021261',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '93d713b7c33cf173f85bd20e4b736fac9dcc2ae4' => 
    array (
      0 => 'C:\\xampp\\htdocs\\logBook\\Smarty\\templates\\update_post.tpl',
      1 => 1635966294,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6182dd598ae744_16021261 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Update Post</title>
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
    <form method="post" id="form_create_post" action="/logBook/Post/updatePost/<?php echo $_smarty_tpl->tpl_vars['postID']->value;?>
">
        <div class="row">
            <div class="col-md-9">
                <div class="card">

                    <div class="col-md-11 py-4">

                        <input type="text" name="title" id="title" class='mx-3 form-control bg-opacity-10' placeholder='Insert title here' size="100%" rows='1' value="<?php echo $_smarty_tpl->tpl_vars['travelTitle']->value;?>
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
                                        <img class="card-img-top w-auto h-100 " src='data:<?php echo $_smarty_tpl->tpl_vars['typeImg']->value[$_smarty_tpl->tpl_vars['i']->value];?>
;charset=utf-8;base64,<?php echo $_smarty_tpl->tpl_vars['pic64Img']->value[$_smarty_tpl->tpl_vars['i']->value];?>
'  alt="...">
                                    </div>
                                    <div class="col-md-3 align-content-center" align="center">
                                        <button class="btn btn-danger"> Delete </button>
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
                                <textarea class="form-control" name="titleExperience[]" rows="1" maxlength="49" placeholder="Insert experience title here"><?php echo $_smarty_tpl->tpl_vars['exp']->value->getTitle();?>
</textarea>
                                <div class="row py-2">
                                    <div class="col-md-3">
                                        <input type="date" name="startDate[]" class="px-2" value="<?php echo $_smarty_tpl->tpl_vars['exp']->value->getStartDay();?>
">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="date" name="endDate[]" class="px-2" value="<?php echo $_smarty_tpl->tpl_vars['exp']->value->getEndDay();?>
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
                                                <optgroup label="Regions"">
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
                                                <optgroup label="Stetes"">
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
                                <textarea class="form-control" name="description[]" maxlength="499" rows="6" placeholder="Insert description here"><?php echo $_smarty_tpl->tpl_vars['exp']->value->getDescription();?>
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
                        <div class="col-md-8 mx-3">
                            <button name="send" type="submit" form="form_create_post" class="btn btn-primary mx-2">Salva</button>
                            <a name="send" href="/logBook/Research/postDetail/<?php echo $_smarty_tpl->tpl_vars['postID']->value;?>
/" class="btn btn-warning mx-2" >Annulla</a>
                            <a name="send" href="/logBook/Post/deletePost/<?php echo $_smarty_tpl->tpl_vars['postID']->value;?>
" class="btn btn-danger mx-2" >Elimina</a>
                            <a name="bottomPage"></a>
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-md-3 fisso" >
                <div class="card">
                    <div class="row">
                        <?php echo '<script'; ?>
 id="creaExperience">
                            function creaExperience() {
                                nuovo_elemento = document.createElement("div");
                                var numCode = parseInt(document.getElementById("container").childNodes.length + 1);
                                nuovo_elemento.setAttribute("id", "quadro" + parseInt(document.getElementById("container").childNodes.length + 1));
                                nuovo_elemento.setAttribute("class", "quadrato");
                                nuovo_elemento.innerHTML =
                                    "<div class='card'>" +
                                    "<div class='card-header'>" +
                                    "<textarea class='form-control' name='titleExperience" + numCode + "' rows='1' maxlength='49' placeholder='Insert experience title here'></textarea>" +
                                    "<div class='row py-2'>" +
                                    "<div class='col-md-3'>" +
                                    "<input type='date' name='startDate" + numCode + "' class='px-2'>" +
                                    "</div><div class='col-md-3'>" +
                                    "<input type='date' name='endDate" + numCode + "' class='px-2'>" +
                                    "</div><div class='col-md-3'>" +
                                    //"<button class='btn btn-primary' onclick='selectPlace()'> + Add Place </button>" +
                                    "<select class='btn btn-primary' name='place" + numCode + "'>" +

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

                                    "" +
                                    "<div class='col-md-3'></div></div></div>" +
                                    "<div class='card-body'>" +
                                    "<textarea class='form-control' name='description" + numCode + "' maxlength='499' rows='6' placeholder='Insert description here'></textarea>" +
                                    "</div><div align='end'>" +
                                    "<a type='button' class='my-3 mx-3 btn btn-danger '  onclick='remove(" + numCode + ")' href='#experiences'>- Delete Experience</a>" +
                                    "</div></div>";
                                document.getElementById("container").appendChild(nuovo_elemento);
                                obj = eval("document.getElementById(\"quadro" + parseInt(document.getElementById("container").childNodes.length) + "\")");
                                obj.style.height = "450px";
                                obj.style.width = "1000px";
                            }
                        <?php echo '</script'; ?>
>
                        <a type="button" class="btn btn-primary "  onclick="creaExperience()" href="#bottomPage" >+ Add Experience</a>
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
