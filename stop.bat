@echo off
echo 🛑 Arrêt de l'environnement Docker...

:: Arrêt des conteneurs
echo ⏹️ Arrêt des conteneurs...
docker-compose down

:: Suppression des volumes
echo 🗑️ Nettoyage des volumes...
docker-compose down -v

:: Nettoyage des images non utilisées
echo 🧹 Nettoyage des images...
docker system prune -f

echo ✅ Environnement arrêté avec succès !
pause