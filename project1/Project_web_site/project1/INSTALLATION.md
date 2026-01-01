# Guide d'installation - Site E-Commerce

## Prérequis

- **XAMPP** ou **WAMP** installé sur votre ordinateur
- Navigateur web moderne (Chrome, Firefox, Edge)
- Node.js (version 16 ou supérieure) pour le développement

---

## Installation

### 1. Configuration de la base de données

#### Démarrer les services
1. Lancez **XAMPP** ou **WAMP**
2. Démarrez les modules **Apache** et **MySQL**

#### Créer la base de données
1. Ouvrez votre navigateur et accédez à **phpMyAdmin** : `http://localhost/phpmyadmin`
2. Cliquez sur l'onglet **SQL**
3. Ouvrez le fichier `database/ecommerce_site.sql` avec un éditeur de texte
4. Copiez tout le contenu et collez-le dans la zone SQL de phpMyAdmin
5. Cliquez sur **Exécuter**

Cela va créer :
- La base de données `ecommerce_site`
- Les tables : `users`, `products`, `orders`, `order_items`
- 12 produits d'exemple
- Un compte admin par défaut

---

### 2. Installation des fichiers PHP

1. Copiez le dossier `php/` dans le répertoire de votre serveur web :
   - **XAMPP** : `C:\xampp\htdocs\`
   - **WAMP** : `C:\wamp64\www\`

2. Vérifiez que la structure est :
   ```
   htdocs/
   └── php/
       ├── config.php
       └── api/
           ├── auth.php
           ├── products.php
           └── orders.php
   ```

---

### 3. Configuration de la connexion

Ouvrez le fichier `php/config.php` et vérifiez les paramètres de connexion :

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');  // Mot de passe vide par défaut pour XAMPP
define('DB_NAME', 'ecommerce_site');
```

Si votre configuration MySQL est différente, modifiez ces valeurs.

---

### 4. Installation du frontend

#### Installer les dépendances
Ouvrez un terminal dans le dossier du projet et exécutez :

```bash
npm install
```

#### Configurer l'URL de l'API
Ouvrez le fichier `src/lib/api.ts` et vérifiez que l'URL correspond à votre serveur local :

```typescript
const API_BASE_URL = 'http://localhost/php/api';
```

#### Lancer le serveur de développement
```bash
npm run dev
```

Le site sera accessible à l'adresse affichée dans le terminal (généralement `http://localhost:5173`)

---

## Utilisation

### Compte administrateur par défaut

Pour accéder à l'interface d'administration, connectez-vous avec :
- **Email** : `admin@shop.sn`
- **Mot de passe** : `admin123`

### Fonctionnalités principales

#### Pour les visiteurs :
- Parcourir le catalogue de produits
- Filtrer par catégorie
- Ajouter des produits au panier
- Créer un compte client

#### Pour les clients connectés :
- Passer des commandes
- Choisir le mode de paiement (Orange Money ou Wave)
- Voir l'historique des commandes

#### Pour les administrateurs :
- Gérer les produits (ajouter, modifier, supprimer)
- Voir toutes les commandes
- Mettre à jour le statut des commandes

---

## Structure de la base de données

### Table `users`
Stocke les informations des utilisateurs (clients et administrateurs)

### Table `products`
Contient tous les produits du catalogue

### Table `orders`
Enregistre toutes les commandes passées

### Table `order_items`
Détails des articles de chaque commande

---

## Dépannage

### Erreur de connexion à la base de données
- Vérifiez que MySQL est bien démarré dans XAMPP/WAMP
- Vérifiez les identifiants dans `php/config.php`
- Assurez-vous que la base de données `ecommerce_site` existe

### Erreur CORS
- Vérifiez que les fichiers PHP sont bien dans `htdocs/php/`
- Vérifiez que l'URL dans `src/lib/api.ts` correspond à votre serveur

### Page blanche
- Ouvrez la console du navigateur (F12) pour voir les erreurs
- Vérifiez que le serveur de développement (`npm run dev`) est lancé
- Vérifiez que Apache et MySQL sont démarrés

---

## Production

Pour créer une version de production :

```bash
npm run build
```

Les fichiers optimisés seront dans le dossier `dist/`. Copiez ce dossier sur votre serveur web de production.

---

## Support

Pour toute question ou problème, vérifiez :
1. Que tous les services (Apache, MySQL) sont démarrés
2. Que la base de données a été correctement créée
3. Que l'URL de l'API est correcte dans le code
