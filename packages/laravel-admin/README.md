# laravel-admin

Laravel Admin Page

## Usage

### Installation

`composer.json` にリポジトリを追加してください。

```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/entap/laravel-admin"
    },
],
```

パッケージをインストールします。
アセットと設定ファイルを公開し、マイグレーションとシーダーを実行します。

```sh
composer require entap/laravel-admin
php artisan admin:install
```

### Create User

新しい管理者を追加します。

```bash
php artisan admin:users:create
```

## Features

-   [LoginLogger Middleware](./docs/LoginLogger.md)
-   [RequestLogger Middleware](./docs/RequestLogger.md)
