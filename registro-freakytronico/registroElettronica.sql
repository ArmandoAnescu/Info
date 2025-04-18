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





-- hashare con sha256

CREATE TABLE dbscuolaAnescu.credenziali(

id INT PRIMARY KEY AUTO_INCREMENT,

username varchar(120) UNIQUE,

password varchar(256) NOT NULL

);



INSERT INTO dbscuolaAnescu.credenziali(username, password) VALUES

('marco.rossi', SHA2('password123', 256)),

('giulia.bianchi', SHA2('docente2024', 256)),

('luca.verdi', SHA2('ciao1234', 256)),

('anna.neri', SHA2('genitore456', 256)),

('paolo.gialli', SHA2('personale789', 256)),

('maria.blu', SHA2('admin001', 256));





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



CREATE TABLE dbscuolaAnescu.partecipare(

alunno INT NOT NULL,

classe INT NOT NULL,

FOREIGN KEY (alunno) REFERENCES dbscuolaAnescu.studenti(id),

FOREIGN KEY (classe) REFERENCES dbscuolaAnescu.classi(id)

);



-- Marco Rossi nella 1A

INSERT INTO dbscuolaAnescu.partecipare(alunno, classe) VALUES (1, 1);



-- Luca Verdi nella 2B

INSERT INTO dbscuolaAnescu.partecipare(alunno, classe) VALUES (2, 2);





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



-- Maria Blu insegna Italiano nella 2B

INSERT INTO dbscuolaAnescu.docenticlassi(docente, classe, materia) VALUES (2, 2, 2);



-- Anna Neri è genitore di Marco Rossi

INSERT INTO dbscuolaAnescu.famiglie(studente, genitore) VALUES (1, 1);
