-- 1.- Creamos la Base de Datos
create database examen07 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
-- Seleccionamos la base de datos "examen07"
use examen07;


-- 2.- Creamos las tablas
-- 2.1.1.- Tabla tienda
create table if not exists tiendas(
id int auto_increment primary key,
nombre varchar(100) not null,
tlf varchar(13) null
);


-- 2.1.2 .- Tabla familia
create table if not exists familias(
cod varchar(6) primary key,
nombre varchar(200) not null
);


-- 2.1.3.- Tabla producto
create table if not exists productos(
id int auto_increment primary key,
nombre varchar(200) not null,
nombre_corto varchar(50) unique not null,
descripcion text null,
pvp decimal(10, 2) not null,
familia varchar(6) not null,
constraint fk_prod_fam foreign key(familia) references familias(cod) on update
cascade on delete cascade
);


-- 2.1.4 Tabla stocks
create table if not exists stocks(
producto int,
tienda int,
unidades int unsigned not null,
constraint pk_stock primary key(producto, tienda),
constraint fk_stock_prod foreign key(producto) references productos(id) on update
cascade on delete cascade,
constraint fk_stock_tienda foreign key(tienda) references tiendas(id) on update
cascade on delete cascade
);

-- 3. para implementar el login, necesitamos una tabla de usuarios
create table usuarios (
usuario varchar(20) primary key,
pass varchar(64) not null
);

-- 4. para implementar el tracking de votos, necesitamos una tabla de votos
create table votos(
    id int auto_increment primary key,
    cantidad int default 0,
    idPr int not null,
    idUs varchar(20) not null,
    constraint fk_votos_usu foreign key(idUs) references usuarios(usuario) on delete cascade on update cascade,
    constraint fk_votos_pro foreign key(idPr) references productos(id) on delete cascade on update cascade
);

-- 5.- Creamos un usuario que pueda administrar la base de datos 
create user admin07@'localhost' identified by "secreto";
grant all on examen07.* to admin07@'localhost';