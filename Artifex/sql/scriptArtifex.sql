create database artifex;

create table artifex.lingue(
                               id int primary key auto_increment,
                               nome varchar(40)
);

INSERT INTO artifex.lingue (nome) VALUES
                                      ('Italian'),
                                      ('English'),
                                      ('French'),
                                      ('Spanish'),
                                      ('German');


create table artifex.livelli(
                                id int primary key auto_increment,
                                nome varchar(40)
);

insert into artifex.livelli(nome) values
                                      ('normale'),
                                      ('avanzato'),
                                      ('madre lingua');

create table artifex.guide(
                              id int primary key auto_increment,
                              cognome varchar(80),
                              nome varchar(80),
                              data_nascita date,
                              luogo_nascita varchar(120),
                              titolo_studio varchar(120)
);

INSERT INTO artifex.guide (cognome, nome, data_nascita, luogo_nascita, titolo_studio) VALUES
                                                                                          ('Rossi', 'Giovanni', '1980-05-15', 'Roma', 'Laurea in Storia dell’Arte'),
                                                                                          ('Bianchi', 'Maria', '1975-09-25', 'Milano', 'Laurea in Archeologia'),
                                                                                          ('Verdi', 'Antonio', '1985-03-10', 'Napoli', 'Laurea in Architettura'),
                                                                                          ('Neri', 'Lucia', '1990-02-05', 'Firenze', 'Laurea in Storia Medievale'),
                                                                                          ('Gialli', 'Paolo', '1983-11-20', 'Venezia', 'Laurea in Filosofia');


create table artifex.eventi(
                               id int primary key auto_increment,
                               titolo varchar(120),
                               ora_inizio datetime,
                               ora_fine datetime,
                               luogo varchar(120),
                               prezzo float,
                               guida int,
                               lingua int,
                               foreign key (guida) references artifex.guide(id),
                               foreign key(lingua) references artifex.lingue(id)
);

-- Evento 1: Visita al Colosseo
INSERT INTO artifex.eventi (titolo, ora_inizio, ora_fine, luogo, prezzo, guida, lingua) VALUES
    ('Visita al Colosseo', '2025-05-01 10:00:00', '2025-05-01 12:00:00', 'Colosseo, Roma', 20.50, 1, 1);

-- Evento 2: Tour del Museo Egizio
INSERT INTO artifex.eventi (titolo, ora_inizio, ora_fine, luogo, prezzo, guida, lingua) VALUES
    ('Tour del Museo Egizio', '2025-05-02 14:00:00', '2025-05-02 16:00:00', 'Museo Egizio, Torino', 15.00, 2, 2);

-- Evento 3: Passeggiata nel Centro Storico
INSERT INTO artifex.eventi (titolo, ora_inizio, ora_fine, luogo, prezzo, guida, lingua) VALUES
    ('Passeggiata nel Centro Storico', '2025-05-03 09:00:00', '2025-05-03 11:00:00', 'Centro Storico, Napoli', 18.00, 3, 1);

-- Evento 4: Visita a Palazzo Pitti
INSERT INTO artifex.eventi (titolo, ora_inizio, ora_fine, luogo, prezzo, guida, lingua) VALUES
    ('Visita a Palazzo Pitti', '2025-05-04 11:00:00', '2025-05-04 13:00:00', 'Palazzo Pitti, Firenze', 25.00, 4, 1);

-- Evento 5: Tour della Basilica di San Marco
INSERT INTO artifex.eventi (titolo, ora_inizio, ora_fine, luogo, prezzo, guida, lingua) VALUES
    ('Tour della Basilica di San Marco', '2025-05-05 15:00:00', '2025-05-05 17:00:00', 'Basilica di San Marco, Venezia', 22.00, 5, 3);



create table artifex.sapere(
                               id int primary key auto_increment,
                               guida int,
                               lingua int,
                               livello int,
                               foreign key (guida) references artifex.guide(id),
                               foreign key (lingua) references artifex.lingue(id),
                               foreign key (livello) references artifex.livelli(id)
);

-- Giovanni Rossi
INSERT INTO artifex.sapere (guida, lingua, livello) VALUES
                                                        (1, 1, 3),  -- Italiano - Madre lingua
                                                        (1, 2, 2);  -- Inglese - Avanzato

-- Maria Bianchi
INSERT INTO artifex.sapere (guida, lingua, livello) VALUES
                                                        (2, 2, 3),  -- Inglese - Madre lingua
                                                        (2, 3, 2);  -- Francese - Avanzato

-- Antonio Verdi
INSERT INTO artifex.sapere (guida, lingua, livello) VALUES
                                                        (3, 1, 3),  -- Italiano - Madre lingua
                                                        (3, 4, 2);  -- Spagnolo - Avanzato

-- Lucia Neri
INSERT INTO artifex.sapere (guida, lingua, livello) VALUES
                                                        (4, 1, 3),  -- Italiano - Madre lingua
                                                        (4, 5, 1);  -- Tedesco - Normale

-- Paolo Gialli
INSERT INTO artifex.sapere (guida, lingua, livello) VALUES
                                                        (5, 3, 2),  -- Francese - Avanzato
                                                        (5, 4, 3);  -- Spagnolo - Madre lingua


create table artifex.utenti(
                               nome varchar(80),
                               email varchar(120) primary key,
                               password varchar(255),
                               nazionalita varchar(80),
                               lingua int,
                               telefono varchar(90) not null,
                               foreign key(lingua) references artifex.lingue(id)
);

create table artifex.stati(
                              id int primary key auto_increment,
                              nome varchar(80)
);

insert into artifex.stati(nome)
values
    ("Pagato"),("Prenotato");

create table artifex.prenotare(
                                  utente varchar(120),
                                  evento int,
                                  data_pagamento date,
                                  primary key(utente,evento,data_pagamento),
                                  foreign key(utente) references artifex.utenti(email),
                                  foreign key(evento) references artifex.eventi(id)
);
alter table artifex.prenotare
    add data_pagamento date;

update artifex.prenotare
set data_pagamento=CURDATE();

create table artifex.carrello(
                                 utente varchar(120),
                                 evento int,
                                 primary key (utente,evento),
                                 foreign key(utente) references artifex.utenti(email),
                                 foreign key(evento) references artifex.eventi(id)
);

