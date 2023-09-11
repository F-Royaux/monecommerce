<?php require("inc/init.inc.php");
// traitement
if (isset($_GET['action']) && $_GET['action'] == "deconnexion"){
    session_destroy();
}
if(userIsConnected()){
    header("location profil.php");
}
if ($_POST && isset(($_POST['mdp']))) {
    $resultat = executeRequete("SELECT * FROM utilisateur WHERE pseudo='$_POST[pseudo]'");
    if ($resultat->num_rows != 0) {
        $membre = $resultat->fetch_assoc();
        if (password_verify($_POST['mdp'], $membre['mot_de_passe'])){
            foreach ($membre as $indice => $element) {
                if ($indice != 'mot_de_passe'){
                    $_SESSION['membre'][$indice] = $element;
                }
            }
            header("location: profil.php");
        } else {
            $contenu .= '<div class="erreur"> Erreur de mot de passe</div>';
        }
        //si tout est bon redirige vers le profil
        // header("location: profil.php");
    } else {
        $contenu .= '<div class="erreur"> Erreur de pseudo</div>';
    }
}



?>
<?php require("inc/haut.inc.php"); ?>
<?php echo $contenu ?>
<form action="" method="post">
    <label for="pseudo">pseudo</label>
    <input type="text" id="cpPseudo" name="pseudo">
    <label for="mdp">Mot de passe</label>
    <input type="password" id="coMdp" name="mdp">
    <button> Se connecter</button>
</form>
<?php require("./inc/bas.inc.php"); ?>