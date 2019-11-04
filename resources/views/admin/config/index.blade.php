@extends('layouts.admin')
@include('layouts.admin-main')

@if($cmd=='index')
@section('content')
<div class="card-body rounded mb-4">
   <div style="margin-bottom:15px;">
      <h1 id="" class="open_create_setup mylink mb-4">Add config</h1>
      <div id="create_setup" style="display:none;">   
         <table style="width:100%">
            <tr>
               <td style="width:50%;">
                  {{ Form::open(['action' => ['Admin\SetupController@store'], 'method' => 'POST', 'enctype' =>'multipart/form-data']) }}
                  <div class="form-group ">
                     {{ Form::text('item','',['class'=>'form-control ','placeholder'=>'item','required']) }}
                  </div>
                  <div class="form-group ">
                     {{ Form::textarea('data','',['class'=>'form-control ','placeholder'=>'value','required','rows'=>'3']) }}
                  </div>
               </td>
               <td valign="top">
                  <div class="form-group ml-2">
                     {{Form::submit('บันทึกข้อมูล',['class'=>'btn btn-success'])}}
                     {{Form::button('&nbsp; ยกเลิก &nbsp;',['class'=>'btn btn-primary open_create_setup'])}}
                  </div>
                  @csrf
                  {{ Form::hidden('cfg', '1') }}
                  {{ Form::close() }}
               </td>
            </tr>
         </table>
      </div> 
      @php $cfgs=DB::table('configs')->orderBy('item','asc')->get(); @endphp
      <table width="85%">
         <tr>
            <th width="10%">ID</th>
            <th width="25%">Keys</th>
            <th>Value</th>
            <th width="10%" style="text-align:center">Action</th>
         </tr>
         @if(count($cfgs))
            @foreach($cfgs as $cfg)
            <tr class="hover" style="vertical-align:top;">
               <td>{{$cfg->id}}</td>
               <td><a href="{{Url('/admin/setup/'.$cfg->id.'/edit')}}">{{$cfg->item}}<a></td>
               <td>{{$cfg->data}}</td>
               <td style="vertical-align:text-top" align="center">
                  {!! Form::open(['action'=>['Admin\SetupController@destroy',$cfg->id],'method'=>'POST', ]) !!}
                  {!! Form::hidden('_method', 'DELETE')!!}
                  {!! Form::submit(' &nbsp; ลบ &nbsp; ',['class'=>'btn border-0 btn-outline-danger pt-1 pb-1','onclick'=>"return confirm('ลบบทความ #$cfg->id แน่ใจ?');"]) !!}
                  @csrf
                  {!! Form::close() !!}               
               </td>
            </tr>
            @endforeach
            @else
            <tr>
               <td colspan="4" style="text-align:center"><p class="py-4 text-danger">ไม่มีการตั้งค่า config</p></td>
            </tr>
            @endif

      </table>
   </div>
</div>
@endsection
@elseif($cmd=='edit')
@section('content')
<div class="card-body rounded mb-4">
   <div style="margin-bottom:15px;">
      <table style="width:100%">
         <tr>
            <td colspan="3">
               <h1 class="mb-4"><a style="text-decoration:none;" href="{{url('/admin/setup/')}}">Back to group</a></h1>
            </td>
         <tr>
            <td style="width:50%;">
               {{ Form::open(['action' => ['Admin\SetupController@update',$cfg->id], 'method' => 'POST', 'enctype' =>'multipart/form-data']) }}
               <div class="form-group ">
                  {{ Form::text('item',$cfg->item,['class'=>'form-control ','placeholder'=>'item','required']) }}
               </div>
               <div class="form-group ">
                  {{ Form::textarea('data',$cfg->data,['class'=>'form-control ','placeholder'=>'value','required','rows'=>'3']) }}
               </div>
            </td>
            <td valign="top">
               <div class="form-group ml-2">
                  <div class="form-group ml-2">
                     {{ Form::hidden('_method','PUT')}}
                     {{Form::submit('แก้ไขข้อมูล',['class'=>'btn btn-primary'])}}
                  </div>
                  <a href="{{url('/admin/setup')}}" class="ml-2 btn btn-success">&nbsp; &nbsp;ยกเลิก &nbsp; &nbsp;</a>
               </div>
               @csrf
               {{ Form::close() }}
            </td>
         </tr>    
      </table>
   </div>
</div>
@endsection
@endif
