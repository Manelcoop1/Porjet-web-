<?php
// 1. Démarrer la session TOUJOURS tout en haut du fichier
session_start();
require_once 'config/db.php';

$erreur = ''; // Variable pour stocker les messages d'erreur

// 2. Si le formulaire a été soumis (clic sur le bouton)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // 3. On cherche l'utilisateur dans la base de données
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // 4. On vérifie si l'utilisateur existe ET si le mot de passe correspond
    if ($user && password_verify($password, $user['mot_de_passe'])) {
        // Succès ! On stocke les infos utiles dans la session
        $_SESSION['user_id'] = $user['id_user'];
        $_SESSION['user_nom'] = $user['prenom'] . ' ' . $user['nom'];
        $_SESSION['user_role'] = $user['id_role'];
        
        // On redirige vers la page d'accueil
        header('Location: index.php');
        exit();
    } else {
        $erreur = "Identifiants incorrects.";
    }
}

// Seulement après le traitement PHP, on affiche le HTML
require_once 'views/layouts/header.php';
?>

<div class="login-container">
    <h2>Espace de Connexion</h2>
    
    <?php if ($erreur): ?>
        <p style="color: red; text-align: center; margin-bottom: 15px; font-weight: bold;">
            ❌ <?php echo $erreur; ?>
        </p>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <label for="email">Adresse Email</label>
        <input type="email" id="email" name="email" placeholder="admin@viacesi.fr" required>

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" placeholder="Votre mot de passe" required>

        <button type="submit">Se connecter</button>
    </form>
</div>

<?php require_once 'views/layouts/footer.php'; ?>