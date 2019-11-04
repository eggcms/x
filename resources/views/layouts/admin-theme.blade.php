<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,,height=device-height,  initial-scale=1.0">
 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Bootstrap CSS CDN -->
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"> --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="{{asset('css/admin-style.css')}}">
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"></script> 
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"></script> 

</head>

<body>

   <div class="wrapper">
      <!-- Sidebar  -->
      <nav id="sidebar">
         <div class="sidebar-header">
               <h3>X</h3>
               <strong>BS</strong>
         </div>

         <ul class="list-unstyled components">
            <li class="active">
               <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                  <i class="fas fa-home"></i>
                  Home
               </a>
               <ul class="collapse list-unstyled" id="homeSubmenu">
                  <li>
                     <a href="#">Home 1</a>
                  </li>
                  <li>
                     <a href="#">Home 2</a>
                  </li>
                  <li>
                     <a href="#">Home 3</a>
                  </li>
               </ul>
            </li>
            <li>
               <a href="#">
                  <i class="fas fa-briefcase"></i>
                  About
               </a>
               <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                  <i class="fas fa-copy"></i>
                  Pages
               </a>
               <ul class="collapse list-unstyled" id="pageSubmenu">
                  <li>
                     <a href="#">Page 1</a>
                  </li>
                  <li>
                     <a href="#">Page 2</a>
                  </li>
                  <li>
                     <a href="#">Page 3</a>
                  </li>
               </ul>
            </li>
            <li>
               <a href="#">
                  <i class="fas fa-image"></i>
                  Portfolio
               </a>
            </li>
            <li>
               <a href="#">
                  <i class="fas fa-question"></i>
                  FAQ
               </a>
            </li>
            <li>
               <a href="#">
                  <i class="fas fa-paper-plane"></i>
                  Contact
               </a>
            </li>
         </ul>

         <ul class="list-unstyled CTAs">
            <li>
               <a href="https://bootstrapious.com/tutorial/files/sidebar.zip" class="download">Download source</a>
            </li>
            <li>
               <a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article">Back to article</a>
            </li>
         </ul>
      </nav>

        <!-- Page Content  -->
      <div id="content">

         <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

               <button type="button" id="sidebarCollapse" class="btn btn-info">
                  <i class="fas fa-align-left"></i>
                  <span>Toggle Sidebar</span>
               </button>
                  <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                     <i class="fas fa-align-justify"></i>
                  </button>

                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="nav navbar-nav ml-auto">
                           <li class="nav-item active">
                              <a class="nav-link" href="#">Page</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="#">Page</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="#">Page</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="#">Page</a>
                           </li>
                     </ul>
                  </div>
               </div>
         </nav>

         <h2>Collapsible Sidebar Using Bootstrap 4</h2>
<div class="py-4">
<div id="app">
   <test></test>
</div>
</div>
         <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> This alert box could indicate a successful or positive action.
         </div>
         <div class="alert alert-info alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Info!</strong> This alert box could indicate a neutral informative change or action.
         </div>
         <div class="alert alert-warning alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Warning!</strong> This alert box could indicate a warning that might need attention.
         </div>
         <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Danger!</strong> This alert box could indicate a dangerous or potentially negative action.
         </div>

         <blockquote><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

         <div class="line"></div>

         <h2>Lorem Ipsum Dolor</h2>
         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

         <div class="line"></div>

         <h2>Lorem Ipsum Dolor</h2>
         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

         <div class="line"></div>

         <h3>Lorem Ipsum Dolor</h3>
         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
   </div>



   <!-- jQuery CDN - Slim version (=without AJAX) -->
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
   {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script> --}}

   <script src="{{ asset('js/app.js') }}" defer></script>
   <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
               $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>