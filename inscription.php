<?php require("./inc/init.inc.php"); ?>
<?php
if ($_POST) {
    // debug($_POST);
    $verif_caractere = preg_match("#^[a-zA-Z0-9-_.]+$#", $_POST['pseudo']);
    if (!$verif_caractere || strlen($_POST['pseudo']) < 1 || strlen($_POST['pseudo']) > 20) {
        $contenu .= "<div class='erreur'>Le psudo doit contenir entre 1 et 20 caractéres. <br>
        Caractères aceptés: lettre de a à z et chiffres de 1 à 9.</div>";
    } else {
        $utilisateur = executeRequete("SELECT * FROM utilisateur WHERE pseudo='$_POST[pseudo]'");
        if ($utilisateur->num_rows > 0) {
            $contenu .= "<div class='erreur'>Pseudo déja pris</div>";
        } else {
            // $_POST['mdp'] = md5($_POST['mdp']);
            $_POST['mdp'] = password_hash($_POST['mdp'], PASSWORD_BCRYPT);
            foreach ($_POST as $indice => $valeur) {
                $_POST[$indice] = htmlspecialchars(addslashes($valeur));
            }
            executeRequete("INSERT INTO utilisateur (pseudo, mot_de_passe, nom, prenom, email, civilite, ville, code_postal, adresse) VALUES ('$_POST[pseudo]', '$_POST[mdp]', '$_POST[nom]', '$_POST[prenom]', '$_POST[email]', '$_POST[civilite]', '$_POST[ville]', '$_POST[code_postal]', '$_POST[adresse]')");
            $contenu .= "<div class='validation'>Vous êtes inscrit à notre site web. <a href=\"connexion.php\"><u>Cliquez ici pour vous connecter</u></a></div>";
        }
    }
}
?>
<?php require("./inc/haut.inc.php"); ?>
<!-- <h2>inscription</h2> -->

<?php echo $contenu ?>
<form method="post" action="">
    <label for="pseudo">Pseudo</label>
    <!-- <input type="text" id="pseudo" name="pseudo" placeholder="saisir votre pseudo" maxlength="20" minlength="5" required pattern="[a-zA-Z0-9-_.]{1, 20}" title="caractéres acceptés : lettre, chiffre, '. - _'"> -->
    <input type="text" id="pseudo" name="pseudo" placeholder="saisir votre pseudo" required pattern="[a-zA-Z0-9-_.]{1, 20}" title="caractéres acceptés : lettre, chiffre, '. - _'">

    <label for="mdp">Mot de passe</label>
    <input type="password" id="mdp" name="mdp" placeholder="Mot de passe" maxlength="20" required pattern="[a-zA-Z0-9-_.]{1, 20}" title="caractéres acceptés : lettre, chiffre, '. - _'">

    <label for="nom">Nom</label>
    <input type="text" id="nom" name="nom" placeholder="votre nom">

    <label for="prenom">Prénom</label>
    <input type="text" id="prenom" name="prenom" placeholder="votre prénom">

    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="exemple@gmail.com">

    <div class="civilite">
        <label for="civilite">Civilité</label><br>
        <input name="civilite" value="m" checked="" type="radio">Homme
        <input name="civilite" value="f" type="radio">Femme
    </div>

    <label for="ville">Ville</label>
    <input type="text" id="ville" name="ville" placeholder="votre ville" pattern="[a-zA-Z0-9-_.]{5,15}" title="caractères acceptés : a-zA-Z0-9-_.">

    <label for="cp">Code Postal</label>
    <input type="text" id="code_postal" name="code_postal" placeholder="code postal" pattern="[0-9]{5}" title="5 chiffres requis : 0-9">

    <label for="adresse">Adresse</label>
    <textarea id="adresse" name="adresse" placeholder="votre adresse" pattern="[a-zA-Z0-9-_.]{5,15}" title="caractères acceptés :  a-zA-Z0-9-_."></textarea>

    <input type="submit" name="inscription" value="S'inscrire">
</form>
<?php require("./inc/bas.inc.php"); ?>