CREATE TABLE
    clientes (
        id_cliente INT AUTO_INCREMENT PRIMARY KEY,
        nombre_cliente VARCHAR(255) NOT NULL,
        correo_cliente VARCHAR(255) UNIQUE NOT NULL,
        telefono_cliente VARCHAR(15),
        fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        estado ENUM ('activo', 'inactivo') DEFAULT 'activo'
    );

CREATE TABLE
    carrito (
        id_carrito INT AUTO_INCREMENT PRIMARY KEY,
        id_cliente INT,
        estado ENUM ('activo', 'inactivo') DEFAULT 'activo',
        fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (id_cliente) REFERENCES clientes (id_cliente)
    );

CREATE TABLE
    rifas (
        id_rifa INT AUTO_INCREMENT PRIMARY KEY,
        nombre_rifa VARCHAR(255) NOT NULL,
        imagen_rifa VARCHAR(255),
        precio_boleto DECIMAL(10, 2) NOT NULL,
        cantidad_boletos INT NOT NULL,
        fecha_inicio DATE NOT NULL,
        fecha_sorteo DATE NOT NULL,
        premio TEXT NOT NULL,
        estado ENUM ('activo', 'inactivo') DEFAULT 'activo'
    );

CREATE TABLE
    numeros_rifa (
        id_numero INT AUTO_INCREMENT PRIMARY KEY,
        id_rifa INT,
        numero INT NOT NULL,
        estado ENUM ('disponible', 'vendido', 'separado') DEFAULT 'disponible',
        id_cliente INT,
        FOREIGN KEY (id_rifa) REFERENCES rifas (id_rifa),
        FOREIGN KEY (id_cliente) REFERENCES clientes (id_cliente)
    );

CREATE TABLE
    carrito_numeros (
        id_carrito INT,
        id_numero INT,
        FOREIGN KEY (id_carrito) REFERENCES carrito (id_carrito),
        FOREIGN KEY (id_numero) REFERENCES numeros_rifa (id_numero)
    );

CREATE TABLE
    sorteos (
        id_sorteo INT AUTO_INCREMENT PRIMARY KEY,
        id_rifa INT,
        fecha_sorteo DATE,
        ganador_id_cliente INT,
        numero_ganador INT,
        estado ENUM (
            'realizado',
            'sin_ganador',
            'sin_reclamo',
            'anulado'
        ) DEFAULT 'sin_ganador',
        FOREIGN KEY (id_rifa) REFERENCES rifas (id_rifa),
        FOREIGN KEY (ganador_id_cliente) REFERENCES clientes (id_cliente)
    );

CREATE TABLE
    ganadores (
        id_ganador INT AUTO_INCREMENT PRIMARY KEY,
        id_sorteo INT,
        id_cliente INT,
        fecha_ganador TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        estado ENUM ('activo', 'inactivo') DEFAULT 'activo',
        FOREIGN KEY (id_sorteo) REFERENCES sorteos (id_sorteo),
        FOREIGN KEY (id_cliente) REFERENCES clientes (id_cliente)
    );

CREATE TABLE
    facturas (
        id_factura INT AUTO_INCREMENT PRIMARY KEY,
        id_cliente INT,
        id_carrito INT,
        fecha_compra TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        metodo_pago VARCHAR(50),
        estado ENUM ('pagado', 'pendiente', 'cancelado') DEFAULT 'pendiente',
        total DECIMAL(10, 2) NOT NULL,
        tipo_compra ENUM ('compra', 'separacion') NOT NULL,
        FOREIGN KEY (id_cliente) REFERENCES clientes (id_cliente),
        FOREIGN KEY (id_carrito) REFERENCES carrito (id_carrito)
    );

CREATE TABLE
    metodos_pago (
        id_pago INT AUTO_INCREMENT PRIMARY KEY,
        nombre_metodo VARCHAR(100) NOT NULL,
        digito_cuenta VARCHAR(50) NOT NULL,
        estado ENUM ('activo', 'inactivo') DEFAULT 'activo'
    );

CREATE TABLE
    empresa (
        id_empresa INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(255) NOT NULL,
        direccion VARCHAR(255) NOT NULL,
        telefono VARCHAR(15) NOT NULL,
        redes_sociales TEXT,
        estado ENUM ('activo', 'inactivo') DEFAULT 'activo'
    );

CREATE TABLE
    admin (
        id_admin INT PRIMARY KEY AUTO_INCREMENT,
        correo VARCHAR(100) UNIQUE NOT NULL,
        contrasena VARCHAR(100) NOT NULL,
        nombre_admin VARCHAR(100) NOT NULL
    );