<?php
require_once 'views/layouts/db.php';

$email = 'admin@viacesi.fr';
$mot_de_passe_clair = 'admin123';
// On crypte le mot de passe (hachage sécurisé)
$mot_de_passe_crypte = password_hash($mot_de_passe_clair, PASSWORD_DEFAULT);

try {
    // On insère l'utilisateur avec le rôle 1 (Administrateur)
    $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, id_role) VALUES ('Dupont', 'Jean', ?, ?, 1)");
    $stmt->execute([$email, $mot_de_passe_crypte]);
    echo "<h2 style='color:green;'>✅ Compte Admin créé avec succès !</h2>";
    echo "<p>Email : <b>$email</b></p>";
    echo "<p>Mot de passe : <b>$mot_de_passe_clair</b></p>";
    echo "<a href='login.php'>Aller à la page de connexion</a>";
} catch (PDOException $e) {
    echo "Erreur (le compte existe peut-être déjà) : " . $e->getMessage();
}
?>
