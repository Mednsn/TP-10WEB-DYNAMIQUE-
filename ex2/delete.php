<?php
$conn = new mysqli('localhost', 'username', 'password', 'TP10');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $stmt = $conn->prepare("DELETE FROM exercice WHERE id=?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header('Location: index.php?message=L\'exercice a été supprimé avec succès');
    } else {
        echo "Erreur lors de la suppression";
    }
    $stmt->close();
}

$conn->close();
?>