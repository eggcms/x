<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name', 'Xseries') }}</title>
      <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
      <script src="{{ asset('js/app.js') }}" defer></script>
      <script src="{{ asset('js/main.js') }}"></script>
      <link rel="dns-prefetch" href="//fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css?family=Mitr|Nunito:300:400:500|Pattaya&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
      crossorigin="anonymous">
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <link href="{{ asset('css/style.css') }}" rel="stylesheet">
   </head>
   <body>
      @yield('nav')
      <div id="app">
         <main class="py-4">
            @yield('content')
         </main>
      </div>
      @yield('adv3')
      @yield('footer')
      <a id="back-to-top" href="#" class="btn btn-light btn-lg back-to-top" role="button"><i class="fas fa-chevron-up"></i></a>
   </body>
</html>
