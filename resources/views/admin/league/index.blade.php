@extends('layouts.admin')
@include('layouts.admin-main')

@if($cmd=='edit')
@section('content')
<div class="card-body rounded mb-4">
   <div style="margin-bottom:15px;">
      <h1 class="mb-4"><a style="text-decoration:none;" href="{{url('/admin/league/')}}">Back to leagues</a></h1>
      <div id="create_league">   
         <table style="width:70%;">
            <tr>
               <td>
                  {{ Form::open(['action' => ['Admin\LeagueController@update',$league->id], 'method' => 'POST', 'enctype' =>'multipart/form-data']) }}
                  <div class="form-group ">
                     <label for="title_th">ชื่อลีค ภาษาไทย</label>
                     {{ Form::text('title_th',$league->title_th,['class'=>'form-control ','placeholder'=>'ใส่ชื่อลีค ภาษาไทย','required']) }}
                  </div>
               </td>
               <td>
                  <div class="form-group ">
                     <label for="title_en">ชื่อลีค ภาษาอังกฤษ</label>
                     {{ Form::text('title_en',$league->title_en,['class'=>'form-control ','placeholder'=>'ใส่ชื่อลีค ภาษาอังกฤษ','required']) }}
                  </div>
               </td>
            </tr>
            <tr>
               <td colspan="2">
                  <div class="form-group mt-3 mb-5">
                     {{Form::submit('บันทึกข้อมูล',['class'=>'btn btn-success'])}}
                     <a href="{{url('admin/league')}}" class="btn btn-primary">&nbsp; ยกเลิก &nbsp;</a>
                  </div>
                  @csrf
                  {!! Form::hidden('_method', 'PUT')!!}
                  {{ Form::close() }}
               </td>
            </tr>
         </table>
      </div>
   </div>
</div>
@endsection


@elseif($cmd=='index')
   @section('content')
   <div class="card-body rounded mb-4">
      <div style="margin-bottom:15px;">
         <h1 id="" class="open_create_league mylink mb-4">Create League</h1>
         <div id="create_league" style="display:none;">   
            <table style="width:70%;">
               <tr>
                  <td>
                     {{ Form::open(['action' => ['Admin\LeagueController@store'], 'method' => 'POST', 'enctype' =>'multipart/form-data']) }}
                     <div class="form-group ">
                        <label for="title_th">ชื่อลีค ภาษาไทย</label>
                        {{ Form::text('title_th','',['class'=>'form-control ','placeholder'=>'ใส่ชื่อลีค ภาษาไทย','required']) }}
                     </div>
                  </td>
                  <td>
                     <div class="form-group ">
                        <label for="title_en">ชื่อลีค ภาษาอังกฤษ</label>
                        {{ Form::text('title_en','',['class'=>'form-control ','placeholder'=>'ใส่ชื่อลีค ภาษาอังกฤษ','required']) }}
                     </div>
                  </td>
               </tr>
               <tr>
                  <td colspan="2">
                     <div class="form-group mt-3 mb-5">
                        {{Form::submit('บันทึกข้อมูล',['class'=>'btn btn-success'])}}
                        {{Form::button('&nbsp; ยกเลิก &nbsp;',['class'=>'btn btn-primary open_create_league'])}}
                     </div>
                     @csrf
                     {{ Form::hidden('order', '0.4') }}
                     {{ Form::close() }}
                  </td>
               </tr>
            </table>
         </div>
         <div>
            <table style="width:75%">
               <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th colspan="2" style="width:18%; text-align:center;">Order</th>
                  <th style="width:8%; text-align:center;">Action</th>
               </tr>
               @foreach($leagues as $league)
               <tr class="hover">
                  <td>{{$league->id}}</td>
                  <td><a href="{{url('/admin/league/'.$league->id.'/edit')}}">{{$league->title_th}}</a> ( <i class="small">{{$league->title_en}}</i> )</td>
                  <td style="text-align:center">
                        @if ($league->orders == 1)
                        <span class="small" style="text-decoration: line-through; color:#999">&nbsp; ขึ้น &nbsp; </span>
                        @else
                           {!! Form::open(['action'=>['Admin\LeagueController@update',$league->id],'method'=>'POST', ]) !!}
                           {!! Form::hidden('_method', 'PUT')!!}
                           {!!Form::hidden('switch','oup')!!}
                           {!! Form::submit(' &nbsp; ขึ้น &nbsp; ',['class'=>'btn border-0 btn-outline-primary pt-1 pb-1']) !!}
                           @csrf
                           {!! Form::close() !!}
                        @endif
                     </td>
                     <td style="text-align:center">
                        @if ($league->orders == count($leagues))
                        <span class="small" style="text-decoration: line-through; color:#999">&nbsp; ลง &nbsp; </span>
                        @else
                           {!! Form::open(['action'=>['Admin\LeagueController@update',$league->id],'method'=>'POST', ]) !!}
                           {!! Form::hidden('_method', 'PUT')!!}
                           {!!Form::hidden('switch','odown')!!}
                           {!! Form::submit(' &nbsp; ลง &nbsp; ',['class'=>'btn border-0 btn-outline-primary pt-1 pb-1']) !!}
                           @csrf
                           {!! Form::close() !!}
                        @endif
                     </td>
                     <td>
                        {!! Form::open(['action'=>['Admin\LeagueController@destroy',$league->id],'method'=>'POST', ]) !!}
                        {!! Form::hidden('_method', 'DELETE')!!}
                        {!! Form::submit(' &nbsp; ลบ &nbsp; ',['class'=>'btn border-0 btn-outline-danger pt-1 pb-1','onclick'=>"return confirm('ลบบทความ #$league->id แน่ใจ?');"]) !!}
                        @csrf
                        {!! Form::close() !!}
                     </td>
               </tr>
               @endforeach
            </table>
         </div>
      </div>
   </div>
@endsection
@endif
