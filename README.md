<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
<a href="https://nodejs.org/dist/v10.15.1/"><img src="https://img.shields.io/static/v1.svg?label=nodeJS&message=v10.15.1&color=blue" alt="Latest Stable Version"></a>
<a><img src="https://img.shields.io/static/v1.svg?label=php&message=v7.2.5^&color=blue" alt="Latest Stable Version"></a>
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
> [https://getcomposer.org/download/](https://getcomposer.org/download/)

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
