DROP TABLE IF EXISTS Support;
DROP TABLE IF EXISTS Products;
DROP TABLE IF EXISTS Categories;
DROP TABLE IF EXISTS Users;

-- Création de la table Users
CREATE TABLE Users (
    id_user SERIAL PRIMARY KEY,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    mail VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) DEFAULT 'client' CHECK (role IN ('client', 'vendeur', 'admin'))
);

-- Création de la table Categories
CREATE TABLE Categories (
    id_categorie SERIAL PRIMARY KEY,
    name VARCHAR(100) UNIQUE NOT NULL,
    description TEXT
);

-- Création de la table Products
CREATE TABLE Products (
    id_product SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image_url TEXT,
    id_categorie INT,
    id_vendeur INT,
    FOREIGN KEY (id_categorie) REFERENCES Categories(id_categorie) ON DELETE SET NULL,
    FOREIGN KEY (id_vendeur) REFERENCES Users(id_user) ON DELETE SET NULL
);

-- Création de la table Support
CREATE TABLE Support (
    id_ticket SERIAL PRIMARY KEY,
    id_user INT NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES Users(id_user) ON DELETE CASCADE
);

-- Réinitialisation des séquences pour repartir de 1 pour chaque table
ALTER SEQUENCE users_id_user_seq RESTART WITH 1;
ALTER SEQUENCE categories_id_categorie_seq RESTART WITH 1;
ALTER SEQUENCE products_id_product_seq RESTART WITH 1;
ALTER SEQUENCE support_id_ticket_seq RESTART WITH 1;

-- Insertion des utilisateurs
INSERT INTO Users (firstname, lastname, mail, password, role)
VALUES 
    ('Alice', 'Dupont', 'alice@example.com', 'password123', 'vendeur'),
    ('Bob', 'Martin', 'bob@example.com', 'password123', 'vendeur'),
    ('Charlie', 'Durand', 'charlie@example.com', 'password123', 'client');

-- Insertion des catégories
INSERT INTO Categories (name, description)
VALUES 
    ('Vêtements', 'Vêtements pour hommes, femmes et enfants'),
    ('Sport', 'Articles et équipements sportifs pour toutes les disciplines');

-- Insertion des produits
INSERT INTO Products (name, description, price, image_url, id_categorie, id_vendeur)
VALUES 
    ('Produit A', 'Excellent produit A.', 20.50, 'assets/images/produit_a.jpg', 1, 1),
    ('Produit B', 'Produit B de haute qualité.', 15.99, 'assets/images/produit_b.jpg', 2, 2),
    ('Produit C', 'Produit C, très demandé.', 30.00, 'assets/images/produit_c.jpg', 1, 1);

