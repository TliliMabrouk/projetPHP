<?php 
class C_enseignant{
    public $CodeEnseignant;
    public $Nom;
    public $Prenom;
    public $DateRecrutement;
    public $Adresse;
    public $Mail;
    public $Tel;
    public $CodeDepartement;
    public $CodeGrade;

function insertEnseignant($CodeEnseignant,$Nom, $Prenom, $DateRecrutement, $Mail, $Tel, $Adresse) {
    require_once('config.php');
    $mysqli=new mysqli(db_host,db_user,db_password,db_database);
    $req = 'INSERT INTO `t_enseignant` (CodeEnseignant, Nom, Prenom, DateRecrutement, Mail, Tel, Adresse) VALUES (' . "'" . $this->$CodeEnseignant . "'," . "'" . $this->$Nom . "'," . "'" . $this->$Prenom . "'," . "'" . $this->$DateRecrutement . "'," . "'" . $this->$Mail . "'," . "'" .$this-> $Tel . "'," . "'" . $this->$Adresse . "')"; 
    $mysqli->query($req);
    if ($mysqli->query($req)) {
        echo "Enseignant ajouté avec succès !";
    } else {
        echo "Erreur lors de l'ajout de l'enseignant : " . $mysqli->error;
    }
    $mysqli->close();
}

function deleteEnseignant()
{
require_once('config.php');
$mysqli=new mysqli(db_host,db_user,db_password,db_database);
$req = "DELETE FROM `t_enseignant` WHERE CodeEnseignant = '" . $this->$mysqli->real_escape_string($CodeEnseignant) . "'";
$mysqli->query($req);
if ($mysqli->query($req)) {
    echo "Enseignant supprimé avec succès.";
} else {
    echo "Erreur lors de la suppression de l'enseignant : " . $mysqli->error;
}
$mysqli->close();
}

function listEnseignant()
{
require_once('config.php');
$mysqli=new mysqli(db_host,db_user,db_password,db_database);
$query='SELECT * FROM `t_enseignant` ';
$result=$mysqli->query($query);
return $result;
$mysqli->close();
}

function modifEnseignant()
{
require_once('config.php');
$mysqli=new mysqli(db_host,db_user,db_password,db_database);
$req = "UPDATE `t_enseignant` SET Nom = '" . $this->$mysqli->real_escape_string($Nom) . "', Prenom = '" . $this->$mysqli->real_escape_string($Prenom) . "', DateRecrutement = '" .$this-> $mysqli->real_escape_string($DateRecrutement) . "', Mail = '" .$this-> $mysqli->real_escape_string($Mail) . "', Tel = '" .$this-> $mysqli->real_escape_string($Tel) . "', Adresse = '" . $this->$mysqli->real_escape_string($Adresse) . "' WHERE CodeEnseignant = '" .$this-> $mysqli->real_escape_string($CodeEnseignant) . "'";
$mysqli->query($query);
if ($mysqli->query($req)) {
    echo "Enseignant mis à jour avec succès.";
} 
else {
    echo "Erreur : " . $mysqli->error;
}
$mysqli->close();
}
}
?>