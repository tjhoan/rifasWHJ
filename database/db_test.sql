CREATE TABLE METODOS_PAGO (
    id_metodo_pago INT PRIMARY KEY AUTO_INCREMENT,
    fecha_pago DATE,
    total_pago DECIMAL(10, 2),
    metodo_pago VARCHAR(50),
    id_administrador INT,
    FOREIGN KEY (id_administrador) REFERENCES ADMINISTRADOR(id_administrador)
);

CREATE TABLE CLIENTES (
    cedula VARCHAR(20) PRIMARY KEY,
    primer_nombre VARCHAR(50),
    segundo_nombre VARCHAR(50),
    primer_apellido VARCHAR(50),
    segundo_apellido VARCHAR(50),
    correo VARCHAR(100) UNIQUE NOT NULL,
    celular VARCHAR(20)
);

CREATE TABLE VENTAS (
    id_ventas INT PRIMARY KEY AUTO_INCREMENT,
    factura VARCHAR(50),
    ticket VARCHAR(50),
    estado VARCHAR(20),
    cedula_cliente VARCHAR(20),
    id_metodo_pago INT,
    id_rifa INT,
    FOREIGN KEY (cedula_cliente) REFERENCES CLIENTES(cedula),
    FOREIGN KEY (id_metodo_pago) REFERENCES METODOS_PAGO(id_metodo_pago),
    FOREIGN KEY (id_rifa) REFERENCES RIFA(id_rifa)
);

CREATE TABLE RIFAS (
    id_rifa INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100),
    premio VARCHAR(100),
    precio DECIMAL(10, 2),
    cantidad_numero INT,
    fecha_inicio DATE,
    fecha_sorteo DATE,
    id_administrador INT,
    id_sorteo INT,
    FOREIGN KEY (id_administrador) REFERENCES ADMINISTRADOR(id_administrador),
    FOREIGN KEY (id_sorteo) REFERENCES SORTEO(id_sorteo)
);

CREATE TABLE GANADORES (
    id_ganador INT PRIMARY KEY AUTO_INCREMENT,
    boletos_ganador VARCHAR(100),
    nombre_ganador VARCHAR(100),
    id_sorteo INT,
    id_rifa INT,
    FOREIGN KEY (id_sorteo) REFERENCES SORTEO(id_sorteo),
    FOREIGN KEY (id_rifa) REFERENCES RIFA(id_rifa)
);

CREATE TABLE SORTEOS (
    id_sorteo INT PRIMARY KEY AUTO_INCREMENT,
    fecha_realizacion DATE,
    estado VARCHAR(20)
);

CREATE TABLE IMAGEN_RIFA (
    id_imagen INT PRIMARY KEY AUTO_INCREMENT,
    ruta_imagen VARCHAR(255),
    id_rifa INT,
    FOREIGN KEY (id_rifa) REFERENCES RIFA(id_rifa)
);

CREATE TABLE CARRITO (
    id_carrito INT PRIMARY KEY AUTO_INCREMENT,
    fecha_creacion DATE,
    id_rifa INT,
    FOREIGN KEY (id_rifa) REFERENCES RIFA(id_rifa)
);

CREATE TABLE ADMINISTRADORES (
    id_administrador INT PRIMARY KEY AUTO_INCREMENT,
    correo VARCHAR(100) UNIQUE NOT NULL,
    contrasena VARCHAR(100),
    nombre_admin VARCHAR(100)
);

CREATE TABLE DATOS_EMPRESA (
    NIT VARCHAR(20) PRIMARY KEY,
    nombre_empresa VARCHAR(100),
    direccion VARCHAR(255),
    celular VARCHAR(20),
    redes_sociales VARCHAR(255),
    id_administrador INT,
    FOREIGN KEY (id_administrador) REFERENCES ADMINISTRADOR(id_administrador)
);