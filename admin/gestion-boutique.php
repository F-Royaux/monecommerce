<?php require("../inc/init.inc.php"); ?>
<?php
if(!userIsAdmin()){
    header ("location: ../connexion.php");
    exit();
}
if ($_POST) {
}
?>
<?php require("../inc/haut.inc.php"); ?>
<h2>Formulaire</h2>


<form method="post" action="" enctype="multipart/form-data">
    <label for="reference">reference</label>
    <input type="text" id="reference" name="reference" placeholder="réference du produit">
    <button>Enregistrer le produit</button>
</form>
<?php require("../inc/bas.inc.php"); ?>