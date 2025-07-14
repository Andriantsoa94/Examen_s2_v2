<?php
include "../include/fonction.php";
session_start();

if (!isset($_SESSION['IdUtilisateur'])) {
    header("location:index.php");
    exit();
}

$categorie_filter = isset($_GET['categorie']) ? $_GET['categorie'] : null;

$objets = get_objets_vue($categorie_filter);

$categories = get_categories();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <title>Liste des Objets</title>
</head>
<body>
    <?php include "../include/header.php"; ?>
    
    <div class="container mt-4">
        <h1>Liste des Objets</h1>
        
        <div class="mb-3">
            <form method="GET" class="d-flex align-items-center">
                <label for="categorie" class="me-2">Filtrer par catégorie:</label>
                <select name="categorie" class="form-select me-2" style="width: auto;">
                    <option value="">Toutes les catégories</option>
                    <?php while ($cat = mysqli_fetch_assoc($categories)) { ?>
                        <option value="<?php echo $cat['id']; ?>" 
                                <?php echo ($categorie_filter == $cat['id']) ? 'selected' : ''; ?>>
                            <?php echo $cat['nom']; ?>
                        </option>
                    <?php } ?>
                </select>
                <button type="submit" class="btn btn-primary">Filtrer</button>
                <a href="accueil.php" class="btn btn-secondary ms-2">Réinitialiser</a>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Categorie</th>
                        <th>Proprietaire</th>
                        <th>Statut</th>
                        <th>Emprunte par</th>
                        <th>Date de retour prevue</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($objet = mysqli_fetch_assoc($objets)) { ?>
                        <tr>
                            <td>
                                <a href="fiche_objet.php?id=<?php echo $objet['id']; ?>">
                                    <?php echo htmlspecialchars($objet['nom_objet']); ?>
                                </a>
                            </td>
                            <td><?php echo $objet['nom_categorie']; ?></td>
                            <td><?php echo $objet['proprietaire_nom']; ?></td>
                            <td>
                                <?php if ($objet['statut_emprunt'] == 'Emprunte') { ?>
                                    <span class="badge bg-warning">Emprunte</span>
                                <?php } else { ?>
                                    <span class="badge bg-success">Disponible</span>
                                <?php } ?>
                            </td>
                            <td>
                                <?php echo $objet['emprunteur_nom'] ? $objet['emprunteur_nom'] : '-'; ?>
                            </td>
                            <td>
                                <?php
                                if ($objet['date_retour_prevue']) {
                                    $date = new DateTime($objet['date_retour_prevue']);
                                    $today = new DateTime();
                                    $late = $date < $today;
                                    $class = $late ? 'text-danger fw-bold' : 'text-primary';
                                    echo '<span class="' . $class . '">' . $date->format('d/m/Y') . '</span>';
                                    if ($late) echo ' <small class="text-danger">(En retard)</small>';
                                } else {
                                    echo '-';
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>