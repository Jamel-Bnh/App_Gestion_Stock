# Le chemin du script
Set-Location $PSScriptRoot

# Forcer l'encodage en UTF-8
[Console]::OutputEncoding = [System.Text.Encoding]::UTF8
$env:PYTHONIOENCODING = "UTF-8"

Write-Host "=== Mise à jour de l'environnement Docker ===" -ForegroundColor Green

# Copier les fichiers mis à jour dans le container PHP
Write-Host ">> Copie des fichiers mis à jour..." -ForegroundColor Yellow
docker cp ./frontend-php/. appstock_dmsp-php-1:/var/www/html/

# Copier la configuration nginx mise à jour
Write-Host ">> Mise à jour de la configuration nginx..." -ForegroundColor Yellow
docker cp ./frontend-php/nginx.conf appstock_dmsp-nginx-1:/etc/nginx/conf.d/default.conf

# Recharger la configuration nginx
Write-Host ">> Rechargement de la configuration nginx..." -ForegroundColor Yellow
docker exec appstock_dmsp-nginx-1 nginx -s reload

# Vérifier le statut des services
Write-Host ">> Vérification des services..." -ForegroundColor Yellow
docker ps --format "table {{.Names}}\t{{.Status}}\t{{.Ports}}"

# Afficher les logs récents pour vérifier les erreurs
Write-Host "`n>> Derniers logs nginx:" -ForegroundColor Yellow
docker logs --tail 10 appstock_dmsp-nginx-1

Write-Host "`n>> Derniers logs PHP:" -ForegroundColor Yellow
docker logs --tail 10 appstock_dmsp-php-1

Write-Host "`n>> L'application a été mise à jour!" -ForegroundColor Green
Write-Host "   Accédez à http://localhost:8080 pour voir les changements" -ForegroundColor Green
