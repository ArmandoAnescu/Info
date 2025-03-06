create database fastroute;

create table fastroute.stati(
    nome varchar(20) primary key
);
create table fastroute.sedi(
                               id int primary key auto_increment ,
                               nome varchar(40),
                               luogo varchar(40)
);

create table fastroute.dipendenti(
                                     email varchar(40) primary key,
                                     password varchar(40),
                                     nome varchar(40)
);

create table fastroute.clienti(
                                  nome varchar(20),
                                  cognome varchar(20),
                                  indirizzo varchar(40),
                                  telefono varchar(30),
                                  email varchar(30) primary key,
                                  punteggio int
);

create table fastroute.plichi(
    id int primary key auto_increment,
    consegna datetime ,
    ritiro datetime ,
    cliente varchar(30),
    spedizione datetime,
    responsabile varchar(40),
    stato varchar(20),
    sede_partenza int,
    sede_arrivo int,
    foreign key(stato)references fastroute.stati(nome),
            foreign key(sede_partenza)references fastroute.sedi(id),
                                 foreign key(sede_arrivo)references fastroute.sedi(id),
                                 foreign key(cliente)references fastroute.clienti(email)
);