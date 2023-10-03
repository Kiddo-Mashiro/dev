<p>Un mail de confirmation à été envoyé sur votre mail ci-dessous.</p>
<?php

echo "<h3>Ton nom est : </h3>";
$nom=$_POST['nom']; echo $nom;
echo "<h3>Ton Prénom est : </h3>";
$prenom=$_POST['prenom']; echo $prenom;
echo "<h3>Ton Mail est : </h3>";
$mail=$_POST['mail']; echo $mail;
echo "<h3>Vous êtes : </h3>";
$nb_personne=$_POST['nb_personne']; echo $nb_personne;
echo "<h3>Vous venez : </h3>";
$jour=$_POST['jour']; echo $jour;
echo "<h3>Vous êtes nouveau ? : </h3>";
$new=$_POST['new']; echo $new;echo"<br><br>";
if ($new=='oui')echo"Bienvenue $prenom ravie de faire ta connaissance !";
else echo"Re - Bonjour ",$prenom;echo"<br><br>";
$menu=$_POST['menu']; echo"<h3>Vous avez choisi :</h3> $menu.";
$prix = 0; 
    if ($menu=='Sandwich chaud + Boisson')$prix=10;
    elseif ($menu=='Sandwich froid + Boisson')$prix=12;
    else $prix=11;
    $total=$prix*$nb_personne;
    echo $total;
    
?>
