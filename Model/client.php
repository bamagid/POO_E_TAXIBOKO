<?php 
class Utilisateurs {
    private $nom;
    private $prenom;
    private $tel;
    private $email;
    private $mdp;
    private $bdd;

    public function __construct($bdd,$email,$mdp) {
        $this->setBdd($bdd);
        $this->setEmail($email);
        $this->setMdp($mdp);
    }

    function getBdd() {
        return $this->bdd;
    }
    function setBdd($bdd) {
        $this->bdd = $bdd;
    }
    function getEmail() {
        return $this->email;
    }

    function setEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "L'e-mail n'est pas valide";
        } else {
            $this->email = $email;
        }
    }

    function getMdp() {
        return $this->mdp;
    }

    function setMdp($mdp) {
        $this->mdp = md5($mdp);
    }

    static function inscription($bdd, $nom, $prenom, $tel, $email, $mdp) {
        if (isset($_POST['logout']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['telephone']) && !empty($_POST['email2']) && !empty($_POST['password2'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $tel = htmlspecialchars($_POST['telephone']);
    $email = htmlspecialchars($_POST['email2']);
    $mdp =md5(htmlspecialchars($_POST['password2']));
    $erreurs=[];
    // Validation des données
    if(!preg_match("/^[a-zA-Zàéùè -]{2,50}$/", $prenom)) {
        array_push($erreurs,"veuillez entrer un prenom valide");
    }
    if (!preg_match("/^[a-zA-Z]{2,30}$/", $nom)) {
        array_push($erreurs,"veuillez entrer un nom valide");
    }
    if(!preg_match("/^7[05768]{1}+[0-9]{7}$/",$tel)){
        array_push($erreurs,"le numéro de téléphone est invalide");}
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            array_push($erreurs,"l'e-mail n'est pas valide");
    }elseif (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $all_users=$bdd->prepare("SELECT * FROM taxiboko WHERE email=:mail");
            $all_users->execute(['mail'=>$email]);
            if ($all_users->rowCount()>=1) {
                array_push($erreurs,"L'email que vous avez mis est deja associé a un compte");
            }
        }
    if (strlen($mdp)>256) {
            array_push($erreurs,"le mot de passe ne doit pas depasser 256 caracteres");
        }
        if(count($erreurs)===0){
        // Insertion des infos de l'utilisateur dans la base de données
        $insert = $bdd->prepare('INSERT INTO taxiboko (nom, prenom, telephone, email, password) VALUES (:nom, :prenom, :telephone, :email, :password)');
        $insert->execute(array(
            'nom' => $nom,
            'prenom' => $prenom,
            'telephone' => $tel,
            'email' => $email,
            'password' => $mdp
        ));
        echo '<p style="color: green; text-align:center;"><b>Bravo votre inscription a reussie!</b></p>';
    }else{
            foreach ($erreurs as $error) {
               echo '<ul style="color: red;"><li> '. $error.' </li></ul>';
           }
    }}
    }
    static function connexion($bdd, $email, $mdp) {
        if (isset($_POST['connect']) && !empty($email) && !empty($mdp)) {
            $email = htmlspecialchars($_POST['email']);
            $pass =md5(htmlspecialchars($_POST['password']));
            $query = $bdd->prepare("SELECT nom, prenom, telephone FROM taxiboko WHERE email = :email AND password = :password");
            $query->execute(array('email' => $email, 'password' =>$pass));
            if ($query->rowCount() == 1) {
                $user = $query->fetch();
                $_SESSION['user'] = $user;
                header("Location: ../View/user_list.php");
                exit();
            } else {
                echo "Désolé, les identifiants que vous avez entrés sont incorrects.";
            }
        }

    }
}
