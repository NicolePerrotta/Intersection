CREATE TABLE job_offer
(
  offer_id SERIAL PRIMARY KEY,
  company_id integer NOT NULL, -- company_id SERIAL REFERENCES company(company_id),
  title varchar(100) NOT NULL,
  description text DEFAULT NULL,
  salary varchar(100) DEFAULT NULL,
  period varchar(100) DEFAULT NULL,
  embedding FLOAT4 ARRAY[512]
);

CREATE TABLE applies_to
(
    offer_id SERIAL REFERENCES job_offer(offer_id),
    worker_id SERIAL REFERENCES worker(worker_id)
);