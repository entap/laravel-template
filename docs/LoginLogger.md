# Login Logger

ログイン情報を記録する。

## Usage

コントローラーやルーターのミドルウェアに指定する。

```php
Route::get('/', HomeController::class)->middleware('log.login:admin');
```

引数を省略した場合の `user_type` は `user` になる。
