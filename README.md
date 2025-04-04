# Logística

Este proyecto es una aplicación desarrollada en Laravel para gestionar operaciones logísticas.

## Requisitos

Asegúrate de tener instalados los siguientes requisitos antes de continuar:
- PHP 8.2
- Composer
- MySQL o PostgreSQL
- Node.js y npm (para assets front-end si es necesario)
- Docker (opcional, si deseas usar contenedores)

## Instalación

Sigue estos pasos para clonar el repositorio e instalar las dependencias:

```bash
# Clonar el repositorio
git clone https://github.com/luisbayona01/logistica.git
cd logistica

# Instalar dependencias
composer install
npm install  # Si se usa assets front-end

# Configurar el archivo de entorno
cp .env.example .env
php artisan key:generate
```

## Configuración de la Base de Datos

1. Crea una base de datos en MySQL o PostgreSQL.
2. Edita el archivo `.env` y configura las credenciales de la base de datos:

```env
DB_CONNECTION=mysql  # o pgsql si usas PostgreSQL
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_base_de_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

3. Ejecuta las migraciones para crear las tablas:

```bash
php artisan migrate
```

## Ejecución de la Aplicación

Para ejecutar el servidor de desarrollo, usa el siguiente comando:

```bash
php artisan serve
```

Si usas Docker, asegúrate de levantar los contenedores:

```bash
docker-compose up -d
```




## Autor

**Luis Guillermo Bayona**

## Licencia

Este proyecto está bajo la licencia MIT.
