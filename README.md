<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Requirements
- php
- mysql
- composer
- nodejs
- [mailhog](https://github.com/mailhog/MailHog?tab=readme-ov-file)

## Quickstart
```bash
    composer install
    npm install
    npm run build
    php artisan key:generate
    php artisan migrate
    php artisan db:seed
    php artisan storage:link
    php artisan serve
```
use `npm run dev` instead of `npm run build` in development
> make sure to run mailhog on development to send and receive emails

## Notes
> default password for `guru`/`tenaga pendidik` is `password`

## VSCode Extension helper (optional)
1. PHP Intelephense
2. Laravel IDE Helper
3. Laravel Extra Intellisense
4. Laravel Goto View
5. Laravel Goto Controller
6. PHP

### setup go to definition (optional)
```bash    
    composer require --dev barryvdh/laravel-ide-helper
    php artisan ide-helper:generate
    php artisan ide-helper:meta
```

