Это просто упражнение по созданию API при помощи фреймворка Laravel

При скачивании, не забудьте установить зависимости:

```bash
composer install
```
После этого следует скопировать .env.example в .env

```bash
cp .env.example .env
```

Сгенерируйте ключ

```bash
php artisan key:generate
```

После этого можно сделать миграцию (желательно с сидером)

```bash
php artisan migrate --seed
```
или

```bash
php artisan migrate:fresh --seed
```
