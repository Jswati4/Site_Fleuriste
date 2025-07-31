SQL – bdd / Mysite FLEURISTE

/*BDD : CREATE TABLE*/
CREATE TABLE Client(
   id_c VARCHAR(50),
   nom VARCHAR(50),
   prenom VARCHAR(50),
   email VARCHAR(50),
   adresse VARCHAR(50),
   num_de_tel VARCHAR(10),
   mdp VARCHAR(50),
   PRIMARY KEY(id_c)
);

CREATE TABLE Commande(
   id_co VARCHAR(50),
   date_co DATE,
   message_personnel VARCHAR(50),
   mode_de_paiement VARCHAR(50),
   total_de_co VARCHAR(50),
   PRIMARY KEY(id_co)
);

CREATE TABLE adresse_livraison(
   id_adr VARCHAR(50),
   adresse VARCHAR(50),
   ville VARCHAR(50),
   code_postal VARCHAR(50),
   pays VARCHAR(50),
   id_c VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_adr),
   FOREIGN KEY(id_c) REFERENCES Client(id_c)
);

CREATE TABLE promotion(
   id_promo VARCHAR(50),
   code_promo VARCHAR(4),
   pourcentage_de_reduc VARCHAR(2),
   date_debut DATE,
   date_fin DATE,
   PRIMARY KEY(id_promo)
);

CREATE TABLE Bouquet(
   id_b VARCHAR(50),
   nom_b_standard VARCHAR(50),
   prix_b_standard DECIMAL(15,2),
   PRIMARY KEY(id_b)
);

CREATE TABLE Fleurs(
   Id_Fleurs VARCHAR(50),
   nom_fleur VARCHAR(50),
   prix_f DECIMAL(15,2),
   PRIMARY KEY(Id_Fleurs)
);

CREATE TABLE Bouquet_Personnalisé(
   Id_Bouquet_Personnalisé VARCHAR(50),
   prix_bp DECIMAL(15,2),
   PRIMARY KEY(Id_Bouquet_Personnalisé)
);

CREATE TABLE Choisir(
   id_c VARCHAR(50),
   Id_Fleurs VARCHAR(50),
   Id_Bouquet_Personnalisé VARCHAR(50),
   quantité INT,
   PRIMARY KEY(id_c, Id_Fleurs, Id_Bouquet_Personnalisé),
   FOREIGN KEY(id_c) REFERENCES Client(id_c),
   FOREIGN KEY(Id_Fleurs) REFERENCES Fleurs(Id_Fleurs),
   FOREIGN KEY(Id_Bouquet_Personnalisé) REFERENCES Bouquet_Personnalisé(Id_Bouquet_Personnalisé)
);
CREATE TABLE Commander(
   id_c VARCHAR(50),
   id_co VARCHAR(50),
   PRIMARY KEY(id_c, id_co),
   FOREIGN KEY(id_c) REFERENCES Client(id_c),
   FOREIGN KEY(id_co) REFERENCES Commande(id_co)
);

CREATE TABLE Composer (
   id_composer VARCHAR(50),  -- un identifiant unique pour chaque composition
   id_co VARCHAR(50),
   id_b VARCHAR(50) DEFAULT NULL,
   Id_Bouquet_Personnalisé VARCHAR(50) DEFAULT NULL,
   PRIMARY KEY(id_composer),
   FOREIGN KEY(id_co) REFERENCES Commande(id_co),
   FOREIGN KEY(id_b) REFERENCES Bouquet(id_b),
   FOREIGN KEY(Id_Bouquet_Personnalisé) REFERENCES Bouquet_Personnalisé(Id_Bouquet_Personnalisé)
);
CREATE TABLE Appliquer(
   id_co VARCHAR(50),
   id_promo VARCHAR(50),
   PRIMARY KEY(id_co, id_promo),
   FOREIGN KEY(id_co) REFERENCES Commande(id_co),
   FOREIGN KEY(id_promo) REFERENCES promotion(id_promo)
);


ALTER TABLE Fleurs ADD COLUMN stock INT DEFAULT 100;






/*BDD : INSERT INTO*/

INSERT INTO Client (id_c, nom, prénom, email, adresse, num_de_tel, mdp) 
VALUES ('C1', Durant, 'Alice', 'alice.durant@gmail.com', '12 rue des Lilas, Paris', '0612345678', '$2y$10$eImiTXuWVxfM37uY4JANjQ== ');

INSERT INTO Client (id_c, nom, prénom, email, adresse, num_de_tel, mdp) 
VALUES ('C2', 'De Aron', 'Bianca', 'bianca.dearon @example.com', '45 avenue Victor Hugo, Lyon', '0787654321', '$2y$10$0AItP1Vv4ydwV2ePzciy5 ');
INSERT INTO Client (id_c, nom, prénom, email, adresse, num_de_tel, mdp) 
VALUES ('C3', ‘Rose’, 'Wilona', 'wilona.rose@gmail.com', '27 rue des Ladies, Paris', '0627201203', ' As271213W&*');

INSERT INTO Bouquet (id_b, nom_b_standard, prix_b_standard) 
VALUES ('B1', 'Bouquet Roses Passion', 39.90);

INSERT INTO Choisir (id_c, Id_Fleurs, Id_Bouquet_Personnalisé, quantité)
VALUES ('C1', 'F1', 'BP1', 5);

INSERT INTO Choisir (id_c, Id_Fleurs, Id_Bouquet_Personnalisé, quantité)
VALUES ('C1', 'F2', 'BP1', 3);




INSERT INTO Bouquet (id_b, nom_b_standard, prix_b_standard) 
VALUES ('B2', 'Bouquet Printemps Frais', 29.50);

INSERT INTO Fleurs (Id_Fleurs, nom_fleur, prix_f) 
VALUES ('F1', 'Rose rouge', 2);

INSERT INTO Fleurs (Id_Fleurs, nom_fleur, prix_f) 
VALUES ('F2', 'Tulipe jaune', 1.80);

INSERT INTO promotion (id_promo, code_promo, pourcentage_de_reduc, date_debut, date_fin) 
VALUES ('P1', 'FLO1', '10', '2025-06-20', '2025-06-30');

INSERT INTO promotion (id_promo, code_promo, pourcentage_de_reduc, date_debut, date_fin) 
VALUES ('P2', 'ETE2', '15', '2025-07-01', '2025-07-13');

INSERT INTO promotion (id_promo, code_promo, pourcentage_de_reduc, date_debut, date_fin) 
VALUES ('P3', 'Sum3', '20', '2025-07-31', '2025-08-13');

INSERT INTO Commande (id_co, date_co, message_personnel, mode_de_paiement, total_de_co) 
VALUES ('CO1', '2025-06-18', 'Joyeux anniversaire !', 'Carte bancaire', '49.90');

INSERT INTO Commande (id_co, date_co, message_personnel, mode_de_paiement, total_de_co) 
VALUES ('CO2', '2025-06-19', 'Avec tout mon amour', 'PayPal', '75.50');

INSERT INTO Bouquet_Personnalisé (Id_Bouquet_Personnalisé, prix_bp) 
VALUES ('BP1', 15.00);

INSERT INTO Bouquet_Personnalisé (Id_Bouquet_Personnalisé, prix_bp) 
VALUES ('BP2', 80.50);

INSERT INTO adresse_livraison (id_adr, adresse, ville, code_postal, pays, id_c) 
VALUES ('ADR1', '12 rue des Lilas', 'Paris', '75012', 'France', 'C1');

INSERT INTO adresse_livraison (id_adr, adresse, ville, code_postal, pays, id_c) 
VALUES ('ADR2', '45 avenue Victor Hugo', 'Lyon', '69006', 'France', 'C2');

INSERT INTO Appliquer (id_co, id_promo) 
VALUES ('CO1', 'P1');

INSERT INTO Appliquer (id_co, id_promo) 
VALUES ('CO2', 'P2');

INSERT INTO Commander (id_c, id_co) 
VALUES ('C1', 'CO1');

INSERT INTO Commander (id_c, id_co) 
VALUES ('C2', 'CO2');





























