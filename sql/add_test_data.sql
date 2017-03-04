-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Kayttaja (nimi, password, email) VALUES ('Jussi', 'Jussinsalasana', 'jussi@helsinki.fi');
INSERT INTO Kayttaja (nimi, password, email) VALUES ('Pekka', 'Pekansalasana', 'pekka@helsinki.fi');
INSERT INTO Kayttaja (nimi, password, email) VALUES ('testi', 'testi', 'testi@testi.fi');

INSERT INTO Huone (nimi, kuvaus) VALUES ('Pelit', 'Keskustelua peleistä');
INSERT INTO Huone (nimi, kuvaus) VALUES ('Yliopisto', 'Yliopiston huone');
INSERT INTO Huone (nimi, kuvaus) VALUES ('Ohjelmointi', 'CS chillaushuone');
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