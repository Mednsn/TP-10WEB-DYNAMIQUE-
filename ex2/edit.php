<?php
$conn = new mysqli('localhost', 'username', 'password', 'TP10');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $titre = $_POST['titre'];
        $auteur = $_POST['auteur'];
        $date = $_POST['date_creation'];
        
        $stmt = $conn->prepare("UPDATE exercice SET titre=?, auteur=?, date_creation=? WHERE id=?");
        $stmt->bind_param("sssi", $titre, $auteur, $date, $id);
        
        if ($stmt->execute()) {
            header('Location: index.php?message=L\'exercice a été mis à jour avec succès');
        } else {
            echo "Erreur lors de la mise à jour";
        }
        $stmt->close();
    }
    
    $result = $conn->query("SELECT * FROM exercice WHERE id=$id");
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier un exercice</title>
</head>
<body>
    <h2>Modifier un exercice</h2>
    <form method="post">
        Titre: <input type="text" name="titre" value="<?php echo $row['titre']; ?>" required><br>
        Auteur: <input type="text" name="auteur" value="<?php echo $row['auteur']; ?>" required><br>
        Date création: <input type="date" name="date_creation" value="<?php echo $row['date_creation']; ?>" required><br>
        <input type="submit" value="Modifier">
    </form>
    <a href="index.php">Retour à la liste</a>
</body>
</html>
<?php $conn->close(); ?>