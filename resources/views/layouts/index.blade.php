<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="shortcut icon" type="image/png" href="img/football-kick.png"/>
      <title>@yield('title')</title>
      <meta name="description" content="@yield('description')">
      <script src="{{ asset('js/jquery.js') }}"></script>
      <script src="{{ asset('js/main.js') }}"></script>      
      <script src="{{ asset('js/app.js') }}" defer></script>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <link href="{{ asset('css/style.css') }}" rel="stylesheet">
      @if ($cmd=='step-api')
      <link href="{{ asset('css/vision_step.css') }}" rel="stylesheet">
      @endif
   </head>
   <body>
      @yield('nav')
      <div id="app">
         <main class="py-3">
            @yield('content')
         </main>
       </div>
       @yield('adv3')
       @yield('footer')
       <a id="back-to-top" href="#" class="btn btn-danger btn-lg back-to-top" role="button"><i class="fas fa-chevron-up text-white"></i></a>
   </body>
</html>