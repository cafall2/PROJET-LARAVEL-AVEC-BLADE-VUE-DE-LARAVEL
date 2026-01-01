# Installation avec WAMP Server

## Guide d'installation étape par étape

### Prérequis
- WAMP Server installé (télécharger sur https://www.wampserver.com/)
- Navigateur web moderne (Chrome, Firefox, Edge)

---

## ÉTAPE 1 : Démarrer WAMP

1. Lancez WAMP Server
2. Attendez que l'icône WAMP devienne **verte** dans la barre des tâches
   - Rouge = services arrêtés
   - Orange = certains services démarrés
   - Vert = tous les services fonctionnent ✓

---

## ÉTAPE 2 : Copier les fichiers du projet

1. Localisez le dossier `www` de WAMP :
   ```
   C:\wamp64\www\
   ```

2. Créez un nouveau dossier nommé `eshop` :
   ```
   C:\wamp64\www\eshop\
   ```

3. **Copiez TOUS les fichiers et dossiers du projet** dans `C:\wamp64\www\eshop\`

   Vous devriez avoir cette structure :
   ```
   C:\wamp64\www\eshop\
   ├── admin/
   ├── ajax/
   ├── assets/
   │   ├── css/
   │   ├── js/
   │   └── images/
   │       └── products/
   ├── auth/
   ├── config/
   ├── database/
   ├── includes/
   ├── .htaccess
   ├── index.php
   ├── boutique.php
   ├── produit.php
   ├── panier.php
   ├── commande.php
   └── contact.php
   ```

---

## ÉTAPE 3 : Créer la base de données

### Option A : Via phpMyAdmin (Recommandé)

1. **Ouvrez phpMyAdmin** :
   - Clic gauche sur l'icône WAMP (barre des tâches)
   - Cliquez sur "phpMyAdmin"
   - OU allez directement à : `http://localhost/phpmyadmin`

2. **Importez la base de données** :
   - Cliquez sur l'onglet "SQL" en haut
   - Ouvrez le fichier `database/ecommerce_site.sql` avec un éditeur de texte
   - **Copiez TOUT le contenu** du fichier
   - **Collez-le** dans la zone SQL de phpMyAdmin
   - Cliquez sur le bouton "Exécuter" (en bas à droite)

3. **Vérifiez la création** :
   - Dans la colonne de gauche, vous devriez voir la base `ecommerce_site`
   - Cliquez dessus pour voir les 4 tables :
     - `users`
     - `products`
     - `orders`
     - `order_items`

### Option B : Via l'interface WAMP

1. Clic gauche sur l'icône WAMP
2. MySQL > MySQL Console
3. Appuyez sur Entrée (pas de mot de passe par défaut)
4. Tapez : `source C:/wamp64/www/eshop/database/ecommerce_site.sql`
5. Appuyez sur Entrée

---

## ÉTAPE 4 : Vérifier la configuration

1. Ouvrez le fichier `config/database.php`

2. Vérifiez que les paramètres sont corrects :
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', '');  // Vide par défaut pour WAMP
   define('DB_NAME', 'ecommerce_site');
   ```

3. Si vous avez changé le mot de passe root de MySQL, mettez-le dans `DB_PASS`

---

## ÉTAPE 5 : Accéder au site

1. Ouvrez votre navigateur

2. Allez à l'adresse :
   ```
   http://localhost/eshop/
   ```

3. Vous devriez voir la page d'accueil du site ! 🎉

---

## ÉTAPE 6 : Tester les fonctionnalités

### Se connecter en tant qu'administrateur

1. Cliquez sur "Connexion" (en haut à droite)

2. Utilisez ces identifiants :
   - **Email** : `admin@shop.sn`
   - **Mot de passe** : `admin123`

3. Une fois connecté, cliquez sur "Administration" pour accéder au tableau de bord

### Tester en tant que client

1. Cliquez sur "S'inscrire"
2. Créez un nouveau compte
3. Parcourez la boutique
4. Ajoutez des produits au panier
5. Passez une commande de test

---

## Résolution des problèmes

### ❌ "Cannot connect to database"

**Solution** :
1. Vérifiez que WAMP est démarré (icône verte)
2. Vérifiez que MySQL fonctionne :
   - Clic gauche sur WAMP > MySQL > Service "wampmysqld64" started
3. Vérifiez les identifiants dans `config/database.php`

---

### ❌ Page blanche ou erreur 500

**Solution** :
1. Activez l'affichage des erreurs :
   - Éditez `config/config.php`
   - Changez `ini_set('display_errors', 0);` en `ini_set('display_errors', 1);`

2. Vérifiez les logs Apache :
   - Clic gauche sur WAMP > Apache > Apache error log

3. Vérifiez que le fichier `.htaccess` est bien présent

---

### ❌ Les images ne s'affichent pas

**Solution** :
1. Vérifiez que le dossier `assets/images/products/` existe
2. Les images sont des fichiers SVG (`.jpg` contenant du code SVG)
3. Si les images ne chargent toujours pas, vérifiez la console du navigateur (F12)

**Pour utiliser de vraies images** :
1. Remplacez les fichiers dans `assets/images/products/` par de vraies images JPG
2. Gardez les mêmes noms de fichiers

---

### ❌ "Access forbidden" ou "You don't have permission"

**Solution** :
1. Clic gauche sur WAMP
2. Cliquez sur "Put Online" (si vous voyez "Put Offline", c'est déjà en ligne)
3. Redémarrez WAMP

---

### ❌ Le panier ne fonctionne pas

**Solution** :
1. Vérifiez que les sessions PHP fonctionnent
2. Dans `config/config.php`, assurez-vous que `session_start()` est appelé
3. Videz le cache du navigateur (Ctrl + Shift + Delete)

---

## Personnalisation

### Changer le nom du site

Éditez `config/config.php` :
```php
define('SITE_NAME', 'Ma Super Boutique');
```

### Ajouter des produits

**Via phpMyAdmin** :
1. Ouvrez phpMyAdmin
2. Sélectionnez la base `ecommerce_site`
3. Cliquez sur la table `products`
4. Cliquez sur "Insérer"
5. Remplissez les champs :
   - `nom` : Nom du produit
   - `description` : Description
   - `prix` : Prix en CFA
   - `image_url` : `/assets/images/products/nom-image.jpg`
   - `categorie` : Catégorie (Vêtements, Électronique, etc.)
   - `stock` : Quantité disponible

### Modifier les catégories

Les catégories sont automatiquement générées depuis la base de données.
Pour ajouter une catégorie, créez simplement des produits avec cette catégorie.

---

## Structure du projet

```
eshop/
│
├── admin/                      # Interface d'administration
│   └── index.php              # Tableau de bord admin
│
├── ajax/                       # Handlers AJAX
│   └── add-to-cart.php        # Ajouter au panier
│
├── assets/                     # Fichiers statiques
│   ├── css/
│   │   └── style.css          # Styles personnalisés
│   ├── js/
│   │   └── script.js          # JavaScript
│   └── images/
│       └── products/          # Images produits
│
├── auth/                       # Authentification
│   ├── login.php              # Page de connexion
│   ├── register.php           # Page d'inscription
│   └── logout.php             # Déconnexion
│
├── config/                     # Configuration
│   ├── config.php             # Configuration générale
│   └── database.php           # Connexion base de données
│
├── database/                   # SQL
│   └── ecommerce_site.sql     # Structure et données
│
├── includes/                   # Templates réutilisables
│   ├── header.php             # En-tête du site
│   └── footer.php             # Pied de page
│
├── .htaccess                   # Configuration Apache
├── index.php                   # Page d'accueil
├── boutique.php                # Liste des produits
├── produit.php                 # Détail produit
├── panier.php                  # Panier d'achat
├── commande.php                # Passer commande
└── contact.php                 # Page de contact
```

---

## Déployer sur InfinityFree / 000webhost

Une fois que tout fonctionne en local :

1. **Exportez votre base de données** :
   - phpMyAdmin > ecommerce_site > Exporter > SQL > Exécuter

2. **Uploadez tous les fichiers** via FTP ou File Manager

3. **Importez la base de données** sur l'hébergeur

4. **Modifiez `config/database.php`** avec les identifiants fournis par l'hébergeur

5. **Testez le site** en ligne !

---

## Support et aide

### Ressources utiles :
- Documentation WAMP : https://www.wampserver.com/
- Documentation PHP : https://www.php.net/
- Tutoriels MySQL : https://dev.mysql.com/doc/

### En cas de problème :
1. Vérifiez les logs d'erreur Apache et PHP
2. Vérifiez la console du navigateur (F12)
3. Assurez-vous que tous les fichiers ont été copiés
4. Vérifiez que la base de données est bien créée et remplie

---

**Félicitations ! Votre site e-commerce est maintenant opérationnel en local.** 🎉

Pour toute question, vérifiez d'abord ce guide et les fichiers de logs.
