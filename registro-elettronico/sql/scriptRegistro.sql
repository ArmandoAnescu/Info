CREATE DATABASE dbscuolaAnescu;

CREATE TABLE dbscuolaAnescu.materie(
id INT PRIMARY KEY AUTO_INCREMENT ,
nome varchar(90) 
);

INSERT INTO dbscuolaAnescu.materie(nome) VALUES 
('Matematica'),
('Italiano'),
('Inglese'),
('Storia'),
('Scienze');

INSERT INTO dbscuolaAnescu.materie(nome) VALUES 
('Informatica'),
('Sistemi e reti'),
('Chimica'),
('Fisica'),
('Ed. Fisica');

-- hashare con sha256
CREATE TABLE dbscuolaAnescu.credenziali(
id INT PRIMARY KEY AUTO_INCREMENT,
username varchar(120) UNIQUE,
password varchar(256) NOT NULL
);

CREATE TABLE dbscuolaAnescu.indirizzi(
id INT PRIMARY KEY AUTO_INCREMENT,
nome varchar(120) UNIQUE
);

INSERT INTO dbscuolaAnescu.indirizzi (nome) VALUES 
('Informatica'),('Chimica');

CREATE TABLE dbscuolaAnescu.articolazioni(
id INT PRIMARY KEY AUTO_INCREMENT,
indirizzo INT,
nome varchar(120) UNIQUE,
FOREIGN KEY (indirizzo) REFERENCES dbscuolaAnescu.indirizzi(id)
);

INSERT INTO dbscuolaAnescu.articolazioni  (nome,indirizzo) VALUES 
('Informatica',1),('Chimica Organica',2);



INSERT INTO dbscuolaAnescu.credenziali(username, password) VALUES
('marco.rossi', SHA2('password123', 256)),
('giulia.bianchi', SHA2('docente2024', 256)),
('luca.verdi', SHA2('ciao1234', 256)),
('anna.neri', SHA2('genitore456', 256)),
('paolo.gialli', SHA2('personale789', 256)),
('maria.blu', SHA2('admin001', 256));

INSERT INTO dbscuolaAnescu.credenziali(username, password) VALUES
('pippo.beige', SHA2('password456', 256)),
('matteo.panini', SHA2('paninibuoni90', 256)),
('tungtung.sahur', SHA2('sahursahur34', 256)),
('maria.rosa', SHA2('rosarosa123', 256)),
('anna.azzurri', SHA2('azzurro69', 256)),
('simone.limone', SHA2('limoni', 256));

CREATE TABLE dbscuolaAnescu.pianistudio(
id INT PRIMARY KEY AUTO_INCREMENT,
articolazione INT,
materia INT,
FOREIGN key(articolazione) REFERENCES dbscuolaAnescu.articolazioni(id),
FOREIGN KEY (materia) REFERENCES dbscuolaAnescu.materie(id)
);


INSERT INTO dbscuolaAnescu.pianistudio (articolazione, materia) VALUES
(1, 1), (1, 2), (1, 3), (1, 4), (1, 5), (1, 10),(1, 6), (1, 7);

INSERT INTO dbscuolaAnescu.pianistudio (articolazione, materia) VALUES
(2, 1), (2, 2), (2, 3), (2, 4), (2, 5), (2, 10),(2,8);


CREATE TABLE dbscuolaAnescu.persone(
id INT PRIMARY KEY AUTO_INCREMENT,
nome varchar(90),
cognome varchar(90),
data_nascita date,
luogo_nascita varchar(120)
);

INSERT INTO dbscuolaAnescu.persone(nome, cognome, data_nascita, luogo_nascita) VALUES
('Marco', 'Rossi', '2007-04-12', 'Milano'),
('Giulia', 'Bianchi', '1980-06-21', 'Roma'),
('Luca', 'Verdi', '2010-11-03', 'Torino'),
('Anna', 'Neri', '1975-03-30', 'Napoli'),
('Paolo', 'Gialli', '1990-01-20', 'Firenze'),
('Maria', 'Blu', '1985-09-15', 'Genova');

INSERT INTO dbscuolaAnescu.persone(nome, cognome, data_nascita, luogo_nascita) VALUES
('Pippo','Beige','2007-05-23','Catanisetta'),
('Matteo','Panini','2006-02-23','Napoli'),
('Tungtung','Sahur','2004-06-23','Polesella'),
('Maria','Rosa','2007-09-2','Frassinelle'),
('Anna','Azzurri','2007-12-25','Bologna'),
('Simone','Limone','2007-10-30','Rovigo');

CREATE TABLE dbscuolaAnescu.docenti(
id INT PRIMARY KEY AUTO_INCREMENT,
persona INT NOT NULL,
credenziali INT NOT NULL,
FOREIGN KEY (persona) REFERENCES dbscuolaAnescu.persone(id),
FOREIGN key(credenziali) REFERENCES dbscuolaAnescu.credenziali(id)
);

CREATE TABLE dbscuolaAnescu.studenti(
id INT PRIMARY KEY AUTO_INCREMENT,
persona INT NOT NULL,
credenziali INT NOT NULL,
FOREIGN KEY (persona) REFERENCES dbscuolaAnescu.persone(id),
FOREIGN key(credenziali) REFERENCES dbscuolaAnescu.credenziali(id)
);

CREATE TABLE dbscuolaAnescu.genitori(
id INT PRIMARY KEY AUTO_INCREMENT,
persona INT NOT NULL,
credenziali INT NOT NULL,
FOREIGN KEY (persona) REFERENCES dbscuolaAnescu.persone(id),
FOREIGN key(credenziali) REFERENCES dbscuolaAnescu.credenziali(id)
);

CREATE TABLE dbscuolaAnescu.personale(
id INT PRIMARY KEY AUTO_INCREMENT,
persona INT NOT NULL,
credenziali INT NOT NULL,
FOREIGN KEY (persona) REFERENCES dbscuolaAnescu.persone(id),
FOREIGN key(credenziali) REFERENCES dbscuolaAnescu.credenziali(id)
);

CREATE TABLE dbscuolaAnescu.classi(
id INT PRIMARY KEY AUTO_INCREMENT ,
anno char(1),
sezione char(1),
anno_scolastico VARCHAR(50)
);

INSERT INTO dbscuolaAnescu.classi(anno, sezione, anno_scolastico) VALUES 
('1', 'A', '2024/2025'),
('2', 'B', '2024/2025');

ALTER TABLE dbscuolaAnescu.classi
ADD articolazione INT;

UPDATE dbscuolaAnescu.classi c
SET articolazione=1
WHERE c.id=2;
UPDATE dbscuolaAnescu.classi c
SET articolazione=2
WHERE c.id=1;

CREATE TABLE dbscuolaAnescu.partecipare(
alunno INT NOT NULL,
classe INT NOT NULL,
FOREIGN KEY (alunno) REFERENCES dbscuolaAnescu.studenti(id),
FOREIGN KEY (classe) REFERENCES dbscuolaAnescu.classi(id)
);




CREATE TABLE dbscuolaAnescu.docenticlassi(
id INT PRIMARY KEY AUTO_INCREMENT,
docente INT NOT NULL,
classe INT NOT NULL,
materia INT NOT NULL,
FOREIGN KEY (classe) REFERENCES dbscuolaAnescu.classi(id),
FOREIGN KEY (docente) REFERENCES dbscuolaAnescu.docenti(id),
FOREIGN KEY (materia) REFERENCES dbscuolaAnescu.materie(id)
);

CREATE TABLE dbscuolaAnescu.famiglie(
studente INT NOT NULL,
genitore INT NOT NULL,
PRIMARY key(studente,genitore),
FOREIGN KEY (studente) REFERENCES dbscuolaAnescu.studenti(id),
FOREIGN KEY (genitore) REFERENCES dbscuolaAnescu.genitori(id)
);

-- Studente (Marco Rossi)
INSERT INTO dbscuolaAnescu.studenti(persona, credenziali) VALUES (1, 1);

-- Docente (Giulia Bianchi)
INSERT INTO dbscuolaAnescu.docenti(persona, credenziali) VALUES (2, 2);

-- Studente (Luca Verdi)
INSERT INTO dbscuolaAnescu.studenti(persona, credenziali) VALUES (3, 3);

-- Genitore (Anna Neri)
INSERT INTO dbscuolaAnescu.genitori(persona, credenziali) VALUES (4, 4);

-- Personale scolastico (Paolo Gialli)
INSERT INTO dbscuolaAnescu.personale(persona, credenziali) VALUES (5, 5);

-- Altro docente/personale (Maria Blu)
INSERT INTO dbscuolaAnescu.docenti(persona, credenziali) VALUES (6, 6);

-- Giulia Bianchi insegna Matematica nella 1A
INSERT INTO dbscuolaAnescu.docenticlassi(docente, classe, materia) VALUES (1, 1, 1);
-- Giulia Bianchi insegna Matematica nella 2B
INSERT INTO dbscuolaAnescu.docenticlassi(docente, classe, materia) VALUES (1, 2, 3);

-- Maria Blu insegna Italiano nella 2B
INSERT INTO dbscuolaAnescu.docenticlassi(docente, classe, materia) VALUES (2, 2, 2);

-- Anna Neri è genitore di Marco Rossi
INSERT INTO dbscuolaAnescu.famiglie(studente, genitore) VALUES (1, 1);

insert into dbscuolaanescu.studenti(persona,credenziali) VALUES(7,7);

insert into dbscuolaanescu.studenti(persona,credenziali) VALUES(8,8);

insert into dbscuolaanescu.studenti(persona,credenziali) VALUES(9,9);

insert into dbscuolaanescu.studenti(persona,credenziali) VALUES(10,10);

insert into dbscuolaanescu.studenti(persona,credenziali) VALUES(11,11);

insert into dbscuolaanescu.studenti(persona,credenziali) VALUES(12,12);


-- Marco Rossi nella 1A
INSERT INTO dbscuolaAnescu.partecipare(alunno, classe) VALUES (1, 1);
INSERT INTO dbscuolaAnescu.partecipare(alunno, classe) VALUES (5, 1);
INSERT INTO dbscuolaAnescu.partecipare(alunno, classe) VALUES (8, 1);
INSERT INTO dbscuolaAnescu.partecipare(alunno, classe) VALUES (7, 1);


-- Luca Verdi nella 2B
INSERT INTO dbscuolaAnescu.partecipare(alunno, classe) VALUES (2, 2);
INSERT INTO dbscuolaAnescu.partecipare(alunno, classe) VALUES (6, 2);
INSERT INTO dbscuolaAnescu.partecipare(alunno, classe) VALUES (9, 2);
INSERT INTO dbscuolaAnescu.partecipare(alunno, classe) VALUES (10, 2);




