<?php
$conn = new mysqli('localhost', 'username', 'password', 'TP10');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['titre'])) {
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $date = $_POST['date_creation'];
    
    $stmt = $conn->prepare("INSERT INTO exercice (titre, auteur, date_creation) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $titre, $auteur, $date);
    
    if ($stmt->execute()) {
        $message = "L'exercice a été ajouté avec succès";
    } else {
        $message = "Erreur lors de l'ajout";
    }
    $stmt->close();
}


$result = $conn->query("SELECT * FROM exercice");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestion des exercices</title>
</head>
<body>
    <?php if (isset($message)) echo "<p>$message</p>"; ?>
    
    <h2>Ajouter un exercice</h2>
    <form method="post">
        Titre: <input type="text" name="titre" required><br>
        Auteur: <input type="text" name="auteur" required><br>
        Date création: <input type="date" name="date_creation" required><br>
        <input type="submit" value="Ajouter">
    </form>
    
    <h2>Liste des exercices</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['titre']; ?></td>
            <td><?php echo $row['auteur']; ?></td>
            <td><?php echo $row['date_creation']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $row['id']; ?>">Modifier</a>
                <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Êtes-vous sûr?')">Supprimer</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
<?php $conn->close(); ?>