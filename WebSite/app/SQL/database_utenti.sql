CREATE EXTENSION citext;
CREATE DOMAIN email AS citext
  CHECK ( value ~ '^[a-zA-Z0-9.!#$%&''*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$' );

CREATE TABLE worker
(
   worker_id SERIAL PRIMARY KEY,
   name VARCHAR(30) NOT NULL,
   surname VARCHAR(30) NOT NULL,
   username VARCHAR(50) UNIQUE,
   email EMAIL UNIQUE,
   password VARCHAR(50) UNIQUE,
   birth_date DATE NOT NULL,
   address VARCHAR(50),
   city VARCHAR(50),
   country VARCHAR(50),
   genre VARCHAR(50),
   contact_email VARCHAR(100) NOT NULL,
   telephone_number VARCHAR(50),
   curriculum BYTEA NOT NULL,
   embedding FLOAT4 ARRAY[512] NOT NULL,
   picture BYTEA
);

CREATE TABLE company
(
   company_id SERIAL PRIMARY KEY,
   company_name varchar(50) NOT NULL,
   username varchar(50) UNIQUE,
   email email UNIQUE,
   password varchar(50) UNIQUE,
   VAT_number varchar(50) UNIQUE,
   address varchar(50),
   city varchar(50),
   country varchar(50),
   description text NOT NULL,
   contact_email VARCHAR(100) NOT NULL,
   telephone_number varchar(75),
   logo BYTEA
);