@extends('layouts.home')
@include('layouts.index-inc')

@if($cmd=='index')
@section('title')
{{ cfg('meta-title') }}
@endsection
@section('description')
{{ cfg('meta-description') }}
@endsection
@section('content')
@yield('adv')

   {{-- </div> --}}

   <div class="container">
      <div class="row">
         <div class="col-md-8 p-3 mt-3" style="background-color:#f0f0f0;">
            {!!youtube('https://www.youtube.com/embed/vLZcjhMuA1I')!!}
         </div>
         <div class="col-md-4 px-3 mt-3" style="background-color:#f0f0f0;">
            @yield('signup')
         </div>
      </div>
   </div>
   
   
   <div class="container">
      <div class="row pt-3 px-3 mt-3 bg-light">
         @php 
            echo '<h1 class="col-12 mb-3"><i class="fas fa-quote-left text-danger"></i> <span>'.get_groups(3).'</span> <i class="fas fa-quote-right text-danger"></i> <span class="small" style="float:right;"><a class="btn btn-primary py-1" href="'.get_link('all','3',get_groups(3)).'">ดูทั้งหมด</a></span></h1>';
         $blogs=DB::table('blogs')->where('cid',3)->where('status',1)->orderBy('id','desc')->take(3)->get();
         @endphp
         @foreach($blogs as $blog)
            <div class="col-sm-4 col-md-4 mb-3 img-hover">
               @if($blog->switch1!=1 && $blog->image)
               <div class="pic">
                  <a href="{{get_link('item',$blog->id,$blog->slug)}}">
                     <img src="{{get_image($blog->image)}}" width="100%" height="191vh">
                  </a>
               </div>         
               <p class="text-muted mt-2" style="height:50px; overflow:hidden;"><a href="{{get_link('item',$blog->id,$blog->slug)}}">{{$blog->title}}</a></p>
               @else
               {!! youtube($blog->clip) !!}
               <p class="text-muted mt-2" style="height:45px; overflow:hidden;"><a href="{{get_link('item',$blog->id,$blog->slug)}}">{{$blog->title}}</a></p>
               @endif
            </div>
         @endforeach 
      </div>   
   </div>

   <div class="container">
      <div class="row pt-3 px-3 mt-3 bg-light">
         @php
            echo '<h1 class="col-12 mb-3"><i class="fas fa-quote-left text-danger"></i> <span>'.get_groups(1).'</span> <i class="fas fa-quote-right text-danger"></i><span class="small" style="float:right;"><a class="btn btn-primary py-1" href="'.get_link('all','1',get_groups(1)).'">ดูทั้งหมด</a></span></h1>';
            $blogs=DB::table('blogs')->where('cid',1)->where('status',1)->orderBy('id','desc')->take(8)->get();
         @endphp
         @foreach($blogs as $blog)
         <div class="col-sm-3 col-md-3 mb-3 img-hover">
            <div class="pic">   
               <a href="{{get_link('item',$blog->id,$blog->slug)}}">
                  <img src="{{get_image($blog->image)}}" height="163px" height="163px">
               </a>
            </div>         
            <p class="text-muted mt-2" style="height:50px; overflow:hidden;"><a href="{{get_link('item',$blog->id,$blog->slug)}}">{{$blog->title}}</a></p>
         </div>
         @endforeach 
      </div>   
   </div>

   <div class="container">
      <div class="row pt-3 px-3 my-3 bg-light">
         @php
            echo '<h1 class="col-12 mb-3"><i class="fas fa-quote-left text-danger"></i> <span>'.get_groups(4).'</span> <i class="fas fa-quote-right text-danger"></i><span class="small" style="float:right;"><a class="btn btn-primary py-1" href="'.get_link('all','4',get_groups(4)).'">ดูทั้งหมด</a></span></h1>';
            $blogs=DB::table('blogs')->where('cid',4)->where('status',1)->orderBy('id','desc')->take(8)->get();
         @endphp
         @foreach($blogs as $blog)
            <div class="col-sm-6 col-md-3 mb-3 img-hover">
               <div class="pic">
                  <a href="{{get_link('item',$blog->id,$blog->slug)}}">
                     <img src="{{get_image($blog->image)}}" height="163px">
                  </a>
               </div>         
               <p class="text-muted mt-2" style="height:50px; overflow:hidden;"><a href="{{get_link('item',$blog->id,$blog->slug)}}">{{$blog->title}}</a></p>
            </div>
         @endforeach 
      </div>  
   </div>

   @yield('adv2')

   <div class="container">   
      <div class="row pt-3 px-3 mt-3 bg-light">
         @php
            echo '<h1 class="col-12 mb-3"><i class="fas fa-quote-left text-danger"></i> <span>'.get_groups(2).'</span> <i class="fas fa-quote-right text-danger"></i><span class="small" style="float:right;"><a class="btn btn-primary py-1" href="'.get_link('all','2',get_groups(2)).'">ดูทั้งหมด</a></span></h1>';
            $blogs=DB::table('blogs')->where('cid',2)->where('status',1)->orderBy('id','desc')->take(8)->get();
         @endphp
         @foreach($blogs as $blog)
            <div class="col-sm-6 col-md-3 mb-3 img-hover">
               <div class="pic">
                  <a href="{{get_link('item',$blog->id,$blog->slug)}}">
                     <img src="{{get_image($blog->image)}}" height="163px">
                  </a>
               </div>         
               <p class="text-muted mt-2" style="height:50px; overflow:hidden;"><a href="{{get_link('item',$blog->id,$blog->slug)}}">{{$blog->title}}</a></p>
            </div>
         @endforeach 
      </div>
   </div>
   @endsection



@elseif($cmd=='group')
@php $meta=get_meta($groupID); @endphp
@section('title')
{{$meta->title}}
@endsection
@section('description')
{{$meta->description}}
@endsection

@section('sidebar')
<div id="sidebar-scroll">
   <div style="display:block;">
      <div  class="img-hover">
         <div class="pic">
            <a href="#"><img src="{{url('img/popup-online.jpg')}}" width="100%"></a>
         </div>
      </div>
   </div>
   <div style="display:block;">
      <div class="p-0 my-4">
         <h2><i class="fas fa-rss text-danger"></i> อัพเดทล่าสุด</h2>
         @php
         $ups=DB::table('blogs')->where('id','!=',$groupID)->orderBy('id','Desc')->take(5)->get();
         @endphp
         <ul class="update">
         @foreach($ups as $up)
            <li style="padding:0 5px 5px;">
               <div>
                  <a href="{{get_link('item',$up->id,$up->slug)}}"><img src="{{get_image($up->image)}}">{{$up->title}}</a>
               </div>
            </li>
         @endforeach
         </ul>
      </div>
      <div class="img-hover">
         <div class="pic">
            <a href="#"><img src="{{url('img/online.jpg')}}" width="100%"></a>
         </div>
      </div>   

      <div style="display:block;">
         <div class="p-0 my-4">
            <h2><i class="fas fa-users text-danger"></i> ยอดนิยม</h2>
            @php
            $ups=DB::table('blogs')->where('id','!=',$groupID)->orderBy('visit','asc')->take(5)->get();
            @endphp
            <ul class="update">
            @foreach($ups as $up)
               <li style="padding:0 5px 5px;">
                  <div>
                     <a href="{{get_link('item',$up->id,$up->slug)}}"><img src="{{get_image($up->image)}}">{{$up->title}}</a>
                  </div>
               </li>
            @endforeach
            </ul>
         </div>
      </div>
   </div> 
</div>
@endsection

@section('content')
<div class="container">
   <div class="row">
      <div class="col-lg-8 bg-light p-4">
         <h1 class="mt-0">{{$meta->title}}</h1>
         <hr>
         <p><i class="fas fa-home text-danger"></i> <a href="{{url('/')}}">หน้าแรก</a> > <span class="small" style="color:#777;">{{$meta->title}}</span></p>
         <hr>
         @yield('adv2')
         <div class="container p-0">
            <div class="row pt-3 px-0 mt-3 bg-light">         
               @foreach($blogs as $blog)
               <div class="col-sm-4 col-md-4 mb-4 img-hover">
                  <div class="pic">
                     <a href="{{get_link('item',$blog->id,$blog->slug)}}"><img src="{{get_image($blog->image)}}" width="100%" height="150px"></a>
                  </div>         
                  <p class="text-muted mt-2" style="height:45px; overflow:hidden;"><a href="{{get_link('item',$blog->id,$blog->slug)}}">{{$blog->title}}</a></p>
                  <span class="small p-0" style="color:#999;">{{ DateThai($blog->created_at) }} / {{ $blog->visit }}views</span>
               </div>
               @endforeach 
            </div>   
         </div>
         <hr class="my-3">
         {{-- <blockquote class="blockquote mt-3">
            <footer class="blockquote-footer"><i class="fa fa-tag" aria-hidden="true"></i>
               <cite title="Source Title">hahaha</cite>
            </footer>
         </blockquote>
         <hr class="mb-3"> --}}
         @yield('adv')
         <hr>
         @php
            $rands=DB::table('blogs')->where('status', 1)->inRandomOrder()->limit(4)->get();
         @endphp
         <div class="row">
            <h1 class="p-3" style="width:100%">เรื่องแนะนำ</h1>
            @foreach($rands as $rand)
            <div class="col-md-6 col-sd-12 img-hover">
               <div class="pic">
                  <a href="{{get_link('item',$rand->id,$rand->slug)}}">
                     <img src="{{get_image($rand->image)}}" width="100%" height="200vh">
                  </a>
               </div>
               <p class="text-muted mt-2" style="height:50px; overflow:hidden;">
                  <a href="{{get_link('item',$rand->id,$rand->slug)}}">{{$rand->title}}</a>
               </p>
            </div>
            @endforeach
         </div>               
      </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4 bg-light py-4 px-4">
         @yield('sidebar')
      </div>
   </div>
</div>
@endsection


@elseif($cmd=='item')
@section('title')
   {{$blog->title}}
@endsection
@section('description')
   {{$blog->description}}
@endsection
@section('sidebar')
<div id="sidebar-scroll">
   <div style="display:block;">
      <div  class="img-hover">
         <div class="pic">
            <a href="#"><img src="{{url('img/popup-online.jpg')}}" width="100%"></a>
         </div>
      </div>
   </div>
   <div style="display:block;">
      <div class="p-0 my-4">
         <h2 style="border-bottom:4px solid #999; padding-bottom:8px;"><i class="fas fa-rss"></i> อัพเดทล่าสุด</h2>
         @php
            $ups=DB::table('blogs')->where('id','!=',$blog->id)->orderBy('id','desc')->take(5)->get();
         @endphp
         <ul class="update">
         @foreach($ups as $up)
            <li style="padding:0 5px 5px;">
            <div>
               <a href="{{get_link('item',$up->id,$up->slug)}}"><img src="{{get_image($up->image)}}">{{$up->title}}</a>
            </div>
            </li>
         @endforeach
         </ul>
      </div>
      <div class="img-hover">
         <div class="pic">
            <a href="#"><img src="{{url('img/online.jpg')}}" width="100%"></a>
         </div>
      </div>
   </div>
</div>
@endsection

@section('content')
@yield('adv2')
<div class="container mt-3">
   <div class="row">
      <div class="col-lg-8 bg-light p-4 pb-0">
         <h1>{{$blog->title}}</h1>
         <hr>
         @php $group=get_groups($blog->cid); @endphp
         <p><i class="fas fa-home text-danger"></i> <a href="{{url('/')}}">หน้าแรก</a> > <a href="{{get_link('all',$blog->cid,$group)}}">{{$group}}</a> > <span class="small" style="color:#999;">{{$blog->title}}</span></p>
         <hr>   
         <p class="small" style="text-align:right; color:#999;"><i class="far fa-eye"></i> {{ visit($blog->id,'add') }} views | <i class="fas fa-feather-alt"></i> {{DateThai($blog->created_at)}} / {{get_creator($blog->uid)}}</p>
         @if($blog->clip!=null)
            {!! youtube($blog->clip) !!}
         @else
            <img class="img-fluid" src="{{get_image($blog->image)}}" width="100%" alt="{{$blog->title}}">
         @endif
         <hr class="mt-5">
         <b>{{$blog->description}}</b>
         {!!$blog->content!!}
         @if($blog->clip!=null)
            <img class="img-fluid" src="{{get_image($blog->image)}}" width="100%" alt="{{$blog->title}}">
         @endif
         <hr class="mt-4">
         <blockquote class="blockquote mt-3">
            <footer class="blockquote-footer"><i class="fa fa-tag" aria-hidden="true"></i>
               <cite title="Source Title">{{tag_links($blog->tag)}}</cite>
            </footer>
         </blockquote>
         
         @php
            $rands=DB::table('blogs')->where('status', 1)->inRandomOrder()->limit(4)->get();
         @endphp
         <div class="row">
            <h1 class="p-3" style="width:100%">เรื่องแนะนำ</h1>
            @foreach($rands as $rand)
            <div class="col-md-6 col-sd-12 img-hover">
               <div class="pic">
                  <a href="{{get_link('item',$rand->id,$rand->slug)}}">
                     <img src="{{get_image($rand->image)}}" width="100%" height="200vh">
                  </a>
               </div>
               <p class="text-muted mt-2" style="height:50px; overflow:hidden;">
                  <a href="{{get_link('item',$rand->id,$rand->slug)}}">{{$rand->title}}</a>
               </p>
            </div>
            @endforeach
         </div>
         @yield('adv')

      </div>
      <!-- Sidebar Widgets Column -->
      <div class="col-md-4 bg-light py-4 px-4">
         @yield('sidebar')
      </div>
   </div>
</div>
@endsection


@elseif($cmd=='tags')
@php $meta=get_meta(); @endphp
@section('title')
{{$meta['title']}}
@endsection
@section('description')
{{$meta['description']}}
@endsection

@section('sidebar')
<div id="sidebar-scroll">
   <div style="display:block;">
      <div  class="img-hover">
         <div class="pic">
            <a href="#"><img src="{{url('img/popup-online.jpg')}}" width="100%"></a>
         </div>
      </div>
   </div>
   <div style="display:block;">
      <div class="p-0 my-4">
         <h2><i class="fas fa-rss"></i> อัพเดทล่าสุด</h2>
         @php
         $ups=DB::table('blogs')->where('status',1)->orderBy('id','Desc')->take(5)->get();
         @endphp
         <ul class="update">
         @foreach($ups as $up)
            <li style="padding:0 5px 5px;">
               <div>
                  <a href="{{get_link('item',$up->id,$up->slug)}}"><img src="{{get_image($up->image)}}">{{$up->title}}</a>
               </div>
            </li>
         @endforeach
         </ul>
      </div>
      <div class="img-hover">
         <div class="pic">
            <a href="#"><img src="{{url('img/online.jpg')}}" width="100%"></a>
         </div>
      </div>   

      <div style="display:block;">
         <div class="p-0 my-4">
            <h2><i class="fas fa-users"></i> ยอดนิยม</h2>
            @php
            $ups=DB::table('blogs')->where('status',1)->orderBy('visit','asc')->take(5)->get();
            @endphp
            <ul class="update">
            @foreach($ups as $up)
               <li style="padding:0 5px 5px;">
                  <div>
                     <a href="{{get_link('item',$up->id,$up->slug)}}"><img src="{{get_image($up->image)}}">{{$up->title}}</a>
                  </div>
               </li>
            @endforeach
            </ul>
         </div>
      </div>
   </div> 
</div>
@endsection

@section('content')
<div class="container">
   <div class="row">
      <div class="col-lg-8 bg-light p-4">
         <h1 class="mt-0">{{$tag}}</h1>
         <hr>
         <p><i class="fas fa-home text-danger"></i> <a href="{{url('/')}}">หน้าแรก</a> > <span class="small" style="color:#777;">{{$tag}}</span></p>
         <hr>
         @yield('adv2')
         <div class="container p-0">
            <div class="row pt-3 px-0 mt-3 bg-light">         
               @foreach($blogs as $blog)
               <div class="col-sm-4 col-md-4 mb-4 img-hover">
                  <div class="pic">
                     <a href="{{get_link('item',$blog->id,$blog->slug)}}"><img src="{{get_image($blog->image)}}" width="100%" height="150px"></a>
                  </div>         
                  <p class="text-muted mt-2" style="height:50px; overflow:hidden;"><a href="{{get_link('item',$blog->id,$blog->slug)}}">{{$blog->title}}</a></p>
                  <span class="small p-0" style="color:#999;">{{ DateThai($blog->created_at) }} / {{ $blog->visit }}views</span>
               </div>
               @endforeach 
            </div>   
         </div>
         {{-- <hr class="mt-4">
         <blockquote class="blockquote mt-3">
            <footer class="blockquote-footer"><i class="fa fa-tag" aria-hidden="true"></i>
               <cite title="Source Title">hahaha</cite>
            </footer>
         </blockquote> --}}
         <hr class="my-3">
         @yield('adv')
         <hr>
      </div>
      <!-- Sidebar Widgets Column -->
      <div class="col-md-4 bg-light py-4 px-4">
         @yield('sidebar')
      </div>
   </div>
</div>
@endsection
@endif

