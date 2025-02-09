#!/bin/bash

echo "🚀 Démarrage de l'environnement Docker..."

# Vérification de Docker
if ! command -v docker &> /dev/null; then
    echo "❌ Docker n'est pas installé"
    exit 1
fi

# Change to the directory where docker-compose.yml is located
cd "$(dirname "$0")"

# Arrêt des conteneurs existants
echo "🔄 Arrêt des conteneurs existants..."
docker-compose down

# Nettoyage des volumes
echo "🗑️ Nettoyage des volumes..."
docker-compose down -v

# Construction des images avec vérification
echo "🏗️ Construction des images..."
if ! docker-compose build --no-cache; then
    echo "❌ Erreur lors de la construction des images"
    exit 1
fi

# Démarrage des conteneurs avec vérification
echo "▶️ Démarrage des conteneurs..."
if ! docker-compose up -d; then
    echo "❌ Erreur lors du démarrage des conteneurs"
    exit 1
fi

# Attente que les conteneurs soient prêts
echo "⏳ Attente du démarrage complet..."
sleep 10

# Vérification des conteneurs
echo "✅ Vérification des conteneurs..."
docker-compose ps

# Configuration des permissions
echo "🔒 Configuration des permissions..."
docker-compose exec -T php chown -R www-data:www-data /var/www/html

echo "🌟 Environnement prêt !"
echo "📝 Accédez à votre application sur : http://localhost:8080"

# Affichage des logs en temps réel
echo "📊 Affichage des logs..."
echo "Pour quitter les logs: Ctrl+C"
docker-compose logs -f php