<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/static/v1.svg?label=downloads&message=89.75M&color=blue" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/static/v1.svg?label=stable&message=v7.6.2&color=blue" alt="Latest Stable Version"></a>
<a href="https://nodejs.org/dist/v10.15.1/"><img src="https://img.shields.io/static/v1.svg?label=nodeJS&message=v10.15.1&color=blue" alt="Latest Stable Version"></a>
<a><img src="https://img.shields.io/static/v1.svg?label=php&message=v7.2.5^&color=green" alt="Latest Stable Version"></a>
</p>

## 安裝 Composer

使用 terminal 執行下列指令進行安裝
```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'e0012edf3e80b6978849f5eff0d4b4e4c79ff1609dd1e613307e16318854d24ae64f26d17af3ef0bf7cfb710ca74755a') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

執行 composer ，如果能看到版本號代表安裝成功
```bash
composer --version
# Composer version 1.8.6 2019-06-11 15:03:05
```

> Composer 官方文件<br>
> [https://getcomposer.org/download/](https://getcomposer.org/download/)<br>

---

## 安裝 Laravel

使用 terminal 執行下列指令進行安裝
```bash
composer global require laravel/installer
```

新增 PATH
```bash
vim ~/.bash_profile
```

將此行程式碼加入該檔案中並儲存
```bash
export PATH=~/.composer/vendor/bin:$PATH
```

套用剛剛新增的 PATH
```bash
source ~/.bash_profile
```

嘗試執行 Laravel，如果可以看到版本號表示安裝成功
```bash
laravel --version
# Laravel Installer 3.0.1
```

> Laravel 官方文件<br>
> [https://laravel.com/docs/7.x/installation](https://laravel.com/docs/7.x/installation)
> <br>
> Laravel 社群中文文檔<br>
> [https://learnku.com/docs/laravel/7.x](https://learnku.com/docs/laravel/7.x)
> <br>
> Laravel 6.0 初體驗！怎麼用最新的 laravel 架網站！<br>
> [https://ithelp.ithome.com.tw/articles/10214524](https://ithelp.ithome.com.tw/articles/10214524)
> <br>
> 新手後端工程師的學習歷程(中後段有提到laravel)<br>
> [https://ithelp.ithome.com.tw/users/20107697/ironman/1900?page=3](https://ithelp.ithome.com.tw/users/20107697/ironman/1900?page=3)
> <br>
> 使用 Laravel 打造 RESTful API<br>
> [https://ithelp.ithome.com.tw/users/20105865/ironman/2466?page=1](https://ithelp.ithome.com.tw/users/20105865/ironman/2466?page=1)
> <br>
> Laravel API 官方文件<br>
> [https://laravel.com/api/7.x/index.html](https://laravel.com/api/7.x/index.html)

---

## 在 Laravel 專案中整合 Vue CLI

安裝 Vue CLI 3 環境
```bash
npm i -g @vue/cli
```

## 建立並修改 Laravel 專案

刪除與前端相關的目錄與檔案
```bash
laravel new project
cd project
rm -rf package.json \
    package.json.lock \
    webpack.mix.js \
    yarn.lock \
    resources/view/welcome.blade.php \
    resources/{js,sass}
```

修改 routes/web.php
```php
<?php

use Illuminate\Support\Facades\Route;

Route::view('/{any}', 'index')->where('any', '.*');
```

---

## 建立並修改 Vue CLI 專案
接下來用 Vue CLI 建立前端資料夾，以便管理所有跟前端有關的資源：
```bash
vue create frontend
```

建立並編輯 frontend/vue.config.js
```javascript
module.exports = {
    // 在專案開發中如果呼叫 API 時會 pass 給這個 proxy 網址
    // 這邊就用前面以 Valet 建立的網站網址
    // devServer: {
    //     proxy: 'http://127.0.0.1'
    // },

    // 建置前端靜態檔案時要擺放的目錄
    // 在 package.json 也要調整 "build" 這個 script
    outputDir: '../public',

    // 開發階段修改 index.html 來讓 js/css 可以作用
    // 上線階段則會修改 Laravel 的樣版
    indexPath: process.env.NODE_ENV === 'production'
        ? '../resources/views/index.blade.php'
        : 'index.html'
}
```

然後修改 frontend/package.json 的 scripts.build，避免把 public 整個刪除
```json
"scripts": {
    "serve": "vue-cli-service serve",
    "build": "rm -rf ../public/{js,css,img} && vue-cli-service build --no-clean",
    "lint": "vue-cli-service lint"
}
```

接著執行下列指令來測試專案
```bash
cd frontend
npm run build
cd ..
php artisan serve
```

> **相關文章**<br>
> 網站製作學習誌<br>
> [https://jaceju.net/integrate-vue-cli-into-laravel/](https://jaceju.net/integrate-vue-cli-into-laravel/)<br>
> 30天快速上手Laravel<br>
> [https://ithelp.ithome.com.tw/users/20112515/ironman/2041](https://ithelp.ithome.com.tw/users/20112515/ironman/2041)

---

## 目錄導覽

```bash
/app                應用程式的核心程式碼
/app/Providers/RouteServiceProvider.php
                    /routes/web.php, /routes/web.php 定義的路由
                    會被指派到該檔案的 web 中介群組
-
/bootstrap          啟動框架、快取資料及自動載入設定
/bootstrap/cache    結構最佳化所產生的檔案
    # 請需確認伺服器有以上兩個目錄的寫入權限
-
/config             所有應用的配置檔案
    # 建議熟讀其內包含的所有參數
-
/database           資料庫遷移與填充檔案
-
/public             HTTP請求入口
    # 需要將您的網站伺服器根目錄指向 public 目錄
/public/.htaccess   apache設定值覆寫設定
    # Apache 伺服器需啟用 mod_rewrite 模組
-
/resources          前端靜態資源及語言檔
-
/routes             包含此應用所有的路由定義
/routes/web.php     具備 Session、CSRF 防護以及 Cookie 加密功能
                    除 RESTful API 以外，所有的路由都應定義在該檔案中
/routes/api.php     這些路由是無狀態的，此路由進入時需要經過 token 認證
/routes/console.php 檔案用於定義所有基於閉包的控制台指令
-
/storage            編譯後的 blade 模板
/storage/logs       包含了應用程式的執行日誌
-
/tests              自動化測試，提供現成的範例
    # 每一個測試類都需要新增 Test 字首
    # 可以使用 phpunit 或者 php vendor/bin/phpunit 指令來執行測試
    # phpUnit範例 https://phpunit.de/
-
/vendor             Composer 依賴套件
-
.env                包含應用程式金鑰等組態
```
---

## 參數操作
- ***.env***<br>
該檔案不應該被提交到應用程式的版本控制系統，因為使用此應用程式的每個開發人員或伺服器可能需要不同的環境設定。
```bash
# 手動新增金鑰
php artisan key:generate
```
```php
// 取用參數
env('APP_DEBUG');

// 第二個參數為「預設值」。當給定的鍵沒有環境變數存在時就會使用該值。
env('APP_DEBUG', false);

// 判斷當前環境是否為 local 或 staging
App::environment('local', 'staging')
```

- ***/config***<br>
你可以在應用程式的任何位置輕鬆的使用全域的 config 輔助函式來存取你的設定值。<br>
也可以指定預設值，當該設定選項不存在時就會回傳預設值
```php
// 取用參數
config('app.timezone');

// 第二個參數為「預設值」。當給定的鍵沒有環境變數存在時就會使用該值。
config('app.timezone', 'Asia/Taipei');

// 修改參數
config(['app.timezone' => 'Asia/Taipei']);
```

---

## 設定快取

***config:cache***<br>
所有的設定檔都會集中合併成一個檔案，讓框架可以快速載入。<br>
每次線上部署前都應重新進行快取，以確保伺服器效能最佳化
```bash
php artisan config:cache
# Configuration cache cleared!
# Configuration cached successfully!
```

---

## 維護模式

當應用程式正在進行維護時，所有傳遞至應用程式的請求都應該拋出「維護中」的訊息。<br>
維護模式回應的預設模板放置在 ***resources/views/errors/503.blade.php***。

可以透過以下指令運行維護模式：
```bash
# 啟用維護模式
php artisan down

# 啟用維護模式，包含 option
php artisan down --message="Upgrading Database" --retry=60

# 關閉維護模式
php artisan up
```

---

## App 目錄

> 在 app 目錄中的很多類別都可以透過 Artisan 指令產生<br />
> 要檢視所有有效的指令，可以在終端機中執行***php artisan list make*** 指令。

---

## Laravel 的生命週期

> Laravel 官方文件<br>
> [https://laravel.com/docs/7.x/lifecycle](https://laravel.com/docs/7.x/lifecycle)

### 第一步

所有的請求發出後，Laravel 會從 ***public/index.php*** 進行接收，因此需要將 Apache 伺服器的網站根目錄導入到該路徑下，以確保程式可以被正確執行。<br>
***index.php*** 檔案將會：
1. 初始化 `composer autoloader`
2. 透過 ***bootstrap/app.php*** 實例化 Laravel 應用程式
3. Laravel 進一步實例化 `application` / [service container](https://laravel.com/docs/7.x/container)

### Http / Kernels

緊接著 Laravel 會針對請求的種類來啟動 Http kernel 或 console kernal。以 HTTP 請求來說，HTTP kernel 存放路徑為 ***app/Http/Kernel.php***<br>

Http kernel 繼承了 `Illuminate\Foundation\Http\Kernel` class，期內定義了 `Array $bootstrappers`，該陣列將會在請求執行前優先被啟動。這些程序定義了包含錯誤處理、設定檔載入、[應用程式監控](https://laravel.com/docs/7.x/configuration#environment-configuration)及請求執行前必須要完成的任務。<br>

HTTP kernal 同時定義了 HTTP Request 的中介層 ([middleware](https://laravel.com/docs/7.x/middleware))，所有請求都必須先通過該中介層的驗證，才可以被執行。中介層控制 [HTTP Session](https://laravel.com/docs/7.x/session) 的讀寫、維護模式管理、[CSRF token](https://laravel.com/docs/7.x/csrf)處理...等。<br>

簡單來說 HTTP kernel 就是概括整個後端應用的核心，用來處理所有的 `HTTP Request` 並返回 `HTTP Response`

### Service Provider

服務提供者 ([Service providers](https://laravel.com/docs/7.x/providers)) 是 Kernel 所引導的程序中最中最重要的項目之一，所有的服務提供者都必須註冊在 ***config/app.php*** 設定檔的 `Array providers` 中，所有的 providers 會先被執行 `register` 方法，待所有的 providers 都註冊完畢後再接著執行 `boot` 方法。<br>

Service providers 負責將程式引導到框架中的各式模組，例如 `database`、`queue`、`validation` 及 `routing`等。

這些 service providers 都被放置在 ***app/Providers*** 路徑中。這個資料夾中 ***AppServiceProvider.php*** 預設是空白的，您可以將各式服務的綁定寫入該檔案。

### Dispatch Request

當應用已經引導到所有的服務提供者並註冊後，`Request` 就會連結到 router 中，當 router 被請求時就會調用對應的 `controller` ，同時啟動對應的中介層 (middleware)

---

## Service Container

Laravel service container class 主要用來管理類別依賴並執行依賴注入，代表該類別的資源必須透過其內部的 `__construct` 或 `setter` ...等方法來進行設置。

舉例來說
```php
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\User;

class UserController extends Controller
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = $this->users->find($id);

        return view('user.profile', ['user' => $user]);
    }
}
```
從上面的例子中可以看到，`UserController` 需要依賴外部注入 `user` 才能實例化，`show` 方法也必須透過注入的 `user` 才能取得對應的資料。其中 `UserRepository` 是一個從 database 中取得，類似於 [Eloquent](https://laravel.com/docs/7.x/eloquent) ORM 的 `user` 實例化類別。總結來說，只要容器已經被注入，我們就可以很輕易地在其他實例 (implementation) 之間進行切換。同時我們也可以很輕易的製造模板(mock)或建立一個仿製的 `UserRepository` 的實例化來協助我們進行測試。

> 何謂依賴注入<br>
> [https://ithelp.ithome.com.tw/articles/10194274](https://ithelp.ithome.com.tw/articles/10194274)

## 綁定 Binding

### Binding Basics

幾乎所有的 service container 都會在 [service providers](https://laravel.com/docs/7.x/providers) 中進行註冊，因此接下來會示範如何在 `providers` 中使用 container。

> 如果你的 container 沒有依賴介面(interface)，你將不需要引入或綁定任何的 class 對象，service container 會自動鏡射到對應的物件上。

### Simple Bindings

在 Service provider 中，可以透過 `$this->app` 屬性來取用 container。接著使用 `bind` 方法並傳入想要註冊的 class 或 interface 名稱進行綁定，函式會回傳該類別的實例。

```php
$this->app->bind('HelpSpot\API', function ($app) {
    return new \HelpSpot\API($app->make('HttpClient'));
});
```

實作範例

建立一個初始介面
```php
// app/Interface.php

namespace App;

interface PaymentInterface
{
    public function pay();
}
```

接著建立一個類別來實作該介面
```php
// app/PaypalPayment.php

namespace App;

class PaypalPayment implements PaymentInterface
{
    public function pay()
    {
        return 'pay with paypal';
    }
}
```

依照依賴注入(DI)及控制反轉(IoC)設計模式，如果需要使用類別(PaypalPayment)，依賴介面會是比較好的的做法，因此我們會想要在路由中直接鏡射介面來實作
```php
// route/web.php

Route::get('paypal', function (App\PaymentInterface $payment) {
    return $payment->pay();
});
```

此時 paypal route 仍然無法運作，因為 Laravel 不能針對介面進行實例化，因此會需要 `綁定 (bind)` 這個動作，告訴 Laravel 如果看到對應的介面名稱，就轉導到指定的 class 身上
```php
// app/Providers/AppServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\PaymentInterface', function () {
            return new \App\PaypalPayment();
        });
    }
}
```

完成後再次呼叫 paypal route 就可以成功看到 PaypalPayment class 回傳的內容
```html
pay with paypal
```

> 官方文件<br>
> [https://laravel.com/docs/7.x/container](https://laravel.com/docs/7.x/container)<br>
> 為何需要使用 binding<br>
> [https://stackoverflow.com/questions/49348681/what-is-a-usage-and-purpose-of-laravels-binding](https://stackoverflow.com/questions/49348681/what-is-a-usage-and-purpose-of-laravels-binding)<br>
> 為何需要使用 binding (中文版)<br>
> [https://pse.is/R9489](https://medium.com/mr-efacani-teatime/laravel%E5%A6%82%E4%BD%95%E5%AF%A6%E7%8F%BE%E4%BE%9D%E8%B3%B4%E6%80%A7%E6%B3%A8%E5%85%A5-d760c8e5abde)<br>
> 依賴注入實作範例 CoolKiller<br>
> [https://ithelp.ithome.com.tw/articles/10194274](https://ithelp.ithome.com.tw/articles/10194274)

---

## Service Providers

### 引言

`Service providers` 是整個 Laravel 應用程式 `導引程序(bootstrapping)` 的中心，包含你所開發的應用程式及 Laravel 的核心服務都需要透過 `service providers` 來進行引導。<br>

那什麼是 `導引程序(bootstrapping)` 呢？一般來說，bootstrapping 代表註冊各種功能的行為，包括上一章提到的綁定 (bindings)、事件監聽 (event listener)、中介層 (middleware) 以及 路由 (routes)等都需要透過 `bootstrapping` 來進行註冊。<br>

如果你打開 ***config/app.php*** ，你將會看到一個 `Array providers => []`，所有 Laravel 啟動時要載入的 service providers 都會包含在這個陣列之中。需要注意的是，當中有些項目是 `延遲提供者(deferred providers)` ，這些服務並不會在應用程式啟動的第一時間就緒，只有當該服務被啟用的時候才會進行載入。

### 如何撰寫 Service Providers

所有的 service providers 都繼承自 `Illuminate\Support\ServiceProvider`，且大部分的 service provider 都會包含 `register` 及 `boot` 兩個方法。在 `register` 方法中，你只能進行各種 service container 的 綁定(binding) 行為，其餘包含 event listener、routes 或其他任何功能都不應在 `register` 中進行實作。<br>

Artisan CLI 提供了 provider 的自動生成指令
```bash
php artisan make:provider RiakServiceProvider
```

### 關於 Register Method

在下列範例中，你隨時可以藉由 $this->app 來取得 service container。

```php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Riak\Connection;

class RiakServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Connection::class, function ($app) {
            return new Connection(config('riak'));
        });
    }
}
```

### 關於 `bindings` 與 `singletons` 屬性

如果你的 service providers 註冊了許多 簡易綁定(simple bindings)，你可以使用 `bindings` 與 `singletons` 屬性來快速註冊這些項目，就不用每個綁定都要重寫一次 `$this->app->bind()`。

```php
use App\Contracts\DowntimeNotifier;
use App\Contracts\ServerProvider;
use App\Services\DigitalOceanServerProvider;
use App\Services\PingdomDowntimeNotifier;
use App\Services\ServerToolsProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        // interface binding
        ServerProvider::class => DigitalOceanServerProvider::class,

        // tag binding
        'bindTestClass' => TestClass::class
    ];

    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        // interface binding
        DowntimeNotifier::class => PingdomDowntimeNotifier::class,
        ServerToolsProvider::class => ServerToolsProvider::class,

        // tag binding
        'singletonTestClass' => TestClass::class
    ];
}
```

> bindings 與 singletons 的差別<br>
> bindings 每次取用時都會重新實例化該物件，而 singletons 則只會實例化第一次。因此如果取用的物件需要保留先前的參數，則使用 singletons，反之如果每次取用都希望是全新的物件則用 bindings

### 關於 Boot Method

Boot method 可以用來註冊 [view composer](https://laravel.com/docs/7.x/views#view-composers)，boot method 只有在所有的 service providers 都註冊完成後才會被執行，這代表你可以在 boot method 中存取所有的 services。

```php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('view', function () {
            //
        });
    }
}
```

### Boot method 依賴注入

你可以在 boot method 中加入 type-hint，services container 將會自動注入所以需要的依賴類別

```php
public function boot(PaymentInterface $paypal)
{
    echo $paypal->pay();
}
```

### 註冊 Providers

所有的 service providers 都統一註冊在 ***config/app.php***。該檔案包含一個 `Array providers => []`，你可以將自己開發的 Providers 新增在該陣列中。如同前面有提到過的，該陣列預設就已經包含了一些核心的 service providers。

```php
// config/app.php

'providers' => [
    // Other Service Providers
    App\Providers\ComposerServiceProvider::class,
],
```

### 延遲服務 Deferred Providers

假如你的 provider 只在 service container 中使用的 bindings 進行註冊，你可以選擇性地將該 provider 設定為 延遲註冊 (deferred registration)，直到該 provide 被請求時才會進行註冊。延遲載入可以減少每次服務啟動時的 providers 註冊量，藉此提升應用程式的性能。<br>

如果要延遲載入 provider，須將 `\Illuminate\Contracts\Support\DeferrableProvider` 介面擴展到指定的 provider 中，並定義一個 `provides method`，`provides method` 將會回傳一個綁定完成的 service container。

```php
namespace App\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Riak\Connection;

class RaikServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Connection::class, function ($app) {
            return new Connection($app['config']['riak']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Connection::class];
    }
}
```

---

## Facades

### 引言

Facades 提供一個類別接口

所有的 facades 都被定義在 `namespace Illuminate\Support\Facades`，我們可以很輕易地透過以下方法來取用這些 facades

```php
Route::get('/cache', function () {
    return Cache::get('key');
});
```

> 官方文件<br>
> [https://laravel.com/docs/7.x/facades](https://laravel.com/docs/7.x/facades)<br>
> Understanding Laravel Facade<br>
> [https://medium.com/a-young-devoloper/understanding-laravel-facades-4802025899e6](https://medium.com/a-young-devoloper/understanding-laravel-facades-4802025899e6)<br>

---

## Contracts

### 引言

---

## 路由 Routing

最基本的

