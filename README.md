## Modern monolithic pwa Admin Panel boilerplate with ssr

Application with laravel, vue js, vite, inertia js, tailwind css, typescript

# Getting started

## Installation


Install project with composer command

```
composer create-project anisaronno/multipurpose-admin-panel-boilerplate admin-panel
```

Switch to the repo folder

    cd admin-panel

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


Run command for development

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


Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

## Contribution Guide

Follow the [Link](https://github.com/anisAronno/multipurpose-admin-panel-boilerplate/blob/develop/CONTRIBUTING.md).

## License

The application is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

