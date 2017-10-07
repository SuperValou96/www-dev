<?php
//connexion à la base de donnée
try{
    $bdd = new PDO('mysql:host=localhost;dbname=bde;charset=utf8', 'bde', 'Dd1&aa1&hob1cjp');
}
catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
}

//identification via le CAS
require_once("CAS.php");

// -------------------------------- CASIFICATION de l'application --------------------------------
phpCAS::setDebug();
phpCAS::client(CAS_VERSION_2_0, "cas.emse.fr", 443, "");
phpCAS::setNoCasServerValidation();
phpCAS::forceAuthentication();
// -------------------------------- CASIFICATION de l'application --------------------------------



// Connexion a la BDD via l'id du CAS
if (!isset($_SESSION["id"]))
{
	$req = $bdd -> prepare("SELECT id_user, droit_user FROM user WHERE login_user=?");
	$req -> execute(array($_SESSION['phpCAS']['user']));
	$donnees = $req -> fetch();
    
    
	if(isset($donnees["id_user"]) AND $donnees["droit_user"]!="aucun")
	{
		
		$rep = $bdd->prepare('UPDATE user SET prenom=:prenom, nom=:nom WHERE id_user=:ID');
        $rep->execute(array(
            'ID' => $donnees["id_user"],
            'prenom' => $_SESSION['phpCAS']['attributes']["givenName"],
            'nom' => $_SESSION['phpCAS']['attributes']["sn"]
            ));

		$_SESSION["id"]=$donnees["id_user"];
		$est_dans_la_base = true;
		
		//On vérifie si l'utilisateur est un administrateur
		$req = $bdd -> prepare("SELECT id_admin FROM admin WHERE id_user=?");
	    $req -> execute(array($donnees["id_user"]));
	    $donnees2 = $req -> fetch();
		
		
		if($donnees2){
			$_SESSION["id_admin"]=$donnees2["id_admin"];
			
			//On vérifie si l'administrateur est un super administrateur
			$req = $bdd -> prepare("SELECT id_super_admin FROM super_admin WHERE id_admin=?");
	        $req -> execute(array($donnees2["id_admin"]));
	        $donnees3 = $req -> fetch();
									
			if($donnees3){
			$_SESSION["id_super_admin"]=$donnees3["id_super_admin"];
			}
		}else{
		
			//On vérifie si l'administrateur est un administrateur temporaire
			$req = $bdd -> prepare("SELECT id_admin_tempo FROM admin_tempo WHERE dbt<NOW() AND fin>NOW() AND id_user=?");
	        $req -> execute(array($donnees["id_user"]));
	        $donnees4 = $req -> fetch();
            
			if($donnees4){
			$_SESSION["id_admin_tempo"]=$donnees4["id_admin_tempo"];
			}
		
		}
	}else{
		$erreur="Connexion impossible";
	}
}