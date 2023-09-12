<?php require("../inc/init.inc.php"); ?>
<?php
if (!userIsAdmin()) {
    header("location: ../connexion.php");
    exit();
}
// var_dump($_POST);
if (!empty($_POST)) {
    $photo_bdd = "";
    if (!empty($_FILES['photo']['name'])) {
        $nom_photo = $_POST['reference'] . '_' . $_FILES['photo']['name'];
        $photo_bdd = "public/img/$nom_photo";
        $photo_dossier = "../public/img/$nom_photo";
        copy($_FILES['photo']['tmp_name'], $photo_dossier);
    }
    foreach ($_POST as $indice => $value) {
        $_POST[$indice] = htmlentities(addslashes($value));
    }
    // var_dump($_POST);
    // echo "\n";
    // print_r($_FILES);
    executeRequete("INSERT INTO monecommerce.produit 
    (reference, categorie, titre, description, couleur, taille, public, photo, prix, stock) 
    VALUES('$_POST[reference]', '$_POST[categories]', '$_POST[titre]', '$_POST[description]', '$_POST[couleur]', '$_POST[taille]', '$_POST[public]', '$photo_bdd' , '$_POST[prix]', '$_POST[stock]')");
    $contenu .= '<div class="validation">Produit enregistré</div>';
}
// liens Produits
$contenu .= '<a href="?action=affichage">Affichage produit</a>';
$contenu .= '<a href="?action=ajout">Ajout produit</a>';
// Affichage des Produits
if (isset($_GET['action']) && $_GET['action'] == "affichage") {
    $resultat = executeRequete("SELECT * FROM produit");
    $contenu .= '<h2>Affichage des produits</h2>';
    $contenu .= 'Nombre de produits disponibles:' . $resultat->num_rows;
    $contenu .= '<table border="2"><tr>';
    while ($colonne = $resultat->fetch_field()) {
        $contenu .= '<th>' . $colonne->name . '</th>';
    }
    $contenu .= '<th>Modification</th>';
    $contenu .= '<th>Suppression</th>';
    $contenu .= '</tr>';
    while ($ligne = $resultat->fetch_assoc()) {
        foreach ($ligne as $indice => $information) {
            if ($indice == "photo") {
                $contenu .= '<td><img src="' . RACINE_SITE . $information . '" height = "70"></td>';
            } else {
                $contenu .= '<td>' . $information . '</td>';
            }
        }
        $contenu .= '<td><a href="?action=modification&id_produit=' . $ligne['id_produit'] .
            '"><img src="../inc/assets/icons/edit.png"></a></td>';
        $contenu .= '<td><a href="?action=supression&id_produit=' . $ligne['id_produit'] .
            '" OnClick="return(confirm(\'En êtes vous certain?\'))"><img src="../inc/assets/icons/delete.png"></a></td>';
        $contenu .= '</tr>';
    }
    $contenu .= '</table>';
}

?>
<?php require("../inc/haut.inc.php"); ?>
<?php echo $contenu ?>
<?php
// if (isset($_GET['action']) && $_GET['action'] == "affichage"){
//     echo $contenu;
// }
if (isset($_GET['action']) && $_GET['action'] == "ajout") {
    echo '
<h2>Formulaire</h2>


<form method="post" action="" enctype="multipart/form-data">
    <label for="reference">reference</label>
    <input type="text" id="reference" name="reference" placeholder="réference du produit">

    <label for="categorie">categorie</label>
    <input type="text" id="categorie" name="categories" placeholder="categorie du produit">

    <label for="titre">titre</label>
    <input type="text" id="titre" name="titre" placeholder="titre du produit">

    <label for="description">description</label>
    <textarea type="text" id="description" name="description" placeholder="description du produit"></textarea>

    <label for="couleur">couleur</label>
    <input type="text" id="couleur" name="couleur" placeholder="couleur du produit">

    <label for="taille">taille</label>
    <select name="taille" id="taille">
        <option value="S">S</option>
        <option value="M">M</option>
        <option value="L">L</option>
        <option value="XL">XL</option>
    </select>
    <div>
        <label for="public">public</label><br>
        <input type="radio" name="public" id="publicM" value="m" checked>Homme
        <input type="radio" name="public" id="publicF" value="f">Femme
    </div>

    <label for="photo">Photo</label>
    <input type="file" id="photo" name="photo">

    <label for="prix">Prix</label>
    <input type="text" id="prix" name="prix" placeholder="Le prix du produit">
    <label for="stock">Stock</label>
    <input type="text" id="stock" name="stock" placeholder="Le stock du produit">
    <button>Enregistrer le produit</button>
</form>';
}
?>
<?php require("../inc/bas.inc.php"); ?>