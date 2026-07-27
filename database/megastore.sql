-- ============================================
-- BASE DE DATOS
-- ============================================

DROP DATABASE IF EXISTS megastore_db;

CREATE DATABASE megastore_db
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

USE megastore_db;

-- ============================================
-- TABLA ROLES
-- ============================================

CREATE TABLE roles(

    id INT AUTO_INCREMENT PRIMARY KEY,

    nombre VARCHAR(30) NOT NULL UNIQUE

)ENGINE=InnoDB;

INSERT INTO roles(nombre)

VALUES

('ADMIN'),
('CLIENTE');

-- ============================================
-- TABLA USUARIOS
-- ============================================

CREATE TABLE usuarios(

    id INT AUTO_INCREMENT PRIMARY KEY,

    rol_id INT NOT NULL DEFAULT 2,

    cedula VARCHAR(13) UNIQUE NOT NULL,

    nombres VARCHAR(100) NOT NULL,

    apellidos VARCHAR(100) NOT NULL,

    email VARCHAR(150) UNIQUE NOT NULL,

    password VARCHAR(255) NOT NULL,

    telefono VARCHAR(20),

    direccion TEXT,

    foto VARCHAR(255) DEFAULT 'default.png',

    estado TINYINT(1) DEFAULT 1,

    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_usuario_rol
    FOREIGN KEY(rol_id)

    REFERENCES roles(id)

);

-- ============================================
-- TABLA CATEGORIAS
-- ============================================

CREATE TABLE categorias(

    id INT AUTO_INCREMENT PRIMARY KEY,

    nombre VARCHAR(100) NOT NULL,

    descripcion TEXT,

    estado TINYINT(1) DEFAULT 1

)ENGINE=InnoDB;

-- ============================================
-- TABLA PRODUCTOS
-- ============================================

CREATE TABLE productos(

    id INT AUTO_INCREMENT PRIMARY KEY,

    categoria_id INT NOT NULL,

    codigo VARCHAR(20) UNIQUE NOT NULL,

    nombre VARCHAR(150) NOT NULL,

    marca VARCHAR(100),

    descripcion TEXT,

    unidad_medida VARCHAR(30),

    precio DECIMAL(10,2) NOT NULL,

    stock INT DEFAULT 0,

    imagen VARCHAR(255) DEFAULT 'default.png',

    estado TINYINT(1) DEFAULT 1,

    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_producto_categoria

    FOREIGN KEY(categoria_id)

    REFERENCES categorias(id)

);

-- ============================================
-- TABLA PEDIDOS
-- ============================================

CREATE TABLE pedidos(

    id INT AUTO_INCREMENT PRIMARY KEY,

    usuario_id INT NOT NULL,

    codigo VARCHAR(20) UNIQUE NOT NULL,

    subtotal DECIMAL(10,2),

    iva DECIMAL(10,2),

    total DECIMAL(10,2),

    metodo_pago VARCHAR(50),

    estado VARCHAR(30) DEFAULT 'PENDIENTE',

    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_pedido_usuario

    FOREIGN KEY(usuario_id)

    REFERENCES usuarios(id)

);

-- ============================================
-- TABLA DETALLE PEDIDOS
-- ============================================

CREATE TABLE detalle_pedidos(

    id INT AUTO_INCREMENT PRIMARY KEY,

    pedido_id INT NOT NULL,

    producto_id INT NOT NULL,

    cantidad INT NOT NULL,

    precio DECIMAL(10,2),

    subtotal DECIMAL(10,2),

    CONSTRAINT fk_detalle_pedido

    FOREIGN KEY(pedido_id)

    REFERENCES pedidos(id)

    ON DELETE CASCADE,

    CONSTRAINT fk_detalle_producto

    FOREIGN KEY(producto_id)

    REFERENCES productos(id)

);

-- ============================================
-- CATEGORIAS
-- ============================================

INSERT INTO categorias(nombre,descripcion)

VALUES

('Herramientas Manuales','Herramientas de uso manual'),

('Herramientas Eléctricas','Equipos eléctricos'),

('Electricidad','Materiales eléctricos'),

('Plomería','Accesorios para agua'),

('Pinturas','Pinturas y accesorios'),

('Tornillería','Pernos y tornillos'),

('Jardinería','Herramientas para jardín'),

('Seguridad Industrial','Equipos de protección');