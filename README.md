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

HTTP kernal 同時定義了 HTTP Request 的中介層 ([middleware](https://laravel.com/docs/7.x/middleware))，所有請求都必須先通過該中介層的驗證，才可以被執行。中介層控制 [HTTP Session](https://laravel.com/docs/7.x/session) 的讀寫、維護模式管理、[CSRF token](https://laravel.com/docs/7.x/csrf)處理...等。

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

### Simple Bindings

在 Service provider 中，可以透過 `$this->app` 屬性來取用 container。接著使用 `bind` 方法並傳入想要註冊的 class 或 interface 名稱進行綁定，函式會回傳該類別的實例。

```php
$this->app->bind('HelpSpot\API', function ($app) {
    return new \HelpSpot\API($app->make('HttpClient'));
});
```

> 如果你的 container 沒有依賴抽象類別(interface)，你將不需要引入或綁定任何的 class 對象，service container 會自動鏡射到對應的物件上。

# FIXME:
看不太懂<br>
去查了
https://stackoverflow.com/questions/49348681/what-is-a-usage-and-purpose-of-laravels-binding<br>
https://heera.it/laravel-repository-pattern#.VuJcVfl97cs<br>
中文版
https://medium.com/mr-efacani-teatime/laravel%E5%A6%82%E4%BD%95%E5%AF%A6%E7%8F%BE%E4%BE%9D%E8%B3%B4%E6%80%A7%E6%B3%A8%E5%85%A5-d760c8e5abde<br>
CoolKiller
https://ithelp.ithome.com.tw/articles/10194274
讀到一半

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[British Software Development](https://www.britishsoftware.co)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- [UserInsights](https://userinsights.com)
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)
- [Invoice Ninja](https://www.invoiceninja.com)
- [iMi digital](https://www.imi-digital.de/)
- [Earthlink](https://www.earthlink.ro/)
- [Steadfast Collective](https://steadfastcollective.com/)
- [We Are The Robots Inc.](https://watr.mx/)
- [Understand.io](https://www.understand.io/)
- [Abdel Elrafa](https://abdelelrafa.com)
- [Hyper Host](https://hyper.host)
- [Appoly](https://www.appoly.co.uk)
- [OP.GG](https://op.gg)
- [云软科技](http://www.yunruan.ltd/)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
