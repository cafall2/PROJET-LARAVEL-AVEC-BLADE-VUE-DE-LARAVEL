@echo off
echo ==========================================
echo   Script de preparation pour deploiement
echo ==========================================
echo.

REM Verifier que npm est installe
where npm >nul 2>nul
if %errorlevel% neq 0 (
    echo [ERREUR] npm n'est pas installe
    exit /b 1
)

REM Verifier si .env.production existe
if not exist ".env.production" (
    echo [ATTENTION] Le fichier .env.production n'existe pas
    echo [INFO] Creation d'un fichier .env.production a partir de l'exemple...
    copy .env.production.example .env.production >nul
    echo [OK] Fichier cree ! Veuillez le modifier avec vos vraies valeurs avant de continuer.
    echo.
    echo Ouvrez le fichier .env.production et remplissez :
    echo   - DB_HOST (generalement localhost)
    echo   - DB_USER (fourni par 000webhost)
    echo   - DB_PASS (fourni par 000webhost)
    echo   - DB_NAME (fourni par 000webhost)
    echo   - API_URL (votre URL 000webhost + /php/api)
    echo.
    pause
    exit /b 1
)

echo [OK] Fichier .env.production trouve
echo.

echo Etapes qui seront effectuees :
echo   1. Nettoyage des anciens fichiers de build
echo   2. Installation des dependances
echo   3. Construction du projet (npm run build)
echo   4. Preparation des fichiers pour l'upload
echo.
set /p confirm="Continuer ? (o/n) "
if /i not "%confirm%"=="o" (
    echo [ANNULE]
    exit /b 1
)

REM Nettoyer les anciens builds
echo.
echo [INFO] Nettoyage des anciens fichiers...
if exist "dist\" rmdir /s /q "dist\"
if exist "deploy\" rmdir /s /q "deploy\"
if exist "deploy.zip" del /q "deploy.zip"

REM Installer les dependances
echo.
echo [INFO] Installation des dependances...
call npm install

REM Build du projet
echo.
echo [INFO] Construction du projet...
call npm run build

if %errorlevel% neq 0 (
    echo [ERREUR] Erreur lors de la construction du projet
    exit /b 1
)

echo.
echo [OK] Construction reussie !
echo.

REM Creer le dossier de deploiement
echo [INFO] Preparation des fichiers pour le deploiement...
mkdir deploy

REM Copier les fichiers buildes
xcopy /E /I /Q dist\* deploy\ >nul

REM Copier le dossier PHP
xcopy /E /I /Q php deploy\php\ >nul

REM Copier les fichiers de configuration
copy .htaccess deploy\ >nul
copy .env.production deploy\ >nul

echo.
echo ==========================================
echo [OK] Preparation terminee avec succes !
echo ==========================================
echo.
echo [INFO] Fichiers prets dans le dossier 'deploy\'
echo.
echo Prochaines etapes :
echo   1. Connectez-vous a 000webhost
echo   2. Allez dans File Manager
echo   3. Supprimez tous les fichiers dans public_html/
echo   4. Uploadez le contenu du dossier 'deploy\'
echo   5. Configurez les permissions si necessaire
echo.
echo Consultez DEPLOY_000WEBHOST.md pour plus de details
echo.
pause
