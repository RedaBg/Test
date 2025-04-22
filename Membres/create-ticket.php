<?php 
ob_start();
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] == 'Admin') {
    header('Location: ../login.php');
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
    <link rel="icon" type="../image/x-icon" href="../assets/favicon.ico" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="../css/table.css" rel="stylesheet">
</head>

<body id="page-top" class="bg-primary">
    <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="../index.php">Service de Ticketing</a>
            <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="membre.php">Mes tickets</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="../logout.php">Se déconnecter</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="../about.php">à propos</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="masthead bg-primary text-white text-center" style="height: 50vh;">
        <div class="container d-flex align-items-center flex-column">
        <h2 class="page-section-heading text-center text-uppercase text-white" style="margin-top: -50;">Créer un ticket</h2>
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <form action="create-ticket.php" method="post">
                <div class="form-group mb-3">
                    <label class="mb-2" for="title">Titre</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Entrez le titre" style="width:350px;" required>
                </div>

                <div class="form-group mb-3">
                    <label class="mb-2" for="message" >Message</label>
                    <textarea name="message" class="form-control" id="message" placeholder="Votre message" style="width:350px; height:150px;" required></textarea>
                </div>

                <div class="form-group mb-3">
                    <label class="mb-2" for="category">Catégorie</label>
                    
                    <select name="category" class="form-control" id="category" style="width:350px;" required=required>
                        <option value="">Choisiez la catégorie</option>
                        <option value="1">Général</option>
                        <option value="2">Technique</option>
                        <option value="3">Autre</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label class="mb-2" for="file">Fichiers (optionnel)</label>
                    <input type="file" class="form-control" id="file" name="file" multiple />
                </div>

                <input type="submit" name="creer" class="btn mt-3 mb-3 btn-primary border border-white" value="Soumettre">
            </form>
        </div>
    </header>
<?php
    try {           
        if(@$_POST['creer']) {
            require '../ticket.php';
            creerTicket();
        }
    }
    catch(PDOException $pe) {
        echo 'Erreur :'.$pe->getMessage();
    }
?>

    <div class="fixed-bottom copyright py-3 text-center text-white">
        <div class="container"><small>&copy Essaye de voler l'idée et BRUNET Loan te cassera la gueule</small></div>
    </div>
</body>
</html>
<?php ob_end_flush(); ?>