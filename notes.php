<?php
    $serveur = "lakartxela.iutbayonne.univ-pau.fr";
    $dbname = "rvache001_bd";
    $user = "rvache001_bd";
    $pass = "rvache001_bd";

    $pseudo = $_POST["pseudo"];
    $pays = $_POST["pays"];
    $commentaire = $_POST["commentaire"];
    $tempsSejour = $_POST["tempsSejour"];
    $note = $_POST["note"];

    try{
        //On se connecte à la BDD
        $dbco = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //On insère les données reçues
        $sth = $dbco->prepare('
            INSERT INTO ApiWebService(Pseudo, Pays, Commentaire, TempsSejour, Note)
            VALUES(:pseudo, :pays, :commentaire, :tempsSejour, :note)');
        $sth->bindParam(':pseudo',$pseudo);
        $sth->bindParam(':pays',$pays);
        $sth->bindParam(':commentaire',$commentaire);
        $sth->bindParam(':tempsSejour',$tempsSejour);
        $sth->bindParam(':note',$note);
        $sth->execute();

        //On renvoie l'utilisateur vers la page de remerciement
        header("Location:form-merci.html");
    }
    catch(PDOException $e){
        echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
    }
?>
