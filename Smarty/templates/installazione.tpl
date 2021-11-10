<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Installation Page</title>

    <link rel="icon" type="image/x-icon" href="/logBook/Smarty/immagini/immagine_logo.JPG" />

    <link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/cover/">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="/logBook/Smarty/css/style.css">
</head>

<body class="text-center">

<div class="">
    <header align="center">
            <div class="col-md-auto" >
                <h1 class="">Installazione</h1>
                <img src="/logBook/Smarty/immagini/logo_logbook.PNG"  width="500" height="200">
            </div>
    </header>

    <main role="main" class="inner cover">
        <h3 class=" text-danger">{if isset($nophpv)} La tua versione di php non è compatibile! {/if}</h3>
        <form action="/logBook/" method="POST">
            <div class="form-group">
                <label>Database name</label>
                <input class="form-control" name="nomedb"> </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="nomeutente"> </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password"> </div>
            <div class="form-group">
                <button type="submit" class="btn mt-2 btn btn-light">Install</button>
            </div>
        </form>
    </main>

    <footer class="mastfoot mt-auto">
    </footer>
</div>


<script src="/logBook/Smarty/js/checkjs.js"></script>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>