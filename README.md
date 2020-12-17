# laravel-template

## Usage

### Installation

GitHub のテンプレートとして利用します。
新しいプロジェクトを作成する際にテンプレートから entap/laravel-template を選んでください。

## For developers

クローンしたら以下を実行してください。

```sh
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan passport:install
```

### Testing

```sh
composer test
```

### Fresh database

```sh
php artisan migrate:fresh \
    && php artisan passport:install \
    && php artisan admin:install \
    && php artisan db:seed
```
