# 📌 API en PHP con XAMPP

Esta API fue desarrollada en *PHP* y corre sobre *XAMPP*. Expone endpoints bajo el path:

http://localhost:80/API/v1

## 🚀 Requisitos

- [XAMPP](https://www.apachefriends.org/) instalado (PHP + Apache + MySQL).
- Navegador o cliente REST (ej: [Postman](https://www.postman.com/) o Thunder client en VScode).
- Script SQL para crear la base de datos.

---

## 📥 Instalación

1. Clona o copia los archivos de la API dentro de la carpeta:
C:\xampp\htdocs\

2. Inicia *XAMPP* y habilita:
- Apache
- MySQL

3. Abre [phpMyAdmin](http://localhost/phpmyadmin) e importa el archivo SQL provisto:

- Selecciona la opción *SQLr*.
- Pagar el SQL script para crear la base dedatos
- Esto creará las tablas necesarias para la API.

CREATE TABLE usuarios( 
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    Nombre_usuario VARCHAR(50) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL,
    Nombre_completo VARCHAR(100) NOT NULL
);

CREATE TABLE entradas(
    id_entrada INT PRIMARY KEY AUTO_INCREMENT,
    Tipo_entrada VARCHAR(100) NOT NULL,
    Monto DECIMAL(10,2) NOT NULL,
    Fecha DATE NOT NULL,
    Factura VARCHAR(255),
    id_usuario INT,
    FOREIGN KEY(id_usuario) REFERENCES usuarios(id_usuario)
);

CREATE TABLE salidas(
    id_salidas INT PRIMARY KEY AUTO_INCREMENT,
    Tipo_salida VARCHAR(100) NOT NULL,
    Monto DECIMAL(10,2) NOT NULL,
    Fecha DATE NOT NULL,
    Factura VARCHAR(255),
    id_usuario INT,
    FOREIGN KEY(id_usuario) REFERENCES usuarios(id_usuario)
);

---

## ▶️ Ejecución

Una vez levantado Apache y MySQL en XAMPP, la API estará disponible en: http://localhost:80/API/v1
