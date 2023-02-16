## Modern monolithic pwa Admin Panel boilerplate with ssr

Application with laravel 10, vue 3, vite 4, inertia 1.0, tailwind 3, typescript

# Getting started

## Installation


Install project with composer command

```
composer create-project anisaronno/multipurpose-admin-panel-boilerplate admin-panel
```

Switch to the repo folder

    cd admin-panel

Run command for install node modules 

```
npm run dev
```

for frontend build

```
npm run build
```

for ssr

```
node bootstrap/ssr/ssr.mjs
```


Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Run the database seeder (**Do it after migrating your table**)

    php artisan db:seed


Run Job

```
php artisan queue:work
```

Or

```
php artisan schedule:run
```

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

## License

The application is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

