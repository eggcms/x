@section('signup')
<div class="container">
   <div class="row">
      <div class="col-md p-0 my-3" style="background-color:#fff;">
         <div class="panel panel-info p-3" >
            <div class="panel-heading">
               <h1 class="text-success">สมัครสมาชิกผ่านหน้าเว็บ</h1>
            </div>     
            <div style="padding-top:10px" class="panel-body" >
               <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div> 
                  <form name="line-notify" class="form-horizontal" role="form" action="{{url('/api/line')}}" method="post">     
                     <div class="input-group" style="margin-bottom: 25px">
                        <div class="input-group-prepend">
                           <span class="input-group-text">
                              <span class="fa fa-user"></span>
                           </span>                    
                        </div>
                        <input name="fullname" id="fullname" type="text" class="form-control" value="" placeholder="ชื่อ - นามสกุล" required> 
                     </div>
                     <div class="input-group" style="margin-bottom: 25px">
                     <div class="input-group-prepend">
                        <span class="input-group-text">
                           <span class="fas fa-mobile"></span>
                        </span>                    
                     </div>
                     <input name="phone" id="phone" type="text" class="form-control" maxlength="10" placeholder="เบอร์โทรศัพท์" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                  </div>
                  <div class="input-group" style="margin-bottom: 25px">
                     <div class="input-group-prepend">
                        <span class="input-group-text">
                           <span class="fab fa-line text-success"></span>
                        </span>                    
                     </div>
                     <input name="lineid" id="lineid" type="text" class="form-control" placeholder="lineID" required>
                  </div>
                  <div style="margin-top:10px" class="form-group">
                     <div class="col-sm-12 controls">
                        <button class="btn btn-success" name="submit" type="submit">ยืนยันข้อมูลการสมัคร</button>
                     </div>
                  </div>
               </form>
            </div>                     
         </div>  
      </div>
   </div>
</div>
@endsection   

@section('slider')
<div class="container">
      <div class="row">
         <div class="col-sm p-0 mt-3">
            <div id="demo" class="carousel slide" data-ride="carousel">
               <ul class="carousel-indicators">
                  <li data-target="#demo" data-slide-to="0" class="active"></li>
                  <li data-target="#demo" data-slide-to="1"></li>
                  <li data-target="#demo" data-slide-to="2"></li>
               </ul>
               <div class="carousel-inner">
                  <div class="carousel-item active " >
                     <div class="wrapper">
                        <a href="#"><img src="{{url('img/01.jpg')}}" alt="Los Angeles" width="100%"></a>
                     </div>
                     <div class="carousel-caption rounded" style="background-color:rgba(20, 20, 20, 0.7);">
                        <h3>Los Angeles</h3>
                        <p class="text-dark">We had such a great time in LA!</p>
                     </div>   
                  </div>
                  <div class="carousel-item">
                     <div class="wrapper">
                        <a href="#"><img src="{{url('img/02.jpg')}}" alt="Chicago" width="100%"></a>
                     </div>
                     <div class="carousel-caption rounded" style="background-color:rgba(20, 20, 20, 0.7);">
                        <h3>Chicago</h3>
                        <p>Thank you, Chicago!</p>
                     </div>   
                  </div>
                  <div class="carousel-item">
                     <div class="wrapper">
                        <a href="#"><img src="{{url('img/03.jpg')}}" alt="New York" width="100%"></a>
                     </div>
                     <div class="carousel-caption rounded" style="background-color:rgba(20, 20, 20, 0.7);">
                        <h3>New York</h3>
                        <p>We love the Big Apple!</p>
                     </div>   
                  </div>
               </div>
               <a class="carousel-control-prev" href="#demo" data-slide="prev">
                  <span class="carousel-control-prev-icon"></span>
               </a>
               <a class="carousel-control-next" href="#demo" data-slide="next">
                  <span class="carousel-control-next-icon"></span>
               </a>
            </div>      
         </div>
      </div>
   </div>
@endsection

@section('adv')
<div class="container p-1 bg-light">
   <div class="" style="display:block; overflow:hidden;">
      <img src="{{url('img/banner.gif')}}" width="100%" alt="banner">
      <img src="{{url('img/banner2.gif')}}" width="100%" style="margin-top:4px;" alt="banner">
   </div>
</div>
@endsection

@section('adv2')
<div class="container p-1 mt-2 bg-light">
   <div class="" style="display:block; overflow:hidden;">
      <img src="{{url('img/banner3.gif')}}" width="100%" alt="banner">
   </div>
</div>
@endsection

@section('adv3')
<div class="container p-1 bg-danger mb-3">
   <div class="" style="display:block; overflow:hidden;">
      <img src="{{url('img/register.png')}}" width="100%" alt="banner">
   </div>
</div>
@endsection

@section('nav')
<div class="container-fluid p-0">
   <div class="container">
      <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background:rgba(30, 30, 30, 0.9)">
         <div class="container">
            <a class="navbar-brand" href="{{url('/')}}" target="_blank">Start-X</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
               <ul class="navbar-nav ml-auto">
                  <li class="nav-item active">
                     <a class="nav-link" href="{{url('/')}}" style="font-size:17px;">หน้าแรก<span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="{{url('/all')}}" style="font-size:17px;">หมวดหมู่</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="/page/service" style="font-size:17px;">บริการของเรา</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="/page/about" style="font-size:17px;">เกี่ยวกับเรา</a>
                  </li>
               </ul>
            </div>
         </div>
      </nav>
   </div>
</div>
@endsection

@section('footer')
<footer class="py-3" style="background-color:rgba(10,10,10,0.75);">
   <div class="container">
      <div class="row">
         {{-- <div class="col-3 d-block"><img src="{{url('img/blackfire-io.png')}}" width="100%"></div>
         <div class="col-3 d-block"><img src="{{url('img/envoyer.png')}}" width="100%"></div>
         <div class="col-3 d-block"><img src="{{url('img/digitalocean.png')}}" width="100%"></div>
         <div class="col-3 d-block"><img src="{{url('img/forge.png')}}" width="100%"></div> --}}
      </div>
      <p class="m-0 text-center text-white">Copyright &copy;2019 powered by {{ config('app.name', 'Zean7M Dev') }}</p>
   </div>
</footer>
@endsection