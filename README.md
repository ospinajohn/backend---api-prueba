# Api laravel backend

## Requisitos

-   PHP >= 7.3
-   Composer
-   MySQL

# Configuración

Por favor descargar o clonar el otro respositorio frontend y agregarlo en una carpeta junto con este proyecto para poder hacer uso de la aplicación.

[Repositorio frontend](https://github.com/ospinajohn/frontend.git)

```bash
  carpeta raiz
    - backend
    - frontend
```



## Installation

```bash
composer install
```

## Crear el archivo .env

```bash
cp .env.example .env
```

## Generar la key

```bash
php artisan key:generate
```

## Correr las migraciones

```bash
php artisan migrate
```

## Correr el servidor

```bash
php artisan serve
```
