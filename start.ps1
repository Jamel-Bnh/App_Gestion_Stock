# Le chemin du script
Set-Location $PSScriptRoot

# Forcer l'encodage en UTF-8
[Console]::OutputEncoding = [System.Text.Encoding]::UTF8
$env:PYTHONIOENCODING = "UTF-8"

Write-Host "=== Démarrage de l'environnement Docker ===" -ForegroundColor Green

Write-Host ">> Arrêt des conteneurs existants..." -ForegroundColor Yellow
docker-compose down --remove-orphans

Write-Host ">> Nettoyage complet..." -ForegroundColor Yellow
# Supprimer les volumes
docker-compose down -v
# Supprimer les images
docker-compose rm -f
# Nettoyer le cache de build
docker builder prune -f

Write-Host ">> Construction des images..." -ForegroundColor Yellow
# Forcer la reconstruction sans cache
docker-compose build --no-cache

Write-Host ">> Démarrage des conteneurs..." -ForegroundColor Yellow
docker-compose up -d

Write-Host ">> Attente du démarrage complet..." -ForegroundColor Yellow
Start-Sleep -Seconds 10

Write-Host ">> Vérification des conteneurs..." -ForegroundColor Yellow
docker ps --format "table {{.Names}}\t{{.Status}}\t{{.Ports}}"

# Vérifier si les conteneurs sont en cours d'exécution
$dbRunning = docker ps -q -f name=appstock_dmsp-db-1
if (-not $dbRunning) {
    Write-Host "!! Erreur: Le conteneur MySQL n'est pas démarré" -ForegroundColor Red
    Write-Host ">> Affichage des logs MySQL..." -ForegroundColor Yellow
    docker-compose logs db
} else {
    Write-Host ">> MySQL est démarré et en cours d'exécution" -ForegroundColor Green
    
    # Vérifier le statut des autres services
    $phpRunning = docker ps -q -f name=appstock_dmsp-php-1
    $nginxRunning = docker ps -q -f name=appstock_dmsp-nginx-1
    
    if (-not $phpRunning) {
        Write-Host "!! Erreur: Le conteneur PHP n'est pas démarré" -ForegroundColor Red
        Write-Host ">> Affichage des logs PHP..." -ForegroundColor Yellow
        docker-compose logs php
    }
    
    if (-not $nginxRunning) {
        Write-Host "!! Erreur: Le conteneur Nginx n'est pas démarré" -ForegroundColor Red
        Write-Host ">> Affichage des logs Nginx..." -ForegroundColor Yellow
        docker-compose logs nginx
    }
    
    if ($phpRunning -and $nginxRunning) {
        Write-Host ">> Tous les services sont démarrés et en cours d'exécution" -ForegroundColor Green
        Write-Host ">> L'application est accessible sur http://localhost:8080" -ForegroundColor Green
    }
}

Write-Host ">> Configuration des permissions..." -ForegroundColor Yellow
docker-compose exec php chown -R www-data:www-data /var/www/html

Write-Host "=== Environnement prêt ! ===" -ForegroundColor Green
Write-Host ">> Accédez à votre application sur : http://localhost:8080"
Write-Host ">> Affichage des logs..."
Write-Host "Pour quitter les logs: Ctrl+C"
docker-compose logs -f php