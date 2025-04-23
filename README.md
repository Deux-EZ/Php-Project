# 🌸 AnimePink Store - Sistema de Login

[![PHP Version](https://img.shields.io/badge/PHP-8.0%2B-pink.svg)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-pink.svg)](https://www.mysql.com/)
[![License](https://img.shields.io/badge/License-MIT-pink.svg)](LICENSE)

Sistema de autenticación desarrollado en PHP con diseño temático de anime.

## ✨ Características

- 🔐 Sistema de login seguro
- 👤 Registro de usuarios
- 🛡️ Protección contra inyección SQL
- 🎨 Diseño responsivo y amigable
- 🌈 Tema personalizado anime/kawaii
- 📱 Interfaz adaptable a dispositivos móviles

## 🚀 Tecnologías

- PHP 8.0+
- MySQL/MariaDB
- HTML5 & CSS3
- JavaScript
- FontAwesome Icons

## 📂 Estructura del Proyecto

```
Php-login/
├── app/
│   ├── config/
│   │   ├── config.php
│   │   └── database.php
│   ├── controllers/
│   │   ├── AuthController.php
│   │   ├── BaseController.php
│   │   ├── HomeController.php
│   │   └── UserController.php
│   ├── models/
│   │   └── User.php
│   └── views/
│       ├── auth/
│       ├── home/
│       ├── layouts/
│       └── users/
├── public/
│   ├── assets/
│   │   ├── css/
│   │   ├── img/
│   │   └── js/
│   └── index.php
└── .env
```

## 💻 Requisitos

- PHP 8.0 o superior
- MySQL/MariaDB
- Servidor web (Apache/Nginx)
- Composer (opcional)

## ⚙️ Instalación

1. Clona el repositorio:
```bash
git clone https://github.com/tuusuario/Php-login.git
```

2. Configura tu archivo `.env`:
```env
DB_HOST=localhost
DB_PORT=3307
DB_USER=root
DB_PASS=
DB_NAME=bdtest
APP_URL=http://localhost/Php-login
```

3. Importa la base de datos:
```sql
CREATE TABLE login (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);
```

## 🔒 Seguridad

- Contraseñas hasheadas con `password_hash()`
- Protección contra XSS
- Validación de formularios
- Manejo seguro de sesiones


## 🌟 Autor

- [@Deux-EZ](https://github.com/Deux-EZ)

---
⌨️ con ❤️ por [Santiago Gonzalez] 🌸