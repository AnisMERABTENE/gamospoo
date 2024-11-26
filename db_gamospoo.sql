-- Vérifier si la base de données existe, sinon la créer
DROP DATABASE IF EXISTS db_Gamospoo;
CREATE DATABASE db_Gamospoo;

-- Utiliser la base de données
USE db_Gamospoo;

-- Création de la table Utilisateurs
CREATE TABLE IF NOT EXISTS Utilisateurs (
    id_utilisateur INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    prenom VARCHAR(100),
    mot_de_passe VARCHAR(255) NOT NULL,
    role ENUM('admin', 'utilisateur') NOT NULL
);

-- Création de la table Voitures
CREATE TABLE IF NOT EXISTS Voitures (
    id_voiture INT AUTO_INCREMENT PRIMARY KEY,
    marque VARCHAR(100) NOT NULL,
    image_path VARCHAR(255) DEFAULT NULL,
    prix DECIMAL(10,2) NOT NULL
);

-- Création de la table Reservations
CREATE TABLE IF NOT EXISTS Reservations (
    id_reservation INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT NOT NULL,
    id_voiture INT NOT NULL,
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL,
    prix_total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateurs(id_utilisateur) ON DELETE CASCADE,
    FOREIGN KEY (id_voiture) REFERENCES Voitures(id_voiture) ON DELETE CASCADE
);

-- Création de la table Disponibilites
CREATE TABLE IF NOT EXISTS Disponibilites (
    id_disponibilite INT AUTO_INCREMENT PRIMARY KEY,
    id_voiture INT NOT NULL,
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL,
    statut ENUM('disponible', 'reserve') NOT NULL,
    FOREIGN KEY (id_voiture) REFERENCES Voitures(id_voiture) ON DELETE CASCADE
);
