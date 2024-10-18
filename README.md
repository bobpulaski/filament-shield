### Comands

php artisan make:model ClientStatus -m

php artisan shield:generate --resource=UserResource

php artisan make:filament-resource Person

php artisan make:observer UserObserver --model=User

Связь с родительской таблицей Клиентов с ее методом persons с выводом поля
php artisan make:filament-relation-manager ClientResource persons surname

Добавляем инверсию при необходимости для AssotiateAction
protected static string $relationship = 'persons';
protected static ?string $inverseRelationship = 'client';
