@echo off
echo Starting Laravel development server...
cd /d "C:\xampp\htdocs\bimtek"
set PATH=%PATH%;C:\xampp\php
php artisan serve --host=0.0.0.0 --port=8000
pause
