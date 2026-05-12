-- Creamos la base de datos
create database examen06;

-- La seleccionamos
use examen06;

create user admin06@'localhost' identified by "secreto";
grant all on examen06.* to admin06@'localhost';

 -- Creamos las Tablas --
 create table jugadores(
    id int auto_increment primary key,
    nombre varchar(40) not null,
    apellidos varchar(60) not null,
    dorsal int unique,
    posicion enum('Portero', 'Defensa', 'Lateral Izquierdo', 'Lateral Derecho', 'Central', 'Delantero'),
    barcode varchar(13) unique not null
 );

