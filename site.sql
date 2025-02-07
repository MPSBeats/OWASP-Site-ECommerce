DROP TABLE IF EXISTS Support;
DROP TABLE IF EXISTS Products;
DROP TABLE IF EXISTS Categories;
DROP TABLE IF EXISTS Users;

-- Table Users
CREATE TABLE Users (
    id_user SERIAL PRIMARY KEY,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    mail VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) DEFAULT 'client' CHECK (role IN ('client', 'vendeur', 'admin'))
);

-- Table Categories
CREATE TABLE Categories (
    id_categorie SERIAL PRIMARY KEY,
    name VARCHAR(100) UNIQUE NOT NULL,
    description TEXT
);

-- Table Products (corrigé pour utiliser id_vendeur et id_categorie)
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

-- Table Support
CREATE TABLE Support (
    id_ticket SERIAL PRIMARY KEY,
    id_user INT NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES Users(id_user) ON DELETE CASCADE
);

-- Réinitialisation des séquences
ALTER SEQUENCE users_id_user_seq RESTART WITH 1;
ALTER SEQUENCE categories_id_categorie_seq RESTART WITH 1;
ALTER SEQUENCE products_id_product_seq RESTART WITH 1;
ALTER SEQUENCE support_id_ticket_seq RESTART WITH 1;
