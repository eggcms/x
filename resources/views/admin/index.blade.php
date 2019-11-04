@extends('layouts.admin')
@include('layouts.admin-main')
@section('content')
@if(session('status'))
   <div class="alert alert-success" role="alert">
         {{ session('status') }}
   </div>
@endif
@endsection
   
@section('box-show')
<div class="row align-items-center my-5">
   <div class="col-lg-7">
      <img class="img-fluid rounded mb-4 mb-lg-0" src="{{asset('img/coding.png')}}" alt="">
   </div>
   <div class="col-lg-5">
      <h1 class="font">Api System</h1>
      <p>กำหนดการปล่อย Api จำนวน 0 </p>
      <p class="small">ยังไม่มีข้อมูลในการปล่อยใช้งาน Api</p>
      <a class="btn btn-primary" href="#">รายละเอียด</a>
   </div>
</div>
@endsection

@section('box-3')
    <!-- Content Row -->
    <div class="row">
         <div class="col-md-4 mb-5">
           <div class="card h-100">
             <div class="card-body">
               <h2 class="card-title">Group Controller</h2>
               @php
                   $groups=DB::table('groups')->get();
               @endphp
               <p class="small card-text">
                หมวดในการแสดงบทความทั้งหมด {{count($groups)}} หมวด
                <ul>
                   @foreach($groups as $group)
                  <li class="small"> หมวด {{$group->title}}</li>
                   @endforeach
                </ul>
               </p>
             </div>
             <div class="card-footer">
               <a href="{{url('/admin/group')}}" class="btn btn-primary btn-sm">รายละเอียด</a>
             </div>
           </div>
         </div>
         <!-- /.col-md-4 -->
         <div class="col-md-4 mb-5">
           <div class="card h-100">
             <div class="card-body">
               <h2 class="card-title">Blog Controller</h2>
               @php
                   $blogs=DB::table('blogs')->orderBy('id','desc')->take(5)->get();
               @endphp
               <p class="small card-text">
                บทความใหม่
                <ul>
                   @foreach($blogs as $blog)
                   <li class="small">{{$blog->title}}</li>
                   @endforeach
                </ul>
               </p>
             </div>
             <div class="card-footer">
               <a href="{{url('/admin/blog')}}" class="btn btn-primary btn-sm">รายละเอียด</a>
             </div>
           </div>
         </div>
         <!-- /.col-md-4 -->
         <div class="col-md-4 mb-5">
           <div class="card h-100">
             <div class="card-body">
               <h2 class="card-title">Page Controller</h2>
               @php
                   $pages=DB::table('pages')->get();
               @endphp
               <p class="small card-text">
                มีการสร้างหน้าเพจทั้งหมด {{count($pages)}} เพจ
                <ul>
                   @foreach($pages as $page)
                   <li class="small">{{$page->title}}</li>
                   @endforeach
                </ul>
               </p>
             </div>
             <div class="card-footer">
             <a href="{{url('/admin/page')}}" class="btn btn-primary btn-sm">รายละเอียด</a>
             </div>
           </div>
         </div>
         <!-- /.col-md-4 -->
   
      </div>
      <!-- /.row -->
@endsection