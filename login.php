<?php
ob_start();
session_start();

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Member')
        header('Location: Membres/membre.php');
    if ($_SESSION['role'] == 'Admin')
        header('Location: Admin/admin.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Service de Ticketing</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="../css/btn.css" rel="stylesheet">

    </head>


    <body id="page-top" class="bg-primary">
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="index.php">Service de Ticketing</a>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="login.php">Login</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="about.php">à propos</a></li>
                    </ul>
                </div>
            </div>
        </nav>


        <header class="masthead bg-primary text-white text-center" style="height: 100vh;">
            <div class="container d-flex align-items-center flex-column">
                <h1 class="masthead-heading text-uppercase mb-0">Connexion</h1>
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <form action="login.php" method="post">
                    <div class="form-group mb-3 ">
                        <label class="mb-2" for="exampleInputEmail1">E-mail</label>
                        <input type="email" name ="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="E-mail" style="width:350px;" required>
                    </div>
                    <div class="form-group mb-1">
                        <label class="mb-2" for="exampleInputPassword1">Mot de passe</label>
                        <input type="password" name ="password" class="form-control" id="exampleInputPassword1" placeholder="Mot de passe" required>
                    </div>
                    <input type="submit" name="login" class="btn mt-3 mb-3 btn-primary border border-white" value="Se connecter">
                    </form>
            </div>
            <div>
                <p class="text-white mt-3">Vous n'avez pas encore de compte ?<br></p>
                <button type="button" class="btn btn-primary" onclick="window.location.href='create.php'"><u>Créer un compte</u></button>
            </div>

<?php
    try {           
        if(@$_POST['login']) {
            require 'account.php';
            login();       
        }
    }
    catch(PDOException $pe) {
        echo 'Erreur :'.$pe->getMessage();
    }
?>

        </header>
            <div class="fixed-bottom copyright py-3 text-center text-white">
            <div class="container"><small>&copy Essaye de voler l'idée et Brunette te casse la gueule</small></div>
            </div>
<?php ob_end_flush(); ?>