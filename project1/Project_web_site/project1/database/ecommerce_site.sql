-- Créer la base de données
CREATE DATABASE IF NOT EXISTS ecommerce_site CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE ecommerce_site;

-- Table users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    telephone VARCHAR(20),
    is_admin BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table products
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    prix DECIMAL(10, 2) NOT NULL,
    image_url TEXT NOT NULL,
    categorie VARCHAR(100) NOT NULL,
    stock INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table orders
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    statut ENUM('pending', 'paid', 'shipped', 'delivered', 'cancelled') DEFAULT 'pending',
    payment_method ENUM('orange_money', 'wave'),
    payment_status ENUM('pending', 'success', 'failed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table order_items
CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    prix_unitaire DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insérer des produits d'exemple avec images locales
INSERT INTO products (nom, description, prix, image_url, categorie, stock) VALUES
('T-shirt Premium Coton', 'T-shirt de qualité supérieure en coton 100% biologique, confortable et durable', 15000, '/assets/images/products/tshirt.jpg', 'Vêtements', 25),
('Jean Slim Fit', 'Jean moderne avec coupe ajustée, idéal pour toutes les occasions', 35000, '/assets/images/products/jean.jpg', 'Vêtements', 15),
('Sneakers Sport', 'Chaussures de sport légères et confortables pour la vie quotidienne', 45000, '/assets/images/products/sneakers.jpg', 'Chaussures', 20),
('Montre Élégante', 'Montre classique avec bracelet en cuir véritable', 75000, '/assets/images/products/montre.jpg', 'Accessoires', 10),
('Sac à Dos Design', 'Sac à dos moderne avec compartiment pour ordinateur portable', 28000, '/assets/images/products/sac.jpg', 'Accessoires', 18),
('Écouteurs Bluetooth', 'Écouteurs sans fil avec réduction de bruit active', 55000, '/assets/images/products/ecouteurs.jpg', 'Électronique', 30),
('Smartphone Pro', 'Téléphone intelligent dernière génération avec caméra 48MP', 350000, '/assets/images/products/smartphone.jpg', 'Électronique', 12),
('Robe Soirée', 'Robe élégante parfaite pour les occasions spéciales', 42000, '/assets/images/products/robe.jpg', 'Vêtements', 8),
('Lunettes de Soleil', 'Lunettes de soleil polarisées avec protection UV400', 22000, '/assets/images/products/lunettes.jpg', 'Accessoires', 22),
('Casquette Sport', 'Casquette ajustable en coton respirant', 8000, '/assets/images/products/casquette.jpg', 'Accessoires', 35),
('Chemise Business', 'Chemise formelle en coton premium pour le bureau', 25000, '/assets/images/products/chemise.jpg', 'Vêtements', 16),
('Boots Cuir', 'Bottines en cuir véritable, style intemporel', 65000, '/assets/images/products/boots.jpg', 'Chaussures', 14),
('Ordinateur Portable', 'PC portable performant avec SSD 512GB, 16GB RAM', 450000, '/assets/images/products/laptop.jpg', 'Électronique', 8),
('Tablette 10 pouces', 'Tablette tactile Android avec stylet inclus', 180000, '/assets/images/products/tablette.jpg', 'Électronique', 15),
('Parfum Homme', 'Eau de toilette premium, senteur boisée', 38000, '/assets/images/products/parfum.jpg', 'Beauté', 20),
('Crème Visage', 'Crème hydratante anti-âge pour tous types de peau', 15000, '/assets/images/products/creme.jpg', 'Beauté', 30),
('Chaussures de Course', 'Running shoes légères avec amorti optimal', 55000, '/assets/images/products/running.jpg', 'Chaussures', 18),
('Veste Bomber', 'Veste tendance en coton, style urbain', 48000, '/assets/images/products/veste.jpg', 'Vêtements', 12),
('Ceinture Cuir', 'Ceinture en cuir véritable avec boucle métallique', 18000, '/assets/images/products/ceinture.jpg', 'Accessoires', 25),
('Portefeuille Homme', 'Portefeuille compact en cuir, plusieurs compartiments', 12000, '/assets/images/products/portefeuille.jpg', 'Accessoires', 40);

-- Créer un utilisateur admin par défaut (mot de passe: admin123)
INSERT INTO users (nom, email, mot_de_passe, telephone, is_admin) VALUES
('Administrateur', 'admin@shop.sn', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '771234567', TRUE);
