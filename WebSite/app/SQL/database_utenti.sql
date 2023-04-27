CREATE EXTENSION citext;
CREATE DOMAIN email AS citext
  CHECK ( value ~ '^[a-zA-Z0-9.!#$%&''*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$' );

CREATE TABLE Utente
(
   ID_User SERIAL PRIMARY KEY,
   Nome varchar(30) NOT NULL,
   Cognome varchar(30) NOT NULL,
   Username varchar(50) UNIQUE,
   Email email UNIQUE,
   Pwd varchar(50) UNIQUE,
   DataNascita date NOT NULL,
   Indirizzo varchar(50),
   Citta varchar(50),
   Nazione varchar(50),
   Genere varchar(50),
   EmailDiContatto email,
   NumeroDiContatto varchar(50)
);

CREATE TABLE Azienda
(
   ID_Azienda SERIAL PRIMARY KEY,
   Ragione_Sociale varchar(50) NOT NULL,
   Username varchar(50) UNIQUE,
   Email email UNIQUE,
   Pwd varchar(50) UNIQUE,
   Partita_Iva numeric(11,0) UNIQUE,
   Indirizzo varchar(50),
   Citta varchar(50),
   Nazione varchar(50),
   Descrizione text NOT NULL,
   EmailDiContatto email UNIQUE,
   NumeroDiContatto varchar(75)
);