# laravel-template

## Usage

### Installation

GitHub のテンプレートとして利用します。
`Use this template` ボタンから新しいリポジトリを作成してください。

`composer.json` の `name` 属性を変更してください。

クローンしたら以下を実行してください。

```sh
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan passport:install
php artisan admin:install
```

管理者の初期パスワードは `admin` / `password` です。

### Start Server

ローカルのサーバーを起動します。

```sh
php artisan serve
```

### Testing

テストを実行します。

```sh
php artisan test
```

### Fresh Database

データベースを初期化します。

```sh
php artisan migrate:fresh \
    && php artisan passport:install \
    && php artisan admin:install \
    && php artisan db:seed
```
