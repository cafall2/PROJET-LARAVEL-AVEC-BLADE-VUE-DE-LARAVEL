# Site E-Commerce - Plateforme complète

Site e-commerce moderne avec gestion des produits, commandes et paiements mobiles (Orange Money, Wave).

## Caractéristiques

- **Catalogue de produits** avec filtrage par catégorie
- **Panier d'achat** avec gestion des quantités
- **Authentification** (inscription, connexion)
- **Paiement mobile** (Orange Money, Wave)
- **Interface administrateur** pour gérer produits et commandes
- **Design responsive** moderne et professionnel

## Technologies

### Frontend
- React 18 + TypeScript
- Tailwind CSS pour le design
- Vite pour le build
- Lucide React pour les icônes

### Backend
- PHP 7.4+ avec API REST
- MySQL pour la base de données
- Sessions PHP pour l'authentification

## Installation locale

### Prérequis
- XAMPP ou WAMP
- Node.js 16+
- Navigateur moderne

### Étapes

1. **Cloner le projet**
```bash
git clone <url-du-repo>
cd project
```

2. **Configurer la base de données**
   - Démarrez XAMPP/WAMP (Apache + MySQL)
   - Ouvrez phpMyAdmin : `http://localhost/phpmyadmin`
   - Importez le fichier `database/ecommerce_site.sql`

3. **Installer les dépendances**
```bash
npm install
```

4. **Copier les fichiers PHP**
   - Copiez le dossier `php/` dans `C:\xampp\htdocs\` (ou votre dossier WAMP)

5. **Lancer le serveur de développement**
```bash
npm run dev
```

6. **Accéder au site**
   - Ouvrez `http://localhost:5173` dans votre navigateur

### Compte administrateur
- **Email** : `admin@shop.sn`
- **Mot de passe** : `admin123`

## Déploiement en production

### Sur 000webhost (Gratuit)

Consultez le guide complet : **[DEPLOY_000WEBHOST.md](DEPLOY_000WEBHOST.md)**

#### Résumé rapide

1. **Préparer le projet**
```bash
# Linux/Mac
./deploy.sh

# Windows
deploy.bat
```

2. **Créer un compte sur 000webhost**
   - Allez sur [000webhost.com](https://www.000webhost.com)
   - Créez un site gratuit

3. **Configurer la base de données**
   - Créez une base MySQL sur 000webhost
   - Importez `database/ecommerce_site.sql` via phpMyAdmin

4. **Configurer les variables**
   - Modifiez `.env.production` avec vos identifiants 000webhost
   - Mettez à jour l'URL API dans `src/lib/api.ts`

5. **Upload des fichiers**
   - Uploadez le contenu du dossier `deploy/` dans `public_html/`

6. **Tester**
   - Accédez à votre site : `https://votresite.000webhostapp.com`

## Structure du projet

```
project/
├── src/                      # Code source React
│   ├── components/           # Composants React
│   ├── contexts/             # Contexts (Auth, Cart)
│   └── lib/                  # Utilitaires (API, config)
├── php/                      # Backend PHP
│   ├── api/                  # Endpoints API REST
│   │   ├── auth.php          # Authentification
│   │   ├── products.php      # Gestion produits
│   │   └── orders.php        # Gestion commandes
│   ├── config.php            # Configuration
│   ├── database.php          # Connexion DB
│   └── .htaccess             # Sécurité PHP
├── database/                 # Scripts SQL
│   └── ecommerce_site.sql    # Schema + données
├── .htaccess                 # Configuration serveur
├── .env.production.example   # Exemple configuration prod
└── package.json              # Dépendances npm
```

## API Endpoints

### Authentification
- `POST /php/api/auth.php?action=register` - Inscription
- `POST /php/api/auth.php?action=login` - Connexion
- `POST /php/api/auth.php?action=logout` - Déconnexion
- `GET /php/api/auth.php` - Vérifier session

### Produits
- `GET /php/api/products.php` - Liste des produits
- `POST /php/api/products.php` - Créer produit (admin)
- `PUT /php/api/products.php` - Modifier produit (admin)
- `DELETE /php/api/products.php?id=X` - Supprimer produit (admin)

### Commandes
- `GET /php/api/orders.php` - Liste des commandes
- `POST /php/api/orders.php` - Créer commande
- `PUT /php/api/orders.php` - Mettre à jour statut (admin)

## Base de données

### Tables

**users**
- Stocke les utilisateurs (clients et admins)
- Mots de passe hashés avec bcrypt

**products**
- Catalogue de produits
- Gestion du stock

**orders**
- Commandes passées
- Statut de paiement et livraison

**order_items**
- Détails des articles commandés
- Lien avec produits et commandes

## Sécurité

- Mots de passe hashés avec `password_hash()`
- Protection CSRF via sessions PHP
- Headers de sécurité configurés (.htaccess)
- Échappement SQL pour prévenir injections
- Validation des entrées utilisateur

## Scripts disponibles

```bash
npm run dev        # Serveur de développement
npm run build      # Build de production
npm run preview    # Prévisualiser le build
npm run lint       # Vérifier le code
```

## Personnalisation

### Modifier les couleurs
Éditez `tailwind.config.js` pour changer le thème.

### Ajouter des catégories
Les catégories sont automatiquement générées depuis les produits.

### Modifier les méthodes de paiement
Éditez `src/components/CheckoutPage.tsx` pour ajouter/retirer des options.

## Dépannage

### Erreur de connexion DB
- Vérifiez `php/config.php` ou `.env.production`
- Assurez-vous que MySQL est démarré
- Vérifiez les identifiants de connexion

### Produits ne s'affichent pas
- Ouvrez la console navigateur (F12)
- Vérifiez l'URL API dans `src/lib/api.ts`
- Vérifiez que les fichiers PHP sont accessibles

### Erreur 500
- Consultez `php/error.log`
- Vérifiez les permissions des fichiers
- Vérifiez la syntaxe PHP

## Support

Pour les questions ou problèmes :
1. Consultez les fichiers de documentation
2. Vérifiez les logs d'erreur
3. Consultez les issues du projet

## Licence

Ce projet est fourni à des fins éducatives.

## Auteurs

Développé avec React, TypeScript, PHP et MySQL.

---

**Documentation complète** : [INSTALLATION.md](INSTALLATION.md) | [DEPLOY_000WEBHOST.md](DEPLOY_000WEBHOST.md)
