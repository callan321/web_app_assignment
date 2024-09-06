

## Setup 
.env files removed from gitignore  and will be included in git.
### install dependencies 
```
git clone https://github.com/callan321/web_app_assignment.git
cd web_app_assignment
```
```
composer install
```
```
npm install
```
### Generate key and db
```
php artisan key:generate
```
``` 
php artisan app:database
```
### Run Dev Server 
```
php artisan serve
```
```
npm run dev 
```


### app:database 

The `app:database` command deletes the current SQLite database, creates a new one, and seeds it with data from `database.sql`.

- **Command**: [Laravel Command Documentation](https://laravel.com/docs/10.x/artisan#writing-commands)
- **File Facade**: [Laravel File Facade](https://laravel.com/docs/10.x/filesystem#the-file-facade)
- **DB Facade**: [Laravel DB Facade](https://laravel.com/docs/10.x/database#running-queries)
