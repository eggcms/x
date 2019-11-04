<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>@yield('title')</title>
      <meta name="description" content="@yield('description')">
      <script src="{{ asset('js/jquery.js') }}"></script>
      <script src="{{ asset('js/main.js') }}"></script>

      <script src="{{ asset('js/app.js') }}" defer></script>
      {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css?family=Mitr:300:500|Nunito:300:500&display=swap" rel="stylesheet"> --}}
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <link href="{{ asset('css/style.css') }}" rel="stylesheet">
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
       <a id="back-to-top" href="#" class="btn btn-light btn-lg back-to-top" role="button"><i class="fas fa-chevron-up"></i></a>
   </body>
</html>