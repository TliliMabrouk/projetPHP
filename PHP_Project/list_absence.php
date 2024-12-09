<?php
// Connexion à la base de données
try {
    $conn = new PDO('mysql:host=localhost;dbname=sysgestionabs', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Gestion de la soumission du formulaire pour la recherche d'absences
$absences = [];
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['date_debut'], $_GET['date_fin'], $_GET['classe'], $_GET['nom_etudiant'], $_GET['prenom_etudiant'])) {
    $dateDebut = $_GET['date_debut'];
    $dateFin = $_GET['date_fin'];
    $classe = $_GET['classe'];
    $nomEtudiant = $_GET['nom_etudiant'];
    $prenomEtudiant = $_GET['prenom_etudiant'];

    try {
        $stmt = $conn->prepare("
            SELECT E.Nom, E.Prenom, M.NomMatiere, COUNT(*) AS NombreAbsences
            FROM t_ligneficheabsence LFA
            JOIN t_ficheabsence FA ON LFA.CodeFicheAbsence = FA.CodeFicheAbsence
            JOIN t_matiere M ON FA.CodeMatiere = M.CodeMatiere
            JOIN t_etudiant E ON LFA.CodeEtudiant = E.CodeEtudiant
            JOIN t_classe C ON E.CodeClasse = C.CodeClasse
            WHERE E.Nom LIKE :nom
              AND E.Prenom LIKE :prenom
              AND FA.DateJour BETWEEN :dateDebut AND :dateFin
              AND C.CodeClasse = :classe
            GROUP BY E.Nom, E.Prenom, M.NomMatiere
        ");
        $stmt->execute([
            ':nom' => "%$nomEtudiant%",
            ':prenom' => "%$prenomEtudiant%",
            ':dateDebut' => $dateDebut,
            ':dateFin' => $dateFin,
            ':classe' => $classe
        ]);
        $absences = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération des absences : " . $e->getMessage();
    }
}

// Récupération des classes pour remplir la liste déroulante
$classes = [];
try {
    $stmt = $conn->query("SELECT CodeClasse, NomClasse FROM t_classe");
    $classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur lors de la récupération des classes : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des absences</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Rechercher les absences</h1>
        <form action="list_absence.php" method="GET" class="mb-4">
            <div class="mb-3">
                <label for="date_debut" class="form-label">Date de début:</label>
                <input type="date" id="date_debut" name="date_debut" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="date_fin" class="form-label">Date de fin:</label>
                <input type="date" id="date_fin" name="date_fin" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="classe" class="form-label">Classe:</label>
                <select id="classe" name="classe" class="form-select" required>
                    <option value="">Sélectionnez une classe</option>
                    <?php foreach ($classes as $class): ?>
                        <option value="<?= htmlspecialchars($class['CodeClasse']) ?>">
                            <?= htmlspecialchars($class['NomClasse']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="nom_etudiant" class="form-label">Nom de l'étudiant:</label>
                <input type="text" id="nom_etudiant" name="nom_etudiant" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="prenom_etudiant" class="form-label">Prénom de l'étudiant:</label>
                <input type="text" id="prenom_etudiant" name="prenom_etudiant" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>

        <?php if (!empty($absences)): ?>
            <h2 class="mt-4">Résultats des absences</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nom de l'étudiant</th>
                        <th>Prénom de l'étudiant</th>
                        <th>Matière</th>
                        <th>Nombre d'absences</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($absences as $absence): ?>
                        <tr>
                            <td><?= htmlspecialchars($absence['Nom']) ?></td>
                            <td><?= htmlspecialchars($absence['Prenom']) ?></td>
                            <td><?= htmlspecialchars($absence['NomMatiere']) ?></td>
                            <td><?= htmlspecialchars($absence['NombreAbsences']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php elseif ($_SERVER['REQUEST_METHOD'] === 'GET'): ?>
            <p>Aucune absence trouvée pour les critères spécifiés.</p>
        <?php endif; ?>
    </div>
</body>
</html>
