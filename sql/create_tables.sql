-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Kayttaja(
  id SERIAL PRIMARY KEY,
  nimi varchar(50) NOT NULL,
  password varchar(255) NOT NULL,
  email varchar(255), 
  taso INTEGER DEFAULT 1
);

CREATE TABLE Huone(
  id SERIAL PRIMARY KEY,
  nimi varchar(50) NOT NULL,
  kuvaus varchar(255)
);

CREATE TABLE HuoneKayttaja(
  id SERIAL PRIMARY KEY,
  kayttaja_id INTEGER REFERENCES Kayttaja(id),
  huone_id INTEGER REFERENCES Huone(id)
);

CREATE TABLE Viesti(
  id SERIAL PRIMARY KEY,
  kayttaja_id INTEGER REFERENCES Kayttaja(id),
  huone_id INTEGER REFERENCES Huone(id),
  sisalto varchar(100) NOT NULL,
  lahetysaika timestamp DEFAULT CURRENT_TIMESTAMP
);
