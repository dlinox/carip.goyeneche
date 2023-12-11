<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    @vite([ 'resources/js/app.js'])
    @inertiaHead
    <style>
        html {
            overflow: auto !important;
            font-family: 'Nunito', sans-serif !important;
        }

        .v-list-group__items .v-list-item {
            padding: 4px 8px 4px 10px !important;
            /* padding-inline-start: .5rem !important; */
        }

        .v-list-item__prepend .v-list-item__spacer {
            width: 15px !important;
        }

        .v-list-item__append .v-list-item__spacer {
            width: 15px !important;
        }
    </style>
</head>

<body>
    @inertia
</body>

</html>