# Micro servicio de almacenamiento simple

Configuración crear archivo .env con las siguientes variables.
```bash

APP_NAME=Lumen
APP_ENV=local
APP_KEY=php -r "echo bin2hex(random_bytes(16));"
APP_DEBUG=true
APP_URL=http://localhost
APP_TIMEZONE=America/Mexico_City

LOG_CHANNEL=stack
LOG_SLACK_WEBHOOK_URL=

DB_CONNECTION=sqlite
DB_HOST=
DB_PORT=
DB_DATABASE=/var/www/html/storage.sqlite
DB_USERNAME=
DB_PASSWORD=

CACHE_DRIVER=file
QUEUE_CONNECTION=sync

```


Lanzar imagen docker
```
docker-compose up --build
```