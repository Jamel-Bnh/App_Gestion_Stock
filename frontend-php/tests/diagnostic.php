<?php
require_once 'config.php';

echo "<h2>Diagnostic de la base de données</h2>";

// 1. Vérifier la connexion
echo "<h3>1. Statut de la connexion</h3>";
if ($link_db) {
    echo "✅ Connexion à la base de données réussie<br>";
} else {
    echo "❌ Échec de la connexion à la base de données<br>";
    die();
}

// 2. Vérifier la structure de la table
echo "<h3>2. Structure de la table users_stock</h3>";
$structure = mysqli_query($link_db, "DESCRIBE users_stock");
echo "<pre>";
while ($row = mysqli_fetch_assoc($structure)) {
    print_r($row);
}
echo "</pre>";

// 3. Lister les utilisateurs
echo "<h3>3. Liste des utilisateurs</h3>";
$users = mysqli_query($link_db, "SELECT matricule, user_name, role, LENGTH(mdp) as pwd_length FROM users_stock");
echo "<table border='1'>
<tr>
    <th>Matricule</th>
    <th>Nom</th>
    <th>Rôle</th>
    <th>Longueur MDP</th>
</tr>";
while ($user = mysqli_fetch_assoc($users)) {
    echo "<tr>
        <td>{$user['matricule']}</td>
        <td>{$user['user_name']}</td>
        <td>{$user['role']}</td>
        <td>{$user['pwd_length']}</td>
    </tr>";
}
echo "</table>";

// 4. Vérifier les sessions
echo "<h3>4. Configuration des sessions</h3>";
echo "Session save path: " . session_save_path() . "<br>";
echo "Session save handler: " . ini_get('session.save_handler') . "<br>";
echo "Session status: " . session_status() . "<br>";