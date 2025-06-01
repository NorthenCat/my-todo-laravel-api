# Environment Configuration Examples

## Development (.env)

```env
APP_NAME="My Todo API"
APP_ENV=local
APP_KEY=base64:HVvZn+XMOFWiiRvxT4uba2TSapCIM3yiIJaNBXN4TEE=
APP_DEBUG=true
APP_URL=http://localhost:8001

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=sqlite
# For MySQL use:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=my_todo_laravel
# DB_USERNAME=root
# DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

SANCTUM_STATEFUL_DOMAINS=localhost:3000,127.0.0.1:3000,localhost:8080,127.0.0.1:8080
```

## Production (.env.production)

```env
APP_NAME="My Todo API"
APP_ENV=production
APP_KEY=your-production-key-here
APP_DEBUG=false
APP_URL=https://yourdomain.com

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=your-database-host
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

BROADCAST_DRIVER=log
CACHE_DRIVER=redis
FILESYSTEM_DISK=s3
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis
SESSION_LIFETIME=120

REDIS_HOST=your-redis-host
REDIS_PASSWORD=your-redis-password
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-email-password
MAIL_ENCRYPTION=tls

SANCTUM_STATEFUL_DOMAINS=yourdomain.com,www.yourdomain.com
```

## Testing (.env.testing)

```env
APP_NAME="My Todo API"
APP_ENV=testing
APP_KEY=base64:HVvZn+XMOFWiiRvxT4uba2TSapCIM3yiIJaNBXN4TEE=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=sqlite
DB_DATABASE=:memory:

CACHE_DRIVER=array
QUEUE_CONNECTION=sync
SESSION_DRIVER=array

SANCTUM_STATEFUL_DOMAINS=localhost
```
