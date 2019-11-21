@section('nav')
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
      <a class="navbar-brand" href="{{ url('/admin') }}">Xseries</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
               
            <li class="nav-item {{ Request::is('admin')?'active':'' }}">
              <a class="nav-link" href="{{url('/admin')}}">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item {{ Request::is('*/group*')?'active':'' }}">
            <a class="nav-link" href="{{url('/admin/group')}}">Groups</a>
            </li>
            <li class="nav-item {{ Request::is('*/blog*')?'active':'' }}">
              <a class="nav-link" href="{{url('/admin/blog')}}">Blogs</a>
            </li>
            <li class="nav-item {{ Request::is('*/page*')?'active':'' }}">
               <a class="nav-link" href="{{url('/admin/page')}}">Pages</a>
            </li>
            <li class="nav-item {{ Request::is('*/user*')?'active':'' }}">
               <a class="nav-link" href="{{url('/admin/user')}}">Members</a>
            </li>  
            <li class="nav-item dropdown {{ Request::is('*/setup*')?'active':'' }} {{ Request::is('*/menu*')?'active':'' }}">
               <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                 Config
               </a>
               <div class="dropdown-menu">
                 <a class="dropdown-item" href="#">Link 1</a>
                 <a class="dropdown-item" href="{{url('/admin/menu')}}">Setup menu</a>
                 <a class="dropdown-item" href="{{url('/admin/setup')}}">Configuration</a>
               </div>
             </li>
            {{-- <li class="nav-item {{ Request::is('*/setup*')?'active':'' }}">
               <a class="nav-link" href="{{url('/admin/setup')}}">Config</a>
            </li>     --}}
            <li class="nav-item {{ Request::is('*/review*')?'active':'' }}">
               <a class="nav-link" href="{{url('/admin/review')}}">Reviews</a>
            </li>            
            <li class="nav-item {{ Request::is('*/result*')?'active':'' }}">
               <a class="nav-link" href="{{url('/admin/result')}}">Results</a>
            </li>     
            <li class="nav-item {{ Request::is('*/league*')?'active':'' }}">
               <a class="nav-link" href="{{url('/admin/league')}}">Leagues</a>
            </li>

            <li class="nav-item">
               <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">{{ __('LogOut') }}</a>

               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
               </form>

            </li>
          </ul>
        </div>
      </div>
   </nav>
@endsection

@section('footer')
<footer class="py-5 bg-dark">
   <div class="container">
      <p class="m-0 text-center text-white">Xseries &copy;2019</p>
   </div>
   <!-- /.container -->
</footer>
@endsection



@section('notify')
<div style="z-index:1; position: absolute; top:12%; right:1%; left:70%;" id="alert-x">
   @if(count($errors)>0)
      @foreach($errors->all() as $error)
      <div class="alert alert-danger alert-dismissible fade show" data-auto-dismiss="5000">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <strong>Oh snap!!</strong> &nbsp; &nbsp; {{$error}}
      </div>
      @endforeach
   @endif
   @if(session('success'))
   <div class="alert alert-success alert-dismissible fade show" data-auto-dismiss="5000">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Well done!</strong>  &nbsp; &nbsp;  You successfully. {{session('success')}}
   </div>
   @endif
   @if(session('error'))
   <div class="alert alert-danger alert-dismissible fade show" data-auto-dismiss="5000">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Oh snap!!</strong> &nbsp; &nbsp; {{session('error')}}
   </div>      
   @endif
</div>
@endsection


{{-- @section('notify')
<div id="alert-100" style="position: absolute; top:8%; right:1%; left:70%;">
@if(count($errors)>0)
@foreach($errors->all() as $error)
<div style="right:0; text-align:center;" class="alert alert-danger page-alert">
   <button type="button" class="close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
   <strong>Oh snap!</strong> &nbsp; &nbsp; {{$error}}
</div>
    @endforeach
@endif

@if(session('success'))
<div style="right:0; text-align:center;" class="alert alert-success page-alert">
   <button type="button" class="close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
   <strong>Well done!</strong> You successfully. {{session('success')}}
</div>

@endif

@if(session('error'))
<div style="right:0; text-align:center;" class="alert alert-danger page-alert">
      <button type="button" class="close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
      <strong>Oh snap!</strong> {{session('error')}}
</div>

@endif
</div>
@endsection --}}
            <!------ Include the above in your HEAD tag ---------->
            
   {{-- <div class="page-alerts">
      <div class="alert alert-success page-alert" id="alert-1">
            <button type="button" class="close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <strong>Well done!</strong> You successfully read this important alert message.
      </div>
      <div class="alert alert-info page-alert" id="alert-2">
            <button type="button" class="close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <strong>Heads up!</strong> This alert needs your attention, but it's not super important.
      </div>
      <div class="alert alert-warning page-alert" id="alert-3">
            <button type="button" class="close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <strong>Warning!</strong> Best check yo self, you're not looking too good.
      </div>
      <div class="alert alert-danger page-alert" id="alert-4">
            <button type="button" class="close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <strong>Oh snap!</strong> Change a few things up and try submitting again.
      </div>
      <div class="alert alert-success page-alert" id="alert-5">
            <button type="button" class="close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <strong>Cool!</strong> This alert will close in 3 seconds. The data-delay attribute is in milliseconds.
      </div>
   </div> --}}

{{-- 
@if(count($errors)>0)
@foreach($errors->all() as $error)
<div class="card text-red alert alert-danger my-4 py-2 text-center">
   <div class="card-body" style="margin-top:25px; width:100%">
      {{$error}}
   </div>
</div>
    @endforeach
@endif

@if(session('success'))
<div class="card text-green alert alert-success my-4 py-2 text-center" style="margin-top:25px; width:100%">
   <div class="card-body ">
      {{session('success')}}
   </div>
</div>
@endif

@if(session('error'))
<div class="card text-red alert alert-danger my-4 py-2 text-center" style="margin-top:25px; width:100%">
   <div class="card-body">
      {{session('error')}}
   </div>
</div>
@endif --}}



