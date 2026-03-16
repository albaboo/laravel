# Laravel Project

Aplicación desarrollada con **Laravel** para gestionar un ERP.

## 🚀 Características

* API REST con Laravel
* Autenticación de usuarios
* Gestión de recursos mediante CRUD
* Arquitectura limpia siguiendo buenas prácticas
* Integración con base de datos

## 🛠️ Tecnologías

* PHP
* Laravel
* MySQL / PostgreSQL
* Composer
* Node.js / NPM

## 📋 Requisitos

Antes de empezar asegúrate de tener instalado:

* PHP >= 8.x
* Composer
* Node.js y npm
* Base de datos (MySQL/PostgreSQL)
* Git

## ⚙️ Instalación

Clona el repositorio:

```bash
git clone https://github.com/albaboo/laravel.git
cd laravel
```

Instala dependencias de PHP:

```bash
composer install
```

Copia el archivo de entorno:

```bash
cp .env.example .env
```

Configura la base de datos en `.env`.

Genera la key de la aplicación:

```bash
php artisan key:generate
```

Ejecuta las migraciones:

```bash
php artisan migrate
```

Instala dependencias frontend:

```bash
npm install
npm run build
```

## ▶️ Ejecutar el proyecto

```bash
php artisan serve
```

La aplicación estará disponible en:

```
http://localhost:8000
```

## 🧪 Tests

Para ejecutar los tests:

```bash
php artisan test
```

## 📂 Estructura del proyecto

```
app/
bootstrap/
config/
database/
public/
resources/
routes/
storage/
tests/
```

## 📄 Licencia

Este proyecto está bajo la licencia MIT.
