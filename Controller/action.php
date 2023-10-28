<?php
session_start();
require_once("../Model/config.php");
require_once ("../Model/bdd.php");
require_once ("../Model/client.php");

if (isset($_POST['connect'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    Utilisateurs::connexion($bdd,$email,$password);
}

if (isset($_POST['logout'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $tel = $_POST['telephone'];
    $email = $_POST['email2'];
    $mdp = $_POST['password2'];
    $confirm = $_POST['password2'];

    Utilisateurs::inscription($bdd,$nom,$prenom,$tel,$email,$mdp);
}
if (isset($_POST['deconnect'])) {
    unset($_SESSION['user']);
    header("Location:../View/index.php");
}
?>
