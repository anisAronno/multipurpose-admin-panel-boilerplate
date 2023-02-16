## Modern monolithic pwa Admin Panel boilerplate with ssr

Application with laravel 10, vue 3, vite 4, inertia 1.0, tailwind 3, typescript

# Getting started

## Installation


Clone the repository

    git clone https://github.com/anis3139/multipurpose-admin-panel-boilerplate.git

Switch to the repo folder

    cd multipurpose-admin-panel-boilerplate

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

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

## License

The application is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

