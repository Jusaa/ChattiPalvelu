-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Kayttaja (nimi, password) VALUES ('Jussi', 'Jussinsalasana');
INSERT INTO Kayttaja (nimi, password) VALUES ('Pekka', 'Pekansalasana');

INSERT INTO Huone (nimi) VALUES ('Pelit');
INSERT INTO Huone (nimi) VALUES ('Yliopisto');
INSERT INTO Huone (nimi) VALUES ('Ohjelmointi');
INSERT INTO Huone (nimi) VALUES ('Random');

INSERT INTO HuoneKayttaja (kayttaja_id, huone_id) VALUES ('1', '1');
INSERT INTO HuoneKayttaja (kayttaja_id, huone_id) VALUES ('1', '2');
INSERT INTO HuoneKayttaja (kayttaja_id, huone_id) VALUES ('1', '4');
INSERT INTO HuoneKayttaja (kayttaja_id, huone_id) VALUES ('2', '1');
INSERT INTO HuoneKayttaja (kayttaja_id, huone_id) VALUES ('2', '2');
INSERT INTO HuoneKayttaja (kayttaja_id, huone_id) VALUES ('2', '3');

INSERT INTO Viesti (kayttaja_id, huone_id, sisalto) VALUES ('1', '1', 'Sistaltooooo');
INSERT INTO Viesti (kayttaja_id, huone_id, sisalto) VALUES ('1', '2', 'Huehuehhehehe');
INSERT INTO Viesti (kayttaja_id, huone_id, sisalto) VALUES ('2', '2', 'LELELELELE');