<?php
class C_etudiant {
    public $CodeEtudiant;
    public $Nom;
    public $Prenom;
    public $Datenaissance;
    public $CodeClasse;
    public $NumInscription;
    public $Adresse;
    public $Mail;
    public $Tel;

    // Method to insert a new student
    function insertEtudiant($Nom, $Prenom, $Datenaissance, $Mail, $Tel, $Adresse, $NumInscription) {
        require_once('config.php');
        $mysqli = new mysqli(db_host, db_user, db_password, db_database);

        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        $stmt = $mysqli->prepare("INSERT INTO t_etudiant (Nom, Prenom, Datenaissance, Mail, Tel, Adresse, NumInscription) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die("Prepare failed: " . $mysqli->error);
        }

        $stmt->bind_param("sssssss", $Nom, $Prenom, $Datenaissance, $Mail, $Tel, $Adresse, $NumInscription);

        if ($stmt->execute()) {
            echo "Etudiant ajouté avec succès!";
        } else {
            echo "Erreur lors de l'ajout de l'étudiant: " . $stmt->error;
        }

        $stmt->close();
        $mysqli->close();
    }

    // Method to delete a student
    function deleteEtudiant($CodeEtudiant) {
        require_once('config.php');
        $mysqli = new mysqli(db_host, db_user, db_password, db_database);

        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        $stmt = $mysqli->prepare("DELETE FROM t_etudiant WHERE CodeEtudiant = ?");
        if ($stmt === false) {
            die("Prepare failed: " . $mysqli->error);
        }

        $stmt->bind_param("s", $CodeEtudiant);

        if ($stmt->execute()) {
            echo "Etudiant supprimé avec succès.";
        } else {
            echo "Erreur lors de la suppression de l'étudiant: " . $stmt->error;
        }

        $stmt->close();
        $mysqli->close();
    }

    // Method to list all students
    function listEtudiants() {
        require_once('config.php');
        $mysqli = new mysqli(db_host, db_user, db_password, db_database);

        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        $query = "SELECT * FROM t_etudiant";
        $result = $mysqli->query($query);

        $etudiants = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $etudiants[] = $row;
            }
        }

        $mysqli->close();
        return $etudiants;
    }

    // Method to update a student
    function modifEtudiant($CodeEtudiant, $Nom, $Prenom, $Datenaissance, $Mail, $Tel, $Adresse, $NumInscription) {
        require_once('config.php');
        $mysqli = new mysqli(db_host, db_user, db_password, db_database);

        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        $stmt = $mysqli->prepare("UPDATE t_etudiant SET Nom = ?, Prenom = ?, Datenaissance = ?, Mail = ?, Tel = ?, Adresse = ?, NumInscription = ? WHERE CodeEtudiant = ?");
        if ($stmt === false) {
            die("Prepare failed: " . $mysqli->error);
        }

        $stmt->bind_param("ssssssss", $Nom, $Prenom, $Datenaissance, $Mail, $Tel, $Adresse, $NumInscription, $CodeEtudiant);

        if ($stmt->execute()) {
            echo "Etudiant mis à jour avec succès.";
        } else {
            echo "Erreur lors de la mise à jour: " . $stmt->error;
        }

        $stmt->close();
        $mysqli->close();
    }
}
?>
    