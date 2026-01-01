#!/bin/bash

echo "=========================================="
echo "  Script de préparation pour déploiement"
echo "=========================================="
echo ""

# Vérifier que npm est installé
if ! command -v npm &> /dev/null; then
    echo "❌ Erreur : npm n'est pas installé"
    exit 1
fi

# Vérifier si .env.production existe
if [ ! -f ".env.production" ]; then
    echo "⚠️  Le fichier .env.production n'existe pas"
    echo "📝 Création d'un fichier .env.production à partir de l'exemple..."
    cp .env.production.example .env.production
    echo "✅ Fichier créé ! Veuillez le modifier avec vos vraies valeurs avant de continuer."
    echo ""
    echo "Ouvrez le fichier .env.production et remplissez :"
    echo "  - DB_HOST (généralement localhost)"
    echo "  - DB_USER (fourni par 000webhost)"
    echo "  - DB_PASS (fourni par 000webhost)"
    echo "  - DB_NAME (fourni par 000webhost)"
    echo "  - API_URL (votre URL 000webhost + /php/api)"
    echo ""
    exit 1
fi

echo "✅ Fichier .env.production trouvé"
echo ""

# Demander confirmation
echo "📋 Étapes qui seront effectuées :"
echo "  1. Nettoyage des anciens fichiers de build"
echo "  2. Installation des dépendances"
echo "  3. Construction du projet (npm run build)"
echo "  4. Création d'une archive pour l'upload"
echo ""
read -p "Continuer ? (o/n) " -n 1 -r
echo ""

if [[ ! $REPLY =~ ^[OoYy]$ ]]; then
    echo "❌ Annulé"
    exit 1
fi

# Nettoyer les anciens builds
echo "🧹 Nettoyage des anciens fichiers..."
rm -rf dist/
rm -f deploy.zip

# Installer les dépendances
echo ""
echo "📦 Installation des dépendances..."
npm install

# Build du projet
echo ""
echo "🔨 Construction du projet..."
npm run build

if [ $? -ne 0 ]; then
    echo "❌ Erreur lors de la construction du projet"
    exit 1
fi

echo ""
echo "✅ Construction réussie !"
echo ""

# Créer le dossier de déploiement
echo "📦 Préparation des fichiers pour le déploiement..."
rm -rf deploy/
mkdir -p deploy

# Copier les fichiers buildés
cp -r dist/* deploy/

# Copier le dossier PHP
cp -r php deploy/

# Copier les fichiers de configuration
cp .htaccess deploy/
cp .env.production deploy/

# Créer une archive ZIP
echo ""
echo "📦 Création de l'archive deploy.zip..."
cd deploy
zip -r ../deploy.zip . -q
cd ..

echo ""
echo "=========================================="
echo "✅ Préparation terminée avec succès !"
echo "=========================================="
echo ""
echo "📁 Fichiers prêts dans le dossier 'deploy/'"
echo "📦 Archive créée : deploy.zip"
echo ""
echo "📤 Prochaines étapes :"
echo "  1. Connectez-vous à 000webhost"
echo "  2. Allez dans File Manager"
echo "  3. Supprimez tous les fichiers dans public_html/"
echo "  4. Uploadez le contenu du dossier 'deploy/' ou utilisez deploy.zip"
echo "  5. Configurez les permissions si nécessaire"
echo ""
echo "📚 Consultez DEPLOY_000WEBHOST.md pour plus de détails"
echo ""
