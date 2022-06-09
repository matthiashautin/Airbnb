-- CREATE DATABASE Airbnb;
-- use Airbnb;
CREATE TABLE Region (
  ID int PRIMARY KEY AUTO_INCREMENT,
  Nom varchar(255) NOT NULL UNIQUE
);
CREATE TABLE Typelmmo (
  ID int PRIMARY KEY AUTO_INCREMENT,
  Lib varchar(255) NOT NULL UNIQUE,
  PrixMin int
);
CREATE TABLE Services (
  ID int PRIMARY KEY AUTO_INCREMENT,
  Libelle varchar(255) NOT NULL UNIQUE
);
CREATE TABLE Piece (
  ID int PRIMARY KEY AUTO_INCREMENT,
  Nom VARCHAR(255) UNIQUE
);
CREATE TABLE Client (
ID int PRIMARY KEY AUTO_INCREMENT,
Nom VARCHAR(255) NOT NULL,
Prenom VARCHAR(255) NOT NULL,
Email VARCHAR(255) UNIQUE NOT NULL,
Phone VARCHAR(255) UNIQUE NOT NULL,
Passwords VARCHAR(255) NOT NULL,
Adresse VARCHAR(255) NULL,
Hote INT NOT NULL,
    CONSTRAINT CHK_Hote CHECK (Hote = 0 or Hote = 1),
DateCreation DATETIME NOT NULL,
DateModification DATETIME NOT NULL
);
CREATE TABLE Annonce (
  ID int PRIMARY KEY AUTO_INCREMENT,
  Publication INT NOT NULL,
  CONSTRAINT CHK_Publication CHECK 
  (Publication = 0 or Publication = 1),
  PrixHT FLOAT NOT NULL,
  Adresse varchar(255) NOT NULL,
  DateCreation DATETIME NOT NULL,
  DateModification DATETIME NOT NULL,
  Client_ID INT NOT NULL,
  Typelmmo_ID INT NOT NULL,
  Region_ID INT NULL,
  CONSTRAINT FK_AnnonceClient FOREIGN KEY (Client_ID) REFERENCES Client(ID),
  CONSTRAINT FK_AnnonceTypelmmo FOREIGN KEY (Typelmmo_ID) REFERENCES Typelmmo(ID),
  CONSTRAINT FK_AnnonceRegion FOREIGN KEY (Region_ID) REFERENCES Region(ID)
);
CREATE TABLE Commentaire (
    ID int PRIMARY KEY AUTO_INCREMENT,
    Avis VARCHAR(255) NULL,
    Note INT NOT NULL,
    DateModification DATETIME NOT NULL,
    Client_ID INT NOT NULL,
    Annonce_ID INT NOT NULL,
    CONSTRAINT FK_CommentaireClient FOREIGN KEY (Client_ID) REFERENCES Client(ID),
    CONSTRAINT FK_CommentaireAnnonce FOREIGN KEY (Annonce_ID) REFERENCES Annonce(ID)
  );
CREATE TABLE Fournir (
    Service_ID INT,
    Annonce_ID INT,
    CONSTRAINT FK_FournirService FOREIGN KEY (Service_ID) REFERENCES Services(ID),
    CONSTRAINT FK_FournirAnnonce FOREIGN KEY (Annonce_ID) REFERENCES Annonce(ID),
    PRIMARY KEY (Service_ID, Annonce_ID)
  );
CREATE TABLE Photo (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Chemin VARCHAR(255) NOT NULL,
    Annonce_ID INT NOT NULL,
    CONSTRAINT FK_PhotoAnnonce FOREIGN KEY (Annonce_ID) REFERENCES Annonce(ID)
  );
CREATE TABLE Posseder (
    Piece_ID INT,
    Annonce_ID INT,
    Quantite INT NOT NULL,
    CONSTRAINT CHK_Quantite CHECK (Quantite < 10),
    CONSTRAINT FK_PossederPiece FOREIGN KEY (Piece_ID) REFERENCES Piece(ID),
    CONSTRAINT FK_PossederAnnonce FOREIGN KEY (Annonce_ID) REFERENCES Annonce(ID),
    PRIMARY KEY (Piece_ID, Annonce_ID)
  );
  ALTER TABLE
    Posseder
  modify
    Quantite INT NOT NULL DEFAULT 1,
    drop CONSTRAINT CHK_Quantite,
  add
    CONSTRAINT CHK_Quantite CHECK (Quantite < 100);
CREATE TABLE Reservation (
      Annonce_ID INT,
      Client_ID INT,
      DateDebut DATETIME,
      DateFin DATETIME NOT NULL,
      CONSTRAINT FK_ReservationAnnonce FOREIGN KEY (Annonce_ID) REFERENCES Annonce(ID),
      CONSTRAINT FK_ReservationClient FOREIGN KEY (Client_ID) REFERENCES Client(ID),
      PRIMARY KEY (Annonce_ID, Client_Id, DateDebut)
    );
CREATE TABLE TVA (
      ID INT PRIMARY KEY AUTO_INCREMENT,
      Taux INT NOT NULL,
      DateDepart DATETIME UNIQUE NOT NULL
    );

  INSERT INTO
    Client (
      ID,
      Nom,
      Prenom,
      Email,
      Phone,
      Passwords,
      Adresse,
      Hote,
      DateCreation,
      DateModification
    )
  VALUES
    (
      0,
      'Hautin',
      'Matthias',
      'matthiashautin@gmail.com',
      0787410356,
      'Admin',
      'LePerreuxsurMarne',
      1,
      20220118,
      20220203
    );

  INSERT INTO
    Region (ID, Nom)
  VALUES
    (0, 'Bretagne');
  INSERT INTO
    Region (ID, Nom)
  VALUES
    (1, 'IleDeFrance');
  INSERT INTO
    Services (ID, Libelle)
  VALUES
    (0, 'Wifi');
  INSERT INTO
    Services (ID, Libelle)
  VALUES
    (1, 'Télé');
  INSERT INTO
    Typelmmo (ID, Lib, PrixMin)
  VALUES
    (0 ,'Maison',50 );
 INSERT INTO
    Typelmmo (ID, Lib, PrixMin)
  VALUES
    (1 ,'Appart',50 );
  INSERT INTO
    Annonce (
      ID,
      Publication,
      PrixHT,
      Adresse,
      DateCreation,
      DateModification,
      Client_ID,
      Typelmmo_ID,
      Region_ID
    )
  VALUES
    (
      0,
      1,
      300,
      '4 Bd Copernic, 77420 Champs-sur-Marne',
      20220203,
      20220203,
      0,
      0,
      1
    );
  INSERT INTO
    Piece (ID, Nom)
  VALUES
    (0, 'Chambre');
  INSERT INTO
    Piece (ID, Nom)
  VALUES
    (1, 'Cuisine');
  INSERT INTO
    Piece (ID, Nom)
  VALUES
    (2, 'SalleDeBain');
  INSERT INTO
    Piece (ID, Nom)
  VALUES
    (3, 'Salon');
  INSERT INTO
    Posseder (Piece_ID, Annonce_ID, Quantite)
    /* Chambre = 4*/
  VALUES
    (0, 0, 1);
  INSERT INTO 
    Posseder (Piece_ID, Annonce_ID, Quantite)
    /* Cuisine = 1*/
  VALUES
    (1, 0, 1);
  INSERT INTO
    Posseder (Piece_ID, Annonce_ID, Quantite)
    /* Salle de Bain = 2*/
  VALUES
    (2, 0, 2);
  INSERT INTO
    Posseder (Piece_ID, Annonce_ID, Quantite)
    /* Salon = 1*/
  VALUES
    (3, 0, 1);
  INSERT INTO
    Reservation (Annonce_ID, Client_ID, DateDebut, DateFin)
  VALUES
    (0, 0, 20220705, 20220720);