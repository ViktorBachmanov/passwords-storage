<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Passwords storage</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>       
        </style>

        <script src="{{ mix('/js/manifest.js') }}"></script>
        <script src="{{ mix('/js/vendor.js') }}"></script>
    </head>

    <body>
      {{-- <div id="passwords-storage-app-vue" data-user-name="{{ Auth::user()->name }}"></div> --}}
      <div id="passwords-storage-app-vue"></div>
      <script src="{{ mix('/js/passwords-storage-app-vue.js') }}"></script>
    </body>
</html>
