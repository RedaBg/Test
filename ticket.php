<?php

function notif($ticket) {

     require "database.php";

    $notif=0;

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $db_username, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT id FROM tickets_comments WHERE notif = 0 && ticket_id = $ticket && account_id != " . $_SESSION['user_id']. " ";
        $stmt = $pdo->query($query);

        $notif = $stmt->rowCount();
        
        return "<span class='notif'>". $notif ."</span>";

    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
}

function notifclear() {
         require "database.php";

    $ticket_id = intval($_GET['id']);
    $current_user = $_SESSION['user_id']; 

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $db_username, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT id FROM tickets_comments WHERE notif = 0 && ticket_id = $ticket_id && account_id != $current_user";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $sql = "UPDATE tickets_comments SET notif = 1 WHERE id = " .$row['id'] ."";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        }

    } catch (PDOException $e) {
        echo "Erreur lors de l'envoi du message : " . $e->getMessage();
    }
}

function getTicket($id) {

     require "database.php";


    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $db_username, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT title, msg, created, ticket_status, id FROM tickets WHERE account_id = $id";
        $stmt = $pdo->query($query);

        if ($stmt->rowCount() > 0) {
            echo "<table border='1'>
                    <tr>
                        <th>Titre</th>
                        <th>Message</th>
                        <th>Date de Création</th>
                        <th>Statut</th>
                        <th>Consulter</th>
                    </tr>";

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                        <td>" . $row['title'] . "</td>
                        <td>" . $row['msg'] . "</td>
                        <td>" . $row['created'] . "</td>";
                        if ($row['ticket_status'] == "open") {
                            echo "<td><div class='status-open'>Ouvert</div></td>";
                        } elseif ($row['ticket_status'] == "resolved") {
                            echo "<td><div class='status-resolved'>Résolut</div></td>";
                        } elseif ($row['ticket_status'] == "closed") {
                            echo "<td><div class='status-closed'>Fermé</div></td>";
                        }
                        echo   "<td><a href='consulter.php?id=" . $row['id'] . "'class='btn-create-ticket'>Consulter</a>". notif($row['id']) ."</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo '<div class="ms-auto text-center pt-5"><p class="lead">Vous n\'avez pas encore de tickets..</p></div>
';
        }
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
}

function getTicketAll($sort) {
    require "database.php";

    $i = 0;
    
    if (isset($_GET['state'])) {$state = $_GET['state'];} else {header("Location: admin.php");}
    if (isset($_GET['prio'])) {$prio = $_GET['prio'];} else {header("Location: admin.php");}

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $db_username, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT id, title, msg, created, priority, ticket_status FROM tickets";
        
        if ($sort == "recent") {$query = "SELECT id, title, msg, created, priority, ticket_status FROM tickets ORDER BY created DESC";}
        if ($sort == "old") {$query = "SELECT id, title, msg, created, priority, ticket_status FROM tickets ORDER BY created ASC";}
        if ($sort == "state") {$query = "SELECT id, title, msg, created, priority, ticket_status FROM tickets WHERE ticket_status = $state";}
        if ($sort == "prio") {$query = "SELECT id, title, msg, created, priority, ticket_status FROM tickets WHERE priority = $prio";}

        $stmt = $pdo->query($query);

        if ($stmt->rowCount() > 0) {
            echo "<table border='1'>
                    <tr>
                        <th>Titre</th>
                        <th>Message</th>
                        <th>Date de Création</th>
                        <th>Priorité</th>
                        <th>Statut</th>
                        <th>Actions</th>
                        <th>Réponse</th>
                    </tr>";

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                        <td>" . $row['title'] . "</td>
                        <td>" . $row['msg'] . "</td>
                        <td>" . $row['created'] . "</td>";
                        if ($row['priority'] == "low") {
                            echo "<td><div class='prio-low'>Faible</div></td>";
                        } elseif ($row['priority'] == "medium") {
                            echo "<td><div class='prio-med'>Moyenne</div></td>";
                        } elseif ($row['priority'] == "high") {
                            echo "<td><div class='prio-high'>Elévée</div></td>";
                        }

                        if ($row['ticket_status'] == "open") {
                            echo "<td><div class='status-open'>Ouvert</div></td>";
                        } elseif ($row['ticket_status'] == "resolved") {
                            echo "<td><div class='status-resolved'>Résolut</div></td>";
                        } elseif ($row['ticket_status'] == "closed") {
                            echo "<td><div class='status-closed'>Fermé</div></td>";
                        }
                echo   "<td><a href='gerer-ticket.php?id=" . $row['id'] . "'class='btn-create-ticket'>Gérer</a></td>
                        <td><a href='repondre.php?id=" . $row['id'] . "'class='btn-create-ticket'>Répondre</a></td>
                    </tr>";
            }

            echo "</table>";
        } else {
            echo "Aucun ticket trouvé.";
        }
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
}


function creerTicket() {

    $title = $_POST['title'];
    $message = $_POST['message'];
    $category_id = $_POST['category'];

    $full_name = $_SESSION['username'];
    $email = $_SESSION['email'];
    $account_id = $_SESSION['user_id'];

    require "database.php";


    $conn = new mysqli($host, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Échec de la connexion : " . $conn->connect_error);
    }

    $result = $conn->query("SELECT MAX(id) AS max_id FROM tickets");
    if ($result) {
        $row = $result->fetch_assoc();
        $last_id = $row['max_id'] ?? 0;
    } else {
        die("Erreur lors de la récupération du dernier ID : " . $conn->error);
    }

    $new_id = $last_id + 1;

    $sql = "INSERT INTO tickets (id, title, msg, full_name, email, created, ticket_status, priority, category_id, private, account_id, approved) 
            VALUES (?, ?, ?, ?, ?, CURRENT_TIMESTAMP, 'open', 'low', ?, 0, ?, 1)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("issssii", $new_id, $title, $message, $full_name, $email, $category_id, $account_id);
        $stmt->execute();

        header("Location: ../mail.php?action=1&user=" .$full_name. "&mail=" .$email. ""); 
        exit();

        $stmt->close();
    } else {
        echo "Erreur de préparation de la requête : " . $conn->error;
    }

    $conn->close();
}

function gererTicket() {
     require "database.php";

    $ticket_status = $_POST['ticket_status'];
    $priority = $_POST['priority'];
    $ticket_id = intval($_GET['id']);

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $db_username, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE tickets SET ticket_status = ?, priority = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute([$ticket_status, $priority, $ticket_id])) {
            header("Location: gerer-ticket.php?id=" . $ticket_id . "&success=true");
            exit();
        } else {
            echo "Erreur lors de la mise à jour du ticket.";
        }
    } catch (PDOException $e) {
        echo "Erreur lors de la connexion ou de l'exécution : " . $e->getMessage();
    }
}


function getModif() {
     require "database.php";


    $conn = new mysqli($host, $db_username, $password, $db_password);

    if ($conn->connect_error) {
        die("Échec de la connexion : " . $conn->connect_error);
    }

    if (isset($_GET['id'])) {
        $ticket_id = intval($_GET['id']);

        $sql = "SELECT id, title, msg, created, ticket_status, priority FROM tickets WHERE id = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $ticket_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $ticket = $result->fetch_assoc();
            } else {
                die("Ticket introuvable.");
            }

            $stmt->close();
        } else {
            die("Erreur de préparation de la requête : " . $conn->error);
        }
    } else {
        die("ID du ticket manquant.");
    }

    $conn->close();
    }


function chat() {
     require "database.php";

    $ticket_id = intval($_GET['id']);
    $current_user = $_SESSION['user_id']; 

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $db_username, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT msg, created, account_id FROM tickets_comments WHERE ticket_id = $ticket_id ORDER BY created ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        echo "<div class='chat-container'>"; 

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $isAdmin = ($row['account_id'] == 1); 
            $alignClass = ($row['account_id'] == $current_user) ?  'message-right': 'message-left';

            echo "<div class='message $alignClass'>
                    <p style=color:black;> " . htmlspecialchars($row['msg']) . "</p>
                    <span class='timestamp'>" . $row['created'] . "</span>
                  </div>";
        }

        echo "</div>"; 

    } catch (PDOException $e) {
        echo "Erreur lors de l'envoi du message : " . $e->getMessage();
    }
}



?>
