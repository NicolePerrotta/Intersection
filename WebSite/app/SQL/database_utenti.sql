/*
CREATE EXTENSION citext;
CREATE DOMAIN email AS citext
  CHECK ( value ~ '^[a-zA-Z0-9.!#$%&''*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$' );
*/

CREATE TABLE worker
(
   worker_id SERIAL PRIMARY KEY,
   name varchar(100) NOT NULL,
   surname varchar(100) NOT NULL,
   username varchar(100) UNIQUE,
   email varchar(100) UNIQUE,
   password varchar(100) UNIQUE,
   birth_date DATE NOT NULL,
   address varchar(100),
   city varchar(100),
   country varchar(100),
   gender varchar(50),
   contact_email varchar(100) NOT NULL,
   telephone_number varchar(100),
   curriculum BYTEA NOT NULL,
   embedding FLOAT4 ARRAY[512] NOT NULL,
   picture BYTEA
);

CREATE TABLE company
(
   company_id SERIAL PRIMARY KEY,
   company_name varchar(100) NOT NULL,
   username varchar(100) UNIQUE,
   email varchar(100) UNIQUE,
   password varchar(100) UNIQUE,
   VAT_number varchar(100) UNIQUE,
   address varchar(100),
   city varchar(100),
   country varchar(100),
   description text NOT NULL,
   contact_email varchar(100) NOT NULL,
   telephone_number varchar(100),
   logo BYTEA
);