# Request Logger

API リクエストの内容を記録する。

## Usage

API のコントローラーやルーターに登録する。

```php
Route::get('/api/users', UserController::class)->middleware('log.request');
```
