# laravel-template

## Usage

### Installation

GitHub のテンプレートとして利用します。
新しいプロジェクトを作成する際にテンプレートから entap/laravel-template を選んでください。

## For developers

クローンしたら以下を実行してください。

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
```

### Testing

```bash
composer test
```

### Fresh database

```bash
php artisan migrate:fresh && php artisan admin:install && php artisan db:seed
```
