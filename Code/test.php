<?php
// Informations de connexion à la base de données
$serveur = "localhost";  // Adresse du serveur de la base de données
$utilisateur = "a2sq";  // Nom d'utilisateur de la base de données
$motDePasse = "a2sq";  // Mot de passe de la base de données
$nomBaseDeDonnees = "sae";  // Nom de la base de données

try {
    // Connexion à la base de données
    $connexion = new PDO("pgsql:host=$serveur;dbname=$nomBaseDeDonnees", $utilisateur, $motDePasse);

    // Configuration pour afficher les erreurs SQL
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Si la connexion est réussie, afficher un message
    echo "Connexion à la base de données réussie !";
} catch (PDOException $e) {
    // En cas d'erreur, afficher le message d'erreur
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>
