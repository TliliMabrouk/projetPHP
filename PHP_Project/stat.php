<?php
class C_Stat {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Liste des absences d'un étudiant pour une matière donnée entre deux dates
    public function Liste_absence_etudient_parMatière($code_etudiant, $code_matiere, $date_D, $date_F) {
        $sql = "
            SELECT E.Nom AS NomEtudiant, E.Prenom AS PrenomEtudiant, M.NomMatiere, FA.DateJour, LFA.DateSeance, EN.Nom AS NomEnseignant
            FROM t_ligneficheabsence LFA
            JOIN t_ficheabsence FA ON LFA.CodeFicheAbsence = FA.CodeFicheAbsence
            JOIN t_matiere M ON FA.CodeMatiere = M.CodeMatiere
            JOIN t_etudiant E ON FA.CodeEtudiant = E.CodeEtudiant
            JOIN t_enseignant EN ON FA.CodeEnseignant = EN.CodeEnseignant
            WHERE E.CodeEtudiant = :code_etudiant
            AND M.CodeMatiere = :code_matiere
            AND FA.DateJour BETWEEN :date_D AND :date_F
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':code_etudiant' => $code_etudiant,
            ':code_matiere' => $code_matiere,
            ':date_D' => $date_D,
            ':date_F' => $date_F
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Liste des absences par matière d'un étudiant
    public function Liste_absence_etudient($nom_etudiant, $prenom_etudiant, $date_D, $date_F, $nom_classe) {
        $sql = "
            SELECT M.NomMatiere, COUNT(*) AS NombreAbsences
            FROM t_ligneficheabsence LFA
            JOIN t_ficheabsence FA ON LFA.CodeFicheAbsence = FA.CodeFicheAbsence
            JOIN t_matiere M ON FA.CodeMatiere = M.CodeMatiere
            JOIN t_etudiant E ON LFA.CodeEtudiant = E.CodeEtudiant
            JOIN t_classe C ON E.CodeClasse = C.CodeClasse
            WHERE E.Nom = :nom_etudiant
            AND E.Prenom = :prenom_etudiant
            AND FA.DateJour BETWEEN :date_D AND :date_F
            AND C.NomClasse = :nom_classe
            GROUP BY M.NomMatiere
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':nom_etudiant' => $nom_etudiant,
            ':prenom_etudiant' => $prenom_etudiant,
            ':date_D' => $date_D,
            ':date_F' => $date_F,
            ':nom_classe' => $nom_classe
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>