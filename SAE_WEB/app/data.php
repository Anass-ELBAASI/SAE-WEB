<?php
use Romai\SaeWeb\BddConnect;
use Romai\SaeWeb\DBUserRepository;

require_once '../vendor/autoload.php';
$bdd = new BddConnect();

$pdo = $bdd->connexion();

// Liste des tables à exporter
$tables = ['users', 'formulaire'];

foreach ($tables as $table) {
    try {
        // Exécuter la requête pour récupérer les données de la table
        $stmt = $pdo->query("SELECT * FROM $table");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Convertir les données en format JSON
        $jsonData = json_encode($results, JSON_PRETTY_PRINT,  JSON_UNESCAPED_UNICODE);

        // Sauvegarder les données dans un fichier JSON
        file_put_contents("../js/$table.json", $jsonData);

        echo "Les données de \"$table\" ont été exportées dans $table.json\n";
    } catch (PDOException $e) {
        echo "Erreur lors de l'export de la table \"$table\": " . $e->getMessage() . "\n";
    }
}

// Fermer la connexion à la base de données
$pdo = null;
?>
