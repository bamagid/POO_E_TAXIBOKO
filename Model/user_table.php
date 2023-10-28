<?php
class UserTable {
    public static function generateTable() {
        session_start();
        echo '<div class="content">';
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            echo "<p>Bienvenue à e-taxiboko, " . $user['prenom'] . " " . $user['nom'] . "!</p><br>";
            require_once('../Model/config.php');
            $query = $bdd->query('SELECT nom, prenom, telephone, date FROM taxiboko');
            echo "<p>La liste des personnes inscrites sur la plateforme est la suivante:</p><br>";
            echo "<table class='user-table'>"; // Ajoutez une classe CSS pour le style
            echo "<tr>";
            echo "<th>PRENOM</th>";
            echo "<th>NOM</th>";
            echo "</tr>";
            foreach ($query as $value) {
                echo "<tr>";
                echo "<td>" . $value['prenom'] . "</td>";
                echo "<td>" . $value['nom'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Vous n'êtes pas connecté. Veuillez vous connecter pour voir la liste des utilisateurs.";
        }
        echo '</div>';
    }
}
