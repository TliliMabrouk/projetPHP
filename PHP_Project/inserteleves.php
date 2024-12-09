<?php
require_once('etudiant.php');

// Create an instance of the C_etudiant class
$etudiant = new C_etudiant();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Nom = $_POST['Nom'];
    $Prenom = $_POST['Prenom'];
    $Datenaissance = $_POST['Datenaissance'];
    $Mail = $_POST['Mail'];
    $Tel = $_POST['Tel'];
    $Adresse = $_POST['Adresse'];
    $NumInscription = $_POST['NumInscription'];

    // Call the method to insert the student
    $etudiant->insertEtudiant($Nom, $Prenom, $Datenaissance, $Mail, $Tel, $Adresse, $NumInscription);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ajouter un Étudiant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Ajouter un Étudiant</h2>

    <form method="POST">
        <div class="mb-3">
            <label for="Nom" class="form-label">Nom:</label>
            <input type="text" name="Nom" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="Prenom" class="form-label">Prénom:</label>
            <input type="text" name="Prenom" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="Datenaissance" class="form-label">Date de Naissance:</label>
            <input type="date" name="Datenaissance" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="Mail" class="form-label">Email:</label>
            <input type="email" name="Mail" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="Tel" class="form-label">Téléphone:</label>
            <input type="text" name="Tel" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="Adresse" class="form-label">Adresse:</label>
            <input type="text" name="Adresse" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="NumInscription" class="form-label">Numéro d'Inscription:</label>
            <input type="text" name="NumInscription" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Ajouter</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
