<?php
class C_matiere{
    public $CodeMatiere;
    public $NomMatiere;
    public $NbreHeureCoursParSemaine;
    public $NbreHeureTDParSemaine;
    public $NbreHeureTPParSemaine;

    function insertMatiere($CodeMatiere, $NomMatiere, $NbreHeureCoursParSemaine, $NbreHeureTDParSemaine, $NbreHeureTPParSemaine) {
        require_once('config.php');
        $mysqli=new mysqli(db_host,db_user,db_password,db_database);
        $req = 'INSERT INTO `t_matiere` (codematiere,nommatiere, nbrheurecoursparsemaine, nbrheuretdparsemaine, nbrheuretpparsemaine) VALUES (' . "'" . $this->$CodeMatiere . "'," . "'" . $this->$NomMatiere . "'," . "'" . $this->$NbreHeureCoursParSemaine . "'," . "'" . $this->$NbreHeureTDParSemaine . "'," . "'" . $this->$NbreHeureTPParSemaine . "')"; 
        $mysqli->query($req);
        if ($mysqli->query($req)) {
            echo "Matiere ajouté avec succès !";
        } else {
            echo "Erreur lors de l'ajout du matiere : " . $mysqli->error;
        }
        $mysqli->close();
    }
    
    function deleteMatiere()
    {
    require_once('config.php');
    $mysqli=new mysqli(db_host,db_user,db_password,db_database);
    $req = "DELETE FROM `t_matiere` WHERE CodeMatiere = '" . $this->$mysqli->real_escape_string($CodeMatiere) . "'";
    $mysqli->query($req);
    if ($mysqli->query($req)) {
        echo "Matiere supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression du matiere : " . $mysqli->error;
    }
    $mysqli->close();
    }
    
    function listMatiere()
    {
    require_once('config.php');
    $mysqli=new mysqli(db_host,db_user,db_password,db_database);
    $query='SELECT * FROM `t_matiere` ';
    $result=$mysqli->query($query);
    return $result;
    $mysqli->close();
    }
    
    function modifEnseignant()
    {
    require_once('config.php');
    $mysqli=new mysqli(db_host,db_user,db_password,db_database);
    $req = "UPDATE `t_matiere` SET NomMatiere= '" . $this->$mysqli->real_escape_string($NomMatiere) . "', NbreHeureCoursParSemaine = '" . $this->$mysqli->real_escape_string($NbreHeureCoursParSemaine) . "', NbreHeureTDParSemaine= '" .$this-> $mysqli->real_escape_string($NbreHeureTDParSemaine) . "', NbreHeureTPParSemaine = '" .$this-> $mysqli->real_escape_string($NbreHeureTPParSemaine) .  "' WHERE CodeMatiere = '" .$this-> $mysqli->real_escape_string($CodeMatiere) . "'";
    $mysqli->query($query);
    if ($mysqli->query($req)) {
        echo "Matiere mis à jour avec succès.";
    } 
    else {
        echo "Erreur : " . $mysqli->error;
    }
    $mysqli->close();
    }
}
?>