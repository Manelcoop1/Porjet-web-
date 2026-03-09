<?php
// 1. Les informations de connexion
$host = 'localhost';
$dbname = 'bd_web4all'; 
$user = 'root';         // Par défaut sur Laragon/XAMPP
$pass = '';             // Par défaut vide sur Laragon/XAMPP

try {
    // 2. Tentative de connexion avec PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);

    // 3. Configuration pour voir les erreurs SQL s'il y en a
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Optionnel : décommenter la ligne suivante pour tester la connexion
    // echo "Connexion réussie !"; 

} catch (PDOException $e) {
    // 4. Si ça rate, on affiche l'erreur
    die("Erreur de connexion : " . $e->getMessage());
}
?>
