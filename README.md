# Laravel Testing
Demo aplikasi testing Lighting Talk

## How to install
1. clone repository
`git clone git@github.com:pawoon/laravel_testing.git`
2. masuk ke root directory aplikasi, dan install dependency
`composer install`
3. buat dummy database menggunakan sqlite
`touch database/database.sqlite`
4. setup `.env` ganti nilai **DB_CONNECTION** menjadi `sqlite`

## Running Test
untuk menjalankan test execute command berikut di root aplikasi
`vendor/bin/phpunit --debug`

## Generate Code Coverage
`vendor/bin/phpunit --coverage-html public/coverage`
semua assets code coverage akan disimpan pada folder `public/coverage`

---
###### created with :heart: from pawoon api's team