<?php
$serveur = "lakartxela.iutbayonne.univ-pau.fr";
$dbname = "rvache001_bd";
$user = "rvache001_bd";
$pass = "rvache001_bd";

try{
  //On se connecte à la BDD
  $dbco = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
  $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  if (isset($_GET["pays"])){
    $monTableauToutBeau = array();
    $req = "SELECT * FROM `ApiWebService` WHERE Pays='".$_GET["pays"]."'";
    foreach  ($dbco->query($req) as $row) {
      $monTableauToutBeau[]= array("Pseudo"=>$row['Pseudo'],"Pays"=>$row['Pays'],"Commentaire"=>$row['Commentaire'],"TempsSejour"=>$row['TempsSejour'],
      "Note"=>$row['Note']);
  }
}

elseif (isset($_GET["note"])){
  $monTableauToutBeau = array();
  $req = "SELECT * FROM `ApiWebService` WHERE Note='".$_GET["note"]."'";
  foreach  ($dbco->query($req) as $row) {
    $monTableauToutBeau[]= array("Pseudo"=>$row['Pseudo'],"Pays"=>$row['Pays'],"Commentaire"=>$row['Commentaire'],"TempsSejour"=>$row['TempsSejour'],
    "Note"=>$row['Note']);
}
}

elseif (isset($_GET["tempsSejour"])){
  $monTableauToutBeau = array();
  $req = "SELECT * FROM `ApiWebService` WHERE TempsSejour='".$_GET["tempsSejour"]."'";
  foreach  ($dbco->query($req) as $row) {
    $monTableauToutBeau[]= array("Pseudo"=>$row['Pseudo'],"Pays"=>$row['Pays'],"Commentaire"=>$row['Commentaire'],"TempsSejour"=>$row['TempsSejour'],
    "Note"=>$row['Note']);
}
}

  else {
  $monTableauToutBeau = array();
  $req = "SELECT * FROM `ApiWebService`";
  foreach  ($dbco->query($req) as $row) {
    $monTableauToutBeau[]= array("Pseudo"=>$row['Pseudo'],"Pays"=>$row['Pays'],"Commentaire"=>$row['Commentaire'],"TempsSejour"=>$row['TempsSejour'],
    "Note"=>$row['Note']);
  }
}
  if (empty($monTableauToutBeau)){
      echo json_encode("Aucun commentaire trouve pour cette recherche");
  }
  else {
  echo json_encode($monTableauToutBeau);
}
}

catch(PDOException $e){
  echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
}


?>
