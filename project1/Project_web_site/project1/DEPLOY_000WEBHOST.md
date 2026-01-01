# Guide de déploiement sur 000webhost

Ce guide vous explique comment déployer votre site e-commerce sur 000webhost gratuitement.

---

## Étape 1 : Créer un compte 000webhost

1. Allez sur [https://www.000webhost.com](https://www.000webhost.com)
2. Cliquez sur "Sign Up Free"
3. Créez votre compte gratuit
4. Vérifiez votre email et activez votre compte

---

## Étape 2 : Créer un site web

1. Connectez-vous à votre compte 000webhost
2. Cliquez sur "Create New Site"
3. Choisissez un nom de site (ex: `monshop`)
   - Votre site sera accessible à : `https://monshop.000webhostapp.com`
4. Définissez un mot de passe
5. Cliquez sur "Create"

---

## Étape 3 : Créer la base de données MySQL

1. Dans le panneau de contrôle, allez dans "Manage Database"
2. Cliquez sur "New Database"
3. Notez les informations suivantes (vous en aurez besoin) :
   ```
   Database Name: id123456_ecommerce
   Database User: id123456_user
   Database Password: [votre mot de passe]
   Database Host: localhost
   ```

4. Cliquez sur "Manage" sur votre base de données
5. Cliquez sur "phpMyAdmin"
6. Dans phpMyAdmin :
   - Cliquez sur l'onglet "SQL"
   - Ouvrez le fichier `database/ecommerce_site.sql` de votre projet
   - Copiez tout le contenu
   - Collez-le dans la zone SQL
   - Cliquez sur "Exécuter"

---

## Étape 4 : Configurer les fichiers de production

### 4.1 Créer le fichier .env.production

Dans la racine de votre projet, créez un fichier `.env.production` :

```env
DB_HOST=localhost
DB_USER=id123456_user
DB_PASS=votre_mot_de_passe
DB_NAME=id123456_ecommerce
API_URL=https://monshop.000webhostapp.com/php/api
APP_ENV=production
APP_DEBUG=false
```

**IMPORTANT** : Remplacez les valeurs par celles fournies par 000webhost !

### 4.2 Mettre à jour l'URL de l'API

Ouvrez `src/lib/api.ts` et modifiez :

```typescript
const API_BASE_URL = 'https://monshop.000webhostapp.com/php/api';
```

Remplacez `monshop` par le nom de votre site.

---

## Étape 5 : Construire le projet

Dans votre terminal, exécutez :

```bash
npm run build
```

Cela créera un dossier `dist/` avec tous les fichiers optimisés.

---

## Étape 6 : Uploader les fichiers

### Option A : Via File Manager (Interface Web)

1. Dans le panneau 000webhost, allez dans "File Manager"
2. Supprimez le fichier `index.php` par défaut dans `public_html/`
3. Uploadez **TOUS** les fichiers du dossier `dist/` dans `public_html/`
4. Créez un dossier `php/` dans `public_html/`
5. Uploadez tous les fichiers du dossier `php/` du projet :
   ```
   public_html/
   ├── php/
   │   ├── .htaccess
   │   ├── config.php
   │   ├── database.php
   │   └── api/
   │       ├── auth.php
   │       ├── products.php
   │       └── orders.php
   ├── .htaccess
   ├── .env.production
   ├── index.html
   └── assets/
   ```

### Option B : Via FTP (Recommandé pour gros fichiers)

1. Téléchargez FileZilla : [https://filezilla-project.org](https://filezilla-project.org)
2. Dans 000webhost, allez dans "File Manager" > "FTP Details"
3. Notez les informations FTP :
   ```
   Hostname: files.000webhost.com
   Username: monshop
   Password: [votre mot de passe]
   Port: 21
   ```
4. Connectez-vous avec FileZilla
5. Allez dans le dossier `public_html/`
6. Uploadez tous les fichiers comme indiqué ci-dessus

---

## Étape 7 : Configurer les permissions

Les fichiers suivants doivent avoir les bonnes permissions :

1. Dans File Manager, faites un clic droit sur le dossier `php/`
2. Permissions : `755` (lecture/exécution pour tous, écriture pour propriétaire)
3. Pour les fichiers `.htaccess` : `644`
4. Pour le fichier `.env.production` : `600` (sécurité maximale)

---

## Étape 8 : Tester le site

1. Accédez à votre site : `https://monshop.000webhostapp.com`
2. Testez les fonctionnalités :
   - Chargement des produits
   - Inscription d'un compte
   - Connexion
   - Ajout au panier
   - Passage de commande

### Compte administrateur

Connectez-vous avec :
- **Email** : `admin@shop.sn`
- **Mot de passe** : `admin123`

**IMPORTANT** : Changez ce mot de passe immédiatement après la première connexion !

---

## Structure finale sur le serveur

```
public_html/
├── .htaccess                    (routage React + sécurité)
├── .env.production              (configuration DB - protégé)
├── index.html                   (page principale)
├── assets/                      (CSS, JS, images compilés)
│   ├── index-[hash].css
│   └── index-[hash].js
└── php/                         (Backend PHP)
    ├── .htaccess                (sécurité PHP)
    ├── config.php               (configuration)
    ├── database.php             (connexion DB)
    └── api/                     (endpoints API)
        ├── auth.php
        ├── products.php
        └── orders.php
```

---

## Dépannage

### Erreur "500 Internal Server Error"

1. Vérifiez le fichier `.htaccess` - certaines directives peuvent ne pas être supportées
2. Commentez temporairement certaines lignes dans `.htaccess` :
   ```apache
   # php_value upload_max_filesize 10M
   # php_value post_max_size 10M
   ```

### Erreur de connexion à la base de données

1. Vérifiez que les informations dans `.env.production` sont exactes
2. Vérifiez que la base de données a été créée
3. Vérifiez que les tables ont été importées via phpMyAdmin

### Les produits ne s'affichent pas

1. Ouvrez la console du navigateur (F12)
2. Vérifiez les erreurs réseau
3. Vérifiez que l'URL API dans `src/lib/api.ts` est correcte
4. Reconstruisez le projet avec `npm run build` si vous avez modifié l'URL

### Erreurs CORS

1. Vérifiez que les headers CORS sont présents dans `php/config.php`
2. Vérifiez que le `.htaccess` du dossier `php/` est bien uploadé
3. Essayez d'ajouter votre domaine spécifiquement dans CORS au lieu de `*`

### Les sessions ne fonctionnent pas

000webhost peut avoir des limitations sur les sessions. Si vous rencontrez des problèmes :
1. Vérifiez que `session_start()` est appelé dans `config.php`
2. Les sessions devraient fonctionner normalement sur 000webhost

---

## Limitations de 000webhost (Version gratuite)

- **Bande passante** : 10 GB/mois
- **Espace disque** : 300 MB
- **Base de données** : 1 base MySQL (30 MB)
- **Trafic** : Peut être limité en cas d'utilisation intensive
- **Pas de support email** : Pas d'envoi d'emails
- **Publicité** : Une petite bannière 000webhost peut apparaître

Pour un site en production avec plus de trafic, envisagez un hébergement payant.

---

## Sécurité en production

### Actions recommandées :

1. **Changez le mot de passe admin** immédiatement
2. **Activez HTTPS** (gratuit sur 000webhost)
3. **Sauvegardez régulièrement** votre base de données
4. **Mettez à jour** les produits via l'interface admin
5. **Surveillez** les logs d'erreurs dans `php/error.log`

### Sauvegarder la base de données

1. Allez dans phpMyAdmin
2. Sélectionnez votre base de données
3. Cliquez sur "Exporter"
4. Choisissez "Rapide" et format "SQL"
5. Cliquez sur "Exécuter"
6. Téléchargez et conservez le fichier en sécurité

---

## Support

Si vous rencontrez des problèmes :

1. Consultez les logs d'erreurs : `php/error.log`
2. Vérifiez la console du navigateur (F12)
3. Consultez la documentation 000webhost : [https://www.000webhost.com/forum](https://www.000webhost.com/forum)
4. Vérifiez que toutes les étapes ont été suivies correctement

---

## Mise à jour du site

Pour mettre à jour votre site après des modifications :

1. Modifiez le code localement
2. Exécutez `npm run build`
3. Uploadez uniquement les fichiers modifiés :
   - Le dossier `assets/` complet (nouveaux hashs)
   - Le fichier `index.html`
   - Les fichiers PHP si modifiés

**Astuce** : Gardez toujours une copie locale de votre `.env.production` !

---

Félicitations ! Votre site e-commerce est maintenant en ligne sur 000webhost.
