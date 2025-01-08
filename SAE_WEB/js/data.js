const mysql = require('mysql');
const fs = require('fs');

// Configuration de la connexion à la base
const connection = mysql.createConnection({
    host: 'localhost',
    port: 3307,
    user: 'root',
    password: '',
    database: 'sae_web_database'
});

// Connexion
connection.connect(err => {
    if (err) {
        console.error('Erreur de connexion :', err);
        return;
    }
    console.log('Connecté à la base de données.');
});

// Exporter une table spécifique
const tables = ['users','formulaire']; // Liste des tables à exporter

tables.forEach(table => {
    connection.query(`SELECT * FROM ${table}`, (err, results) => {
        if (err) throw err;

        const jsonData = JSON.stringify(results, null, 2);
        fs.writeFileSync(`${table}.json`, jsonData, 'utf-8');
        console.log(`Les données de "${table}" ont été exportées dans ${table}.json`);
    });
});


// Fermer la connexion
connection.end();
