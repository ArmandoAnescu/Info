create database negozioelettronica;
create table negozioelettronica.prodotti(
codice int primary key,
descrizione varchar(255),
costo float not null,
quantita int not null,
data_produzione date not null,
check(quantita>=0 and costo>=1)
);

create table negozioelettronica.utenti(
 nome varchar(50) not null,
 pwd varchar(255) not null,
 email varchar(50) primary key,
 amministratore bool not null
 );

insert into negozioelettronica.utenti (nome,pwd,email,amministratore) values 
('Admin','$2y$10$o5bPXNdxIfZlSLwRxX.uru064be5vNZv1Ilzc4mfEPev3mxO6N76S','admin@admin.com',true);

INSERT INTO negozioelettronica.prodotti (codice, descrizione, costo, quantita, data_produzione)
VALUES
    (1, 'Smartphone Samsung Galaxy', 299.99, 50, '2024-03-01'),
    (2, 'Laptop HP Pavilion', 899.99, 30, '2023-12-15'),
    (3, 'Wireless Headphones Sony', 129.99, 100, '2025-01-10'),
    (4, '4K Ultra HD TV LG', 799.99, 20, '2024-05-20'),
    (5, 'Smartwatch Apple Series 8', 399.99, 75, '2025-02-10'),
    (6, 'Bluetooth Speaker Bose', 149.99, 80, '2023-11-12'),
    (7, 'Gaming Mouse Razer', 59.99, 200, '2024-06-01'),
    (8, 'Keyboard Logitech G Pro', 129.99, 150, '2024-07-01'),
    (9, 'External Hard Drive Seagate 2TB', 99.99, 40, '2023-10-10'),
    (10, 'Tablet Microsoft Surface Pro', 499.99, 60, '2024-02-25');