<?php
/**
 * Created by PhpStorm.
 * User: Antoine
 * Date: 20/11/2018
 * Time: 21:52
 */
$_SESSION["id"] = 1;
$_SESSION["login"] = "gilles";

if(!isset($_SESSION["id"])) {
    // On n est pas connecté, il faut retourner à la pgae de login
    header("Location:index.php?action=login");
}
// Verifions si on est amis avec cette personne
$sql = "SELECT * FROM user WHERE id IN ( SELECT user.id FROM user INNER JOIN lien ON idUtilisateur1=user.id AND etat='ami' AND idUtilisateur2=? UNION SELECT user.id FROM user INNER JOIN lien ON idUtilisateur2=user.id AND etat='ami' AND idUtilisateur1=?)";
$sql2 = "SELECT * FROM user WHERE id IN ( SELECT user.id FROM user INNER JOIN lien ON idUtilisateur1=user.id AND etat='attente' AND idUtilisateur2=?)";
/*$sql2 = "SELECT user.* FROM user WHERE id IN (SELECT idUtilisateur1 FROM lien WHERE idUtilisateur2=? AND etat='attente' ";*/

// Etape 1  : preparation
$query = $pdo->prepare($sql);
$query2 = $pdo->prepare($sql2);

// Etape 2 : execution : 2 paramètres dans la requêtes !!
$query->execute(array($_SESSION['id'],$_SESSION['id']));
$query2->execute(array($_SESSION['id']));

// Etape 3 SQL :
echo "<div class='wrapper'>"; /*wrapper*/

while($line2 = $query2->fetch()) {
    //Affichage
    echo "<div class='friend margin anim'>";
    echo "<div class='img_article'></div>";
    echo "<a class='nomPersonne' href='index.php?action=mur&id=". $line2["id"] ."'>".$line2["login"]."</a>";
    echo "<br/><div class='etat'>En attente</div>";
    echo "<form method='POST' action='index.php?action=delFriend' >";
    echo "<input type='submit' name='delFriend' value='Refuser'></form>";
    echo "<form method='POST' action='index.php?action=addFriend' >";
    echo"<input type='submit' name='acceptFriend' value='Accepter'></form>";
    echo "</div>";
}


while($line = $query->fetch()) {
    //Affichage
    echo " <div class='friend margin anim'> ";
    echo "  <div class='img_article'></div>";
    echo "<a class='nomPersonne' href='index.php?action=mur&id". $line["id"] ."'>".$line["login"]."</a>";
    echo "<a class='profil_amis' href='index.php?action=mur&id". $line["id"] ."'>Voir le profil</a>";
    echo "<form method='POST' action='index.php?action=delFriend' >";
    echo " <input type=\"submit\" name=\"delFriend\" value=\"Supprimer l'ami\"></form>";
    echo "</div>";
}
echo "</div>"; /*Fin wrapper*/


?>


