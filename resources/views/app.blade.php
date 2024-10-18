<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        @notifyCss
        <style>
            /* Asegura que el contenedor de las notificaciones esté por encima de todo */
            .notify {
                position: fixed;  /* Hace que esté siempre en la misma posición */
                top: 20px;        /* Ajusta la posición desde la parte superior */
                right: 20px;      /* Ajusta la posición desde la derecha */
                z-index: 99999;   /* Muy por encima de cualquier otro elemento */
                width: auto;      /* Ajusta el ancho según el contenido */
                max-width: 400px; /* Ajusta el ancho máximo según tus necesidades */
            }
        </style>


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @include('notify::components.notify')
        @inertia
        @notifyJs 
    </body>
</html>
