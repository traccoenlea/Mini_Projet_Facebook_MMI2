<?php if(isset($_POST["login"]) && isset($_POST['password'])) {
$sql = "SELECT * FROM utilisateur WHERE login=? AND mdp=PASSWORD(?)";

// Etape 1  : preparation
$connexion = $pdo->prepare($sql);

// Etape 2 : execution : 2 paramètres dans la requêtes !!

$connexion->execute(array($_POST["login"], $_POST['password']));
// Etape 3 : ici le login est unique, donc on sait que l'on peut avoir zero ou une  seule ligne.

// un seul fetch
$line = $connexion->fetch();

// Si $line est faux le couple login mdp est mauvais, on retourne au formulaire
if($line == false)
header("Location: login.php");
else {
$_SESSION['id'] = $line['id'];
$_SESSION['login'] = $line['login'];
header("Location: index.php");
// sinon on crée les variables de session $_SESSION['id'] et $_SESSION['login'] et on va à la page d'accueil

}
}
?>