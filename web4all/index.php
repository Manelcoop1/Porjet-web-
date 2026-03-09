<?php
// 1. On démarre la session en TOUT PREMIER (obligatoire)
session_start();

// 2. On inclut la base de données et le menu (Header)
require_once 'config/db.php';
require_once 'views/layouts/header.php';
?>

<section style="text-align: center; margin-top: 50px;">
    <h1>Bienvenue sur Web4All !</h1>
    
    <?php if (isset($_SESSION['user_nom'])): ?>
        <p style="margin-top: 15px; font-size: 1.5rem; color: #0056b3;">
            👋 Bonjour <b><?php echo htmlspecialchars($_SESSION['user_nom']); ?></b> ! Vous êtes connecté.
        </p>
    <?php else: ?>
        <p style="margin-top: 15px; font-size: 1.2rem;">
            Trouvez le stage de vos rêves parmi des centaines d'offres en entreprise.<br><br>
            <a href="login.php" style="padding: 10px 20px; background-color: #0056b3; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;">Connectez-vous pour commencer !</a>
        </p>
    <?php endif; ?>

    <?php
    // Bonus : le message de test BDD qu'on a gardé
    if (isset($pdo)) {
        echo "<p style='color: green; font-weight: bold; margin-top: 40px;'>✅ Base de données opérationnelle !</p>";
    }
    ?>
</section>

<?php 
// 3. On ferme la page avec le Footer
require_once 'views/layouts/footer.php'; 
?>