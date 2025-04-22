<?php 

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
        <link href="../css/btn.css" rel="stylesheet">
    </head>

    <body id="page-top">
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="../index.php">Service de Ticketing</a>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="../logout.php">Se déconnecter</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="../about.php">à propos</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <section class="page-section bg-primary text-white mb-0 " id="about" style="height: 100vh;">
            <div class="container">
                <h2 class="page-section-heading text-center text-uppercase text-white pt-5">Mes tickets</h2>
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <div style="text-align: center; margin-top: 20px;">
                    <a href="create-ticket.php" class="btn-create-ticket">Créer un nouveau ticket</a>
                </div>
                <div>
<?php require '../ticket.php';
    getTicket($_SESSION['user_id']);
?>
                </div>
            </div>
        </section>
                <div class="fixed-bottom copyright py-3 text-center text-white">
            <div class="container"><small>&copy Essaye de voler l'idée et BRUNET Loan te cassera la gueule</small></div>
            </div>

    </body>