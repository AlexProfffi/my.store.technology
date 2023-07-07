<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Scripts -->
        @routes
        <script src="{{ mix('/js/app.js') }}" defer></script>
        @inertiaHead
    </head>

    <body class="bg-light">

        @inertia

        @if (app()->isLocal())
            <script src="http://localhost:3001/browser-sync/browser-sync-client.js" async></script>
        @endif

    </body>
</html>
