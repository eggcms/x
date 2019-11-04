@extends('layouts.admin')
@include('layouts.admin-main')

@if($cmd=='edit')
@section('ckeditor')
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
@endsection

@section('content')
   <div class="card-body rounded mb-4">
      <div style="margin-bottom:15px;">
      <h1 class="mb-4"><a style="text-decoration:none;" href="{{url('/admin/blog/')}}">Back to content</a></h1>
   {!! Form::open(['action' => ['Admin\BlogController@update',$blog->id], 'method' => 'POST', 'enctype' =>'multipart/form-data']) !!}   
   <div class="form-group">
      <table width="100%">
         <tr>
            <td width="60%">
               <div class="form-group">
                  <label for="title">Blog title</label>
                  <input type="text" name="title" class="form-control" required="" oninvalid="this.setCustomValidity('Title is require.')" 
               oninput="setCustomValidity('')" value="{{$blog->title}}">
               </div>
            </td>
            <td>
               <div class="ml-3 form-group">
                  <label for="title">Slug</label>
                  <input type="text" name="slug" class="form-control" value="{{$blog->slug}}" disabled>
               </div>
            </td>
         </tr>
      </table>
      <table>
         <tr>
            <td width="50%">
            <label for="group">Group</label>
            <select class="form-control" name="cid">
               <option value="0">เลือกหมวดหมู่</option>
                  @php
                  $gs=DB::table('groups')->where('type',0)->get();
                  foreach($gs as $g) {
                     if ($blog->cid==$g->id) {
                        echo '<option value="'.$g->id.'" selected>'.$g->title.'</option>'; }

                     else { echo '<option value="'.$g->id.'">'.$g->title.'</option>'; }
                  }
                  @endphp
               </select>            
            </td>
            <td>
               <div style="margin:30px 0 0 50px; ">
                  @php
                     $status=($blog->status==1)?'checked':'';
                  @endphp
                  <input type="checkbox" name="status" value="1" {{$status}}> เปิดแสดงบทความ &nbsp; &nbsp; 
               </div>
            </td>
         </tr>
      </table>
   </div>
   <div class="form-group">
      <label for="description">Description</label>
      <input type="text" name="description" class="form-control" value="{{$blog->description}}" required="" oninvalid="this.setCustomValidity('Description is require.')" oninput="setCustomValidity('')">
   </div>

   <div class="form-group">
      <label for="contect">Content</label>
      <textarea class="form-control" name="content" id="ckeditor" required="" oninvalid="this.setCustomValidity('Content is require.')"
   oninput="setCustomValidity('')">{!!$blog->content!!}</textarea>
   </div>
   <div class="form-group">
      <table style="width:100%">
         <tr>
            <td text-align="left" valign="top">
               <div class="pr-3 pt-0 pb-0">
                  <label for="tag">Tag</label>
                  <div style="text-align:left;">
                  <input type="text" id="tag" name="tag" class="form-control" value="{!!$blog->tag!!}" placeholder="tag, tag2, tag3,...">
                  </div>
               </div>
               

            </td>
            <td style="vertical-align: top">
               <label for="clip">Youtube</label>
               <div class="mt-0" style="text-align:right;">   
                  <div style="">
                  <input type="text" name="clip" class="form-control" value="{!!$blog->clip!!}" placeholder="ลิงค์วีดีโอ"></div>
                  <div style="margin-top:15px;">
                     @php
                        $switch1=($blog->switch1==1)?'checked':'';
                     @endphp
                     <input type="checkbox" name="switch1" value="1" {{$switch1}}>ใช้คลิปแสดงแทนภาพที่หน้าแรก
                  </div>
               </div>
            </td>
         </tr>
         <tr>
            <td colspan="2">
               @php
               $mtags=DB::table('groups')->where('type',1)->where('status',1)->get();
               @endphp
               <div id="myTag" class="mt-4 p-2 bg-white">
               @foreach($mtags as $mtag)
                  @if(strpos($blog->tag,$mtag->title) == false)
                     <input type="button" class="tAdd btn btn-sm btn-outline-secondary" value="{{$mtag->title}}" />
                  @endif
               @endforeach
               </div> 
            </td>
         </tr>
      </table>
   </div>
   <div class="form-group">
      <table style="width:100%">
         <tr>
            <td width="40%" text-align="left" valign="top">
               <script>
                  
                  </script>

               <div class="custom-file mt-3">
                  <input type="file" name="image" class="custom-file-input" id="customFileLang" lang="en">
                  <label class="custom-file-label" for="customFileLang">เลือกอัพโหลดรูปภาพ</label>
               </div>
            </td>   
            <td>
               <div class="ml-3 mt-3">
                  @php
                     if ($blog->image=='noimg.jpg') $storage='img/';
                     else $storage='/storage/images/';
                  @endphp
                     <img src="{{url($storage.$blog->image)}}" alt="" style="float:left;" width="150">
                  <span class="small"> &nbsp; {{$blog->image}}</span>
               </div>
            </td>
         </tr>
      </table>
   </div>                   
   <div class="form-group">
      {{Form::hidden('old_image',$blog->image)}}
      {{Form::hidden('_method','PUT')}}
      {{-- <button name="submit" class="btn btn-primary" style="width:150px; ">Add data</button> --}}
      {{Form::submit('บันทึกข้อมูล',['class'=>'btn btn-success'])}} 
      &nbsp; <a class="btn btn-secondary" style="text-decoration:none;" href="{{url('/admin/blog/')}}"> &nbsp; &nbsp; Cancel &nbsp; &nbsp; </a>
   </div>
   @csrf
   {{ Form::close() }}
   </form>         
   </div>
</div>
   <script type="text/javascript">
      CKEDITOR.replace('ckeditor', {
         filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
         filebrowserUploadMethod: 'form',
         height: 400
         });
   </script>
@endsection

@elseif($cmd=='index')
   @section('content')
   <div class="card-body rounded mb-4">
      <div style="margin-bottom:15px;">
         <h1 class="mb-4"><a style="text-decoration:none;" href="{{url('/admin/blog/create')}}">Create content</a></h1>
         <table width="100%">
            <tr>
               <th width="5%" style="text-align:center">#</th>
               <th>Contents</th>
               <th width="15%">Group</th>
               <th width="5%"  style="text-align:center">Status</th>
               <th width="5%"  style="text-align:center">Action</th>
            </tr>
            @foreach($blogs as $blog)
            <tr class="hover">
               <td style="vertical-align:text-top" align="center">{{$blog->id}}</td>
               <td>
                  <a href="{{Url('/admin/blog/'.$blog->id.'/edit')}}">
                  {!! $blog->title !!}</a>
               </td>
               <td style="vertical-align: top;">
                  @if($blog->cid!=0)
                     <i class="small">{{get_groups($blog->cid)}}</i>
                  @else 
                     <i class="small">ไม่มีการจัดในหมวดหมู่</i>
                  @endif
               </td>
               @php
               if ($blog->status == 1) {
                  $change='เปิด';
                  $status='0';
                  $btn='btn-outline-success';
               }
               else {
                  $change=' ปิด';
                  $status='1';
                  $btn='btn-outline-dark';
               }
               @endphp
               <td style="vertical-align:text-top" align="center">
                  {!! Form::open(['action'=>['Admin\BlogController@update',$blog->id],'method'=>'POST', ]) !!}
                  {!! Form::hidden('_method', 'PUT')!!}
                  {!!Form::hidden('switch','status')!!}
                  {!! Form::submit(' &nbsp; '.$change.' &nbsp; ',['class'=>'btn border-0 '.$btn.' pt-1 pb-1']) !!}
                  @csrf
                  {!! Form::close() !!}          
               </td>
               <td style="vertical-align:text-top" align="center">
                  {!! Form::open(['action'=>['Admin\BlogController@destroy',$blog->id],'method'=>'POST', ]) !!}
                  {!! Form::hidden('_method', 'DELETE')!!}
                  {!! Form::submit(' &nbsp; ลบ &nbsp; ',['class'=>'btn border-0 btn-outline-danger pt-1 pb-1','onclick'=>"return confirm('ลบบทความ #$blog->id แน่ใจ?');"]) !!}
                  @csrf
                  {!! Form::close() !!}                              
               </td>
            </tr>
            @endforeach
            <tr>
            <td colspan="5"><span style="margin-top:20px;float:right;">{{$blogs->links()}}</span></td>
            </tr>
         </table>

      </div>
   </div>
@endsection

@elseif($cmd=='create')
@section('ckeditor')
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
@endsection

@section('content')
   <div class="card-body rounded mb-4">
   {{ Form::open(['action' => ['Admin\BlogController@store'], 'method' => 'POST', 'enctype' =>'multipart/form-data']) }}
   <div class="form-group">
      <table width="100%">
         <tr>
            <td width="60%">
               <div class="form-group">
                  <label for="title">Blog title</label>
                  <input type="text" name="title" class="form-control" required="" oninvalid="this.setCustomValidity('Title is require.')" 
                  oninput="setCustomValidity('')">
               </div>
            </td>
            <td>
               <div class="ml-3 form-group">
                  <label for="title">Slug</label>
                  <input type="text" name="slug" class="form-control" value="" disabled>
               </div>
            </td>
         </tr>
      </table>
      <table>
         <tr>
            <td width="50%">
               <label for="group">Group</label>
               <select class="form-control" name="cid">
                  <option value="0">เลือกหมวดหมู่</option>
                  @php
                     $gs=DB::table('groups')->where('type',0)->get();
                     foreach($gs as $g) {
                        echo '<option value="'.$g->id.'">'.$g->title.'</option>';
                     }
                  @endphp
               </select>            
            </td>
            <td>
               <div style="margin:30px 0 0 50px; ">
                  <input type="checkbox" name="status" value="1" checked> เปิดแสดงบทความ
               </div>
            </td>
         </tr>
      </table>
   </div>
   <div class="form-group">
   <label for="description">Description</label>
      <input type="text" name="description" class="form-control" required="" oninvalid="this.setCustomValidity('Description is require.')" oninput="setCustomValidity('')">
   </div>

   <div class="form-group">
      <label for="contect">Content</label>
      <textarea class="form-control" name="content" id="ckeditor" required="" oninvalid="this.setCustomValidity('Content is require.')"
      oninput="setCustomValidity('')"></textarea>
   </div>
   <div class="form-group">
      <table style="width:100%">
         <tr>
            <td text-align="left" valign="top">
               <div class="pr-3 pt-0 pb-0">
                  <div style="text-align:left;">

                     {{-- <input class="input-tags form-control" type="text" name="tag" data-role="tagsinput"> --}}
                     <input type="text" id="tag" name="tag" class="form-control" placeholder="tag, tag2, tag3,...">
                  </div>
               </div>
            </td>
            <td>
               <div class="mt-0" style="text-align:right;">
                  <div style="">
                  <input type="text" name="clip" class="form-control" placeholder="ลิงค์วีดีโอ"></div>
                  <div style="margin-top:15px;">
                     <input type="checkbox" name="switch1" value="1">ใช้คลิปแสดงแทนภาพที่หน้าแรก
                  </div>
               </div>
            </td>
         </tr>
         <tr>
            <td colspan="2">
               @php
               $mtags=DB::table('groups')->where('type',1)->where('status',1)->get();
               @endphp
               <div id="myTag" class="mt-4 p-2">
               @if(count($mtags))
                  @foreach($mtags as $mtag)
                     <input type="button" class="tAdd btn btn-sm btn-outline-secondary" value="{{$mtag->title}}" />
                  @endforeach
               @endif
               </div> 
            </td>
         </tr>     
      </table>
   </div>
   <div class="form-group">
      <table style="width:100%">
         <tr>
            <td width="40%" text-align="left" valign="top">
               <div class="custom-file mt-3">
                  <input type="file" name="image" class="custom-file-input" id="customFileLang" lang="en">
                  <label class="custom-file-label" for="customFileLang">อัพโหลดรูปภาพ</label>
               </div>
            </td>   
            <td>
               <div class="ml-3 mt-3">
                  <img src="{{url('/img/noimg.jpg')}}" alt="" width="150">
               </div>
            </td>
         </tr>
    
      </table>
   </div>                   
   <div class="form-group">
      {{-- <button name="submit" class="btn btn-primary" style="width:150px; ">Add data</button> --}}
      {{Form::submit('บันทึกข้อมูล',['class'=>'btn btn-success'])}}
      <a class="btn btn-primary" style="text-decoration:none;" href="{{url('/admin/blog/')}}"> &nbsp; &nbsp; Cancel &nbsp; &nbsp; </a>
   </div>
   @csrf
   {{ Form::close() }}
   </form>         
   </div>
   <script type="text/javascript">
      CKEDITOR.replace('ckeditor', {
         filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
         filebrowserUploadMethod: 'form',
         height: 400
         });
   </script>
@endsection
@endif 
