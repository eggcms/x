@extends('layouts.admin')
@include('layouts.admin-main')
@if($cmd=='edit')
   @section('content')
   <div class="card-body rounded mb-4">
      <div style="margin-bottom:15px;">
         <h1 class=" mylink mb-4">Edit Menu</h1>
         <div id="create">      
            <table style="width:100%">
               <tr>
                  <td style="width:40%;">
                     {!! Form::open(['action' => ['Admin\MenuController@update',$menu->id], 'method' => 'POST', 'enctype' =>'multipart/form-data']) !!}                    
                     <div class="form-group ">
                        <label for="title">menu title</label>
                        {{ Form::text('title',$menu->title,['class'=>'form-control ','placeholder'=>'Input menu title','required']) }}
                     </div>
                  </td>
                  <td>
                     <div class="form-group ">
                        <label for="slug">Links</label>
                        {{ Form::text('link',$menu->link,['class'=>'form-control ','placeholder'=>'Input menu links']) }}
                     </div>
                  </td>               
               </tr>
            </table>
            <div class="form-group">
               {{Form::hidden('_method','PUT')}}
               {{Form::submit('บันทึกข้อมูล',['class'=>'btn btn-success'])}}
               {{Form::button('&nbsp; ยกเลิก &nbsp;',['class'=>'btn btn-primary open_create'])}}
            </div>         
         </div>
         @csrf
         {{ Form::close() }}
         </form>    
   
      </div>

   </div>
@elseif($cmd=='index')
   @section('content')
   <div class="card-body rounded mb-4">
      <div style="margin-bottom:15px;">
         <h1 id="" class="open_create mylink mb-4">Ceate Menu</h1>
         <div id="create" style="display:none;">      
            <table style="width:100%">
               <tr>
                  <td style="width:40%;">
                     {!! Form::open(['action' => ['Admin\MenuController@store'], 'method' => 'POST', 'enctype' =>'multipart/form-data']) !!}                    
                     <div class="form-group ">
                        <label for="title">menu title</label>
                        {{ Form::text('title','',['class'=>'form-control ','placeholder'=>'Input menu title','required']) }}
                     </div>
                  </td>
                  <td>
                     <div class="form-group ">
                        <label for="slug">Links</label>
                        {{ Form::text('link','',['class'=>'form-control ','placeholder'=>'Input menu links']) }}
                     </div>
                  </td>               
               </tr>
            </table>
            <div class="form-group">
               {{Form::submit('บันทึกข้อมูล',['class'=>'btn btn-success'])}}
               {{Form::button('&nbsp; ยกเลิก &nbsp;',['class'=>'btn btn-primary open_create'])}}
            </div>         
         </div>
         @csrf
         {{ Form::close() }}
         </form>    
   
      </div>
      <table width="100%" style="text-align:center;">
         <tr>
            <th width="5%">#</th>
            <th style="text-align:left;">menu title</th>
            <th style="text-align:left;">Link</th>
            <th width="15%" colspan="2" style="text-align:center;">&nbsp;</th>

            <th width="5%">Status</th>
            <th width="5%">action</th>
         </tr>
         @if(count($menus)!=null)
         @foreach($menus as $menu)
   
         <tr class="hover">
            <td style="vertical-align:text-top">{{$menu->id}}</td>
            <td style="text-align:left;">
               <a href="{{Url('/admin/menu/'.$menu->id.'/edit')}}">{{$menu->title}}</a>
            </td style="text-align:left;">
            <td style="vertical-align:text-top; text-align:left;"><i class="small">{{$menu->link}}</i></td>
            @php
            if ($menu->status == 1) {
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

            <td style="text-align:center">
            @if ($menu->orders == 1)
            <span class="small" style="text-decoration: line-through; color:#999">&nbsp; ขึ้น &nbsp; </span>
            @else
               {!! Form::open(['action'=>['Admin\MenuController@update',$menu->id],'method'=>'POST', ]) !!}
               {!! Form::hidden('_method', 'PUT')!!}
               {!!Form::hidden('switch','oup')!!}
               {!! Form::submit(' &nbsp; ขึ้น &nbsp; ',['class'=>'btn border-0 btn-outline-primary pt-1 pb-1']) !!}
               @csrf
               {!! Form::close() !!}
            @endif
            </td>
            <td style="text-align:center">
               @if ($menu->orders == count($menus))
               <span class="small" style="text-decoration: line-through; color:#999">&nbsp; ลง &nbsp; </span>
               @else
                  {!! Form::open(['action'=>['Admin\MenuController@update',$menu->id],'method'=>'POST', ]) !!}
                  {!! Form::hidden('_method', 'PUT')!!}
                  {!!Form::hidden('switch','odown')!!}
                  {!! Form::submit(' &nbsp; ลง &nbsp; ',['class'=>'btn border-0 btn-outline-primary pt-1 pb-1']) !!}
                  @csrf
                  {!! Form::close() !!}
               @endif
            </td>

            <td style="vertical-align:text-top">                  
               {!! Form::open(['action'=>['Admin\MenuController@update',$menu->id],'method'=>'POST', ]) !!}
               {!! Form::hidden('_method', 'PUT')!!}
               {!!Form::hidden('switch','status')!!}
               {!! Form::submit(' &nbsp; '.$change.' &nbsp; ',['class'=>'btn border-0 '.$btn.' pt-1 pb-1']) !!}
               @csrf
               {!! Form::close() !!}          
            </td>
            <td style="vertical-align:text-top">
               {!! Form::open(['action'=>['Admin\MenuController@destroy',$menu->id],'method'=>'POST', ]) !!}
               {!! Form::hidden('_method', 'DELETE')!!}
               {!! Form::submit(' &nbsp; ลบ &nbsp; ',['class'=>'btn border-0 btn-outline-danger pt-1 pb-1','onclick'=>"return confirm('ลบบทความ #$menu->id แน่ใจ?');"]) !!}
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
   @endsection
   @endif
