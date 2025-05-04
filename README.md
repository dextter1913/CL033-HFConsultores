# Instalación del Proyecto

Sigue estos pasos para instalar y levantar el proyecto utilizando Docker y Laravel Sail.

## 1. Instalar dependencias con Composer

Ejecuta el siguiente comando para instalar las dependencias usando Composer dentro de un contenedor Docker:

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

## 2. Levantar los servicios con Sail

Inicia los servicios necesarios en segundo plano:

```bash
./vendor/bin/sail up -d
```

## 3. Crear el archivo `.env`

Crea un archivo `.env` en la raíz del proyecto y copia el siguiente contenido:

```env
APP_NAME=CL033-HFConsultores
APP_ENV=local
APP_KEY=base64:+osVQRvOeMfHXde5RnVx1f65f/8vUcmAC1EO1R6mXQ8=
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://4sides.test

APP_LOCALE=es
APP_FALLBACK_LOCALE=es
APP_FAKER_LOCALE=es_MX

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=proyecto_prueba
DB_USERNAME=sail
DB_PASSWORD=password

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=
MAIL_PORT=80
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=""
MAIL_FROM_NAME=""

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"
```

## 4. Migrar y poblar la base de datos

Ejecuta las migraciones y los seeders:

```bash
./vendor/bin/sail migrate:refresh --seed
```

## 5. Instalar dependencias de Node.js

Instala las dependencias de frontend:

```bash
./vendor/bin/sail npm i
```

## 6. Compilar los assets

Compila los assets para desarrollo:

```bash
./vendor/bin/sail npm run dev
```

¡Listo! El proyecto debería estar corriendo y listo para usarse.
