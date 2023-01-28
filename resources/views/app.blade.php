<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="application-name" content="Admin Panel">
    <meta name="apple-mobile-web-app-title" content="Admin Panel">
    <meta name="theme-color" content="#44ce6f">
    <meta name="msapplication-navbutton-color" content="#44ce6f">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="description" content="Web site created using create-react-app" />
    <link rel="apple-touch-icon" href="%PUBLIC_URL%/images/192.png" />
    <link rel="manifest" href="/manifest.json" />

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.ts', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="font-sans antialiased">
    @inertia
   <x-translations></x-translations>
 
    <script>
        if (
            localStorage.getItem("color-theme") === "dark" ||
            (!("color-theme" in localStorage) &&
                window.matchMedia("(prefers-color-scheme: dark)").matches)
        ) {
            document.documentElement.classList.add("dark");
        } else {
            document.documentElement.classList.remove("dark");
        }

        
        window.addEventListener('load', () => {
            registerSW();
        });
        async function registerSW() { 
            if ('serviceWorker' in navigator) {
                try {
                await navigator.serviceWorker.register('/sw.js');
                } catch (e) {
                console.log(`Service Worker registration failed`);
                }
            }
        }
    </script>
</body>

</html>