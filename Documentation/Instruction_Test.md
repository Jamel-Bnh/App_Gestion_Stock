# Tester la configuration :

docker-compose down -v
docker-compose up --build

# Vérifier la connexion depuis l'application PHP :

docker-compose exec app php -r "var_dump(mysqli_connect('db', 'user', 'password', 'my_database'));"

# Arrêter tous les conteneurs en cours
docker-compose down

# Supprimer les volumes (pour repartir de zéro)
docker-compose down -v

# Construire les images
docker-compose build

# Démarrer les conteneurs
docker-compose up -d

# Voir les logs en cas d'erreur
docker-compose logs

# Liste des conteneurs en cours d'exécution
docker ps

# Voir les logs de l'application
docker-compose logs app

# Voir les logs de la base de données
docker-compose logs db

Accès
Application web : http://localhost:8080
Base de données :
Hôte : localhost
Port : 3306
Utilisateur : user
Mot de passe : password
Base de données : app_stock
Test connexion base de données : http://localhost:8080/test.php


