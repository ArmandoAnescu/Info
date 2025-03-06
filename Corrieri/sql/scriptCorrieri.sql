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
punteggio int,
dipendente varchar(40) foreign key,
foreign key(dipendente) references fastroute.dipendenti(email)
);

create table fastroute.plichi(
id int primary key auto_increment,
consegna datetime ,
ritiro datetime ,
clienti varchar(30) foreign key,
spedizione datetime,
responsabile varchar(40),
stato varchar(20)time foreign key,
sede_partenza varchar(40) foreign key,
sede_arrivo varchar(40) foreign key,
foreign key(stato)references fastroute.stato(nome),
foreign key(sede_partenza)references fastroute.sedi(id),
foreign key(sede_arrivo)references fastroute.sedi(id),
foreign key(cliente) references fastroute.clienti(email)
);