<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


# Auth Services
API donde están los servicios de autenticación de usuario

## Pasos de instalación

#### Importante tener creada la base de datos previamente

1. Clonar el repositorio de https://github.com/DanielZC/auth.git
2. Copiar el archivo .env.example y cambiarle el nombre a .env
3. Reemplazar las variables del archivo original por estas
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pruebaTecnica
DB_USERNAME=root
DB_PASSWORD=
```
4. Ejecutar el comando `composer install` dentro de la carpeta del proyecto
5. Ejecutar las migraciones: `php artisan migrate --seed` esto ejecutará las migraciones del proyecto y un seeder para crear un usuario por defecto para pruebas rápidas
6. Ejecutar el comando `php artisan serve` la API se expone en localhost:8000/
