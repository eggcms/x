@extends('layouts.index')
@include('layouts.index-inc')

@section('content')
@yield('adv')

<div class="container">
   <div class="row pt-3 px-3 mt-3 bg-light">
      @php
      echo '<h1 class="col-12"><span>'.get_groups(1).'</span> <span class="small" style="float:right;"><a href="'.get_link('all','1',get_groups(1)).'">More</a></span></h1>';
         $blogs=DB::table('blogs')->where('cid',1)->where('status',1)->orderBy('id','desc')->take(8)->get();
      @endphp
      @foreach($blogs as $blog)
      <div class="col-sm-3 col-md-3 mb-3 img-hover">
         <div class="pic">
            
            <a href="{{get_link('item',$blog->id,$blog->slug)}}">
               <img src="{{get_image($blog->image)}}" width="100%" height="150vmin">
            </a>
         </div>         
         <p class="text-muted mt-2" style="height:45px; overflow:hidden;"><a href="{{get_link('item',$blog->id,$blog->slug)}}">{{$blog->title}}</a></p>
      </div>
      @endforeach 
   </div>   
</div>

<div class="container">
   <div class="row pt-3 px-3 mt-3 bg-light">
      @php 
      echo '<h1 class="col-12"><span>'.get_groups(3).'</span> <span class="small" style="float:right;"><a href="'.get_link('all','3',get_groups(3)).'">More</a></span></h1>';
      $blogs=DB::table('blogs')->where('cid',3)->where('status',1)->orderBy('id','desc')->take(8)->get();
      @endphp
      @foreach($blogs as $blog)
         <div class="col-sm-3 col-md-3 mb-3 img-hover">
            <div class="pic">
               <a href="{{get_link('item',$blog->id,$blog->slug)}}"><img src="{{get_image($blog->image)}}" width="100%" height="150vmin"></a>
            </div>         
            <p class="text-muted mt-2" style="height:45px; overflow:hidden;"><a href="{{get_link('item',$blog->id,$blog->slug)}}">{{$blog->title}}</a></p>
         </div>
      @endforeach 
   </div>   
</div>

<div class="container">
   <div class="row pt-3 px-3 mt-3 bg-light">
      @php
      echo '<h1 class="col-12"><span>'.get_groups(4).'</span> <span class="small" style="float:right;"><a href="'.get_link('all','4',get_groups(4)).'">More</a></span></h1>';
         $blogs=DB::table('blogs')->where('cid',4)->where('status',1)->orderBy('id','desc')->take(8)->get();
      @endphp
      @foreach($blogs as $blog)
         <div class="col-sm-6 col-md-3 mb-3 img-hover">
            <div class="pic">
               <a href="{{get_link('item',$blog->id,$blog->slug)}}"><img src="{{get_image($blog->image)}}" width="100%" height="150"></a>
            </div>         
            <p class="text-muted mt-2" style="height:45px; overflow:hidden;"><a href="{{get_link('item',$blog->id,$blog->slug)}}">{{$blog->title}}</a></p>
         </div>
      @endforeach 
   </div>  
</div>

@yield('adv2')

<div class="container">   
   <div class="row pt-3 px-3 mt-3 bg-light">
      @php
      echo '<h1 class="col-12"><span>'.get_groups(2).'</span> <span class="small" style="float:right;"><a href="'.get_link('all','2',get_groups(2)).'">More</a></span></h1>';
         $blogs=DB::table('blogs')->where('cid',2)->where('status',1)->orderBy('id','desc')->take(8)->get();
      @endphp
      @foreach($blogs as $blog)
         <div class="col-sm-6 col-md-3 mb-3 img-hover">
            <div class="pic">
               <a href="{{get_link('item',$blog->id,$blog->slug)}}"><img src="{{get_image($blog->image)}}" width="100%" height="150">
               </a>
            </div>         
            <p class="text-muted mt-2" style="height:45px; overflow:hidden;"><a href="{{get_link('item',$blog->id,$blog->slug)}}">{{$blog->title}}</a></p>
         </div>
      @endforeach 
   </div>
</div>
@endsection