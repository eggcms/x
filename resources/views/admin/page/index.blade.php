@extends('layouts.admin')
@include('layouts.admin-main')

@if($cmd=='edit')
@section('ckeditor')
<script src="https://cdn.ckeditor.com/4.12.1/standard-all/ckeditor.js"></script>
@endsection
   @section('content')
   <div class="card-body rounded mb-4">
      <div style="margin-bottom:15px;">
         
         <h1 class="mb-4"><a style="text-decoration:none;" href="{{url('/admin/page/')}}">Back to pages</a></h1>
         <div>      
            <table style="width:100%">
               <tr>
                  <td style="width:60%;">
                     {!! Form::open(['action' => ['Admin\PageController@update',$page->id], 'method' => 'POST', 'enctype' =>'multipart/form-data']) !!}                    
                     <div class="form-group ">
                        <label for="title">Page title</label>
                        {{ Form::text('title',$page->title,['class'=>'form-control ','required']) }}
                     </div>
                  </td>
                  <td>
                     <div class="form-group ">
                        <label for="slug">Slug</label>
                        {{ Form::text('slug',$page->slug,['class'=>'form-control ','placeholder'=>'','disabled']) }}
                     </div>
                  </td>               
               </tr>
               <tr>
                  <td style="width:60%;">
                     <div class="form-group ">
                        <label for="description">Page description</label>
                        {{ Form::text('description',$page->description,['class'=>'form-control ','required']) }}
                     </div>
                  </td>
                  <td>
                     <div class="form-group ">
                        <label for="tag">Tag</label>
                        {{ Form::text('tag',$page->tag,['class'=>'form-control ','placeholder'=>'']) }}
                     </div>
                  </td>   
               </tr>
               <tr>            
                  <td colspan='2'>
                     <div class="form-group">
                        <label for="contect">Content</label>
                        <textarea class="form-control" name="content" id="ckeditor" required="" oninvalid="this.setCustomValidity('Content is require.')"
                     oninput="setCustomValidity('')">{{$page->content}}</textarea>
                     </div>                  
                  
                  </td>
               </tr>
            </table>
            <div class="form-group">
               {{Form::submit('บันทึกข้อมูล',['class'=>'btn btn-success'])}}
               <a class="btn btn-primary" style="text-decoration:none;" href="{{url('/admin/page/')}}"> &nbsp; &nbsp; Cancel &nbsp; &nbsp; </a>
            </div>         
         </div>
         {!! Form::hidden('_method', 'PUT')!!}
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
@section('ckeditor')
<script src="https://cdn.ckeditor.com/4.12.1/standard-all/ckeditor.js"></script>
@endsection
@section('content')
<div class="card-body rounded mb-4">
   <div style="margin-bottom:15px;">
      <h1 id="" class="open_create_page mylink mb-4">Ceate Page</h1>
      <div id="create_page" style="display:none;">      
         <table style="width:100%">
            <tr>
               <td style="width:60%;">
                  {!! Form::open(['action' => ['Admin\PageController@store'], 'method' => 'POST', 'enctype' =>'multipart/form-data']) !!}                    
                  <div class="form-group ">
                     <label for="title">Page title</label>
                     {{ Form::text('title','',['class'=>'form-control ','placeholder'=>'Input Page title','required']) }}
                  </div>
               </td>
               <td>
                  <div class="form-group ">
                     <label for="slug">Slug</label>
                     {{ Form::text('slug','',['class'=>'form-control ','placeholder'=>'','disabled']) }}
                  </div>
               </td>               
            </tr>
            <tr>
               <td style="width:60%;">
                  <div class="form-group ">
                     <label for="description">Page description</label>
                     {{ Form::text('description','',['class'=>'form-control ','placeholder'=>'Input Page description','required']) }}
                  </div>
               </td>
               <td>
                  <div class="form-group ">
                     <label for="tag">Tag</label>
                     {{ Form::text('tag','',['class'=>'form-control ','placeholder'=>'']) }}
                  </div>
               </td>   
            </tr>
            <tr>            
               <td colspan='2'>
                  <div class="form-group">
                     <label for="contect">Content</label>
                     <textarea class="form-control" name="content" id="ckeditor" required="" oninvalid="this.setCustomValidity('Content is require.')"
                  oninput="setCustomValidity('')"></textarea>
                  </div>                  
               
               </td>
            </tr>
         </table>
         <div class="form-group">
            {{Form::submit('บันทึกข้อมูล',['class'=>'btn btn-success'])}}
            {{Form::button('&nbsp; ยกเลิก &nbsp;',['class'=>'btn btn-primary open_create_page'])}}
         </div>         
      </div>

      @csrf
      {{ Form::close() }}
      </form>    

   </div>
   <table width="100%" style="text-align:center;">
      <tr>
         <th width="5%">#</th>
         <th style="text-align:left;">Page title</th>
         <th width="15%">Create at</th>
         <th width="5%">Status</th>
         <th width="5%">action</th>
      </tr>
      @if(isset($pages) && count($pages))
      @foreach($pages as $page)

      <tr class="hover">
         <td style="vertical-align:text-top">{{$page->id}}</td>
         <td align="left">
            <a href="{{Url('/admin/page/'.$page->id.'/edit')}}">{{$page->title}}</a> &nbsp;(<i class="small">{{$page->description}}</i>)
         </td>
         <td style="vertical-align:text-top"><i class="small">{{DateThai($page->created_at)}}</i></td>
         @php
         if ($page->status == 1) {
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
      <td style="vertical-align:text-top">                  
         {!! Form::open(['action'=>['Admin\PageController@update',$page->id],'method'=>'POST', ]) !!}
         {!! Form::hidden('_method', 'PUT')!!}
         {!!Form::hidden('switch','status')!!}
         {!! Form::submit(' &nbsp; '.$change.' &nbsp; ',['class'=>'btn border-0 '.$btn.' pt-1 pb-1']) !!}
         @csrf
         {!! Form::close() !!}          
      </td>
      <td style="vertical-align:text-top">
         {!! Form::open(['action'=>['Admin\PageController@destroy',$page->id],'method'=>'POST', ]) !!}
         {!! Form::hidden('_method', 'DELETE')!!}
         {!! Form::submit(' &nbsp; ลบ &nbsp; ',['class'=>'btn border-0 btn-outline-danger pt-1 pb-1','onclick'=>"return confirm('ลบบทความ #$page->id แน่ใจ?');"]) !!}
         @csrf
         {!! Form::close() !!}  

            </td>
      </tr>
      @endforeach
      @else
      <tr>
         <td colspan="5">
            ยังไม่มีข้อมูลกิจกรรม
         </td>
      </tr>
      @endif
   </table>
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