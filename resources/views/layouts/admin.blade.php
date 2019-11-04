<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name', 'Laravel') }}</title>
      <script src="{{ asset('js/jquery.js') }}"></script>
      <script src="{{ asset('js/bs-custom-file-input.js') }}"></script>
      <script src="{{ asset('js/app.js') }}"></script>
      @yield('ckeditor')
      <!-- Fonts -->
      <link rel="dns-prefetch" href="//fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css?family=Kanit:300:400:500:600|Imprima|Courgette|Anton|Pridi:300|Rubik:700&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
      <script src="{{ asset('js/admin.js') }}"></script>
      <script src="{{ asset('js/bs-script.js') }}"></script>
   </head>
   <body>
      @yield('nav')
      <!-- Page Content -->
      <div class="container">
         <div class="card text-white alert bg-secondary my-4 py-2 text-center" style=" margin-top:25px; width:100%">
            <div class="card-body" >
               <i>ระบบการควบคุม! กำลังใช้งานโดย: {{Auth::user()->name}} ระดับเลเวล: {{Auth::user()->level}}</i>
            </div>
         </div>
      @yield('box-show')
      @yield('notify')
         <!-- Call to Action Well -->
         <div class="row">
            @yield('content')
         </div>      
         @yield('box-3')
      <!-- /.container -->
      </div>
   {{-- @yield('footer') --}}
   </body>
</html>
