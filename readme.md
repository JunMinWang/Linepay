# 新增使用者身份驗證middleware

- Step 1

```shell
php artisan make:middleware isAdmin
```

- Step 2

在`app\Http\Kernel.php`中的`routeMiddleware`陣列新增以下部份:

```php
'admin' => \App\Http\Middleware\IsAdmin::class,
```

- Step 3

編輯`app/Http/Middleware/isAdmin.php`

```php
public function handle($request, Closure $next)
{
     if (Auth::user() &&  Auth::user()->admin == 1) {
            return $next($request);
     }

    return redirect('/');
}
```

- Step 4

在`route`中新增剛建立的middleware


```php
Route::get('admin_area', ['middleware' => 'admin', function () {
    //
}]);
```
